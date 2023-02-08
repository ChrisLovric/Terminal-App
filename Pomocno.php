<?php

class Pomocno{

    public static function rasponBroja($poruka,$min,$max){
        while(true){
            $i=readline($poruka);
            $i=(int)$i;
            if($i<$min || $i>$max){
                echo 'Unos mora biti između ' . $min . ' i ' . $max . PHP_EOL;
                continue;
            }
            return $i;
        }
    }

    public static function unosTeksta($poruka,$vrijednost=''){
        while(true){
            $s=readline($poruka);
            $s=trim($s);
            if(strlen($s)===0 && $vrijednost===''){
                echo 'Obavezan unos' . PHP_EOL;
                continue;
            }
            if(strlen($s)===0 && $vrijednost!==''){
                return $vrijednost;
            }
            return $s;
        }
    }

    public static function unosDecimalnogBroja($poruka){
        while(true){
            $s=readline($poruka);
            $s=(double)$s;
            if($s<=0){
                echo 'Broj mora biti veći od nule' . PHP_EOL;
                continue;
            }
            return $s;
        }
    }


}