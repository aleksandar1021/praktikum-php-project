            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Colors:</h6>
                            <a href="?page=admin&adminPage=addCategory"><button type="button" class="btn btn-primary mb-4">Add new category</button></a>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Category</th>
                                        <th></th>
                                        <th></th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach(dohvatiSve("kategorija") as $p){?>
                                                <tr>
                                                    <td scope="row"><?= $p->id_kategorija ?></td>
                                                    <td><?= $p->naziv_kategorija ?></td>
                                                    <td><a onclick="obrisi(<?= $p->id_kategorija ?>, 'removeCategory.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                    <td><a href="?page=admin&adminPage=updateCategory&id=<?= $p->id_kategorija ?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                                </tr>
                                                <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

