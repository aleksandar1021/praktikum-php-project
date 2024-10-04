<?php
    include("config/konekcija.php");
    //include("const/const.php");

    function ispisNavigacije(){
        global $konekcija;
        if(isset($_SESSION["korisnik"])){
            if($_SESSION["korisnik"]->uloga=="korisnik"){
                $upit = "SELECT * from navigacija WHERE text <> 'Admin panel'";
            }
            else if($_SESSION["korisnik"]->uloga=="admin"){
                $upit = "SELECT * from navigacija";
            }
        }
        else{
            $upit = "SELECT * from navigacija WHERE text <> 'Shop' AND  text <> 'Admin panel' AND  text <> 'Survey'";
        }
        
        $rez = $konekcija -> query($upit);
        $result = $rez -> fetchAll();
        return $result;
        
    }

    function ispisChcBrend($tabela){
        global $konekcija;
        $upit = "SELECT * from $tabela";

        $rez = $konekcija->query($upit);
        $result = $rez->fetchAll();

        foreach($result as $r){
            echo"<input class='ml-2 chc' id='$r->id_brend-brend' name='marka' type='checkbox' value='$r->id_brend'/> <label for='$r->id_brend-brend'>&nbsp;$r->naziv_brend</label><br/>";
        }
    }
    function ispisChcBoja($tabela){
        global $konekcija;
        $upit = "SELECT * from $tabela";

        $rez = $konekcija->query($upit);
        $result = $rez->fetchAll();

        foreach($result as $r){
            echo"<input class='ml-2 chc' id='$r->id_boja-boja' name='boja' type='checkbox' value='$r->id_boja'/> <label for='$r->id_boja-boja'>&nbsp;$r->boja</label><br/>";
        }
    }

    function ispisChcKategorija($tabela){
        global $konekcija;
        $upit = "SELECT * from $tabela";

        $rez = $konekcija->query($upit);
        $result = $rez->fetchAll();

        foreach($result as $r){
            echo"<input class='ml-2 chc' id='$r->id_kategorija-kat' name='kat' type='checkbox' value='$r->id_kategorija'/><label for='$r->id_kategorija-kat'>&nbsp;$r->naziv_kategorija</label><br/>";
        }
    }

    function getProduct($id){
        global $konekcija;
        $upitProizvod = "SELECT opis, naziv, slika, naziv_brend, boja, naziv_kategorija 
                     FROM proizvod p 
                     JOIN brend b on p.id_brend = b.id_brend 
                     JOIN proizvod_boja pb ON p.id_proizvod = pb.id_proizvod 
                     JOIN boja bo ON pb.id_boja = bo.id_boja
                     JOIN kategorija k ON p.id_kategorija = k.id_kategorija 
                     WHERE p.id_proizvod = :id";
        $stm = $konekcija->prepare($upitProizvod);
        $stm -> bindParam(":id", $id);
        $stm ->execute();
        return $stm -> fetch();
    }
    function getPrice($id){
        global $konekcija;
        $cena = "SELECT cena FROM cena c JOIN proizvod p on c.id_proizvod = p.id_proizvod WHERE p.id_proizvod = :id ORDER BY datum desc LIMIT 0,1";
        $stm = $konekcija->prepare($cena);
        $stm -> bindParam(":id", $id);
        $stm ->execute();
        return $stm -> fetch();
    }

    function getDiscount($id){
        global $konekcija;
        $upitPopust = "SELECT procenat FROM popust po JOIN proizvod p on po.id_proizvod = p.id_proizvod WHERE p.id_proizvod = :id  ORDER BY datum_popust desc LIMIT 0,1";
        $stm = $konekcija->prepare($upitPopust);
        $stm -> bindParam(":id", $id);
        $stm ->execute();
        return $stm -> fetch();
    }

    function anketaPitanje(){
        global $konekcija;
        $upitAnketa = "SELECT * FROM anketa ORDER BY datum DESC LIMIT 0,1";
        $rez = $konekcija->query($upitAnketa);
        return $rez->fetch();
    }

    function anketaOdgovori($idAnkete){
        global $konekcija;
        $odgovoriUpit = "SELECT odgovor FROM odgovor WHERE id_anketa = $idAnkete";
        $rezOdgovori = $konekcija->query($odgovoriUpit);
        return $rezOdgovori->fetchAll();
    }

    function printAnketa($idAnkete, $resultOdgovori){
        global $konekcija;
        echo"<input id='skriven' type='hidden' value='$idAnkete'/>";
        foreach($resultOdgovori as $o){
            echo "<p><input type='radio' class='ank' name='odgovor' value ='$o->odgovor'/> $o->odgovor</p>";
        }
    }

    function price($pop, $trenutna){
        global $konekcija;
        if($pop->procenat>0){
            $saPopustomCena = round($trenutna->cena - ($trenutna->cena * ($pop->procenat/100)));
            echo "<del class='mt-2 dodatak' id='stara'>$trenutna->cena &euro;</del>";
            echo  "<h3 class='mt-2 dodatak' id='nova'>$saPopustomCena &euro;</h3>";
        }
        else{
            echo "<span class='mt-2 dodatak' id='stara'>$trenutna->cena &euro;</span>";
        }
    }


    function brojStrana(){
        global $konekcija;
        $upit = "SELECT DISTINCT  p.* 
        FROM proizvod p 
        INNER JOIN proizvod_boja pb ON p.id_proizvod = pb.id_proizvod
        INNER JOIN boja b ON b.id_boja = pb.id_boja
        INNER JOIN brend br ON br.id_brend = p.id_brend
        INNER JOIN kategorija k ON p.id_kategorija = k.id_kategorija";
        $result = $konekcija->query($upit);
        $rezultati = $result->fetchAll();
        return ceil(count($rezultati)/4);
    }

?>