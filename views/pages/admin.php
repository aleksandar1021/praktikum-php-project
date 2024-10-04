<?php 
    include("views/fixed/headerAdmin.php");
    include("config/konekcija.php");
    $upitProizvod = "SELECT DISTINCT p.id_proizvod, opis, naziv, slika, naziv_brend, boja, naziv_kategorija 
                 FROM proizvod p 
                 JOIN brend b on p.id_brend = b.id_brend 
                 JOIN proizvod_boja pb ON p.id_proizvod = pb.id_proizvod 
                 JOIN boja bo ON pb.id_boja = bo.id_boja
                 JOIN kategorija k ON p.id_kategorija = k.id_kategorija";
    $rez = $konekcija->query($upitProizvod);
    $proizvodi = $rez->fetchAll();
?>      <?php
            include("views/fixed/headAdmin.php");
        ?>

        <div class="container-fluid pt-4 px-4">
            <?php
                if(isset($_GET["adminPage"])){
                    if(in_array($_GET["adminPage"], straniceAdmin)){
                        include "views/pages/adminPages/" . $_GET["adminPage"] . ".php";
                        //echo("views/pages/adminPages/" . $_GET["adminPage"] . ".php");
                    }else{
                        include "views/pages/adminPages/products.php";
                    }
                }else{
                    include "views/pages/adminPages/logs.php";
                }
            ?>

            
        </div>
            

        <?php
            include("views/fixed/footerAdmin.php");
        ?>
            