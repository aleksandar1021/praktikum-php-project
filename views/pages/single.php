<?php 
    @session_start(); 
    $id = $_GET["id"];
    $proizvod = getProduct($id);
    $trenutna = getPrice($id);
    $pop = getDiscount($id);
?>
</div>
    </div>
    <!-- //banner-->
    <!--/banner-bottom -->
    <div id="modalKontakt">
        <div class="row2">
            <div id="closeModal2">X</div><br/>
        </div>
        <p id="ispis"></p>
    </div>
    <section class="banner-bottom py-5">
        <div class="container py-md-5">
            <!-- product right -->
            <div class="left-ads-display wthree">
                <div class="row">
                    <div class="desc1-left col-md-6" >
                        <img id="slika" src="assets/images/product-images/big-images/<?=$proizvod->slika?>" class="img-fluid" alt="<?=$proizvod->naziv?>">
                    </div>
                    
                    <div class="desc1-right col-md-6 pl-lg-3">
                        <h1 id="naziv"></h1>                        
                        <h2 class="mt-2">Brand:</h2>
                        <h3 class="mt-1 dodatak" id="brand"><?=$proizvod->naziv_brend?></h3>
                        <h2 class="mt-2 ">Color:</h2>
                        <h3 class="mt-1 dodatak" id="color"><?=$proizvod->boja?></h3>
                        <h2 class="mt-2 ">Intended for:</h2>
                        <h3 class="mt-1 dodatak" id="za"><?=$proizvod->naziv_kategorija?></h3>
                        <h2 class="mt-2 ">Price:</h2>
                        <div id="cene">
                            <?php 
                                price($pop, $trenutna)
                            ?>
                        </div>
                        <button id="add-to-cart-button">Add to cart</button>
                        
                    </div>

                    <div id="dodato">
                        <p>The product has been added to the cart</p>
                    </div>


                </div>
                <div class="sub-para-w3pvt my-5">
                    <h2 class="shop-sing mb-4 mb-3">Description:</h2>
                    <p id="opis"><?=$proizvod->opis?></p>
                </div>


               
    </section>
