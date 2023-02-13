<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use App\Models\Vektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index');
    }

    public function getKasus(Request $request)
    {
        $data = Vektor::select(DB::raw('sum(kasus_dbd) as kasus, triwulan'))->whereYear('date', $request->tahun)->groupBy('triwulan')->get();
        // return $data;
        $map = $data->map(function ($item, $key) {
            return [
                'jumlah_kasus' => $item->kasus,
                'bulan' => $this->getTriwulan($item->triwulan),
            ];
        });
        for ($i = 0; $i < count($map); $i++) {
            $arr['jumlah_kasus'][] = $map[$i]['jumlah_kasus'];
            $arr['bulan'][] = $map[$i]['bulan'];
        }

        return $arr;
    }

    public function getAllPotensi(Request $request)
    {
        $data = Potensi::select(DB::raw('count(potensi) as jumlah, potensi'))
            ->whereYear('date', $request->tahun)
            ->where('triwulan', $request->triwulan)
            ->join('tb_fuzzy', 'tb_fuzzy.id', 'tb_potensi.id_fuzzy')
            ->join('tm_rule', 'tm_rule.id', 'tb_fuzzy.id_rule')
            ->groupBy('potensi')
            ->get();
        // return $data;
        for ($i = 0; $i < count($data); $i++) {
            $arr['potensi'][] = $data[$i]['potensi'];
            $arr['jumlah'][] = $data[$i]['jumlah'];
        }
        return $arr;
    }

    public function getTriwulan($triwulan)
    {
        switch ($triwulan) {
            case 1:
                return 'Januari - Maret';
                break;
            case 2:
                return 'April - Juni';
                break;
            case 3:
                return 'Juli - September';
                break;
            case 4:
                return 'Oktober - Desember';
                break;
            default:
                # code...
                break;
        }
    }
}
