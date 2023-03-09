<?php

namespace App\Service;


class FuzzyService
{

    public function Fuzzy($arr)
    {

        $ch = $this->CurahHujan($arr['curah_hujan']);
        $hh = $this->HariHujan($arr['hari_hujan']);
        $abj = $this->AngkaBebasJentik($arr['abj']);
        $kelembaban = $this->Kelembaban($arr['kelembaban'] == null ? 0 : $arr['kelembaban']);
        $suhu = $this->Suhu($arr['suhu'] == null ? 0 : $arr['suhu']);
        $fuzzyfikasi = array( 'CH' => implode(",",$ch), 'HH' => implode(",",$hh), 'ABJ' => implode(",",$abj), 'suhu' => implode(",",$suhu), 'kelembaban' => implode(",",$kelembaban));
        $rule = $this->RuleEvaluation($ch, $hh, $abj, $suhu, $kelembaban);
        return array('result' => $rule, 'fuzzyfikasi' => $fuzzyfikasi );
    }




    public function CurahHujan($ch)
    {
        $arr = array();
        // Fuzzyfikasi Rendah
        if ($ch <= 0 or $ch >= 200) {
            $arr['rendah'] = 0;
        } elseif ($ch >= 0 and $ch <= 100) {
            $arr['rendah'] = ($ch - 0) / 100;
        } elseif ($ch >= 100 and $ch <= 200) {
            $arr['rendah'] = (200 - $ch) / 100;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Sedang
        if ($ch <= 100 or $ch >= 300) {
            $arr['sedang'] = 0;
        } elseif ($ch >= 100 and $ch <= 200) {
            $arr['sedang'] = ($ch - 100) / 100;
        } elseif ($ch >= 200 and $ch <= 300) {
            $arr['sedang'] = (300 - $ch) / 100;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Tinggi
        if ($ch <= 280) {
            $arr['tinggi'] = 0;
        } elseif ($ch >= 280 and $ch <= 300) {
            $arr['tinggi'] = ($ch - 280) / 20;
        } elseif ($ch >= 300) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }
        return $arr;
    }

    public function HariHujan($hh)
    {
        $arr = array();
        // Fuzzyfikasi Rendah
        if ($hh <= 0 or $hh >= 10) {
            $arr['rendah'] = 0;
        } elseif ($hh >= 0 and $hh <= 5) {
            $arr['rendah'] = ($hh + 10) / 15;
        } elseif ($hh >= 5 and $hh <= 10) {
            $arr['rendah'] = (10 - $hh) / 5;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Sedang
        if ($hh <= 5 or $hh >= 15) {
            $arr['sedang'] = 0;
        } elseif ($hh >= 5 and $hh <= 10) {
            $arr['sedang'] = ($hh - 5) / 5;
        } elseif ($hh >= 10 and $hh <= 15) {
            $arr['sedang'] = (15 - $hh) / 5;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Tinggi
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
        // Fuzzyfikasi Rendah
        $arr = array();
        if ($abj >= 50) {
            $arr['rendah'] = 0;
        } elseif ($abj >= 35 and $abj <= 50) {
            $arr['rendah'] = (50 - $abj) / 15;
        } elseif ( $abj <= 35) {
            $arr['rendah'] = 1;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Sedang
        if ($abj <= 35 or $abj >= 90) {
            $arr['sedang'] = 0;
        } elseif ($abj >= 35 and $abj <= 50) {
            $arr['sedang'] = ($abj - 35) / 15;
        } elseif ($abj >= 60 and $abj <= 90) {
            $arr['sedang'] = (90 - $abj) / 30;
        } 

        // Fuzzyfikasi Tinggi
        if ($abj <= 78) {
            $arr['tinggi'] = 0;
        } elseif ($abj >= 78 and $abj <= 95) {
            $arr['tinggi'] = ($abj - 78) / 17;
        } elseif ($abj >= 95) {
            $arr['tinggi'] = 1;
        } 


        return $arr;
    }


    public function Kelembaban($kelembaban)
    {
        // Fuzzyfikasi Sedang
        $arr = array();
        if ($kelembaban >= 0 & $kelembaban <= 5) {
            $arr['rendah'] = 1;
        } elseif ($kelembaban >= 5 and $kelembaban <= 10) {
            $arr['rendah'] = (10 - $kelembaban) / 5;
        } elseif ($kelembaban >=  10) {
            $arr['rendah'] = 0;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Sedang
        if ($kelembaban <= 20 or $kelembaban >= 50) {
            $arr['sedang'] = 0;
        } elseif ($kelembaban >= 20 and $kelembaban <= 35) {
            $arr['sedang'] = ($kelembaban - 20) / 15;
        } elseif ($kelembaban >= 35 and $kelembaban <= 50) {
            $arr['sedang'] = (50 - $kelembaban) / 15;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Tinggi
        if ($kelembaban <= 40) {
            $arr['tinggi'] = 0;
        } elseif ($kelembaban >= 40 and $kelembaban <= 60) {
            $arr['tinggi'] = ($kelembaban - 60) / 20;
        } elseif ($kelembaban >= 60) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    public function Suhu($suhu)
    {

        $arr = array();
        // Fuzzyfikasi Rendah
        if ($suhu >= 20 ) {
            $arr['rendah'] = 0;
        } elseif ($suhu >= 10 and $suhu <= 20) {
            $arr['rendah'] = (20 - $suhu) / 10;
        } elseif ($suhu >=  0 and $suhu <=10) {
            $arr['rendah'] = 1;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Sedang
        if ($suhu <= 10 or $suhu >= 40) {
            $arr['sedang'] = 0;
        } elseif ($suhu >= 10 and $suhu <= 20) {
            $arr['sedang'] = ($suhu - 10) / 10;
        } elseif ($suhu >= 30 and $suhu <= 40) {
            $arr['sedang'] = (40 - $suhu) / 10;
        } elseif ($suhu >= 20 and $suhu <= 30) {
            $arr['sedang'] = 1;
        } else {
            return 'null';
        }

        // Fuzzyfikasi Tinggi
        if ($suhu <= 30) {
            $arr['tinggi'] = 0;
        } elseif ($suhu >= 30 and $suhu <= 40) {
            $arr['tinggi'] = ($suhu - 30) / 10;
        } elseif ($suhu >= 40) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    public function RuleEvaluation($ch, $hh, $abj, $suhu, $kelembaban)
    {
        //  POTENSI RENDAH
        $rule1 = array($ch['sedang'], $hh['tinggi'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a1 = round(min($rule1), 2);
        $newArr['rendah'][] = round(min($rule1), 2);
       

        //  POTENSI RENDAH
        $rule2 = array($ch['tinggi'], $hh['sedang'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a2 = round(min($rule2), 2);
        $newArr['sedang'][] = round(min($rule2), 2);

        // POTENSI RENDAH
        $rule3 = array($ch['tinggi'], $hh['tinggi'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a3 = round(min($rule3), 2);
        $newArr['tinggi'][] = round(min($rule3), 2);

        // POTENSI RENDAH
        $rule4 = array($ch['sedang'], $hh['tinggi'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a4 = round(min($rule4), 2);
        $newArr['rendah'][] = round(min($rule4), 2);
        
        // POTENSI SEDANG
        $rule5 = array($ch['tinggi'], $hh['tinggi'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a5 = round(min($rule5), 2);
        $newArr['rendah'][] = round(min($rule5), 2);
        

        // POTENSI SEDANG
        $rule6 = array($ch['rendah'], $hh['rendah'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a6 = round(min($rule6), 2);
        $newArr['rendah'][] = round(min($rule6), 2);

        // POTENSI SEDANG
        $rule7 = array($ch['rendah'], $hh['sedang'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a7 = round(min($rule7), 2);
        $newArr['sedang'][] = round(min($rule7), 2);
      

        // POTENSI SEDANG
        $rule8 = array($ch['sedang'], $hh['rendah'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a8 = round(min($rule8), 2);
        $newArr['rendah'][] = round(min($rule8), 2);
        
        // POTENSI SEDANG
        $rule9 = array($ch['sedang'], $hh['rendah'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a9 = round(min($rule9), 2);
        $newArr['rendah'][] = round(min($rule9), 2);
       


        // POTENSI SEDANG
        $rule10 = array($ch['rendah'], $hh['rendah'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a10 = round(min($rule10), 2);
        $newArr['rendah'][] = round(min($rule10), 2);
       

        // POTENSI TINGGI
        $rule11 = array($ch['sedang'], $hh['sedang'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a11 = round(min($rule11), 2);
        $newArr['sedang'][] = round(min($rule11), 2);
       

        // POTENSI TINGGI
        $rule12 = array($ch['sedang'], $hh['sedang'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a12 = round(min($rule12), 2);
        $newArr['sedang'][] = round(min($rule12), 2);
        

        // POTENSI TINGGI
        $rule13 = array($ch['rendah'], $hh['tinggi'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a13 = round(min($rule13), 2);
        $newArr['sedang'][] = round(min($rule13), 2);
        

        $rule14 = array($ch['rendah'], $hh['sedang'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a14 = round(min($rule14), 2);
        $newArr['rendah'][] = round(min($rule14), 2);


        // implikasi
        $arrAlpha = array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13, $a14);
        
        // SELECT INDEX OF RULE
        $selectRule = array_search(max($arrAlpha), $arrAlpha) + 1;

        $arrAtas = array(max($newArr['rendah']) * $this->SetZsum('rendah'), max($newArr['sedang']) * $this->SetZsum('sedang'), max($newArr['tinggi']) * $this->SetZsum('tinggi'));

        $arrBawah = array(max($newArr['rendah']) * $this->SetRvalue('rendah'), max($newArr['sedang']) * $this->SetRvalue('sedang'), max($newArr['tinggi']) * $this->SetRvalue('tinggi'));

        $result = round(array_sum($arrAtas) / array_sum($arrBawah));


        $arrResult = array($result, $selectRule, $arrAlpha, $arrAtas, $arrBawah);
        return $arrResult;


    }


    public function SetZsum($params)
    {
        // Rendah
        switch ($params) {
            case 'rendah':
                return 30;
                break;
            case 'sedang':
                return 100;
                break;
            case 'tinggi':
                return 520;
                break;
            default:
                # code...
                break;
        }
    }

 
    public function SetRvalue($params)
    {
        // Rendah
        switch ($params) {
            case 'rendah':
                return 3;
                break;
            case 'sedang':
                return 4;
                break;
            case 'tinggi':
                return 8;
                break;
            default:
                # code...
                break;
        }
    }
}
