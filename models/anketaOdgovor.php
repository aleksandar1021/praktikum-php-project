<?php
    @session_start();
    include "../config/konekcija.php";

    if(isset($_POST['odgovor'])){
        $odgovor = $_POST['odgovor'];
        $id = $_POST['id'];
        $idk = $_SESSION['korisnik']->id_korisnik;
        
        $upitNadji = "SELECT * from pitanje_odgovor WHERE id_korisnik = :idk AND id_anketa = :id";
        $stm = $konekcija->prepare($upitNadji);
        $stm->bindParam(":idk" ,$idk);
        $stm->bindParam(":id" ,$id);
        $stm->execute();
        $brojRedova = $stm->rowCount();

        $upitIdOdgovor = "SELECT id_odgovor FROM odgovor WHERE odgovor = :odgovor AND id_anketa = :id";
        $rezz = $konekcija -> prepare($upitIdOdgovor);
        $rezz->bindParam(":odgovor", $odgovor);
        $rezz->bindParam(":id", $id);
        $rezz->execute();
        $idOdgovor = $rezz -> fetchColumn();
        
        if($brojRedova==0){
            $insertUpit = "INSERT INTO pitanje_odgovor(id_odgovor, id_korisnik, id_anketa) VALUES (:idO,:idk,:id)";
            $stm = $konekcija->prepare($insertUpit);
            $stm->bindParam(":idO" ,$idOdgovor);
            $stm->bindParam(":idk" ,$idk);
            $stm->bindParam(":id" ,$id);
            $stm->execute();
            echo "You have successfully answered the question";
            if($stm){
                http_response_code(200);
            }
            else{
                http_response_code(500);
            }
        }
        else{
            echo "You have already answered this poll, when the administrator posts a new poll then you can vote again";
        }
    }
?>