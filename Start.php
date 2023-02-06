<?php

include_once 'Pomocno.php';

class Start{

    private $kupac;
    private $placanje;
    private $narudzba;
    private $proizvod;
    private $detaljinarudzbe;
    private $dev;


    public function __construct($argc,$argv){
        $this->kupac=[];
        $this->placanje=[];
        $this->narudzba=[];
        $this->proizvod=[];
        $this->detaljinarudzbe=[];
        if($argc>1 && $argv[1]=='dev'){
            //$this->testPodaci();
            $this->dev=true;
        }else{
            $this->dev=false;
        }
        $this->pozdravnaPoruka();
        $this->glavniIzbornik();
    }

    private function pozdravnaPoruka(){
        echo 'Dobrodošli u terminal webshop za hardware' . PHP_EOL;
    }

    private function glavniIzbornik(){
        echo 'Glavni izbornik' . PHP_EOL;
        echo '1. Kupac' . PHP_EOL;
        echo '2. Plaćanje' . PHP_EOL;
        echo '3. Narudžba' . PHP_EOL;
        echo '4. Proizvod' . PHP_EOL;
        echo '5. Detalji narudžbe' . PHP_EOL;
        echo '6. Izlaz iz programa' . PHP_EOL;
        $this->OdabirOpcijeGlavniIzbornik();
    }

    private function odabirOpcijeGlavniIzbornik(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ',1,6)){
            case 1:
                $this->KupacIzbornik();
                break;
            case 2:
                //$this->PlacanjeIzbornik();
                break;
            case 3:
                //$this->NarudzbaIzbornik();
                break;
            case 4:
                //$this->ProizvodIzbornik();
                break;
            case 5:
                //$this->DetaljiNarudzbe();
                break;
            case 6:
                echo 'Vidimo se opet!' . PHP_EOL;
                break;
            default:
                $this->glavniIzbornik();
        }
    }

    private function KupacIzbornik(){
        echo 'Kupac' . PHP_EOL;
        echo '1. Pregled kupaca' . PHP_EOL;
        echo '1. Unos novog kupca' . PHP_EOL;
        echo '1. Promjena postojećeg kupca' . PHP_EOL;
        echo '1. Brisanje postojećeg kupca' . PHP_EOL;
        echo '1. Povratak na glavni izbornik' . PHP_EOL;
        //$this->odabirOpcijeKupac();
    }
}

new Start($argc,$argv);