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

            $color = $_POST["label"];
           
			$upitBoja="INSERT INTO boja(boja) VALUES (:boja)";
            $stmt = $konekcija->prepare($upitBoja);
            $stmt->bindParam(":boja", $color);
            $result = $stmt->execute();

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
            <h2 class="mb-4">Insert new color</h2>
                <form method="post" action="index.php?page=admin&adminPage=addColor" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Color name:</label>
                        <input type="text" class="form-control" id="color" name="label" placeholder="Color name">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>

                    <button type="submit" name="potvrdi" class="btn btn-danger">Insert color</button>

                </form>
            </div>


