<?php

namespace App\Http\Controllers;

use App\Models\Fuzzy;
use App\Models\GA;
use App\Models\Kecamatan;
use App\Models\Klimatologi;
use App\Models\Potensi;
use App\Models\Vektor;
use App\Service\FuzzyService;
use App\Service\GeneticService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class PotensiController extends Controller
{

    public $fuzzyService;
    public $geneticService;

    public function __construct(FuzzyService $fuzzyService, GeneticService $geneticService)
    {
        $this->fuzzyService = $fuzzyService;
        $this->geneticService = $geneticService;
    }

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

    public function pagina($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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
        $reqyear = $request->year ?: date('Y');
        $dataKli = Potensi::select(
            'tb_potensi.*',
            'tb_potensi.id_kecamatan',
            'tm_kecamatan.nama_kecamatan',
            'tb_fuzzy.nilai as hasilFuzzy',
            'tb_fuzzy.id_rule as ruleFuzzy',
            'tb_ga.nilai as hasilGa',
            'tb_ga.id_rule as ruleGa'
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_potensi.id_kecamatan')
            ->join('tb_fuzzy', 'tb_fuzzy.id', 'tb_potensi.id_fuzzy')
            ->join('tb_ga', 'tb_ga.id', 'tb_potensi.id_ga')
            // ->join('tm_rule', 'tm_rule.id', 'tb_ga.id_rule')
            // ->join('tm_rule', 'tm_rule.id', 'tb_fuzzy.id_rule')
            ->where('tb_potensi.triwulan', $tri)
            ->whereYear('tb_potensi.date', $reqyear)
            ->orderBy('tm_kecamatan.nama_kecamatan')->get();

        $data = array();
        // groupBy berdasarkan nama ruas
        $data = collect($dataKli)->groupBy('nama_kecamatan')->map(function ($item) {
            return $item;
        });
        $data = $this->pagina($data);
        $data->setPath('/admin-panel/data-potensi/potensi');
        return view('backend.potensi.index', compact('data', 'reqyear', 'triwulan', 'month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::select('*')->orderBy('tm_kecamatan.nama_kecamatan')->get();
        return view('backend.potensi.create', compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Hasil Fuzzy array[0] = nilai,array[1] = id_rule
        $fuzzy = $this->fuzzyService->Fuzzy($request);
        $genetic = $this->geneticService->Genetic($request);
        $nilaiFuzzy = $fuzzy[0];
        $idRuleFuzzy = $fuzzy[1];
        $nilaiGenetic = $genetic[0];
        $idRuleGenetic = $genetic[1];

        $cek = Klimatologi::select('tb_klimatologi.id_kecamatan', 'tb_klimatologi.created_at')
            ->where('tb_klimatologi.id_kecamatan', $request->kecamatan)
            ->where('tb_klimatologi.triwulan', $request->triwulan)
            ->whereYear('tb_klimatologi.created_at', $request->tahun)
            ->get();

        $cek2 = Vektor::select('tb_vektor.id_kecamatan', 'tb_vektor.created_at')
            ->where('tb_vektor.id_kecamatan', $request->kecamatan)
            ->where('tb_vektor.triwulan', $request->triwulan)
            ->whereYear('tb_vektor.created_at', $request->tahun)
            ->get();

        if (count($cek) > 0 && count($cek2) > 0) {
            return redirect()->back()->with('info', "Data Sudah Tersedia");
        } else {
            $request->validate([
                'kecamatan' => 'required',
                'temperatur' => 'required',
                'curah_hujan' => 'required',
                'kelembaban' => 'required',
                'rumah_diperiksa' => 'required',
                'rumah_positif' => 'required',
                'kasus_dbd' => 'required',
                'triwulan' => 'required',
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

                //Vektor
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

                //Klimatologi
                $klimatologi = new Klimatologi();
                $klimatologi->id_kecamatan = $request->kecamatan;
                $klimatologi->triwulan = $request->triwulan;
                $klimatologi->temperatur = $request->temperatur;
                $klimatologi->curah_hujan = $request->curah_hujan;
                $klimatologi->kelembapan = $request->kelembaban;
                $klimatologi->hari_hujan = $request->hari_hujan;
                $klimatologi->date =  $request->tahun . "-01-01";
                $klimatologi->save();

                // Fuzzy
                $fuzzy = new Fuzzy();
                $fuzzy->id_rule = $idRuleFuzzy;
                $fuzzy->nilai = $nilaiFuzzy;
                $fuzzy->save();

                // Fuzzy GA
                $fuzzyGA = new GA();
                $fuzzyGA->id_rule = $idRuleGenetic;
                $fuzzyGA->nilai = $nilaiGenetic;
                $fuzzyGA->save();

                $potensi = new Potensi();
                $potensi->id_kecamatan = $request->kecamatan;
                $potensi->id_vektor = $vektor->id;
                $potensi->id_klimatologi = $klimatologi->id;
                $potensi->id_fuzzy = $fuzzy->id;
                $potensi->id_ga = $fuzzyGA->id;
                $potensi->date = $request->tahun . "-01-01";
                $potensi->triwulan = $request->triwulan;
                $potensi->save();
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

        $data = Potensi::find($id);
        $vektor = Vektor::find($data->id_vektor);
        $klimatologi = Klimatologi::find($data->id_klimatologi);
        $kecamatan = Kecamatan::all();
        return view('backend.potensi.show', compact('data', 'kecamatan', 'vektor', 'klimatologi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Potensi::find($id);
        $vektor = Vektor::find($data->id_vektor);
        $klimatologi = Klimatologi::find($data->id_klimatologi);
        $kecamatan = Kecamatan::all();
        return view('backend.potensi.edit', compact('data', 'kecamatan', 'vektor', 'klimatologi'));
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
        $potensi = Potensi::find($id);

        // return $request;
        $fuzzy = $this->fuzzyService->Fuzzy($request);
        $nilaiFuzzy = $fuzzy[0];
        $idRuleFuzzy = $fuzzy[1];

        $request->validate([
            'temperatur' => 'required',
            'curah_hujan' => 'required',
            'kelembaban' => 'required',
            'rumah_diperiksa' => 'required',
            'rumah_positif' => 'required',
            'kasus_dbd' => 'required',
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
            //Vektor
            $vektor = Vektor::find($potensi->id_vektor);
            $vektor->rumah_diperiksa = $request->rumah_diperiksa;
            $vektor->rumah_positif = $request->rumah_positif;
            $vektor->hi = $request->hi;
            $vektor->abj = $request->abj;
            $vektor->kasus_dbd = $request->kasus_dbd;
            $vektor->update();

            //Klimatologi
            $klimatologi = Klimatologi::find($potensi->id_klimatologi);
            $klimatologi->temperatur = $request->temperatur;
            $klimatologi->curah_hujan = $request->curah_hujan;
            $klimatologi->kelembapan = $request->kelembaban;
            $klimatologi->hari_hujan = $request->hari_hujan;
            $klimatologi->update();

            // Fuzzy
            $fuzzy = Fuzzy::find($potensi->id_fuzzy);
            $fuzzy->id_rule = $idRuleFuzzy;
            $fuzzy->nilai = $nilaiFuzzy;
            $fuzzy->update();

            // Fuzzy GA
            $fuzzyGA = GA::find($potensi->id_ga);
            $fuzzyGA->id_rule = $idRuleFuzzy;
            $fuzzyGA->nilai = $nilaiFuzzy;
            $fuzzyGA->update();


            $potensi->update();
            return redirect()->back()->with('success', "Data Berhasil Ditambahkan");
        } catch (\Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
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
        //
    }
}
