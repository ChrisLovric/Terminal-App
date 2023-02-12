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
        echo '__________________________' . PHP_EOL;
        echo 'Glavni izbornik' . PHP_EOL;
        echo '__________________________' . PHP_EOL;
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
                $this->DetaljiNarudzbeIzbornik();
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
        echo '__________________________' . PHP_EOL;
        echo 'Kupac' . PHP_EOL;
        echo '__________________________' . PHP_EOL;
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
        foreach($this->kupac as $kupci){
            echo $rb++ . '. ' . $kupci->ime . ' ' . $kupci->prezime . PHP_EOL . $kupci->email . PHP_EOL;
        }
        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->KupacIzbornik();
        }
    }

    private function unosNovogKupca(){
        $k=new stdClass();
        $k->ime=Pomocno::unosTeksta('Unesi ime kupca: ');
        $k->prezime=Pomocno::unosTeksta('Unesi prezime kupca: ');
        $k->email=Pomocno::unosTeksta('Unesi email adresu kupca: ');
        $this->kupac[]=$k;
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
        echo '__________________________' . PHP_EOL;
        echo 'Plaćanje' . PHP_EOL;
        echo '__________________________' . PHP_EOL;
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
        echo '__________________________' . PHP_EOL;
        echo 'Narudžba' . PHP_EOL;
        echo '__________________________' . PHP_EOL;
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
        echo '---------------' . PHP_EOL;
        if(count($this->narudzba)===0){
            echo 'Nema narudžbi u aplikaciji' . PHP_EOL . 'Za dodavanje narudžbe koristite opciju 2. Unos nove narudžbe' . PHP_EOL;
        }
        $rb=1;
        foreach($this->narudzba as $v){
            echo $rb++ . '. ' . PHP_EOL . 'Broj narudžbe: ' . $v->brojnarudzbe . PHP_EOL . 'Datum narudžbe: ' . $v->datumnarudzbe . PHP_EOL . 'Datum isporuke: ' . $v->datumisporuke . PHP_EOL . 'Datum plaćanja: ' . $v->datumplacanja . PHP_EOL;
            foreach($v->kupac as $k){
                echo 'Kupac: ' . $k->ime . ' ' . $k->prezime . PHP_EOL;
            }
            foreach($v->placanje as $s){
                echo 'Vrsta plaćanja: ' . $s->vrstaplacanja . PHP_EOL;
            }
        }
        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->NarudzbaIzbornik();
        }
    }

    private function unosNoveNarudzbe(){    
        $s=new stdClass();
        $s->brojnarudzbe=Pomocno::unosBroja('Unesi broj narudžbe: ');
        $s->datumnarudzbe=Pomocno::unosTeksta('Unesi datum narudžbe u formatu dd:mm:YYYY hh:mm:ss: ');
        $s->datumisporuke=Pomocno::unosTeksta('Unesi datum isporuke u formatu dd:mm:YYYY hh:mm:ss: ');
        $s->datumplacanja=Pomocno::unosTeksta('Unesi datum plaćanja u formatu dd:mm:YYYY hh:mm:ss: ');

        $s->kupac=[];
        $this->pregledKupaca(false);
        $rb = Pomocno::rasponBroja('Odaberite kupca: ',1,count($this->kupac));
        $rb--;
        $s->kupac[] = $this->kupac[$rb];
        
        $s->placanje=[];
        $this->pregledVrstaPlacanja(false);
        $rb = Pomocno::rasponBroja('Odaberite vrstu plaćanja: ',1,count($this->placanje));
        $rb--;
        $s->placanje[] = $this->placanje[$rb];

        echo '===============';
        echo 'Narudžba dodana';
        echo '===============' . PHP_EOL;
        $this->narudzba[]=$s;
        $this->NarudzbaIzbornik();
    }

    private function promjenaNarudzbe(){
        $this->pregledNarudzbi(false);
        $rb=Pomocno::rasponBroja('Odaberite narudžbu: ',1,count($this->narudzba));
        $rb--;
        $this->narudzba[$rb]->brojnarudzbe=Pomocno::unosBroja('Unesi broj narudžbe (' . $this->narudzba[$rb]->brojnarudzbe . '): ', $this->narudzba[$rb]->brojnarudzbe);
        $this->narudzba[$rb]->datumnarudzbe=Pomocno::unosTeksta('Unesi datum narudžbe (' . $this->narudzba[$rb]->datumnarudzbe . '): ', $this->narudzba[$rb]->datumnarudzbe);
        $this->narudzba[$rb]->datumisporuke=Pomocno::unosTeksta('Unesi datum isporuke (' . $this->narudzba[$rb]->datumisporuke . '): ', $this->narudzba[$rb]->datumisporuke);
        $this->narudzba[$rb]->datumplacanja=Pomocno::unosTeksta('Unesi datum plaćanja (' . $this->narudzba[$rb]->datumplacanja . '): ', $this->narudzba[$rb]->datumplacanja);

        $this->pregledKupaca(false);
        $rbk=Pomocno::rasponBroja('Odaberite kupca: ',1,count($this->kupac));
        $rbk--;
        $this->narudzba[$rb]->kupci=$this->kupac[$rbk];

        $this->pregledVrstaPlacanja(false);
        $rbpl=Pomocno::rasponBroja('Odaberite vrstu plaćanja: ',1,count($this->placanje));
        $rbpl--;
        $this->narudzba[$rb]->vrstaplacanja=$this->placanje[$rbpl];

        echo '===============';
        echo 'Narudžba izmijenjena';
        echo '===============' . PHP_EOL;

        $this->NarudzbaIzbornik();
    
}

    private function brisanjeNarudzbe(){
        $this->pregledNarudzbi(false);
        $rb=Pomocno::rasponBroja('Odaberite narudžbu: ',1,count($this->narudzba));
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

        echo '===============';
        echo 'Narudžba izbrisana';
        echo '===============' . PHP_EOL;

        $this->NarudzbaIzbornik();
    }



