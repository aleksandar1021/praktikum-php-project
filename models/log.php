<?php
    if(isset($_GET["page"])){
        $ipAdresa = $_SERVER['REMOTE_ADDR'];
        $page = $_GET['page'];
        $vreme = date('Y-m-d H:i:s');
        //echo($ipAdresa);
        $upis = $vreme . separator . $ipAdresa . separator . $page . "\n";
        file_put_contents('data/log.txt', $upis, FILE_APPEND);
    }
?>