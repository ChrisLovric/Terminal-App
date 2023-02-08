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
            $this->testPodaci();
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

//Kupac
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
                $this->pregledKupaca();
                break;
            case 2:
                $this->unosNovogKupca();
                break;
            case 3:
                if(count($this->kupac)===0){
                    echo 'Nema kupaca u aplikaciji' . PHP_EOL;
                    $this->KupacIzbornik();
                }else{
                    $this->promjenaKupca();
                }
                break;
            case 4:
                if(count($this->kupac)===0){
                    echo 'Nema kupaca u aplikaciji' . PHP_EOL;
                    $this->KupacIzbornik();
                }else{
                    $this->brisanjeKupca();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->KupacIzbornik();
        }
    }


    private function pregledKupaca($prikaziIzbornik=true){
        echo '---------------' . PHP_EOL;
        echo 'Popis kupaca' . PHP_EOL;
        $rb=1;
        foreach($this->kupac as $s){
            echo $rb++ . '. ' . $s->ime . ' ' . $s->prezime . PHP_EOL . $s->email . PHP_EOL;
        }
        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->KupacIzbornik();
        }
    }

    private function unosNovogKupca(){
        $s=new stdClass();
        $s->ime=Pomocno::unosTeksta('Unesi ime kupca: ');
        $s->prezime=Pomocno::unosTeksta('Unesi prezime kupca: ');
        $s->email=Pomocno::unosTeksta('Unesi email adresu kupca: ');
        $this->kupac[]=$s;
        $this->KupacIzbornik();
    }

    private function promjenaKupca(){
        $this->pregledKupaca(false);
        $rb=Pomocno::rasponBroja('Odaberite kupca: ',1,count($this->kupac));
        $rb--;
        $this->kupac[$rb]->ime=Pomocno::unosTeksta('Unesi ime kupca (' . $this->kupac[$rb]->ime . '): ', $this->kupac[$rb]->ime);
        $this->kupac[$rb]->prezime=Pomocno::unosTeksta('Unesi prezime kupca (' . $this->kupac[$rb]->prezime . '): ', $this->kupac[$rb]->prezime);
        $this->kupac[$rb]->email=Pomocno::unosTeksta('Unesi email adresu kupca (' . $this->kupac[$rb]->email . '): ', $this->kupac[$rb]->email);
        $this->KupacIzbornik();
    }

    private function brisanjeKupca(){
        $this->pregledKupaca(false);
        $rb=Pomocno::rasponBroja('Odaberite kupca: ',1,count($this->kupac));
        $rb--;
        if($this->dev){
            echo 'Prije' . PHP_EOL;
            print_r($this->kupac);
        }
        array_splice($this->kupac,$rb,1);
        if($this->dev){
            echo 'Poslije' . PHP_EOL;
            print_r($this->kupac);
        }
        $this->KupacIzbornik();
    }

