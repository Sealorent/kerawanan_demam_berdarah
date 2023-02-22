<?php

namespace App\Http\Controllers;

use App\Models\DetailKasus;
use App\Models\Fuzzy;
use App\Models\Kasus;
use App\Models\Klimatologi;
use App\Models\Potensi;
use App\Models\Rule;
use App\Models\Vektor;
use App\Service\FuzzyService;
use App\Service\GeneticService;
use App\Service\GrabParameters;
use App\Service\TestFuzzy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public $testFuzzy;
    public $fuzzyService;

    public function __construct(TestFuzzy $testFuzzy, FuzzyService $fuzzyService)
    {
        $this->testFuzzy = $testFuzzy;
        $this->fuzzyService = $fuzzyService;
    }

    public function getPresentase($tri, $year, $totalData)
    {
        $totalValid = DB::table('tb_potensi')
                ->selectRaw('count(potensi) as potensi')
                ->join('tb_fuzzy', 'tb_fuzzy.id', '=', 'tb_potensi.id')
                ->where('tb_potensi.triwulan','=', $tri)
                ->whereYear('tb_potensi.date','=', $year)
                ->where('tb_fuzzy.is_valid',true)
                ->pluck('potensi')
                ->first();
        // return $totalData;        
        return round($totalValid/$totalData * 100) ;

        
    }

    public function index()
    {
        return view('frontend.newfrontend');
    }

    public function test()
    {
       
           // get presentase kesesuaian
    return  DB::table('tb_potensi')
           ->select('tb_potensi.potensi_ir','tb_fuzzy.potensi')
           // ->selectRaw('count(tb_fuzzy.potensi) as potensi')
           ->join('tb_fuzzy', 'tb_fuzzy.id', '=', 'tb_potensi.id')
           ->where('tb_potensiz.potensi_ir','tb_fuzzy.potensi')
           ->where('tb_potensi.triwulan','=', 1)
           ->whereYear('tb_potensi.date','=',2021)
           ->get();


        $arr = [
            'curah_hujan' => 435,
            'hari_hujan' => 16,
            'hi' => 50,
            'abj' => 50,
        ];
        // // strr
       
        $test = $this->fuzzyService->Fuzzy($arr);
        return $test;
       
        $Rule = Rule::findOrFail($test[1]);
        return array($arr, $test[0], $test[1], $Rule);
        // $statisticsJson = file_get_contents("https://method-371407.du.r.appspot.com/prob/?cr=0.2&mr=0.8&gen=1000");
        // $statisticsObj = json_decode($statisticsJson);
        // return $statisticsObj;
    }

    public function nilaiPotensi($nilai)
    {
        if($nilai <= 20){
            $potensi = 'rendah';
        }elseif($nilai > 20 and $nilai <= 30 ){
            $potensi = 'sedang';
        }else{
            $potensi = 'tinggi';
        }

        return $potensi;
    }
    public function nilaiPotensiIr($nilai)
    {
        if($nilai <= 10){
            $potensi = 'rendah';
        }elseif($nilai > 10 and $nilai <= 30 ){
            $potensi = 'sedang';
        }else{
            $potensi = 'tinggi';
        }

        return $potensi;
    }
    
    
    public function updateFuzzy()
    {
        $data = Potensi::select('abj','kelembaban','suhu','curah_hujan','hari_hujan','id_fuzzy as id','ir','tb_potensi.id as id_potensi')
            ->join('tb_vektor', 'tb_potensi.id_vektor', 'tb_vektor.id')
            ->join('tb_klimatologi', 'tb_potensi.id_klimatologi', 'tb_klimatologi.id')
            ->get();

        for ($i = 0; $i < count($data); $i++) {
            $fuzzy = Fuzzy::find($data[$i]['id']);
            $fuzzy->nilai = $this->fuzzyService->Fuzzy($data[$i])[0];
            $fuzzy->potensi =$this->nilaiPotensi($this->fuzzyService->Fuzzy($data[$i])[0]);
            $fuzzy->is_valid = $this->nilaiPotensi($this->fuzzyService->Fuzzy($data[$i])[0]) == $this->nilaiPotensiIr($data[$i]['ir']) ? true : false;
            $fuzzy->update();
        }

    }

    public function filter(Request $request)
    {
        $dataKli = Potensi::select(
            'tb_potensi.*',
            'tb_potensi.id_kecamatan',
            'tm_kecamatan.nama_kecamatan',
            'tb_fuzzy.nilai as hasilFuzzy',
            'tb_fuzzy.id_rule as ruleFuzzy',
            'tb_fuzzy.potensi as potensi',
            'tb_vektor.ir as ir',
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
                'potensi' => $this->getPotensi($item->hasilFuzzy),
                'triwulan' => $this->getTriwulan($item->triwulan),
                'kecamatan' => $item->nama_kecamatan,
                'kasus_dbd' => $this->getKasusDbd($item->id_vektor),
                'arr_kasus' => $this->getKasusTriwulan($item->triwulan, $item->date, $item->id_kecamatan),
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
        if($potensi <= 10){
            return 'rendah';
        }elseif($potensi > 10 and $potensi <= 20){
            return 'sedang';
        }else{
            return 'tinggi';
        }
        // return Rule::select('potensi')->where('id', $potensi)->first()->potensi;
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
    public function getKasusTriwulan($triwulan,$date,$idKecamatan)
    {
             $longlat = Kasus::select('tb_detail_kasus.longitude','tb_detail_kasus.latitude')
                                    ->join('tb_detail_kasus','tb_detail_kasus.id_kasus', 'tb_kasus.id')
                                    ->where('tb_kasus.triwulan', $triwulan)
                                    ->where('tb_kasus.id_kecamatan', $idKecamatan)
                                    ->get();
            $arr = array();  
            foreach ($longlat as $key => $value) {
                $arr['longlat'][$key][] = $value['longitude'];
                $arr['longlat'][$key][] = $value['latitude'];
            }
            return $arr;
    }
}
