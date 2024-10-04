<?php 

    include "../config/konekcija.php";

    if(isset($_POST["id"])) {
        $id_proizvod =  $_POST["id"];

        $slikaUpit = "SELECT slika FROM proizvod WHERE id_proizvod = :id_proizvod";
        $uuu = $konekcija->prepare($slikaUpit);
        $uuu ->bindParam(":id_proizvod", $id_proizvod);
        $uuu -> execute();
        $slikaLink = $uuu->fetch();

        $upitCena="DELETE  from cena where id_proizvod=:id_proizvod";
        $stmt = $konekcija->prepare($upitCena);
        $stmt->bindParam(":id_proizvod", $id_proizvod);
        $result = $stmt->execute();

        $upitPopust="DELETE  from popust where id_proizvod=:id_proizvod";
        $stmt1 = $konekcija->prepare($upitPopust);
        $stmt1->bindParam(":id_proizvod", $id_proizvod);
        $result1 = $stmt1->execute();

        $upitProizvodBoja="DELETE  from proizvod_boja where id_proizvod=:id_proizvod";
        $stmt2 = $konekcija->prepare($upitProizvodBoja);
        $stmt2->bindParam(":id_proizvod", $id_proizvod);
        $result2 = $stmt2->execute();

        $UpitProizvod = "DELETE FROM proizvod WHERE id_proizvod = :id_proizvod";
        $stmt3 = $konekcija->prepare($UpitProizvod);
        $stmt3->bindParam(":id_proizvod", $id_proizvod);
        $result3 = $stmt3->execute();

        if(!$result3){
            http_response_code(500);
        }
        else{
            http_response_code(200);
            unlink("../assets/images/product-images/big-images/".$slikaLink->slika);
            unlink("../assets/images/product-images/thumbnail//".$slikaLink->slika);
            //echo("../assets/images/".$slikaLink->slika);
        }
            
    } else {
        http_response_code(500);
    }

?>