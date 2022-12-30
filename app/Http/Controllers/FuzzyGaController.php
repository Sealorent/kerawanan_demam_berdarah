<?php

namespace App\Http\Controllers;

use App\Models\ParamGA;
use Illuminate\Http\Request;

class FuzzyGaController extends Controller
{
    public function index()
    {
        $data = paramGa::paginate(5);
        $fitnessTerbaik = paramGa::orderBy('fitness', 'desc')->first();
        return view('backend.FuzzzyGa.index', compact('data', 'fitnessTerbaik'));
    }

    public function store(Request $request)
    {
        // return $request;w
        $statisticsJson = file_get_contents("https://method-371407.du.r.appspot.com/prob/?cr=$request->cr&mr=$request->mr&gen=$request->gen&pop=$request->population");
        $statisticsObj = json_decode($statisticsJson);

        try {
            $data =  new ParamGA;
            $data->cr = $request->cr;
            $data->mr = $request->mr;
            $data->generation_rate = $request->gen;
            $data->population = $request->population;
            $data->generation = implode(',', $statisticsObj[0]);
            $data->fitness = $statisticsObj[1];
            $data->save();
            return redirect()->back()->withSuccess('Data Sudah Tersimpan');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function getUjiPopulasi()
    {
        $data = ParamGA::select('fitness', 'population')
            ->where('cr', 0.80)
            ->where('mr', 0.05)
            ->where('generation_rate', 20)
            ->limit(10)->get();
        for ($i = 0; $i < count($data); $i++) {
            $arr['fitness'][] = $data[$i]['fitness'];
            $arr['population'][] = $data[$i]['population'];
        }
        return $arr;
    }

    public function getUjiGenerasi()
    {
        $data = ParamGA::select('fitness', 'generation_rate')
            ->where('cr', 0.80)
            ->where('mr', 0.05)
            ->where('population', 60)
            ->limit(10)->get();
        // return $data;
        for ($i = 0; $i < count($data); $i++) {
            $arr['fitness'][] = $data[$i]['fitness'];
            $arr['generation'][] = $data[$i]['generation_rate'];
        }
        return $arr;
    }
}
