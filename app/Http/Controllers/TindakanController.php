<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tindakan::all();
        return view('backend.tindakan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tindakan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'potensi' => 'required|unique:tb_tindakan',
        ]);
        try {
            $data =  new Tindakan();
            $data->potensi = $request->potensi;
            $data->tindakan = $request->tindakan;
            $data->save();
            return redirect()->back()->withSuccess('Data Sudah Tersimpan');
        } catch (\Exception $e) {
            return $e;  
            return redirect()->back()->withErrors($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e;            
            return redirect()->back()->withError($e->getMessage());
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
        $data = Tindakan::findOrFail($id);
        return view('backend.tindakan.edit',compact('data'));
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
            $data =  Tindakan::findOrFail($id);
            $data->potensi = $request->potensi;
            $data->tindakan = $request->tindakan;
            $data->save();
            return redirect()->back()->withSuccess('Data Sudah Diperbarui');
        } catch (\Exception $e) {
            return $e;  
            return redirect()->back()->withErrors($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return $e;            
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
            $data = Tindakan::findOrFail($id);
            $data->delete();
            return redirect()->back()->with('success', "Data Berhasil Dihapus");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Data Masih Digunakan");
        }
    }
}
