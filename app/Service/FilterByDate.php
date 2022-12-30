<?php

namespace App\Service;

use App\Models\Klimatologi;

class FilterByDate
{
    public function FilterKlimatologiByYear($year)
    {
        $dataKli = Klimatologi::select(
            'tb_klimatologi.*',
            'tb_klimatologi.id_kecamatan',
            'tm_kecamatan.nama_kecamatan'
        )
            ->join('tm_kecamatan', 'tm_kecamatan.id', 'tb_klimatologi.id_kecamatan')
            ->whereYear('tb_klimatologi.date', $year)
            ->orderBy('tm_kecamatan.nama_kecamatan')
            ->get();


        return $dataKli;
    }
}