//Proizvod
    private function ProizvodIzbornik(){
        echo '__________________________' . PHP_EOL;
        echo 'Proizvod' . PHP_EOL;
        echo '__________________________' . PHP_EOL;
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
                    echo 'Nema proizvoda u aplikaciji' . PHP_EOL;
                    $this->ProizvodIzbornik();
                }else{
                    $this->promjenaProizvoda();
                }
                break;
            case 4:
                if(count($this->proizvod)===0){
                    echo 'Nema proizvoda u aplikaciji' . PHP_EOL;
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
    private function DetaljiNarudzbeIzbornik(){
        echo '__________________________' . PHP_EOL;
        echo 'Detalji narudžbe' . PHP_EOL;
        echo '__________________________' . PHP_EOL;
        echo '1. Detalji narudžbe' . PHP_EOL;
        echo '2. Unos novih detalja narudžbe' . PHP_EOL;
        echo '3. Promjena postojećih detalja narudžbe' . PHP_EOL;
        echo '4. Brisanje postojećih detalja narudžbe' . PHP_EOL;
        echo '5. Povratak na glavni izbornik' . PHP_EOL;
        $this->odabirOpcijeDetaljiNarudzbe();
    }

    private function odabirOpcijeDetaljiNarudzbe(){
        switch(Pomocno::rasponBroja('Odaberite opciju: ',1,5)){
            case 1:
                $this->pregledDetalja();
                break;
            case 2:
                $this->unosNovihDetalja();
                break;
            case 3:
                if(count($this->detaljinarudzbe)===0){
                    echo 'Nema detalja narudžbi u aplikaciji' . PHP_EOL;
                    $this->DetaljiNarudzbeIzbornik();
                }else{
                    $this->promjenaDetalja();
                }
                break;
            case 4:
                if(count($this->detaljinarudzbe)===0){
                    echo 'Nema narudžbi u aplikaciji' . PHP_EOL;
                    $this->DetaljiNarudzbeIzbornik();
                }else{
                    $this->brisanjeDetalja();
                }
                break;
            case 5:
                $this->glavniIzbornik();
                break;
            default:
                $this->DetaljiNarudzbeIzbornik();
        }
    }

    private function pregledDetalja($prikaziIzbornik=true){
        echo '---------------' . PHP_EOL;
        echo 'Detalji narudžbe' . PHP_EOL;
        $rb=1;
        foreach($this->detaljinarudzbe as $s){
            echo $rb++ . '. ' . PHP_EOL . 'Cijena: ' . $s->cijena . PHP_EOL . 'Količina: ' . $s->kolicina . PHP_EOL . 'Popust: ' . $s->popust . PHP_EOL;
            foreach($s->narudzba as $n){
                echo 'Broj narudžbe: ' . $n->brojnarudzbe . PHP_EOL;
            }
            foreach($s->proizvod as $p){
                echo 'Proizvod: ' . $p->naziv . PHP_EOL;
            }
        }

        echo '---------------' . PHP_EOL;
        if($prikaziIzbornik){
            $this->DetaljiNarudzbeIzbornik();
        }
    }

    private function unosNovihDetalja(){
        $s=new stdClass();
        $s->cijena=Pomocno::unosDecimalnogBroja('Unesi cijenu: ');
        $s->kolicina=Pomocno::unosBroja('Unesi količinu naručenih proizvoda: ');
        $s->popust=Pomocno::unosDecimalnogBroja('Unesi popust: ');

        $s->narudzba=[];
        $this->pregledNarudzbi(false);
        $rb = Pomocno::rasponBroja('Odaberite narudžbu: ',1,count($this->narudzba));
        $rb--;
        $s->narudzba[] = $this->narudzba[$rb];
        
        $s->proizvod=[];
        $this->pregledProizvoda(false);
        $rb = Pomocno::rasponBroja('Odaberite proizvod: ',1,count($this->proizvod));
        $rb--;
        $s->proizvod[] = $this->proizvod[$rb];

        $this->detaljinarudzbe[]=$s;
        $this->DetaljiNarudzbeIzbornik();
    }

    private function promjenaDetalja(){
        $this->pregledDetalja(false);
        $rb=Pomocno::rasponBroja('Odaberite detalje narudžbe: ',1,count($this->detaljinarudzbe));
        $rb--;
        $this->detaljinarudzbe[$rb]->cijena=Pomocno::unosDecimalnogBroja('Unesi cijenu (' . $this->detaljinarudzbe[$rb]->cijena . '): ', $this->detaljinarudzbe[$rb]->cijena);
        $this->detaljinarudzbe[$rb]->kolicina=Pomocno::unosBroja('Unesi količinu naručenih proizvoda (' . $this->detaljinarudzbe[$rb]->kolicina . '): ', $this->detaljinarudzbe[$rb]->kolicina);
        $this->detaljinarudzbe[$rb]->popust=Pomocno::unosDecimalnogBroja('Unesi popust (' . $this->detaljinarudzbe[$rb]->popust . '): ', $this->detaljinarudzbe[$rb]->popust);

        $this->pregledNarudzbi(false);
        $rbn=Pomocno::rasponBroja('Odaberite narudžbu: ',1,count($this->narudzba));
        $rbn--;
        $this->detaljinarudzbe[$rb]->brojnarudzbe=$this->narudzba[$rbn];

        $this->pregledProizvoda(false);
        $rbpl=Pomocno::rasponBroja('Odaberite proizvod: ',1,count($this->placanje));
        $rbpl--;
        $this->detaljinarudzbe[$rb]->vrstaplacanja=$this->placanje[$rbpl];

        $this->DetaljiNarudzbeIzbornik();
    }

    private function brisanjeDetalja(){
        $this->pregledDetalja(false);
        $rb=Pomocno::rasponBroja('Odaberite detalje narudžbe: ',1,count($this->detaljinarudzbe));
        $rb--;
        if($this->dev){
            echo 'Prije' . PHP_EOL;
            print_r($this->detaljinarudzbe);
        }
        array_splice($this->detaljinarudzbe,$rb,1);
        if($this->dev){
            echo 'Poslije' . PHP_EOL;
            print_r($this->detaljinarudzbe);
        }
        $this->DetaljiNarudzbeIzbornik();
    }

    private function testPodaci(){
        $this->kupac[]=$this->kreirajKupac('Renato','Jukić','rjukic@gmail.com');
        $this->kupac[]=$this->kreirajKupac('Franjo','Balen','fbalen@gmail.com');

        $this->placanje[]=$this->kreirajVrstaPlacanja('Kartica');
        $this->placanje[]=$this->kreirajVrstaPlacanja('Gotovina');

        $this->proizvod[]=$this->kreirajProizvod('Grafička kartica GeForce RTX 3060 Ghost LHR, 12GB GDDR6','Gainward',464.99);
        $this->proizvod[]=$this->kreirajProizvod('Grafička kartica Radeon RX6800XT Gaming OC, 16GB GDDR6','Gigabyte',1499.99);

    }

    private function kreirajKupac($ime,$prezime,$email){
        $k=new stdClass();
        $k->ime=$ime;
        $k->prezime=$prezime;
        $k->email=$email;
        return $k;
    }

    private function kreirajVrstaPlacanja($vrstaplacanja){
        $o=new stdClass();
        $o->vrstaplacanja=$vrstaplacanja;
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