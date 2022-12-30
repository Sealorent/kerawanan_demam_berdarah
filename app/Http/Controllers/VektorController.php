<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Vektor;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VektorController extends Controller
{

    public function triwulan()
    {
        $tri = array(
            1 => [
                "name" => "Triwulan 1",
                "value" => "Januari - Maret"
            ],
            2 => [
                "name" => "Triwulan 2",
                "value" => "April - Juni"
            ],
            3 => [
                "name" => "Triwulan 3",
                "value" => "Juli - September"
            ],
            4 => [
                "name" => "Triwulan 4",
                "value" => "Oktober - Desember"
            ],
        );

        return $tri;
    }

    public function getMonth($month)
    {
        switch ($month) {
            case 1:
            case 2:
            case 3:
                return 1;
                break;
            case 4:
            case 5:
            case 6:
                return 2;
                break;
            case 7:
            case 8:
            case 9:
                return 3;
                break;
            case 10:
            case 11:
            case 12:
                return 4;
                break;
            default:
                # code...
                break;
        }
    }

    public function searchTri($valTri)
    {
        $triwulan = $this->triwulan();
        foreach ($triwulan as $key => $value) {
            if ($valTri == $key) {
                return $value['value'];
            }
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $triwulan = $this->triwulan();
        $month = $request->triwulan != null ? $this->searchTri($request->triwulan) : $this->searchTri($this->getMonth(date('m')));
        $tri = $request->triwulan != null ? $request->triwulan : $this->getMonth(date('m'));
        $reqdate = $request->date ?: date('Y');
        $dataKli = Vektor::select(
            'tb_vektor.*',
            'tm_kecamatan.nama_kecamatan'
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_vektor.id_kecamatan')
            ->where('tb_vektor.triwulan', $tri)
            ->whereYear('tb_vektor.date', $reqdate)
            ->orderBy('tm_kecamatan.nama_kecamatan')->get();
        $data = array();
        // groupBy berdasarkan kecamatan
        $data = collect($dataKli)->groupBy('nama_kecamatan')->map(function ($item) {
            return $item;
        });
        $data = $this->pagina($data);
        if (!empty($request->triwulan) || !empty($request->date)) {
            $data->setPath('/admin-panel/vektor?date=' . $request->date . '&' . 'triwulan=' . $request->triwulan);
        } else {
            $data->setPath('/admin-panel/vektor');
        }
        return view('backend.vektor.index', compact('data', 'reqdate', 'triwulan', 'month'));
    }

    public function pagina($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        $triwulan = $this->triwulan();

        return view('backend.vektor.create', compact('kecamatan', 'triwulan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cek = Vektor::select('tb_vektor.id_kecamatan', 'tb_vektor.created_at')
            ->where('tb_vektor.id_kecamatan', $request->kecamatan)
            ->where('tb_vektor.triwulan', $request->triwulan)
            ->whereYear('tb_vektor.created_at', $request->tahun)
            ->get();
        if (count($cek) > 0) {
            return redirect()->back()->with('info', "Data Sudah Tersedia");
        } else {
            $request->validate([
                'kecamatan' => 'required',
                'tahun' => 'required',
            ], [
                'required' => ':Attribute harus diisi.',
            ], [
                'kecamatan' => 'Kecamatan',
                'tahun' => 'Tanggal',
            ]);
            try {
                $vektor = new Vektor();
                $vektor->id_kecamatan = $request->kecamatan;
                $vektor->triwulan = $request->triwulan;
                $vektor->rumah_diperiksa = $request->rumah_diperiksa;
                $vektor->rumah_positif = $request->rumah_positif;
                $vektor->hi = $request->hi;
                $vektor->abj = $request->abj;
                $vektor->kasus_dbd = $request->kasus_dbd;
                $vektor->date = $request->tahun . "-01-01";
                $vektor->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Vektor::find($id);
        $kecamatan = Kecamatan::all();
        return view('backend.vektor.edit', compact('data', 'kecamatan'));
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
            $vektor = Vektor::find($id);
            $vektor->rumah_diperiksa = $request->rumah_diperiksa;
            $vektor->rumah_positif = $request->rumah_positif;
            $vektor->hi = $request->hi;
            $vektor->abj = $request->abj;
            $vektor->kasus_dbd = $request->kasus_dbd;
            $vektor->update();
            return redirect()->back()->with('success', "Berhasi Merubah Data");
        } catch (\Exception $e) {
            // return $e;
            return redirect()->back()->with($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with($e->getMessage());
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
            $vektor = Vektor::find($id);
            $vektor->delete();
            return redirect()->back()->with('success', "Berhasil Menghapus Data");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
        }
    }
}
