<?php 
    $greske = [];
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    else{
        header("Location: index.php?page=admin&adminPage=products");
    }
    $id = $_GET["id"];
        $upitProizvod ="SELECT p.id_promocija, p.id_brend, c.cena, p.id_kategorija, p.id_proizvod, opis, naziv, slika, naziv_brend, boja, naziv_kategorija 
                        FROM proizvod p 
                        JOIN brend b on p.id_brend = b.id_brend 
                        JOIN proizvod_boja pb ON p.id_proizvod = pb.id_proizvod 
                        JOIN boja bo ON pb.id_boja = bo.id_boja
                        JOIN kategorija k ON p.id_kategorija = k.id_kategorija
                        JOIN cena c on c.id_proizvod=p.id_proizvod 
                        WHERE p.id_proizvod = :id_proizvod 
                        ORDER BY c.datum DESC limit 0,1";

		$stm = $konekcija->prepare($upitProizvod);
		$stm->bindParam(":id_proizvod", $id);
		$stm->execute();
        $proizvod = $stm->fetch();
        

        $upitPopust ="SELECT procenat FROM popust WHERE id_proizvod = :id_proizvod ORDER BY datum_popust DESC limit 0,1";

		$stm1 = $konekcija->prepare($upitPopust);
		$stm1->bindParam(":id_proizvod", $id);
		$stm1->execute();
        $popust = $stm1->fetch();

        $upitBoje ="SELECT id_boja FROM proizvod_boja WHERE id_proizvod = :id_proizvod";

		$stm2 = $konekcija->prepare($upitBoje);
		$stm2->bindParam(":id_proizvod", $id);
		$stm2->execute();
        $boje = $stm2->fetch();

    if(isset($_POST["potvrdi"]))
    {
        if(!isset($_POST['label'])) {
            $greske['label'] = "Name is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Name is required!";
            }
        }

        if($_POST["brand"] =="0") {
            $greske["brand"] = "Brand is required!";
        }

		if($_POST["cat"] == "0") {
            $greske["cat"] = "Brand is required!";
        }

        if($_POST["boja"] == "0") {
            $greske["boja"] = "Color is required!";
        }

        

        if(!isset($_POST["price"])) {
            $greske["price"] = "Price is required!";
        }else {
            if(!$_POST["price"]) {
                $greske["price"] = "Price is required!";
            }
        }

       

        if(!isset($_POST["opis"])) {
            $greske["opis"] = "Description is required!";
        }else {
            if(!$_POST["opis"]) {
                $greske["opis"] = "Description is required!";
            }
        }

        if(!isset($_FILES["slika"])){
            $greske["slika"] = "Image is required!"; 
        }else{
            if(!$_FILES["slika"]){
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

            if($velicina > 4000000) {
                $greske[] = "The file must be smoler then 3mb.";
            }

            
            $noviNazivSlike = "image--" . uniqid() . "--" . $name;
            $path = "assets/images/product-images/big-images/";
            $inputPath = "assets/images/product-images/thumbnail/";
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
				
        }}
        
        //var_dump($greske);
        if(!count($greske)) {

            $label = $_POST["label"];
            $opis =  $_POST["opis"];
            $idKat = $_POST["cat"];
            $idBoje = $_POST["boja"];
            $idBrand = $_POST["brand"];
			$cena=$_POST["price"];
            $popust = $_POST["discount"];
			$promocija=$_POST["prom"];

			$upitProizvod="";
            if($promocija>0){
                $upitProizvod = "UPDATE proizvod SET naziv = :naziv, opis = :opis, id_brend = :id_brend, slika = :slika, id_kategorija = :id_kategorija, id_promocija = :id_promocija WHERE id_proizvod = :id_proizvod";
            }
            else{
                $promocija = null;
                $upitProizvod = "UPDATE proizvod SET naziv = :naziv, opis = :opis, id_brend = :id_brend, slika = :slika, id_kategorija = :id_kategorija, id_promocija = :id_promocija WHERE id_proizvod = :id_proizvod";
            }
            
            $stmt = $konekcija->prepare($upitProizvod);
            $stmt->bindParam(":naziv", $label);
            $stmt->bindParam(":opis", $opis);
            $stmt->bindParam(":id_brend", $idBrand);
            $stmt->bindParam(":slika", $noviNazivSlike);
            $stmt->bindParam(":id_kategorija", $idKat);
            $stmt->bindParam(":id_promocija", $promocija);
            $stmt->bindParam(":id_proizvod", $id);
            $result = $stmt->execute();

            echo("sdas");

			$upitSnizenje="UPDATE popust SET procenat = :procenat WHERE id_proizvod = :id_proizvod";
            $stmt1 = $konekcija->prepare($upitSnizenje);
            $stmt1->bindParam(":procenat", $popust);
            $stmt1->bindParam(":id_proizvod", $id);
            $result1 = $stmt1->execute();

			$upitCena="INSERT INTO cena(cena, id_proizvod) VALUES (:cena, :id_proizvod)";
            $stmt2 = $konekcija->prepare($upitCena);
            $stmt2->bindParam(":cena", $cena);
            $stmt2->bindParam(":id_proizvod", $id);
            $result2 = $stmt2->execute();

			$upitProizvodBoja="UPDATE proizvod_boja SET id_boja =:id_boja,id_proizvod=:id_proizvod WHERE id_proizvod = :id_proizvod";
            $stmt3 = $konekcija->prepare($upitProizvodBoja);
            $stmt3->bindParam(":id_proizvod", $id);
            $stmt3->bindParam(":id_boja", $idBoje);
            $result3 = $stmt3->execute();

            if(!$result) {
                $errors["greske"] = "An error has occurred, try later.";
            } else {
                $errors["success"] = "Successful.";
				header("Location: ?page=admin&adminPage=products");
            }
		}}
        global $proizvod
     
