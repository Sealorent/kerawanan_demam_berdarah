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
        // return array( array('CH' => $ch, 'hH' => $hh, 'ABJ' => $abj, 'suhu' => $suhu, 'kelembaban' => $kelembaban));
        $rule = $this->RuleEvaluation($ch, $hh, $abj, $suhu, $kelembaban);
        return $rule;
    }




    public function CurahHujan($ch)
    {
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($ch <= 0 or $ch >= 200) {
            $arr['rendah'] = 0;
        } elseif ($ch >= 0 and $ch <= 100) {
            $arr['rendah'] = ($ch - 0) / 200;
        } elseif ($ch >= 100 and $ch <= 200) {
            $arr['rendah'] = (200 - $ch) / 100;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($ch <= 100 or $ch >= 300) {
            $arr['sedang'] = 0;
        } elseif ($ch >= 100 and $ch <= 200) {
            $arr['sedang'] = ($ch - 100) / 100;
        } elseif ($ch >= 200 and $ch <= 300) {
            $arr['sedang'] = (300 - $ch) / 100;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
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
        // Defuzzyfikasi Rendah
        if ($hh <= 0 or $hh >= 10) {
            $arr['rendah'] = 0;
        } elseif ($hh >= 0 and $hh <= 5) {
            $arr['rendah'] = ($hh + 10) / 15;
        } elseif ($hh >= 5 and $hh <= 10) {
            $arr['rendah'] = (10 - $hh) / 5;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($hh <= 5 or $hh >= 15) {
            $arr['sedang'] = 0;
        } elseif ($hh >= 5 and $hh <= 10) {
            $arr['sedang'] = ($hh - 5) / 5;
        } elseif ($hh >= 10 and $hh <= 15) {
            $arr['sedang'] = (15 - $hh) / 5;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($hh < 10) {
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

        // Defuzzyfikasi Sedang
        if ($abj <= 35 or $abj >= 90) {
            $arr['sedang'] = 0;
        } elseif ($abj >= 35 and $abj <= 50) {
            $arr['sedang'] = ($abj - 35) / 25;
        } elseif ($abj >= 60 and $abj <= 90) {
            $arr['sedang'] = (90 - $abj) / 30;
        } 

        // Defuzzyfikasi Tinggi
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

        // Defuzzyfikasi Sedang
        if ($kelembaban <= 20 or $kelembaban >= 50) {
            $arr['sedang'] = 0;
        } elseif ($kelembaban >= 20 and $kelembaban <= 35) {
            $arr['sedang'] = ($kelembaban - 20) / 15;
        } elseif ($kelembaban >= 35 and $kelembaban <= 50) {
            $arr['sedang'] = (50 - $kelembaban) / 15;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($kelembaban <= 40) {
            $arr['tinggi'] = 0;
        } elseif ($kelembaban >= 40 and $kelembaban <= 60) {
            $arr['tinggi'] = ($kelembaban - 60) / 20;
        } elseif ($kelembaban >= 40) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    public function Suhu($suhu)
    {
        $arr = array();

        if ($suhu >= 20 ) {
            $arr['rendah'] = 0;
        } elseif ($suhu >= 10 and $suhu <= 10) {
            $arr['rendah'] = (10 - $suhu) / 5;
        } elseif ($suhu >=  10) {
            $arr['rendah'] = 0;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($suhu <= 10 or $suhu >= 40) {
            $arr['sedang'] = 0;
        } elseif ($suhu >= 10 and $suhu <= 20) {
            $arr['sedang'] = ($suhu - 10) / 10;
        } elseif ($suhu >= 30 and $suhu <= 40) {
            $arr['sedang'] = (30 - $suhu) / 10;
        } elseif ($suhu >= 20 and $suhu <= 30) {
            $arr['sedang'] = 1;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
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
        $z1 = $this->SetZvalue('rendah', $a1);
        $r1 = $this->SetRvalue('rendah') * $a1;
        $res1 = $a1 * $z1;

        //  POTENSI RENDAH
        $rule2 = array($ch['tinggi'], $hh['sedang'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a2 = round(min($rule2), 2);
        $newArr['sedang'][] = round(min($rule2), 2);
        $z2 = $this->SetZvalue('rendah', $a2);
        $r2 = $this->SetRvalue('rendah') * $a2;
        $res2 = $a2 * $z2;

        // POTENSI RENDAH
        $rule3 = array($ch['tinggi'], $hh['tinggi'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a3 = round(min($rule3), 2);
        $newArr['tinggi'][] = round(min($rule3), 2);
        $z3 = $this->SetZvalue('rendah', $a3);
        $r3 = $this->SetRvalue('rendah') * $a3;
        $res3 = $a3 * $z3;

        // POTENSI RENDAH
        $rule4 = array($ch['sedang'], $hh['tinggi'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a4 = round(min($rule4), 2);
        $newArr['rendah'][] = round(min($rule4), 2);
        $z4 = $this->SetZvalue('sedang', $a4);
        $r4 = $this->SetRvalue('sedang') * $a4;
        $res4 = $a4 * $z4;

        // POTENSI SEDANG
        $rule5 = array($ch['tinggi'], $hh['tinggi'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a5 = round(min($rule5), 2);
        $newArr['rendah'][] = round(min($rule5), 2);
        $z5 = $this->SetZvalue('sedang', $a5);
        $r5 = $this->SetRvalue('sedang') * $a5;
        $res5 = $a5 * $z5;

        // POTENSI SEDANG
        $rule6 = array($ch['rendah'], $hh['rendah'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a6 = round(min($rule6), 2);
        $newArr['rendah'][] = round(min($rule6), 2);
        $z6 = $this->SetZvalue('sedang', $a6);
        $r6 = $this->SetRvalue('sedang') * $a6;
        $res6 = $a6 * $z6;


        // POTENSI SEDANG
        $rule7 = array($ch['rendah'], $hh['sedang'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a7 = round(min($rule7), 2);
        $newArr['sedang'][] = round(min($rule7), 2);
        $z7 = $this->SetZvalue('sedang', $a7);
        $r7 = $this->SetRvalue('sedang') * $a7;
        $res7 = $a7 * $z7;

        // POTENSI SEDANG
        $rule8 = array($ch['sedang'], $hh['rendah'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a8 = round(min($rule8), 2);
        $newArr['rendah'][] = round(min($rule8), 2);
        $z8 = $this->SetZvalue('sedang', $a8);
        $r8 = $this->SetRvalue('sedang') * $a8;
        $res8 = $a8 * $z8;

        // POTENSI SEDANG
        $rule9 = array($ch['sedang'], $hh['rendah'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a9 = round(min($rule9), 2);
        $newArr['rendah'][] = round(min($rule9), 2);
        $z9 = $this->SetZvalue('sedang', $a9);
        $r9 = $this->SetRvalue('sedang') * $a9;
        $res9 = $a9 * $z9;


        // POTENSI SEDANG
        $rule10 = array($ch['rendah'], $hh['rendah'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a10 = round(min($rule10), 2);
        $newArr['rendah'][] = round(min($rule10), 2);
        $z10 = $this->SetZvalue('sedang', $a10);
        $r10 = $this->SetRvalue('sedang') * $a10;
        $res10 = $a10 * $z10;

        // POTENSI TINGGI
        $rule11 = array($ch['sedang'], $hh['sedang'], $abj['sedang'], $suhu['sedang'],$kelembaban['tinggi']);
        $a11 = round(min($rule11), 2);
        $newArr['rendah'][] = round(min($rule11), 2);
        $z11 = $this->SetZvalue('tinggi', $a11);
        $r11 = $this->SetRvalue('tinggi') * $a11;
        $res11 = $a11 * $z11;

        // POTENSI TINGGI
        $rule12 = array($ch['sedang'], $hh['sedang'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a12 = round(min($rule12), 2);
        $newArr['sedang'][] = round(min($rule12), 2);
        $z12 = $this->SetZvalue('tinggi', $a12);
        $r12 = $this->SetRvalue('tinggi') * $a12;
        $res12 = $a12 * $z12;

        // POTENSI TINGGI
        $rule13 = array($ch['rendah'], $hh['tinggi'], $abj['tinggi'], $suhu['sedang'],$kelembaban['tinggi']);
        $a13 = round(min($rule13), 2);
        $newArr['sedang'][] = round(min($rule13), 2);
        $z13 = $this->SetZvalue('tinggi', $a13);
        $r13 = $this->SetRvalue('tinggi') * $a13;
        $res13 = $a13 * $z13;



        // ARRAY OF ALPHA
        $arrAlpha = array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a13);
        // ARRAY OF Z*ALPHA
        // $arrZxAlpha = array($res1, $res2, $res3, $res4, $res5, $res6, $res7, $res8, $res9, $res10, $res11, $res12, $res13, $res14, $res15, $res16, $res17, $res18, $res19, $res20, $res21, $res22, $res23, $res24);

        // $arrAlphaxR = array($r1, $r2, $r3, $r4, $r5, $r6, $r7, $r8, $r9, $r10, $r11, $r12, $r13, $r14, $r15, $r16, $r17, $r18, $r19, $r20, $r21, $r22, $r23, $r24);

        // SELECT INDEX OF RULE
        $selectRule = array_search(max($arrAlpha), $arrAlpha) + 1;

        $arrAtas = array(max($newArr['rendah']) * $this->SetZsum('rendah'), max($newArr['sedang']) * $this->SetZsum('sedang'), max($newArr['tinggi']) * $this->SetZsum('tinggi'));
        // $arrAtas = array(max($newArr['rendah']) * $this->SetZvalue('rendah', max($newArr['rendah'])), max($newArr['sedang']) * $this->SetZvalue('sedang', max($newArr['sedang'])), max($newArr['tinggi']) * $this->SetZvalue('tinggi', max($newArr['tinggi'])));

        $arrBawah = array(max($newArr['rendah']) * $this->SetRvalue('rendah'), max($newArr['sedang']) * $this->SetRvalue('sedang'), max($newArr['tinggi']) * $this->SetRvalue('tinggi'));
        // $ZapredxAlpha = $res1 + $res2 + $res3 + $res4 + $res5 + $res6 + $res7 + $res8 + $res9 + $res10 + $res11 + $res12 + $res14 + $res15 + $res16 + $res16 + $res17 + $res18 + $res19 + $res20 + $res21 + $res22 +  $res23;
        // $SigmaAlpha = $a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12 + $a14 + $a15 + $a16 + $a16 + $a17 + $a18 + $a19 + $a20 + $a21 + $a22 + $a23;
        // $result = ($ZapredxAlpha / $SigmaAlpha) * 100;

        // return $arrAlpha;
        $result = round(array_sum($arrAtas) / array_sum($arrBawah));


        $arrResult = array($result, $selectRule, $arrAlpha, $arrAtas, $arrBawah);
        return $arrResult;


        // Check Rule

        // Check arr Mamdani
        // return [
        //     'rendah' => $newArr['rendah'],
        //     'sedang' => $newArr['sedang'],
        //     'tinggi' => $newArr['tinggi'],
        // ];

        // Check max Mamdani
        // return [
        //     'rendah' => max($newArr['rendah']),
        //     'sedang' => max($newArr['sedang']),
        //     'tinggi' => max($newArr['tinggi']),
        // ];

        // Check Mamdani
        // return [
        //     'rendah' => max($newArr['rendah']) * $this->SetZsum('rendah') . " : " . max($newArr['rendah']) * $this->SetRvalue('rendah'),
        //     'sedang' => max($newArr['sedang']) * $this->SetZsum('sedang') . " : " . max($newArr['sedang']) * $this->SetRvalue('sedang'),
        //     'tinggi' => max($newArr['tinggi']) * $this->SetZsum('tinggi') . " : " . max($newArr['tinggi']) * $this->SetRvalue('tinggi'),
        // ];
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

    public function SetRvalue($params)
    {
        // Rendah
        switch ($params) {
            case 'rendah':
                return 3;
                break;
            case 'sedang':
                return 5;
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
