<?php 

    include "../config/konekcija.php";

    if(isset($_POST["id"])) {
        $id_boje =  $_POST["id"];

    
     
        $upit = "DELETE from boja where id_boja = :id_boja";
        $stmt = $konekcija->prepare($upit);
        $stmt->bindParam(":id_boja", $id_boje);
        $result = $stmt->execute();

        
        if(!$result){
            http_response_code(500);
        }
        else{
            http_response_code(200);
        }
        
    } else {
        http_response_code(500);
    }

?>