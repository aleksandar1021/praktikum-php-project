<!-- Footer Start -->
<div class="container-fluid col-12 pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="index.php?page=home">Baggage</a>, All Right Reserved. 
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="lib/chart/chart.min.js"></script> -->
  
    <!-- <script src="lib/easing/easing.min.js"></script> -->
    <!-- <script src="lib/waypoints/waypoints.min.js"></script> -->
    <!-- <script src="lib/owlcarousel/owl.carousel.min.js"></script> -->
    <!-- <script src="lib/tempusdominus/js/moment.min.js"></script> -->
    <!-- <script src="lib/tempusdominus/js/moment-timezone.min.js"></script> -->
    <!-- <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script> -->

    <!-- Template Javascript -->
    <!-- <script src="assets/js/main.js"></script> -->
</body>

</html>

<script>
    $(".obrisi").click(function(){
                    $(this).closest("tr").remove()
    })

    function obrisi(id, link) {
        
        $.ajax({
            url : "models/"+link,
            method: "POST",
            data: { id: id },
            success: function(x) {
                //console.log(x)
            },
            error: function(x){

            }
        })
    }

</script>

