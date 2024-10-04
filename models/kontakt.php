<?php 
    include("config/konekcija.php");
    if(isset($_POST["imePrezime"])){
        $imePrezime = $_POST["imePrezime"];
        $mail = $_POST["mail"];
        $adresa = $_POST["adresa"];
        $telefon = $_POST["telefon"];
        $tip = $_POST["tip"];
        $poruka = $_POST["poruka"];

        $upit = "INSERT INTO kontakt(ime_prezime, k_mail, telefon, tip_korisnika, poruka, adresa) VALUES (:imePrezime, :mail, :telefon, :tip, :poruka, :adresa)";
        $stm = $konekcija ->prepare($upit);
        $stm->bindParam(":imePrezime",$imePrezime);
        $stm->bindParam(":mail",$mail);
        $stm->bindParam(":telefon",$telefon);
        $stm->bindParam(":tip",$tip);
        $stm->bindParam(":poruka",$poruka);
        $stm->bindParam(":adresa",$adresa);
       
        $result = $stm->execute();

        if($result){
            echo json_encode($izlaz);
            http_response_code(200);
        }
        else{
            http_response_code(500);
        }
    }
?>