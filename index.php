<?php 
    @session_start();
    
    include("const/const.php");
    if(isset($_GET["page"])){
        if($_GET["page"]!="admin"){
            include("views/fixed/header.php");
        }
    }
    else{
        include("views/fixed/header.php");
    }
    if(isset($_GET["page"])){
                
        if(in_array($_GET["page"], stranice)){
            include "views/pages/" . $_GET["page"] . ".php";
        }
        else{
            include "views/pages/home.php";
        }
    }
    else{
        include "views/pages/home.php";
    }
    if(isset($_GET["page"])){
        if($_GET["page"]!="admin"){
            include("views/fixed/footer.php");
        }
    }
    else{
        include("views/fixed/footer.php");
    }
    
?>
      

