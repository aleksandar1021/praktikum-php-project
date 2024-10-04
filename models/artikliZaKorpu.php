<?php
    include ("../config/konekcija.php");

    $upit = "SELECT * FROM proizvod";
    $rez = $konekcija->query($upit);
    $result = $rez->fetchAll();

    $niz = [];

    foreach($result as $r){
        $upitPojedinacni = "SELECT p.id_proizvod, p.naziv, p.slika, c.cena from proizvod p inner join cena c ON
        p.id_proizvod = c.id_proizvod WHERE c.id_proizvod = $r->id_proizvod ORDER BY c.datum DESC";
        $r = $konekcija -> query($upitPojedinacni);
        $rz = $r->fetch();
        array_push($niz, $rz);
    }

    if($result){
        echo json_encode($niz);
        http_response_code(200);
    }
    else{
        http_response_code(500);
    }
    
    
    
?>