<div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Products:</h6>
                            <a href="index.php?page=admin&adminPage=addProducts"><button type="button" class="btn btn-primary mb-4">Add new product</button></a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Label</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Price</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach($proizvodi as $p){
                                                $cena = "SELECT cena FROM cena c JOIN proizvod p on c.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $p->id_proizvod ORDER BY datum desc LIMIT 0,1";
                                                $result2 = $konekcija->query($cena);
                                                $trenutna = $result2->fetch();
                                                
                                                $upitPopust = "SELECT procenat FROM popust po JOIN proizvod p on po.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $p->id_proizvod  ORDER BY datum_popust desc LIMIT 0,1";
                                                $popust = $konekcija->query($upitPopust);
                                                $pop = $popust->fetch();
                                                
                                            ?>
                                            <tr>
                                                <td scope="row"><?= $p->id_proizvod ?></td>
                                                <td><img class="slika" src="assets/images/product-images/thumbnail/<?= $p->slika ?>"/></td>
                                                <td><?= $p->naziv ?></td>
                                                <td><?= $p->naziv_brend ?></td>
                                                <td><?= $p->naziv_kategorija ?></td>
                                                <td><?= $p->boja ?></td>
                                                <td><?= $p->opis ?></td>
                                                <td><?= $pop->procenat?> %</td>
                                                <td><?= $trenutna->cena?> &euro;</td>
                                                <td><a onclick="obrisi(<?= $p->id_proizvod ?>,'removeProduct.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                <td><a href="index.php?page=admin&adminPage=updateProduct&id=<?= $p->id_proizvod ?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

