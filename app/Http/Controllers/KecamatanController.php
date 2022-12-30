<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $data = Kecamatan::paginate(5);
        return view('backend.kecamatan.index', compact('data'));
    }

    public function create()
    {
        return view('backend.kecamatan.create');
    }

    public function store(Request $request)
    {
        $nama_kecamatan = strtoupper($request->kecamatan);
        $cek = Kecamatan::select('nama_kecamatan')->pluck('nama_kecamatan')->toArray();
        if (in_array($nama_kecamatan, $cek)) {
            return redirect()->back()->with('info', "Data Sudah Ada");
        } else {
            try {
                $kecamatan = new Kecamatan();
                $kecamatan->nama_kecamatan = strtoupper($request->kecamatan);
                $kecamatan->save();
                return redirect()->back()->with('success', "Berhasi Menambahkan Data");
            } catch (\Exception $e) {
                return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->with('error', "Mohon Maaf terjadi Kesalahan");
            }
        }
    }

    public function edit($id)
    {
        try {
            $data = Kecamatan::find($id);
            return view('backend.kecamatan.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Terjadi Kesalahan");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $kecamatan = Kecamatan::find($id);
            $kecamatan->nama_kecamatan = strtoupper($request->kecamatan);
            $kecamatan->update();
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
            $data = Kecamatan::find($id);
            $data->delete();
            return redirect()->back()->with('success', "Data Berhasil Dihapus");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Data Masih Digunakan");
        }
    }
}
