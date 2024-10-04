<?php 
    @session_start();
    include("../config/konekcija.php");

    if(isset($_POST['mail'])){
        $mejl = $_POST["mail"];
        $lozinka = $_POST["password"];
      
        $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.id_uloga = u.id_uloga where mail = :mejl";
        $stm = $konekcija -> prepare($upit);
        $stm -> bindParam(":mejl", $mejl);
        $stm->execute();
        $rezultat = $stm->fetch();

        $kriptovana = sha1($lozinka);

        //echo($kriptovana);

        if(!$rezultat) {
            $greska = "The user is not found, try again.";
            echo($greska);
            http_response_code(401);
        } else {
            if($rezultat->lozinka != $kriptovana) {
                $greska = "Passwords do not match, try again.";
                echo($greska);
                http_response_code(200);
            }else{
                $_SESSION['korisnik'] = $rezultat;
                echo("redirect");
                http_response_code(200);
            } 
        }
        
    }

?>