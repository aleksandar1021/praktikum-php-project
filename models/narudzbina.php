<?php
    @session_start();
include("../config/konekcija.php");

if (isset($_POST['porudzbina'])) {
    $kor = $_POST['porudzbina'];
    $korpa = json_decode($kor, true);
    $greske = 0;
    foreach ($korpa as $k) {
        $idd = $k['id'];
        $qt = $k['quantity'];

        $cena = "SELECT cena FROM cena c JOIN proizvod p on c.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $idd ORDER BY datum desc LIMIT 0,1";
        $result2 = $konekcija->query($cena);
        $trenutna = $result2->fetch();

        $id = $_SESSION['korisnik']->id_korisnik;
        $upit = "INSERT INTO kupovina(id_proizvod, id_korisnik, kolicina, cena_komad, ukupna_cena) 
                 VALUES (" . intval($idd) . ", " . intval($id) . ", " . intval($qt) . ", " . sprintf('%.2f', $trenutna->cena) . ", " . sprintf('%.2f', $trenutna->cena*$qt) . ")";
        $rez = $konekcija->query($upit);
        
        if (!$rez) {
            $greske++;
        } 
    }
    if (!$greske) {
        http_response_code(200);
        echo("You have successfully placed an order, one of the employees will contact you soon");
    } else {
        http_response_code(500);
        echo("An error occurred, please try again");
    }
}   
?>
