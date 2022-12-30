<?php

namespace App\Service;

use App\Models\ParamGA;

class GeneticService
{

    public function Genetic($arr)
    {

        $ch = $this->CurahHujan($arr->curah_hujan);
        $hh = $this->HariHujan($arr->hari_hujan);
        $abj = $this->AngkaBebasJentik($arr->abj);
        $hi = $this->HouseIndex($arr->hi);


        $rule = $this->RuleEvaluation($ch, $hh, $abj, $hi);
        return $rule;
    }



    public function CurahHujan($ch)
    {
        // fitness curah hujan index ke 0 1 2
        $ft = explode(",", ParamGA::select('generation')->orderBy('fitness', 'desc')->first()->generation);
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($ch <= 0 or $ch >= $ft[0]) {
            $arr['rendah'] = 0;
        } elseif ($ch >= 0 and $ch <= 200) {
            $arr['rendah'] = ($ch + 10) / 210;
        } elseif ($ch >= 200 and $ch <= $ft[0]) {
            $arr['rendah'] = (400 - $ch) / ($ft[0] - 200);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($ch <= 200 or $ch >= $ft[1]) {
            $arr['sedang'] = 0;
        } elseif ($ch >= 200 and $ch <= 400) {
            $arr['sedang'] = ($ch - 200) / 200;
        } elseif ($ch >= 400 and $ch <= $ft[1]) {
            $arr['sedang'] = (600 - $ch) / ($ft[1] - 400);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi 126,198
        if ($ch <= 400) {
            $arr['tinggi'] = 0;
        } elseif ($ch >= 400 and $ch <= 600) {
            $arr['tinggi'] = ($ch - 400) / 200;
        } elseif ($ch >= 600) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    public function HariHujan($hh)
    {
        // fitness curah hujan index ke 3 4 5
        $ft = explode(",", ParamGA::select('generation')->orderBy('fitness', 'desc')->first()->generation);
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($hh <= 0 or $hh >= $ft[3]) {
            $arr['rendah'] = 0;
        } elseif ($hh >= 0 and $hh <= 5) {
            $arr['rendah'] = ($hh + 10) / 15;
        } elseif ($hh >= 5 and $hh <= $ft[3]) {
            $arr['rendah'] = (10 - $hh) / ($ft[3] - 5);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($hh <= 5 or $hh >= $ft[4]) {
            $arr['sedang'] = 0;
        } elseif ($hh >= 5 and $hh <= 10) {
            $arr['sedang'] = ($hh - 5) / 5;
        } elseif ($hh >= 10 and $hh <= $ft[4]) {
            $arr['sedang'] = (15 - $hh) / ($ft[4] - 10);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($hh <= 10) {
            $arr['tinggi'] = 0;
        } elseif ($hh >= 10 and $hh <= 15) {
            $arr['tinggi'] = ($hh - 10) / 5;
        } elseif ($hh >= 15) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }


    public function AngkaBebasJentik($abj)
    {
        // fitness abj ke 6 7 8
        $ft = explode(",", ParamGA::select('generation')->orderBy('fitness', 'desc')->first()->generation);
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($abj >= $ft[6]) {
            $arr['rendah'] = 0;
        } elseif ($abj >= 15 and $abj <= 50) {
            $arr['rendah'] = (50 - $abj) / 35;
        } elseif ($abj <= 15) {
            $arr['rendah'] = 1;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($abj <= 30 or $abj >= $ft[7]) {
            $arr['sedang'] = 0;
        } elseif ($abj >= 30 and $abj <= 50) {
            $arr['sedang'] = ($abj - 30) / 20;
        } elseif ($abj >= 50 and $abj <= $ft[7]) {
            $arr['sedang'] = (70 - $abj) / ($ft[7] - 50);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($abj <= 50) {
            $arr['tinggi'] = 0;
        } elseif ($abj >= 50 and $abj <= 90) {
            $arr['tinggi'] = ($abj - 50) / 40;
        } elseif ($abj >= 90) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    public function HouseIndex($hi)
    {
        // fitness abj ke 9 10 11
        $ft = explode(",", ParamGA::select('generation')->orderBy('fitness', 'desc')->first()->generation);
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($hi <= 0 or $hi >= $ft[9]) {
            $arr['rendah'] = 0;
        } elseif ($hi >= 0 and $hi <= 20) {
            $arr['rendah'] = ($hi + 10) / 30;
        } elseif ($hi >= 20 and $hi <= $ft[9]) {
            $arr['rendah'] = (20 - $hi) / ($ft[9] - 20);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($hi <= 30 or $hi >= $ft[10]) {
            $arr['sedang'] = 0;
        } elseif ($hi >= 20 and $hi <= 40) {
            $arr['sedang'] = ($hi - 20) / 20;
        } elseif ($hi >= 40 and $hi <= $ft[10]) {
            $arr['sedang'] = (60 - $hi) / ($ft[10] - 40);
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($hi <= 40) {
            $arr['tinggi'] = 0;
        } elseif ($hi >= 40 and $hi <= 60) {
            $arr['tinggi'] = ($hi - 40) / 20;
        } elseif ($hi >= 60) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }


    public function RuleEvaluation($ch, $hh, $abj, $hi)
    {
        //  POTENSI RENDAH
        $rule1 = array($ch['rendah'], $hh['rendah'], $abj['rendah'], $hi['rendah']);
        $a1 = min($rule1);
        $z1 = $this->SetZvalue('rendah', $a1);
        $res1 = $a1 * $z1;

        //  POTENSI RENDAH
        $rule2 = array($ch['rendah'], $hh['sedang'], $abj['tinggi'], $hi['rendah']);
        $a2 = min($rule2);
        $z2 = $this->SetZvalue('rendah', $a2);
        $res2 = $a2 * $z2;

        // POTENSI RENDAH
        $rule3 = array($ch['rendah'], $hh['tinggi'], $abj['tinggi'], $hi['rendah']);
        $a3 = min($rule3);
        $z3 = $this->SetZvalue('rendah', $a3);
        $res3 = $a3 * $z3;

        // POTENSI RENDAH
        $rule4 = array($ch['sedang'], $hh['tinggi'], $abj['tinggi'], $hi['rendah']);
        $a4 = min($rule4);
        $z4 = $this->SetZvalue('rendah', $a4);
        $res4 = $a4 * $z4;

        // POTENSI SEDANG
        $rule5 = array($ch['sedang'], $hh['sedang'], $abj['tinggi'], $hi['rendah']);
        $a5 = min($rule5);
        $z5 = $this->SetZvalue('sedang', $a5);
        $res5 = $a5 * $z5;

        // POTENSI SEDANG
        $rule6 = array($ch['tinggi'], $hh['tinggi'], $abj['tinggi'], $hi['rendah']);
        $a6 = min($rule6);
        $z6 = $this->SetZvalue('sedang', $a5);
        $res6 = $a6 * $z6;


        // POTENSI SEDANG
        $rule7 = array($ch['rendah'], $hh['sedang'], $abj['sedang'], $hi['rendah']);
        $a7 = min($rule7);
        $z7 = $this->SetZvalue('sedang', $a7);
        $res7 = $a7 * $z7;

        // POTENSI SEDANG
        $rule8 = array($ch['sedang'], $hh['tinggi'], $abj['tinggi'], $hi['rendah']);
        $a8 = min($rule8);
        $z8 = $this->SetZvalue('sedang', $a8);
        $res8 = $a8 * $z8;

        // POTENSI SEDANG
        $rule9 = array($ch['sedang'], $hh['sedang'], $abj['sedang'], $hi['sedang']);
        $a9 = min($rule9);
        $z9 = $this->SetZvalue('sedang', $a9);
        $res9 = $a9 * $z9;


        // POTENSI SEDANG
        $rule10 = array($ch['rendah'], $hh['tinggi'], $abj['tinggi'], $hi['sedang']);
        $a10 = min($rule10);
        $z10 = $this->SetZvalue('sedang', $a10);
        $res10 = $a10 * $z10;

        // POTENSI TINGGI
        $rule11 = array($ch['rendah'], $hh['sedang'], $abj['sedang'], $hi['tinggi']);
        $a11 = min($rule11);
        $z11 = $this->SetZvalue('tinggi', $a11);
        $res11 = $a11 * $z11;

        // POTENSI TINGGI
        $rule12 = array($ch['sedang'], $hh['sedang'], $abj['rendah'], $hi['sedang']);
        $a12 = min($rule12);
        $z12 = $this->SetZvalue('tinggi', $a12);
        $res12 = $a12 * $z12;

        // POTENSI TINGGI
        $rule13 = array($ch['sedang'], $hh['sedang'], $abj['rendah'], $hi['tinggi']);
        $a13 = min($rule13);
        $z13 = $this->SetZvalue('tinggi', $a13);
        $res13 = $a13 * $z13;


        // POTENSI TINGGI
        $rule14 = array($ch['sedang'], $hh['sedang'], $abj['sedang'], $hi['tinggi']);
        $a14 = min($rule14);
        $z14 = $this->SetZvalue('tinggi', $a14);
        $res14 = $a14 * $z14;


        // POTENSI TINGGI
        $rule15 = array($ch['tinggi'], $hh['sedang'], $abj['sedang'], $hi['sedang']);
        $a15 = min($rule15);
        $z15 = $this->SetZvalue('tinggi', $a15);
        $res15 = $a15 * $z15;


        // POTENSI TINGGI
        $rule16 = array($ch['tinggi'], $hh['tinggi'], $abj['rendah'], $hi['sedang']);
        $a16 = min($rule16);
        $z16 = $this->SetZvalue('tinggi', $a16);
        $res16 = $a16 * $z16;


        // POTENSI TINGGI
        $rule17 = array($ch['tinggi'], $hh['tinggi'], $abj['rendah'], $hi['tinggi']);
        $a17 = min($rule17);
        $z17 = $this->SetZvalue('tinggi', $a17);
        $res17 = $a17 * $z17;


        // POTENSI RENDAH
        $rule18 = array($ch['rendah'], $hh['rendah'], $abj['sedang'], $hi['rendah']);
        $a18 = min($rule18);
        $z18 = $this->SetZvalue('tinggi', $a18);
        $res18 = $a18 * $z18;

        // ARRAY OF ALPHA
        $arrAlpha = array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a14, $a15, $a16, $a16, $a17, $a18);
        // ARRAY OF Z*ALPHA
        $arrZxAlpha = array($res1, $res2, $res3, $res4, $res5, $res6, $res7, $res8, $res9, $res10, $res11, $res12, $res14, $res15, $res16, $res16, $res17, $res18);

        // SELECT INDEX OF RULE
        $selectRule = array_search(max($arrAlpha), $arrAlpha) + 1;


        $ZapredxAlpha = $res1 + $res2 + $res3 + $res4 + $res5 + $res6 + $res7 + $res8 + $res9 + $res10 + $res11 + $res12 + $res14 + $res15 + $res16 + $res16 + $res17 + $res18;
        $SigmaAlpha = $a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12 + $a14 + $a15 + $a16 + $a16 + $a17 + $a18;
        $result = ($ZapredxAlpha / $SigmaAlpha) * 100;

        // $arrResult = array($ZapredxAlpha, $SigmaAlpha);

        $arrResult = array($result, $selectRule);
        return $arrResult;
    }


    public function SetZvalue($params, $a)
    {
        // Rendah
        switch ($params) {
            case 'rendah':
                return 0.3 - ($a * 0.2);
                break;
            case 'sedang':
                return 0.4 - ($a * 0.2);
                break;
            case 'tinggi':
                return 0.5 - ($a * 0.2);
                break;
            default:
                # code...
                break;
        }
    }
}
