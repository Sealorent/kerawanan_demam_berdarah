<?php

namespace App\Http\Controllers;

use App\Models\Kasus;
use App\Models\Potensi;
use App\Models\Rule;
use App\Models\Vektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index');
    }

    public function metode()
    {
        $rule = Rule::all();
        return view('backend.metode.index',compact('rule'));
    }

    public function getKasus(Request $request)
    {
        $data = Kasus::select('total_kasus as kasus', 'date')->whereYear('date', $request->tahun)->get();
        $map = $data->map(function ($item, $key) {
            return [
                'jumlah_kasus' => $item->kasus,
                'bulan' => $this->tgl_indo($item->date),
            ];
        });

        if(count($map) > 0){
            for ($i = 0; $i < count($map); $i++) {
                $arr['jumlah_kasus'][] = $map[$i]['jumlah_kasus'];
                $arr['bulan'][] = $map[$i]['bulan'];
            }
            return $arr;
        }else{
            return 'empty';
        }
        

    }

    public function getAllPotensi(Request $request)
    {
        $data = Potensi::select(DB::raw('count(tb_fuzzy.potensi) as jumlah, tb_fuzzy.potensi'))
            ->whereYear('date', $request->tahun)
            ->where('triwulan', $request->triwulan)
            ->join('tb_fuzzy', 'tb_fuzzy.id', 'tb_potensi.id_fuzzy')
            // ->join('tm_rule', 'tm_rule.id', 'tb_fuzzy.id_rule')
            ->groupBy('tb_fuzzy.potensi')
            ->get();
        
        if(count($data) > 0){
            for ($i = 0; $i < count($data); $i++) {
                $arr['potensi'][] = $data[$i]['potensi'];
                $arr['jumlah'][] = $data[$i]['jumlah'];
            }
            return $arr;
        }else{
            return 'empty';
        }
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $bulan[ (int)$pecahkan[1] ] ;
    }
}
