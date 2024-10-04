        <div>
        
            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Orders:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Id product</th>
                                        <th scope="col">Id user</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price per piece</th>
                                        <th scope="col">Total price</th>
                                        <th scope="col">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach(dohvatiSve("kupovina") as $p){?>
                                            <tr>
                                                <td><?= $p->id_kupovina?></td>
                                                <td scope="row"><?= $p->id_proizvod ?></td>
                                                <td><?= $p->id_korisnik ?></td>
                                                <td><?= $p->kolicina ?></td>
                                                <td><?= $p->cena_komad ?>&euro;</td>
                                                <td><?= $p->ukupna_cena ?>&euro;</td>
                                                <td><?= $p->datum ?></td>
                                                
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                                            </div>




