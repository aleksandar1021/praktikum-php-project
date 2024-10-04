<?php 
    $greske = [];
    if(isset($_POST["potvrdi"])) {

        if(!isset($_POST['label'])) {
            $greske['label'] = "Name is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Name is required!";
            }
        }

         if(!count($greske)) {

            $brand = $_POST["label"];
           
			$upitBrand="INSERT INTO brend(naziv_brend) VALUES (:brand)";
            $stmt = $konekcija->prepare($upitBrand);
            $stmt->bindParam(":brand", $brand);
            $result = $stmt->execute();

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
            <h2 class="mb-4">Insert new brand</h2>
                <form method="post" action="?page=admin&adminPage=addBrand" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Brand name:</label>
                        <input type="text" class="form-control" id="color" name="label" placeholder="Brand name">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>

                    <button type="submit" name="potvrdi" class="btn btn-danger">Insert Brand</button>

                </form>
            </div>


