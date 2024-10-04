<?php
    ob_start();
    include("models/functions.php");
    include("models/log.php");
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>Baggage Ecommerce | Home</title>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="Aleksandar Kandić"/>
    <meta name="language" content="english"/>
    <meta name="copyright" content="gags store"/>
    <meta name="description" content="bags store, all bags in our stole"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="keywords" content="Baggage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design, bags,adidas,nike,versace,dior,gucci,dolce and gabana" />
    <link rel="stylesheet" href="assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="assets/css/bootstrap.css"/>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all"/>
    <link href="assets/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"/>
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"/>
    <link rel="icon" type="image/x-icon" href="assets/images/template-images/favicon.ico"/>

</head>

<body>


    <div id="modalCart">
        <div class="row2">
            <h4 class="ml-2">Your cart</h4>
            <div id="closeModal">X</div>
        </div>
        <div id="modalContent">
            
        </div>
        <div class="row3">
            <div class="tot">
                <h3>Total price:&nbsp;</h3>
                <h3 id="total"></h3>
            </div>
            <div id="izlaz">
                <a id="preusmeri"><div id="naruci">Checkout</div></a>
                <div id="obrisi">Empty the cart</div>
            </div>
        </div>
    </div>
    <div id="modalError" >
        <div class="row2">
            <h4 class="ml-2"></h4>
            <div id="closeModal4">X</div>
            <div id="cont"></div>
        </div>
        <p class="text-center pt-4 py-3 px-3"></p>
    </div>
    <div id="modalMail" >
        <div class="row2">
            <h4 class="ml-2"></h4>
            <div id="closeModal3">X</div>
        </div>
        <p class="text-center pt-4 py-3 px-3" id="suc"></p>
    </div>
    <div class="main-sec">
        <!-- //header -->
        <header class="py-sm-3 pt-3 pb-2" id="home">
            <div class="container">
                <!-- nav -->
                
                <div class="top-w3pvt d-flex navv">
                    <div id="logo">
                        <h1> <a href="index.html"><span class="log-w3pvt">B</span>aggage</a> <label class="sub-des">Online Store</label></h1>
                    </div>
                    
                        
                        <?php 
                        if(isset($_SESSION["korisnik"])){?>
                            <p id="osoba">HELLO <?=$_SESSION["korisnik"]->ime?>!</p>
                    <?php }?>
                        <?php 
                            if(!isset($_SESSION["korisnik"])){?>
                                <div class="forms ml-auto">
                                    <a href="?page=login" class="btn"><span class="fa fa-user-circle-o"></span> Sign In</a>
                                    <a href="?page=register" class="btn"><span class="fa fa-pencil-square-o"></span> Sign Up</a>
                                </div>
                        <?php }
                            else{?>
                                <div class="forms ml-auto">
                                    <a href="models/logout.php" class="btn"><span class="fa fa-user-circle-o"></span> Logout</a>
                                </div>
                        <?php } ?>
                        
                        
                      
                    
                </div>
                
                <div class="nav-top-wthree navv">
                    <nav id="navg">
                        <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu" id="navigation">
                            <?php 
                               $result = ispisNavigacije();
                               foreach($result as $r): ?>
                                    <li><a class='d-flex justify-content-center' href='?page=<?=$r->page?>'><?=$r->text?></a></li>
                            <?php endforeach ?>     
                        </ul>
                       
                    </nav>
                    <div id="pretraga">
                    
                        <?php 
                        
                                if(strpos($_SERVER['PHP_SELF'], 'shop.php')){?>
                                    <form id="tt" action="#" method="post" class="newsletter">
                                        <input class="search" id="trazi" type="search" placeholder="Search here..." required="">       
                                    </form>
                        <?php }?>
                        <?php
                                if(isset($_SESSION["korisnik"])):?>
                                    <div class="forms ml-auto" id="cart">
                                    <i class="zmdi zmdi-shopping-cart"></i><div id="krug"><p id="broj">0</p></div>
                                    </div>
                        <?php endif?>
                    
                    </div>
                    <div class="clearfix"></div>
                    
                   
                    

                </div>
            </div>
        </header>
        </div>