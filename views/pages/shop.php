<?php 
    @session_start();
    
    if(!isset($_SESSION['korisnik'])){
        header("Location: ?page=home");
    }
?>
     
</div>

<div id="modalKontakt">
        <div class="row2">
            <div id="closeModal2">X</div><br/>
        </div>
        <p id="ispis"></p>
</div>

    <section class="banner-bottom py-2">
        <div class="row col-12" id="ban">
           
            <div id="sort" class="row col-lg-3 col-sm-12 my-0">
                <h1 id="nas">Filters:</h1>
                <div class="red border py-2 px-2 mt-4">
                    <h2 class="ml-2 mt-2 mb-2">Brand</h2>
                    <?php 
                        ispisChcBrend("brend");
                    ?>
                    <h2 class="ml-2 mt-2 mb-2">Color</h2>
                    <?php 
                        ispisChcBoja("boja");
                    ?>
                    <h2 class="ml-2 mt-2 mb-2">Category</h2>
                    <?php 
                        ispisChcKategorija("kategorija");
                    ?>
                </div>
                
                <div class="red">
                    <h2>Sort by</h2>
                    <select name="sort" id="sor" class="wid ddl">
                    </select>
                </div>
        </div>
        
        <div class="container pt-5 col-lg-9 col-sm-12" id="baner">
           
        </div>
        <nav aria-label="..." class="mx-auto mt-3 nav3 mb-5">  
            <ul class="pagination pagination-lg d-flex justify-content-center">
            <?php
                $broj_strana = brojStrana();
                for($i = 0; $i< $broj_strana ; $i++):?>
                    <?php
                        if(!$i){?>
                            <li class="page-item"><a class="page-link strana active2" data-limit="<?= $i ?>"><?= $i+1?></a></li>
                        <?php }else{?>
                            <li class="page-item"><a class="page-link strana" data-limit="<?= $i ?>"><?= $i+1?></a></li>
                        <?php } ?>
                    
                <?php endfor?>  
            </ul>
        </nav>
    </div>

        <div id="dodato">
            <p>The product has been added to the cart</p>
        </div>

        
    </section>
