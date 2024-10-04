<?php 
    $greske = [];
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    else{
        header("Location: ?page=admin&adminPage=manageBrands");
    }

        $id = $_GET["id"];
        $upitBoja ="SELECT naziv_brend FROM brend WHERE id_brend = :id";

		$stm = $konekcija->prepare($upitBoja);
		$stm->bindParam(":id", $id);
		$stm->execute();
        $proizvod = $stm->fetch();


    if(isset($_POST["potvrdi"]))
    {
        if(!isset($_POST['label'])) {
            $greske['label'] = "Name is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Name is required!";
            }
        }

        if(!count($greske)) {
            $label = $_POST["label"];
			$upit="UPDATE brend SET naziv_brend = :boja WHERE id_brend = :id";
            $stm1 = $konekcija->prepare($upit);
            $stm1->bindParam(":id", $id);
            $stm1->bindParam(":boja", $label);
            $result = $stm1->execute();
            
            if(!$result) {
                $errors["greske"] = "An error has occurred.";
            } else {
                $errors["success"] = "Successful entry.";
				header("Location: ?page=admin&adminPage=manageBrands");
            }
			
		}
    }
        
     
?>
            <div class="container-fluid p-0">
            <h2 class="mb-4">Update brand</h2>
            <form method="post" action="?page=admin&adminPage=updateBrand&id=<?=$_GET["id"];?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">New brand name:</label>
                        <input type="text" class="form-control" value= "<?=$proizvod->naziv_brend?>" id="label" name="label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>


                    <button type="submit" name="potvrdi" class="btn btn-success">Update brand</button>
                    <?php //var_dump($proizvod);
                            //var_dump($id);?>
                </form>
            </div>

