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
                $this->PlacanjeIzbornik();
                break;
            case 3:
                $this->NarudzbaIzbornik();
                break;
            case 4:
                $this->ProizvodIzbornik();
                break;
            case 5:
                $this->DetaljiNarudzbe();
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
        echo '2. Unos novog kupca' . PHP_EOL;
        echo '3. Promjena postojećeg kupca' . PHP_EOL;
        echo '4. Brisanje postojećeg kupca' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeKupac();
    }

    private function odabirOpcijeKupac(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ',1,5)){
            case 1:
                //$this->pregledKupaca();
                break;
            case 2:
                //$this->unosNovogKupca();
                break;
            case 3:
                if(count($this->kupac)===0){
                    echo 'Nema kupaca u aplikaciji' . PHP_EOL;
                    $this->KupacIzbornik();
                }else{
                    //$this->promjenaKupca();
                }
                break;
            case 4:
                if(count($this->kupac)===0){
                    echo 'Nema kupaca u aplikaciji' . PHP_EOL;
                    $this->KupacIzbornik();
                }else{
                    //$this->brisanjeKupca();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->KupacIzbornik();
        }
    }

    private function PlacanjeIzbornik(){
        echo 'Plaćanje' . PHP_EOL;
        echo '1. Vrsta plaćanja' . PHP_EOL;
        echo '2. Unos nove vrste plaćanja' . PHP_EOL;
        echo '3. Promjena postojećih vrsta plaćanja' . PHP_EOL;
        echo '4. Brisanje postojećih vrsta plaćanja' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        //$this->odabirOpcijePlacanje();
    }

    private function NarudzbaIzbornik(){
        echo 'Narudžba' . PHP_EOL;
        echo '1. Pregled narudžbi' . PHP_EOL;
        echo '2. Unos nove narudžbe' . PHP_EOL;
        echo '3. Promjena postojećih narudžbi' . PHP_EOL;
        echo '4. Brisanje postojećih narudžbi' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        //$this->odabirOpcijeNarudzba();
    }

    private function ProizvodIzbornik(){
        echo 'Proizvod' . PHP_EOL;
        echo '1. Pregled proizvoda' . PHP_EOL;
        echo '2. Unos novog proizvoda' . PHP_EOL;
        echo '3. Promjena postojećeg proizvoda' . PHP_EOL;
        echo '4. Brisanje postojećeg proizvoda' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        //$this->odabirOpcijeProizvod();
    }

    private function DetaljiNarudzbe(){
        echo 'Detalji narudžbe' . PHP_EOL;
        echo '1. Detalji narudžbe' . PHP_EOL;
        echo '2. Unos novih detalja narudžbe' . PHP_EOL;
        echo '3. Promjena postojećih detalja narudžbe' . PHP_EOL;
        echo '4. Brisanje postojećih detalja narudžbe' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        //$this->odabirOpcijeDetaljiNarudzbe();
    }
}

new Start($argc,$argv);