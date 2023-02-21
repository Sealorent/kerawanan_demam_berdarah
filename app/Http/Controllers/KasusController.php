<?php

namespace App\Http\Controllers;

use App\Models\DetailKasus;
use App\Models\Kasus;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pagina($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    public function index(Request $request)
    {
        $month = explode('-', $request->date)[1] ?? date('m');
        $year = explode('-', $request->date)[0] == null ? date('Y') : explode('-', $request->date)[0];
        $dataKli = Kasus::select(
            'tb_kasus.*',
            'tb_kasus.id_kecamatan',
            'tm_kecamatan.nama_kecamatan'
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_kasus.id_kecamatan')
            ->whereMonth('tb_kasus.date', $month)
            ->whereYear('tb_kasus.date', $year)
            ->orderBy('tm_kecamatan.nama_kecamatan')->get();

        $data = array();
        // groupBy berdasarkan nama ruas
        $data = collect($dataKli)->groupBy('nama_kecamatan')->map(function ($item) {
            return $item;
        });
        $data = $this->pagina($data);
        $data->setPath('/admin-panel/data-master/kasus');
        return view('backend.kasus.index', compact('data', 'month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('backend.kasus.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Kasus::select('tb_kasus.id_kecamatan', 'tb_kasus.date')
            ->where('tb_kasus.date', date('Y-m-d', strtotime("01-" . $request->date)))
            ->where('tb_kasus.id_kecamatan', $request->kecamatan)
            ->get();
        if (count($cek) > 0) {
            return redirect()->back()->with('info', "Data Sudah Tersedia");
        } else {
            $request->validate([
                'kecamatan' => 'required',
                'date' => 'required',
            ], [
                'required' => ':Attribute harus diisi.',
                'max' => ':Attribute tidak boleh lebih dari :max karakter.',
                'string' => ':Attribute harus berupa karakter.',
                'int' => ':Attribute harus berupa angka.',
            ], [
                'kecamatan' => 'Kecamatan',
                'date' => 'Bulan & Tahun',
            ]);

            try {
                $kasus = new Kasus();
                $kasus->id_kecamatan = $request->kecamatan;
                $kasus->date = date('Y-m-d', strtotime("01-" . $request->date));
                $kasus->total_kasus = $request->total_kasus;
                $kasus->triwulan = $this->checkTriwulan(explode('-', $request->date)[0]);
                $kasus->save();

                foreach ($request->nama as $key => $value) {
                    $detailKasus = new DetailKasus();
                    $detailKasus->id_kasus = $kasus->id;
                    $detailKasus->nama_penderita = $request->nama[$key];
                    $detailKasus->longitude = $request->longitude[$key];
                    $detailKasus->latitude = $request->latitude[$key];
                    $detailKasus->save();
                }
                return redirect()->back()->with('success', "Data Berhasil Ditambahkan");
            } catch (\Exception $e) {
                return redirect()->back()->withError($e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError($e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kasus = Kasus::find($id);
        $kecamatan = Kecamatan::all();
        $detailKasus = DetailKasus::where('id_kasus', $id)->get();
        $lastId = DetailKasus::orderBy('id', 'desc')->first()->id;
        return view('backend.kasus.show', compact('kasus', 'detailKasus', 'kecamatan', 'lastId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kasus = Kasus::find($id);
        $kecamatan = Kecamatan::all();
        $detailKasus = DetailKasus::where('id_kasus', $id)->get();
        $lastId = DetailKasus::orderBy('id', 'desc')->first()->id;
        return view('backend.kasus.edit', compact('kasus', 'detailKasus', 'kecamatan', 'lastId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // $kasus = Kasus::find($id);
            for ($i=0; $i < count($request->id) ; $i++) { 
                $detailKasus = DetailKasus::find($request->id[$i]);
                $detailKasus->id_kasus = $id;
                $detailKasus->nama_penderita = $request->nama[$i];
                $detailKasus->longitude = (double)$request->longitude[$i];
                $detailKasus->latitude = (double)$request->latitude[$i];
                $detailKasus->update();
            }
            return redirect()->back()->with('success', "Data Berhasil Dirubah");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $kasus = Kasus::find($id);
            $kasus->delete();
            $kasus = DetailKasus::where('id_kasus', $id)->get();
            foreach ($kasus as $key => $value) {
                $delKasus = DetailKasus::find($kasus->id);
                $delKasus->delete();
            }
            return redirect()->back()->with('success', "Data Berhasil Dihapus");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function checkTriwulan($month)
    {
        if($month == '01' or $month == '02' or $month == '03'){
            return 1;
        }elseif($month == '04' or $month == '05' or $month == '06'){
            return 2;

        }elseif($month == '07' or $month == '08' or $month == '09'){
            return 3;
        }elseif($month == '10' or $month == '11' or $month == '12'){
            return 4;
        }
    }
}