//Plaćanje
    private function PlacanjeIzbornik(){
        echo 'Plaćanje' . PHP_EOL;
        echo '1. Vrsta plaćanja' . PHP_EOL;
        echo '2. Unos nove vrste plaćanja' . PHP_EOL;
        echo '3. Promjena postojećih vrsta plaćanja' . PHP_EOL;
        echo '4. Brisanje postojećih vrsta plaćanja' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijePlacanje();
    }

    private function odabirOpcijePlacanje(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ',1,5)){
            case 1:
                $this->pregledVrstaPlacanja();
                break;
            case 2:
                $this->unosNoveVrstePlacanja();
                break;
            case 3:
                if(count($this->placanje)===0){
                    echo 'Nema unesenih vrsta plaćanja u aplikaciji' . PHP_EOL;
                    $this->PlacanjeIzbornik();
                }else{
                    $this->promjenaVrstaPlacanja();
                }
                break;
            case 4:
                if(count($this->placanje)===0){
                    echo 'Nema unesenih vrsta plaćanja u aplikaciji' . PHP_EOL;
                    $this->PlacanjeIzbornik();
                }else{
                    $this->brisanjeVrstaPlacanja();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->PlacanjeIzbornik();
        }
    }

    private function pregledVrstaPlacanja($prikaziIzbornik=true){
        echo '---------------' . PHP_EOL;
        echo 'Popis vrsta plaćanja' . PHP_EOL;
        $rb=1;
        foreach($this->placanje as $s){
            echo $rb++ . '. ' . $s->vrstaplacanja . PHP_EOL;
        }
        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->PlacanjeIzbornik();
        }
    }

    private function unosNoveVrstePlacanja(){
        $s=new stdClass();
        $s->vrstaplacanja=Pomocno::unosTeksta('Unesi novu vrstu plaćanja: ');
        $this->placanje[]=$s;
        $this->PlacanjeIzbornik();
    }

    private function promjenaVrstaPlacanja(){
        $this->pregledVrstaPlacanja(false);
        $rb=Pomocno::rasponBroja('Odaberite vrstu plaćanja: ',1,count($this->placanje));
        $rb--;
        $this->placanje[$rb]->vrstaplacanja=Pomocno::unosTeksta('Unesi naziv vrste plaćanja (' . $this->placanje[$rb]->vrstaplacanja . '): ', $this->placanje[$rb]->vrstaplacanja);
        $this->PlacanjeIzbornik();
    }

    private function brisanjeVrstaPlacanja(){
        $this->pregledVrstaPlacanja(false);
        $rb=Pomocno::rasponBroja('Odaberite vrstu plaćanja: ',1,count($this->placanje));
        $rb--;
        if($this->dev){
            echo 'Prije' . PHP_EOL;
            print_r($this->placanje);
        }
        array_splice($this->placanje,$rb,1);
        if($this->dev){
            echo 'Poslije' . PHP_EOL;
            print_r($this->placanje);
        }
        $this->PlacanjeIzbornik();
    }

//Narudžba
    private function NarudzbaIzbornik(){
        echo 'Narudžba' . PHP_EOL;
        echo '1. Pregled narudžbi' . PHP_EOL;
        echo '2. Unos nove narudžbe' . PHP_EOL;
        echo '3. Promjena postojećih narudžbi' . PHP_EOL;
        echo '4. Brisanje postojećih narudžbi' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeNarudzba();
    }

    private function odabirOpcijeNarudzba(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ',1,5)){
            case 1:
                $this->pregledNarudzbi();
                break;
            case 2:
                $this->unosNoveNarudzbe();
                break;
            case 3:
                if(count($this->narudzba)===0){
                    echo 'Nema narudžbi u aplikaciji' . PHP_EOL;
                    $this->NarudzbaIzbornik();
                }else{
                    $this->promjenaNarudzbe();
                }
                break;
            case 4:
                if(count($this->narudzba)===0){
                    echo 'Nema narudžbi u aplikaciji' . PHP_EOL;
                    $this->NarudzbaIzbornik();
                }else{
                    $this->brisanjeNarudzbe();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->NarudzbaIzbornik();
        }
    }

    private function pregledNarudzbi($prikaziIzbornik=true){
        echo '---------------' . PHP_EOL;
        echo 'Sve narudžbe' . PHP_EOL;
        $rb=1;
        foreach($this->narudzba as $s){
            echo $rb++ . '. ' . PHP_EOL . 'Broj narudžbe: ' . $s->brojnarudzbe . PHP_EOL . 'Datum Narudžbe: ' . $s->datumnarudzbe . PHP_EOL . 'Datum isporuke: ' . $s->datumisporuke . PHP_EOL . 'Datum plaćanja: ' . $s->datumplacanja . PHP_EOL;
        }
        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->NarudzbaIzbornik();
        }
    }

    private function unosNoveNarudzbe(){
        $s=new stdClass();
        $s->brojnarudzbe=Pomocno::unosTeksta('Unesi broj narudžbe: ');
        $s->datumnarudzbe=Pomocno::unosTeksta('Unesi datum narudžbe: ');
        $s->datumisporuke=Pomocno::unosTeksta('Unesi datum isporuke: ');
        $s->datumplacanja=Pomocno::unosTeksta('Unesi datum plaćanja: ');
        $this->narudzba[]=$s;
        $this->NarudzbaIzbornik();
    }

    private function promjenaNarudzbe(){
        $this->pregledNarudzbi(false);
        $rb=Pomocno::rasponBroja('Odaberite narudžbu: ',1,count($this->narudzba));
        $rb--;
        $this->narudzba[$rb]->brojnarudzbe=Pomocno::unosTeksta('Unesi broj narudžbe (' . $this->narudzba[$rb]->brojnarudzbe . '): ', $this->narudzba[$rb]->brojnarudzbe);
        $this->narudzba[$rb]->datumnarudzbe=Pomocno::unosTeksta('Unesi datum narudžbe (' . $this->narudzba[$rb]->datumnarudzbe . '): ', $this->narudzba[$rb]->datumnarudzbe);
        $this->narudzba[$rb]->datumisporuke=Pomocno::unosTeksta('Unesi datum isporuke (' . $this->narudzba[$rb]->datumisporuke . '): ', $this->narudzba[$rb]->datumisporuke);
        $this->narudzba[$rb]->datumplacanja=Pomocno::unosTeksta('Unesi datum isporuke (' . $this->narudzba[$rb]->datumplacanja . '): ', $this->narudzba[$rb]->datumplacanja);
        $this->NarudzbaIzbornik();
    }

    private function brisanjeNarudzbe(){
        $this->pregledNarudzbi(false);
        $rb=Pomocno::rasponBroja('Odaberite kupca: ',1,count($this->narudzba));
        $rb--;
        if($this->dev){
            echo 'Prije' . PHP_EOL;
            print_r($this->narudzba);
        }
        array_splice($this->narudzba,$rb,1);
        if($this->dev){
            echo 'Poslije' . PHP_EOL;
            print_r($this->narudzba);
        }
        $this->NarudzbaIzbornik();
    }



