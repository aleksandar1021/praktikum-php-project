<?php 
    $greske = [];
    
    if(isset($_POST["potvrdi"])) {

        if(!isset($_POST['label'])) {
            $greske['label'] = "Href is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Href is required!";
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

            $href = $_POST["label"];
            $text = $_POST["text"];
           
			$upitBoja="INSERT INTO navigacija(text, link) VALUES (:text, :link)";
            $stmt = $konekcija->prepare($upitBoja);
            $stmt->bindParam(":link", $href);
            $stmt->bindParam(":text", $text);
            $result = $stmt->execute();

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
            <h2 class="mb-4">Insert new link</h2>
                <form method="post" action="?page=admin&adminPage=addNavigation" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Link name:</label>
                        <input type="text" class="form-control" id="color" name="label" placeholder="Link name">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>

                        <label class="mt-3" for="exampleFormControlInput1">Text name:</label>
                        <input type="text" class="form-control" id="text" name="text" placeholder="Text name">
                        <?php
                            if(isset($greske['text'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['text'] . "</p>";
                            } 
                        ?>
                       
                    </div>

                    <button type="submit" name="potvrdi" class="btn btn-danger">Insert link</button>

                </form>
            </div>
