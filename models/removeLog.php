<?php
    if(isset($_GET["id"])){
        $Id = $_GET["id"];
        $fajl = file_get_contents("../data/log.txt");
        $linije = explode("\n", $fajl);
        unset($linije[$Id]);

        $noviUnos = implode("\n", $linije);
        $result = file_put_contents("../data/log.txt", $noviUnos);
        if($result){
            http_response_code(200);
        }
        else{
            http_response_code(500);
        }
        header("Location: ../index.php?page=admin&adminPage=logs");
    }
?>