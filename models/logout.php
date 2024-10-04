<?php 
    @session_start();
    if(isset($_SESSION["korisnik"])){
        session_destroy();
        header("Location: ../index.php?page=login");
    }
?>