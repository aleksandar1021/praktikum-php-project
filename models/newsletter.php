<?php 
    @session_start();
    include("../config/konekcija.php");
    if(isset($_POST["mejl"])){
        $mejl = $_POST["mejl"];
        $id = $_SESSION['korisnik']->id_korisnik;

        $upit = "INSERT INTO novosti (id_korisnik,mail) VALUES ($id, :mejl)";

        $stm = $konekcija->prepare($upit);
        $stm -> bindParam(":mejl",$mejl);
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