<?php
    include("../config/konekcija.php");
    $greske = [];
    if(isset($_POST["label"])) {
        if(!isset($_POST['label'])) {
            $greske['label'] = "Label is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Label is required!";
            }
        }
        
        if(!isset($_POST['brand'])) {
            $greske['brand'] = "Brand is required!";
        }else {
            if($_POST["brand"] == "undefined") {
                $greske['brand'] = "Brand is required!";
            }
        }


        if(!isset($_POST['prom'])) {
            $greske["prom"] = "Promotion is required!";
        }else {
            if($_POST["prom"] == "undefined") {
                $greske["prom"] = "Promotion is required!";
            }
        }


        if(!isset($_POST['cat'])) {
            $greske["cat"] = "Category is required!";
        }else {
            if($_POST["cat"] == "undefined") {
                $greske["cat"] = "Category is required!";
            }
        }


        if(!isset($_POST['boja'])) {
            $greske["boja"] = "Color is required!";
        }else {
            if($_POST["boja"] == "undefined") {
                $greske["boja"] = "Color is required!";
            }
        }

        

        if(!isset($_POST["price"])) {
            $greske["price"] = "Price is required!";
        }else {
            if(!is_numeric($_POST["price"])) {
                $greske["price"] = "Price is must be numeric!";
            }
        }

       

        if(!isset($_POST["opis"])) {
            $greske["opis"] = "Description is required!";
        }else {
            if(ctype_alpha($_POST["opis"])) {
                $greske["opis"] = "Description is must be alpha!";
            }
        }

        
        if(!isset($_FILES["slika"])){
            $greske["slika"] = "Image is required!"; 
        }else{
            
            $dozvoljeniTipovi = ["image/jpeg", "image/jpg"];
            $slikaFajl = $_FILES["slika"];

            $tipSlike = $slikaFajl["type"];
            $velicina = $slikaFajl["size"];
            $tmpPutanja = $slikaFajl["tmp_name"];
            $name = $slikaFajl["name"];
            if(!in_array($tipSlike, $dozvoljeniTipovi)) {
                $greske[] = "An error occurred while entering the image or due to illegal image types, allowed image types are jpg and jpeg";
            }

            if($velicina > 3000000) {
                $greske[] = "The file must not exceed 2mb.";
            }

            
            $noviNazivSlike = "image--" . uniqid() . "--" . $name;
            $path = "../assets/images/product-images/big-images/";
            $inputPath = "../assets/images/product-images/thumbnail/";
            $novaPutanjaSlike = $path . $noviNazivSlike;

            $premestaj = move_uploaded_file($tmpPutanja, $novaPutanjaSlike);

            $greska = 0;
            if($premestaj){
                list($sirina, $visina) = getimagesize($novaPutanjaSlike);
                $novaSirina = $sirina/2;
                $novaVisina = $visina/2;
                $novaSlika = imagecreatetruecolor($novaSirina, $novaVisina);
                $uzetaSlika = imagecreatefromjpeg($novaPutanjaSlike);
                imagecopyresampled($novaSlika, $uzetaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
                $premestaj = imagejpeg($novaSlika, $inputPath.$noviNazivSlike);
            }
            else{
                $greska++;
            }

            if(!$premestaj){
                $greska++;
            }  
				
        }
        

         if(!count($greske)) {
            $label = $_POST["label"];
            $opis =  $_POST["opis"];
            $idKat = $_POST["cat"];
            $idBoje = $_POST["boja"];
            $idBrand = $_POST["brand"];
			$cena=$_POST["price"];
            $popust = $_POST["discount"];
			$promocija=$_POST["prom"];
            //echo $idBrand;
			
			$upitProizvod="";
            if($promocija>0){
                $upitProizvod = "INSERT INTO proizvod (naziv, opis, id_brend, slika, id_kategorija, id_promocija) VALUES (:naziv, :opis, :id_brend, :slika, :id_kategorija, :id_promocija)";
            }
            else{
                $upitProizvod = "INSERT INTO proizvod (naziv, opis, id_brend, slika, id_kategorija) VALUES (:naziv, :opis, :id_brend, :slika, :id_kategorija)";
            }
            
            $stmt = $konekcija->prepare($upitProizvod);
            $stmt->bindParam(":naziv", $label);
            $stmt->bindParam(":opis", $opis);
            $stmt->bindParam(":id_brend", $idBrand);
            $stmt->bindParam(":slika", $noviNazivSlike);
            $stmt->bindParam(":id_kategorija", $idKat);
            if($promocija>0){
                $stmt->bindParam(":id_promocija", $promocija); 
            }
            $result = $stmt->execute();
            
            $lastInsertedId=$konekcija->lastInsertId();
            

			$upitSnizenje="INSERT INTO popust(procenat,id_proizvod) VALUES (:procenat, :id_proizvod)";
            $stmt1 = $konekcija->prepare($upitSnizenje);
            $stmt1->bindParam(":procenat", $popust);
            $stmt1->bindParam(":id_proizvod", $lastInsertedId);
            $result1 = $stmt1->execute();

			$upitCena="INSERT INTO cena(cena, id_proizvod) VALUES (:cena, :id_proizvod)";
            $stmt2 = $konekcija->prepare($upitCena);
            $stmt2->bindParam(":cena", $cena);
            $stmt2->bindParam(":id_proizvod", $lastInsertedId);
            $result2 = $stmt2->execute();

			$upitProizvodBoja="INSERT INTO proizvod_boja(id_proizvod ,id_boja) VALUES (:id_proizvod, :id_boja)";
            $stmt3 = $konekcija->prepare($upitProizvodBoja);
            $stmt3->bindParam(":id_proizvod", $lastInsertedId);
            $stmt3->bindParam(":id_boja", $idBoje);
            $result3 = $stmt3->execute();

            if($result) {
                http_response_code(200);
                echo ("redirect");

            }
            
		}else{
            echo json_encode($greske);
        }

        

        

     }


?>