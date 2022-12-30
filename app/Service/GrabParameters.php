<?php

namespace App\Service;

use App\Models\Kecamatan;
use App\Service\FuzzyService;
use App\Models\Klimatologi;

class GrabParameters
{
    public $fuzzyService;

    public function __construct(FuzzyService $fuzzyService)
    {
        $this->fuzzyService = $fuzzyService;
    }


    public function GetValueParameters()
    {
        $data = Kecamatan::select('*')->join('tb_vektor', 'tb_vektor.id_kecamatan', 'tm_kecamatan.id')
            ->join('tb_klimatologi', 'tb_klimatologi.id_kecamatan', 'tm_kecamatan.id')
            ->get();

        // return $data;
        // $arr = [];

        foreach ($data as $key => $value) {
            $arr[] = $this->fuzzyService->Fuzzy($data[$key]);
        }
        return $arr;
    }
}
