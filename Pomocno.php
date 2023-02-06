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





}