?>

            <div class="container-fluid p-0">
            <h2 class="mb-4">Update product</h2>
            <form method="post" action="?page=admin&adminPage=updateProduct&id=<?=$_GET["id"];?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Label for product:</label>
                        <input type="text" class="form-control" value= "<?=$proizvod->naziv ?>" id="label" name="label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select brand:</label>
                        <select class="form-control" id="brand" name="brand">
                            <?php 
                            
                                $upitBrend ="SELECT * FROM brend";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                               
                                echo "<option hidden value='0'>Select brand</option>";
                                foreach($brendovi as $b){
                                    if($b->id_brend == $proizvod->id_brend){
                                        echo "<option selected value='$b->id_brend'>$b->naziv_brend</option>";
                                    }else{
                                        echo "<option value='$b->id_brend'>$b->naziv_brend</option>";
                                    }
                                }
                                
                            ?>
                        </select>
                        <?php
                            if(isset($greske['brand'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['brand'] . "</p>";
                            }  
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select category:</label>
                        <select class="form-control" id="cat" name="cat">
                        <?php 
                                $upitBrend ="SELECT * FROM kategorija";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select category</option>";
                                foreach($brendovi as $b){
                                    if($b->id_kategorija == $proizvod->id_kategorija){
                                        echo "<option selected value='$b->id_kategorija'>$b->naziv_kategorija</option>";
                                    }else{
                                        echo "<option value='$b->id_kategorija'>$b->naziv_kategorija</option>";
                                    }
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['cat'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['cat'] . "</p>";
                            } 
                        ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select promotion:</label>
                        <select class="form-control" id="prom" name="prom">
                        <?php 
                                $upitBrend ="SELECT * FROM promocija";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='-1'>Select promotion</option>";
                                echo "<option value='0'>Without promotion</option>";
                                foreach($brendovi as $b){
                                    if($b->id_promocija == $proizvod->id_promocija){
                                        echo "<option selected value='$b->id_promocija'>$b->promocija</option>";
                                    }else{
                                        echo "<option value='$b->id_promocija'>$b->promocija</option>";
                                    }
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['prom'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['prom'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select color:</label>
                        <select class="form-control" id="boja" name="boja">
                        <?php 
                                $upitBrend ="SELECT * FROM boja";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select color</option>";
                                foreach($brendovi as $b){
                                    if($b->id_boja == $boje->id_boja){
                                        echo "<option selected value='$b->id_boja'>$b->boja</option>";
                                    }else{
                                        echo "<option value='$b->id_boja'>$b->boja</option>";
                                    }
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['boja'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['boja'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Insert price of product:</label>
                        <input type="text" value="<?= $proizvod->cena ?>" class="form-control" id="price" name="price"">
                        <?php
                            if(isset($greske['price'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['price'] . "</p>";
                            } 
                        ?>
                    </div>


                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Insert discount for product:</label>
                        <input type="text" value="<?= $popust->procenat ?>" class="form-control" id="discount" name="discount">
                      
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Select image for product:</label><br/>
                        <input type="file" name="slika" class="form-control-file mb-3" id="exampleFormControlFile1">
                        <?php
                            if(isset($greske['slika'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['slika'] . "</p>";
                            } 
                        ?>
                    </div>
                    
                    
                    <div class="form-group mb-5">
                        <label for="exampleFormControlTextarea1">Product description:</label>
                        <textarea name="opis" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $proizvod->opis ?></textarea>
                        <?php
                            if(isset($greske['opis'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['opis'] . "</p>";
                            } 
                        ?>
                    </div>

                    <?php
                            if(isset($greske)){
                                echo "<p class = 'alert-danger mt-3'>";
                                foreach($greske as $g){
                                    echo($g."</br>");
                                }
                                echo ("</p>");
                            } 
                        ?>

                    <button type="submit" name="potvrdi" class="btn btn-success">Update product</button>
                    <?php //var_dump($proizvod);
                            //var_dump($id);?>
                </form>
            </div>



            