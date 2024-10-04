<?php 
    $greske = [];
    
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    else{
        //header("Location: admin.php");
    }

    $id = $_GET["id"];
        $upitBoja ="SELECT boja FROM boja WHERE id_boja = :id";

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
            
			$upit="UPDATE boja SET boja = :boja WHERE id_boja = :id";
            $stm1 = $konekcija->prepare($upit);
            $stm1->bindParam(":id", $id);
            $stm1->bindParam(":boja", $label);
            $result = $stm1->execute();
            
            if(!$result) {
                $errors["greske"] = "An error has occurred.";
            } else {
                $errors["success"] = "Successful entry.";
				header("Location: ?page=admin&adminPage=manageColors");
            }
			
		}
    }  
?>
            <div class="container-fluid p-0">
            <h2 class="mb-4">Update color</h2>
            <form method="post" action="?page=admin&adminPage=updateColor&id=<?=$_GET["id"];?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">New color name:</label>
                        <input type="text" class="form-control" value= "<?=$proizvod->boja?>" id="label" name="label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>


                    <button type="submit" name="potvrdi" class="btn btn-success">Update color</button>
                    <?php //var_dump($proizvod);
                            //var_dump($id);?>
                </form>
            </div>
