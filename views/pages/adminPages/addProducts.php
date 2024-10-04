

            <div class="container-fluid p-0">
            <h2 class="mb-4">Insert new product</h2>
                <form method="post" action="models/adds.php" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Label for product:</label>
                        <input type="text" class="form-control" id="label" name="label" placeholder="Product label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select brand:</label>
                        <select class="form-control" id="brand" name="brand">
                            <?php 
                                $upitBrend ="SELECT * FROM brend";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select brand</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_brend'>$b->naziv_brend</option>";
                                }
                            ?>
                        </select>
                        <?php
                            if(isset($greske['brand'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['brand'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select category:</label>
                        <select class="form-control" id="cat" name="cat">
                        <?php 
                                $upitBrend ="SELECT * FROM kategorija";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select category</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_kategorija'>$b->naziv_kategorija</option>";
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['cat'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['cat'] . "</p>";
                            } 
                        ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select promotion:</label>
                        <select class="form-control" id="prom" name="prom">
                        <?php 
                                $upitBrend ="SELECT * FROM promocija";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='-1'>Select promotion</option>";
                                echo "<option value='0'>Without promotion</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_promocija'>$b->promocija</option>";
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['prom'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['prom'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select color:</label>
                        <select class="form-control" id="boja" name="boja">
                        <?php 
                                $upitBrend ="SELECT * FROM boja";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select color</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_boja'>$b->boja</option>";
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['boja'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['boja'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Insert price of product:</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Product price">
                        <?php
                            if(isset($greske['price'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['price'] . "</p>";
                            } 
                        ?>
                    </div>


                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Insert discount for product:</label>
                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Product discount">
                      
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Select image for product:</label><br/>
                        <input type="file" name="slika" class="form-control-file mb-3" id="slika">
                        <?php
                            if(isset($greske['slika'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['slika'] . "</p>";
                            } 
                        ?>
                    </div>
                    
                    
                    <div class="form-group mb-5">
                        <label for="exampleFormControlTextarea1">Product description:</label>
                        <textarea name="opis" class="form-control" id="opis" rows="7"></textarea>
                        <?php
                            if(isset($greske['opis'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['opis'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div id="greske"></div>

                    <button type="button" name="potvrdi" id="potvrdi" class="btn btn-danger">Insert product</button>

                </form>
                <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            </div>

        <script>

            var selBrend
            $("#brand").change(function() {
                selBrend = $(this).val();
            });

            var selProm
            $("#prom").change(function() {
                selProm = $(this).val();
            });

            var selCat
            $("#cat").change(function() {
                selCat = $(this).val();
            });

            var selColor
            $("#boja").change(function() {
                selColor = $(this).val();
            });

            
            
            
            $("#potvrdi").click(function(){
               
                var formData = new FormData();
                formData.append('slika', $('#slika')[0].files[0]);
                formData.append('label', $('#label').val());
                formData.append('opis', $('#opis').val());
                formData.append('cat', selCat);
                formData.append('boja', selColor);
                formData.append('brand', selBrend);
                formData.append('prom', selProm);
                formData.append('price', $('#price').val());
                formData.append('discount', $('#discount').val());

                $.ajax({
                url: 'models/adds.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) { //6478acde5ab09--slika
                    console.log(result)
                    if(result == "redirect"){
                        window.location.href = "index.php?page=admin&adminPage=products";
                    }else{
                        result = JSON.parse(result)
                        console.log(result)
                        let greska = `<p class="alert alert-danger">`
                        let errorMessages = Object.values(result);
                        let ispis = ""
                        for(e of errorMessages){
                            ispis += e+"</br>"
                        }
                        $("#greske").html(greska + ispis + "</p>")
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error); 
                }
                });
            })
           
        </script>



          