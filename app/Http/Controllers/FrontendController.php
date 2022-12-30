<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use App\Models\Rule;
use App\Models\Vektor;
use App\Service\FuzzyService;
use App\Service\GeneticService;
use App\Service\GrabParameters;
use App\Service\TestFuzzy;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public $testFuzzy;
    public $fuzzyService;

    public function __construct(TestFuzzy $testFuzzy, FuzzyService $fuzzyService)
    {
        $this->testFuzzy = $testFuzzy;
        $this->fuzzyService = $fuzzyService;
    }


    public function index()
    {
        return view('frontend.newfrontend');
    }

    public function test()
    {
        // $arr = [
        //     'curah_hujan' => 393,
        //     'hari_hujan' => 25.5,
        //     'abj' => 0,
        //     'hi' => 0,
        // ];
        // $arr = [
        //     'curah_hujan' => 557,
        //     'hari_hujan' => 26,
        //     'abj' => 88.71,
        //     'hi' => 11.29,
        // ];
        // $arr = [
        //     'curah_hujan' => 387,
        //     'hari_hujan' => 23,
        //     'abj' => 91.42,
        //     'hi' => 8.5,
        // ];
        $arr = [
            'curah_hujan' => 378,
            'hari_hujan' => 27,
            'abj' => 88.71,
            'hi' => 11,
        ];
        $test = $this->testFuzzy->Fuzzy($arr);
        // $fuzzy =  $this->fuzzyService->Fuzzy($arr);
        // $res = [
        //     'test' => $test,
        //     'fuzzy' => $fuzzy,
        // ];
        return $test;
        // $statisticsJson = file_get_contents("https://method-371407.du.r.appspot.com/prob/?cr=0.2&mr=0.8&gen=1000");
        // $statisticsObj = json_decode($statisticsJson);
        // return $statisticsObj;
    }

    public function filter(Request $request)
    {
        $dataKli = Potensi::select(
            'tb_potensi.*',
            'tb_potensi.id_kecamatan',
            'tm_kecamatan.nama_kecamatan',
            'tb_fuzzy.nilai as hasilFuzzy',
            'tb_fuzzy.id_rule as ruleFuzzy',
            'tb_ga.nilai as hasilGa',
            'tb_ga.id_rule as ruleGa',
            'tb_vektor.rumah_positif as jumlahRumahPositif',
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_potensi.id_kecamatan')
            ->join('tb_fuzzy', 'tb_fuzzy.id', 'tb_potensi.id_fuzzy')
            ->join('tb_ga', 'tb_ga.id', 'tb_potensi.id_ga')
            ->join('tb_vektor', 'tb_vektor.id', 'tb_potensi.id_vektor')
            ->where('tb_potensi.triwulan', $request->triwulan)
            ->whereYear('tb_potensi.date', $request->date)
            ->get();

        $map = $dataKli->map(function ($item, $key) {
            return [
                'potensi' => $this->getPotensi($item->ruleGa),
                'triwulan' => $this->getTriwulan($item->triwulan),
                'kecamatan' => $item->nama_kecamatan,
                'kasus_dbd' => $this->getKasusDbd($item->id_vektor),
                'jumlahRumahPositif' => $item->jumlahRumahPositif,
            ];
        });

        return $map;
    }
    public function getKasusDbd($id_vektor)
    {
        return Vektor::select('kasus_dbd')->where('id', $id_vektor)->first()->kasus_dbd;
    }
    public function getPotensi($potensi)
    {
        return Rule::select('potensi')->where('id', $potensi)->first()->potensi;
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
