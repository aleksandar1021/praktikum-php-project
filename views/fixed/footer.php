    <!--/newsletter -->
  
    <?php 
        if(isset($_SESSION['korisnik'])){?>
         <section class="newsletter-w3pvt py-5">
        <div class="container py-md-5">
            <form method="post" action="#">
                <p class="text-center">Subscribe to the Handbags Store mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                <div class="row subscribe-sec">
                    <div class="col-md-9">
                        <input type="email" class="form-control" id="email" placeholder="Enter Your Email.." name="email" >

                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn submit" id="su">Subscribe</button>
                    </div>

                </div>
                <div class="row p-3">
                    <p id="poruka"></p>
                </div>

            </form>
        </div>
    </section>
    <?php } ?>
    
    <!--//newsletter -->
    <!--/shipping-->
    <section class="shipping-wthree">
        <div class="shiopping-grids d-lg-flex">
            <div class="col-lg-4 shiopping-w3pvt-gd text-center">
                <div class="icon-gd"><span class="fa fa-truck" aria-hidden="true"></span>
                </div>
                <div class="icon-gd-info">
                    <h3>FREE SHIPPING</h3>
                    <p>On all order over 500&euro;</p>
                </div>
            </div>
            <div class="col-lg-4 shiopping-w3pvt-gd sec text-center">
                <div class="icon-gd"><span class="fa fa-bullhorn" aria-hidden="true"></span></div>
                <div class="icon-gd-info">
                    <h3>FREE RETURN</h3>
                    <p>On 1st exchange in 10 days</p>
                </div>
            </div>
            <div class="col-lg-4 shiopping-w3pvt-gd text-center">
                <div class="icon-gd"> <span class="fa fa-gift" aria-hidden="true"></span></div>
                <div class="icon-gd-info">
                    <h3>MEMBER DISCOUNT</h3>
                    <p>Register to receive notifications</p>
                </div>

            </div>
        </div>

    </section>
    <!--//shipping-->
    <!-- footer -->
    <div class="footer_agileinfo_topf py-5">
        <div class="container py-md-5">
            <div class="row" id="fot">
                
                <div class="col-lg-5 col-sm-12 footer_wthree_gridf mt-md-0 mt-4" >
                    <ul class="footer_wthree_gridf_list">
                        <?php 
                            ispisNavigacije();
                        ?>

                    </ul>
                </div>
                

               
            </div>

            
            <div class="move-top text-center mt-lg-4 mt-3">
                <a href="#home"><span class="fa fa-angle-double-up" aria-hidden="true"></span></a>
            </div>
        </div>
    </div>
    <!-- //footer -->

    <!-- copyright -->
    <div class="cpy-right text-center py-2 foot">
        <div class="mt-3"><a id="doc" target="_blank" href="dokumentacija.docx">Documentation</a></div>
        <p class="mt-3">© 2019 Baggage. All rights reserved | Design by
            <a href="?page=home"> Aleksandar Kandic</a>
        </p>
        <div id="raz" class="col-lg-3 footer_wthree_gridf pl-5">
                    <h2><a href="?page=home"><span>B</span>aggage
                        </a> </h2>
               
        </div>
    </div>
    <!-- //copyright -->
    <script
        src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous">
    </script>
    <script src="assets/js/main.js" type="text/javaScript"></script>

</body>

</html>
