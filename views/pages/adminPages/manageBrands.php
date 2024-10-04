         <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Brands:</h6>
                            <a href="?page=admin&adminPage=addBrand"><button type="button" class="btn btn-primary mb-4">Add new brand</button></a>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach(dohvatiSve("brend") as $p){?>
                                                <tr>
                                                    <td scope="row"><?= $p->id_brend ?></td>
                                                    <td><?= $p->naziv_brend ?></td>
                                                    <td><a onclick="obrisi(<?= $p->id_brend ?>, 'removeBrand.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                    <td><a href="?page=admin&adminPage=updateBrand&id=<?= $p->id_brend ?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                                </tr>
                                                <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

   