//Proizvod
    private function ProizvodIzbornik(){
        echo 'Proizvod' . PHP_EOL;
        echo '1. Pregled proizvoda' . PHP_EOL;
        echo '2. Unos novog proizvoda' . PHP_EOL;
        echo '3. Promjena postojećeg proizvoda' . PHP_EOL;
        echo '4. Brisanje postojećeg proizvoda' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeProizvod();
    }

    private function odabirOpcijeProizvod(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ',1,5)){
            case 1:
                $this->pregledProizvoda();
                break;
            case 2:
                $this->unosNovogProizvoda();
                break;
            case 3:
                if(count($this->proizvod)===0){
                    echo 'Nema narudžbi u aplikaciji' . PHP_EOL;
                    $this->ProizvodIzbornik();
                }else{
                    $this->promjenaProizvoda();
                }
                break;
            case 4:
                if(count($this->proizvod)===0){
                    echo 'Nema narudžbi u aplikaciji' . PHP_EOL;
                    $this->ProizvodIzbornik();
                }else{
                    $this->brisanjeProizvoda();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->ProizvodIzbornik();
        }
    }

    private function pregledProizvoda($prikaziIzbornik=true){
        echo '---------------' . PHP_EOL;
        echo 'Proizvodi' . PHP_EOL;
        $rb=1;
        foreach($this->proizvod as $s){
            echo $rb++ . '. ' . PHP_EOL . 'Naziv proizvoda: ' . $s->naziv . PHP_EOL . 'Proizvođač: ' . $s->proizvodjac . PHP_EOL . 'Jedinična cijena: ' . $s->jedinicnacijena . PHP_EOL;
        }
        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->ProizvodIzbornik();
        }
    }

    private function unosNovogProizvoda(){
        $s=new stdClass();
        $s->naziv=Pomocno::unosTeksta('Unesi naziv proizvoda: ');
        $s->proizvodjac=Pomocno::unosTeksta('Unesi proizvođača: ');
        $s->jedinicnacijena=Pomocno::unosDecimalnogBroja('Unesi jediničnu cijenu: ');
        $this->proizvod[]=$s;
        $this->ProizvodIzbornik();
    }

    private function promjenaProizvoda(){
        $this->pregledProizvoda(false);
        $rb=Pomocno::rasponBroja('Odaberite proizvod: ',1,count($this->proizvod));
        $rb--;
        $this->proizvod[$rb]->naziv=Pomocno::unosTeksta('Unesi naziv proizvoda (' . $this->proizvod[$rb]->naziv . '): ', $this->proizvod[$rb]->naziv);
        $this->proizvod[$rb]->proizvodjac=Pomocno::unosTeksta('Unesi proizvođača (' . $this->proizvod[$rb]->proizvodjac . '): ', $this->proizvod[$rb]->proizvodjac);
        $this->proizvod[$rb]->jedinicnacijena=Pomocno::unosDecimalnogBroja('Unesi jediničnu cijenu (' . $this->proizvod[$rb]->jedinicnacijena . '): ', $this->proizvod[$rb]->jedinicnacijena);
        $this->ProizvodIzbornik();
    }

    private function brisanjeProizvoda(){
        $this->pregledProizvoda(false);
        $rb=Pomocno::rasponBroja('Odaberite proizvod: ',1,count($this->proizvod));
        $rb--;
        if($this->dev){
            echo 'Prije' . PHP_EOL;
            print_r($this->proizvod);
        }
        array_splice($this->proizvod,$rb,1);
        if($this->dev){
            echo 'Poslije' . PHP_EOL;
            print_r($this->proizvod);
        }
        $this->ProizvodIzbornik();
    }

