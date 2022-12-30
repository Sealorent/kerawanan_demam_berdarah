<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Klimatologi;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class KlimatologiController extends Controller
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

    public function index(Request $request)
    {
        $triwulan = $this->triwulan();
        $month = $request->triwulan != null ? $this->searchTri($request->triwulan) : $this->searchTri($this->getMonth(date('m')));
        $tri = $request->triwulan != null ? $request->triwulan : $this->getMonth(date('m'));
        $reqyear = $request->year ?: date('Y');
        $dataKli = Klimatologi::select(
            'tb_klimatologi.*',
            'tb_klimatologi.id_kecamatan',
            'tm_kecamatan.nama_kecamatan'
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_klimatologi.id_kecamatan')
            ->where('tb_klimatologi.triwulan', $tri)
            ->whereYear('tb_klimatologi.date', $reqyear)
            ->orderBy('tm_kecamatan.nama_kecamatan')->get();

        $data = array();
        // groupBy berdasarkan nama ruas
        $data = collect($dataKli)->groupBy('nama_kecamatan')->map(function ($item) {
            return $item;
        });
        $data = $this->pagina($data);
        $data->setPath('/admin-panel/klimatologi');
        return view('backend.klimatologi.index', compact('data', 'reqyear', 'triwulan', 'month'));
    }

    public function pagina($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function create()
    {
        $kecamatan = Kecamatan::select('*')->orderBy('tm_kecamatan.nama_kecamatan')->get();
        return view('backend.klimatologi.create', compact('kecamatan'));
    }

    public function store(Request $request)
    {
        $cek = Klimatologi::select('tb_klimatologi.id_kecamatan', 'tb_klimatologi.created_at')
            ->where('tb_klimatologi.id_kecamatan', $request->kecamatan)
            ->where('tb_klimatologi.triwulan', $request->triwulan)
            ->whereYear('tb_klimatologi.created_at', $request->tahun)
            ->get();
        if (count($cek) > 0) {
            return redirect()->back()->with('info', "Data Sudah Tersedia");
        } else {
            $request->validate([
                'kecamatan' => 'required',
                'temperatur' => 'required',
                'curah_hujan' => 'required',
                'kelembaban' => 'required',
            ], [
                'required' => ':Attribute harus diisi.',
                'max' => ':Attribute tidak boleh lebih dari :max karakter.',
                'string' => ':Attribute harus berupa karakter.',
                'int' => ':Attribute harus berupa angka.',
            ], [
                'kecamatan' => 'Kecamatan',
                'temperatur' => 'Temperatur',
                'curah_hujan' => 'Curah Hujan',
                'kelembaban' => 'Kelembaban',
            ]);
            try {
                $klimatologi = new Klimatologi();
                $klimatologi->id_kecamatan = $request->kecamatan;
                $klimatologi->triwulan = $request->triwulan;
                $klimatologi->temperatur = $request->temperatur;
                $klimatologi->curah_hujan = $request->curah_hujan;
                $klimatologi->kelembapan = $request->kelembaban;
                $klimatologi->hari_hujan = $request->hari_hujan;
                $klimatologi->date =  $request->tahun . "-01-01";
                $klimatologi->save();
                return redirect()->back()->with('success', "Data Berhasil Ditambahkan");
            } catch (\Exception $e) {
                return redirect()->back()->withError($e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError($e->getMessage());
            }
        }
    }

    public function edit($id)
    {
        $data = Klimatologi::find($id);
        $kecamatan = Kecamatan::all();
        return view('backend.klimatologi.edit', compact('data', 'kecamatan'));
    }

    public function update(Request $request, $id)
    {
        try {
            $klimatologi = Klimatologi::find($id);
            $klimatologi->temperatur = $request->temperatur;
            $klimatologi->curah_hujan = $request->curah_hujan;
            $klimatologi->hari_hujan = $request->hari_hujan;
            $klimatologi->kelembapan = $request->kelembapan;
            $klimatologi->update();
            return redirect()->back()->with('success', "Berhasi Merubah Data");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
        }
    }

    public function destroy($id)
    {
        try {
            $klimatologi = Klimatologi::find($id);
            $klimatologi->delete();
            return redirect()->back()->with('success', "Berhasil Menghapus Data");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
        }
    }
}
