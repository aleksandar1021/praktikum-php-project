<?php 
    @session_start(); 
    if(!isset($_SESSION['korisnik'])){
        header("Location: index.php");
    }
?>
</div>
<div class="row col-12 my-5">
    <div class=" mx-auto p-5 col-10 my-5 bg-light anketa">
        <div id="modalKontakt">
            <div class="row2">
                <div id="closeModal2">X</div><br/>
            </div>
            <p id="ispis"></p>
        </div>  
        <h3 class="mb-3"><?=anketaPitanje()->pitanje;?></h3>

        <?php
            $idAnkete = anketaPitanje()->id_anketa;
            $resultOdgovori = anketaOdgovori($idAnkete);
            printAnketa($idAnkete, $resultOdgovori);
        ?>
    </div>
</div>