//Detalji narudžbe
    private function DetaljiNarudzbe(){
        echo 'Detalji narudžbe' . PHP_EOL;
        echo '1. Detalji narudžbe' . PHP_EOL;
        echo '2. Unos novih detalja narudžbe' . PHP_EOL;
        echo '3. Promjena postojećih detalja narudžbe' . PHP_EOL;
        echo '4. Brisanje postojećih detalja narudžbe' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        //$this->odabirOpcijeDetaljiNarudzbe();
    }

    private function testPodaci(){
        $this->kupac[]=$this->kreirajKupac('Renato','Jukić','rjukic@gmail.com');
        $this->kupac[]=$this->kreirajKupac('Franjo','Balen','fbalen@gmail.com');

        $this->placanje[]=$this->kreirajVrstaPlacanja('Kartica');
        $this->placanje[]=$this->kreirajVrstaPlacanja('Gotovina');

        $this->narudzba[]=$this->kreirajNarudzba('123','30.11.2022. 15:24:36','04.12.2022. 08:14:44','30.11.2022. 15:26:36');
        $this->narudzba[]=$this->kreirajNarudzba('124','05.12.2022. 08:11:52','08.12.2022. 09:45:12','05.12.2022. 08:13:47');

        $this->proizvod[]=$this->kreirajProizvod('Grafička kartica GeForce RTX 3060 Ghost LHR, 12GB GDDR6','Gainward',464.99);
        $this->proizvod[]=$this->kreirajProizvod('Grafička kartica Radeon RX6800XT Gaming OC, 16GB GDDR6','Gigabyte',1499.99);

    }

    private function kreirajKupac($ime,$prezime,$email){
        $o=new stdClass();
        $o->ime=$ime;
        $o->prezime=$prezime;
        $o->email=$email;
        return $o;
    }

    private function kreirajVrstaPlacanja($vrstaplacanja){
        $o=new stdClass();
        $o->vrstaplacanja=$vrstaplacanja;
        return $o;
    }

    private function kreirajNarudzba($brojnarudzbe,$datumnarudzbe,$datumisporuke,$datumplacanja){
        $o=new stdClass();
        $o->brojnarudzbe=$brojnarudzbe;
        $o->datumnarudzbe=$datumnarudzbe;
        $o->datumisporuke=$datumisporuke;
        $o->datumplacanja=$datumplacanja;
        return $o;
    }

    private function kreirajProizvod($naziv,$proizvodjac,$jedinicnacijena){
        $o=new stdClass();
        $o->naziv=$naziv;
        $o->proizvodjac=$proizvodjac;
        $o->jedinicnacijena=$jedinicnacijena;
        return $o;
    }






}

new Start($argc,$argv);