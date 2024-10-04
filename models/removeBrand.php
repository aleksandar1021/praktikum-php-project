<?php 

    include "../config/konekcija.php";
    if(isset($_POST["id"])) {
        $id_brend =  $_POST["id"];

    
     
        $upit = "DELETE from brend where id_brend = :id_brend";
        $stmt = $konekcija->prepare($upit);
        $stmt->bindParam(":id_brend", $id_brend);
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