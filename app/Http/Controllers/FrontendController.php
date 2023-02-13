<?php

namespace App\Http\Controllers;

use App\Models\Fuzzy;
use App\Models\Klimatologi;
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
        // kaliwates
        // $arr = [
        //     'curah_hujan' => 387,
        //     'hari_hujan' => 23,
        //     'abj' => 91.42,
        //     'hi' => 8.5,
        // ];
        // puger
        // $arr = [
        //     'curah_hujan' => 320.4,
        //     'hari_hujan' => 14.8,
        //     'abj' => 86.58,
        //     'hi' => 13.42,
        // ];
        // MAYANG
        // $arr = [
        //     'curah_hujan' => 378,
        //     'hari_hujan' => 27,
        //     'abj' => 86.42857142857143,
        //     'hi' => 13.571428571428571,
        // ];
        // GUMUK MAS
        // $arr = [
        //     'curah_hujan' => 274,
        //     'hari_hujan' => 21,
        //     'abj' => 80.88,
        //     'hi' => 19.12,
        // ];
        // WULUHAN
        // $arr = [
        //     'curah_hujan' => 341.66,
        //     'hari_hujan' => 19.77,
        //     'abj' => 86.14,
        //     'hi' => 13.86,
        // ];
        // // silo
        // $arr = [
        //     'curah_hujan' => 0,
        //     'hari_hujan' => 17.6,
        //     'abj' => 92,
        //     'hi' => 12.5,
        // ];
        // // KALISAT
        // $arr = [
        //     'curah_hujan' => 922,
        //     'hari_hujan' => 13.66,
        //     'hi' => 19.03,
        //     'abj' => 80.97,
        // ];

        // SUKORAMBI
        //
        $arr = [
            'curah_hujan' => 435,
            'hari_hujan' => 16,
            'hi' => 50,
            'abj' => 50,
        ];
        // // strr
        // $arr = [
        //     'curah_hujan' => 229,
        //     'hari_hujan' => 11,
        //     'hi' => 6,
        //     'abj' => 85,
        // ];
        $test = $this->fuzzyService->Fuzzy($arr);
        return $test;
        // $fuzzy =  $this->fuzzyService->Fuzzy($arr);
        // $res = [
        //     'test' => $test,
        //     'fuzzy' => $fuzzy,
        // ];
        $Rule = Rule::findOrFail($test[1]);
        return array($arr, $test[0], $test[1], $Rule);
        // $statisticsJson = file_get_contents("https://method-371407.du.r.appspot.com/prob/?cr=0.2&mr=0.8&gen=1000");
        // $statisticsObj = json_decode($statisticsJson);
        // return $statisticsObj;
    }

    public function updateFuzzy()
    {
        $data = Potensi::join('tb_vektor', 'tb_potensi.id_vektor', 'tb_vektor.id')
            ->join('tb_klimatologi', 'tb_potensi.id_klimatologi', 'tb_klimatologi.id')
            ->get();
        // return $data;
        // $arr = array();
        for ($i = 0; $i < count($data); $i++) {
            $fuzzy = $this->fuzzyService->Fuzzy($data[$i]);
            $nilaiFuzzy = $fuzzy[0];
            $idRuleFuzzy = $fuzzy[1];

            $fuzzy = Fuzzy::find(Potensi::select('id_fuzzy')->where('id', $data[$i]['id'])->pluck('id_fuzzy'));
            $fuzzy->id_rule = $idRuleFuzzy;
            $fuzzy->nilai = $nilaiFuzzy;
            // $potensi = Potensi::find($data[$i]['id']);
            $fuzzy->update();
            // $potensi->update();

            // $arr['fuzzy'][$i] = $fuzzy;
        }

        // return $arr;
    }

    public function filter(Request $request)
    {
        $dataKli = Potensi::select(
            'tb_potensi.*',
            'tb_potensi.id_kecamatan',
            'tm_kecamatan.nama_kecamatan',
            'tb_fuzzy.nilai as hasilFuzzy',
            'tb_fuzzy.id_rule as ruleFuzzy',
            'tb_vektor.rumah_positif as jumlahRumahPositif',
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_potensi.id_kecamatan')
            ->join('tb_fuzzy', 'tb_fuzzy.id', 'tb_potensi.id_fuzzy')
            ->join('tb_vektor', 'tb_vektor.id', 'tb_potensi.id_vektor')
            ->where('tb_potensi.triwulan', $request->triwulan)
            ->whereYear('tb_potensi.date', $request->date)
            ->get();

        $map = $dataKli->map(function ($item, $key) {
            return [
                'potensi' => $this->getPotensi($item->ruleFuzzy),
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
