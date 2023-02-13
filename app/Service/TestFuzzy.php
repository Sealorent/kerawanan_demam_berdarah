<?php

namespace App\Service;


class TestFuzzy
{

    public function Fuzzy($arr)
    {
        $ch = $this->CurahHujan($arr['curah_hujan']);
        $hh = $this->HariHujan($arr['hari_hujan']);
        $abj = $this->AngkaBebasJentik($arr['abj']);
        $hi = $this->HouseIndex($arr['hi']);
        // return array($ch, $hh, $abj, $hi);
        $rule = $this->RuleEvaluation($ch, $hh, $abj, $hi);
        return $rule;
    }



    public function CurahHujan($ch)
    {
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($ch <= 0 or $ch >= 400) {
            $arr['rendah'] = 0;
        } elseif ($ch >= 0 and $ch <= 200) {
            $arr['rendah'] = ($ch + 10) / 210;
        } elseif ($ch >= 200 and $ch <= 400) {
            $arr['rendah'] = (400 - $ch) / 200;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($ch <= 200 or $ch >= 600) {
            $arr['sedang'] = 0;
        } elseif ($ch >= 200 and $ch <= 400) {
            $arr['sedang'] = ($ch - 200) / 200;
        } elseif ($ch >= 400 and $ch <= 600) {
            $arr['sedang'] = (600 - $ch) / 200;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($ch <= 400) {
            $arr['tinggi'] = 0;
        } elseif ($ch >= 400 and $ch <= 500) {
            $arr['tinggi'] = ($ch - 400) / 100;
        } elseif ($ch >= 500) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    // public function CurahHujan($ch)
    // {
    //     $arr = array();
    //     // Defuzzyfikasi Rendah
    //     if ($ch <= 0 or $ch >= 200) {
    //         $arr['rendah'] = 0;
    //     } elseif ($ch >= 0 and $ch <= 100) {
    //         $arr['rendah'] = ($ch + 10) / 110;
    //     } elseif ($ch >= 100 and $ch <= 200) {
    //         $arr['rendah'] = (200 - $ch) / 100;
    //     } else {
    //         return 'null';
    //     }

    //     // Defuzzyfikasi Sedang
    //     if ($ch <= 100 or $ch >= 300) {
    //         $arr['sedang'] = 0;
    //     } elseif ($ch >= 100 and $ch <= 200) {
    //         $arr['sedang'] = ($ch - 100) / 100;
    //     } elseif ($ch >= 200 and $ch <= 300) {
    //         $arr['sedang'] = (300 - $ch) / 100;
    //     } else {
    //         return 'null';
    //     }

    //     // Defuzzyfikasi Tinggi
    //     if ($ch <= 300) {
    //         $arr['tinggi'] = 0;
    //     } elseif ($ch >= 300 and $ch <= 400) {
    //         $arr['tinggi'] = ($ch - 300) / 100;
    //     } elseif ($ch >= 400) {
    //         $arr['tinggi'] = 1;
    //     } else {
    //         return 'null';
    //     }

    //     return $arr;
    // }



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
        // if ($hh <= 5 or $hh >= 10) {
        //     $arr['sedang'] = 0;
        // } elseif ($hh >= 5 and $hh <= 10) {
        //     $arr['sedang'] = ($hh - 5) / 5;
        // } elseif ($hh >= 10 and $hh <= 15) {
        //     $arr['sedang'] = (15 - $hh) / 5;
        // } else {
        //     return 'null';
        // }

        if ($hh <= 5 or $hh >= 20) {
            $arr['sedang'] = 0;
        } elseif ($hh >= 5 and $hh <= 10) {
            $arr['sedang'] = ($hh - 5) / 5;
        } elseif ($hh >= 10 and $hh <= 15) {
            $arr['sedang'] = 1;
        } elseif ($hh  <= 20) {
            $arr['sedang'] = (20 - $hh) / 5;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($hh <= 15) {
            $arr['tinggi'] = 0;
        } elseif ($hh >= 15 and $hh <= 20) {
            $arr['tinggi'] = ($hh - 15) / 5;
        } elseif ($hh >= 20) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }


    public function AngkaBebasJentik($abj)
    {
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($abj >= 85) {
            $arr['rendah'] = 0;
        } elseif ($abj >= 80 and $abj <= 85) {
            $arr['rendah'] = (85 - $abj) / 5;
        } elseif ($abj <= 85) {
            $arr['rendah'] = 1;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($abj <= 80 or $abj >= 88) {
            $arr['sedang'] = 0;
        } elseif ($abj >= 80 and $abj <= 85) {
            $arr['sedang'] = ($abj - 80) / 5;
        } elseif ($abj >= 85 and $abj <= 88) {
            $arr['sedang'] = (88 - $abj) / 5;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($abj <= 88) {
            $arr['tinggi'] = 0;
        } elseif ($abj >= 88 and $abj <= 90) {
            $arr['tinggi'] = ($abj - 88) / 5;
        } elseif ($abj >= 90) {
            $arr['tinggi'] = 1;
        } else {
            return 'null';
        }

        return $arr;
    }

    public function HouseIndex($hi)
    {
        $arr = array();
        // Defuzzyfikasi Rendah
        if ($hi <= 0 or $hi >= 10) {
            $arr['rendah'] = 0;
        } elseif ($hi >= 0 and $hi <= 9) {
            $arr['rendah'] = ($hi + 10) / 19;
        } elseif ($hi >= 9 and $hi <= 10) {
            $arr['rendah'] = (10  - $hi) / 1;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Sedang
        if ($hi <= 8 or $hi >= 20) {
            $arr['sedang'] = 0;
        } elseif ($hi >= 8 and $hi <= 10) {
            $arr['sedang'] = ($hi - 8) / 2;
        } elseif ($hi >= 10 and $hi <= 20) {
            $arr['sedang'] = (20 - $hi) / 10;
        } else {
            return 'null';
        }

        // Defuzzyfikasi Tinggi
        if ($hi <= 10) {
            $arr['tinggi'] = 0;
        } elseif ($hi >= 10 and $hi <= 30) {
            $arr['tinggi'] = ($hi - 10) / 20;
        } elseif ($hi >= 30) {
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
        $rule8 = array($ch['sedang'], $hh['tinggi'], $abj['tinggi'], $hi['sedang']);
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
        $z18 = $this->SetZvalue('rendah', $a18);
        $res18 = $a18 * $z18;

        // POTENSI RENDAH
        $rule19 = array($ch['sedang'], $hh['tinggi'], $abj['rendah'], $hi['rendah']);
        $a19 = min($rule19);
        $z19 = $this->SetZvalue('rendah', $a19);
        $res19 = $a19 * $z19;

        // POTENSI RENDAH
        $rule20 = array($ch['sedang'], $hh['tinggi'], $abj['sedang'], $hi['sedang']);
        $a20 = min($rule20);
        $z20 = $this->SetZvalue('sedang', $a20);
        $res20 = $a20 * $z20;

        // POTENSI RENDAH
        $rule21 = array($ch['tinggi'], $hh['tinggi'], $abj['sedang'], $hi['sedang']);
        $a21 = min($rule21);
        $z21 = $this->SetZvalue('tinggi', $a21);
        $res21 = $a21 * $z21;

        $rule22 = array($ch['rendah'], $hh['tinggi'], $abj['rendah'], $hi['tinggi']);
        $a22 = min($rule22);
        $z22 = $this->SetZvalue('rendah', $a22);
        $res22 = $a22 * $z22;


        // ARRAY OF ALPHA
        $arrAlpha = array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10, $a11, $a12, $a14, $a15, $a16, $a16, $a17, $a18, $a19, $a20, $a21, $a22);
        // ARRAY OF Z*ALPHA
        $arrZxAlpha = array($res1, $res2, $res3, $res4, $res5, $res6, $res7, $res8, $res9, $res10, $res11, $res12, $res14, $res15, $res16, $res16, $res17, $res18, $res19, $res20, $res21, $res22);

        // SELECT INDEX OF RULE
        $selectRule = array_search(max($arrAlpha), $arrAlpha) + 1;


        $ZapredxAlpha = $res1 + $res2 + $res3 + $res4 + $res5 + $res6 + $res7 + $res8 + $res9 + $res10 + $res11 + $res12 + $res14 + $res15 + $res16 + $res16 + $res17 + $res18 + $res19 + $res20 + $res21 + $res22;
        $SigmaAlpha = $a1 + $a2 + $a3 + $a4 + $a5 + $a6 + $a7 + $a8 + $a9 + $a10 + $a11 + $a12 + $a14 + $a15 + $a16 + $a16 + $a17 + $a18 + $a19 + $a20 + $a21 + $a22;
        $result = ($ZapredxAlpha / $SigmaAlpha) * 100;

        $arrResult = array($result, $selectRule);
        return $arrResult;
    }


    public function SetZvalue($params, $a)
    {
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
