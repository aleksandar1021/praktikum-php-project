<?php 
    $greske = [];
    
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    else{
        header("Location: ?page=admin&adminPage=manageNavigation");
    }

        $id = $_GET["id"];
        $upitBoja ="SELECT * FROM navigacija WHERE id_nav = :id";

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
        if(!isset($_POST['text'])) {
            $greske['text'] = "Text is required!";
        }else {
            if(!$_POST["text"]) {
                $greske['text'] = "Text is required!";
            }
        }

        if(!count($greske)) {

           
            $label = $_POST["label"];
            $text = $_POST["text"];
            
			$upit="UPDATE navigacija SET link = :link, text = :text WHERE id_nav = :id";
            $stm1 = $konekcija->prepare($upit);
            $stm1->bindParam(":id", $id);
            $stm1->bindParam(":link", $text);
            $stm1->bindParam(":text", $label);
            $result = $stm1->execute();
            
            if(!$result) {
                $errors["greske"] = "An error has occurred.";
            } else {
                $errors["success"] = "Successful entry.";
				header("Location: ?page=admin&adminPage=manageNavigation");
            }
			
		}
    }
        
     
?>
            <div class="container-fluid p-0">
            <h2 class="mb-4">Update link</h2>
            <form method="post" action="?page=admin&adminPage=updateNavigation&id=<?=$_GET["id"];?>" enctype="multipart/form-data">
            <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Link name:</label>
                        <input type="text" value= "<?=$proizvod->text?>" class="form-control" id="color" name="label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>

                        <label class="mt-3" for="exampleFormControlInput1">Text name:</label>
                        <input type="text" value= "<?=$proizvod->link?>" class="form-control" id="text" name="text">
                        <?php
                            if(isset($greske['text'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['text'] . "</p>";
                            } 
                        ?>
                       
                    </div>


                    <button type="submit" name="potvrdi" class="btn btn-success">Update link</button>
                    <?php //var_dump($proizvod);
                            //var_dump($id);?>
                </form>
            </div>
