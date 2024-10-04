            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Navigation:</h6>
                            <a href="?page=admin&adminPage=addNavigation"><button type="button" class="btn btn-primary mb-4">Add new link</button></a>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Text</th>
                                        <th scope="col">Href</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach(dohvatiSve("navigacija") as $p){?>
                                                <tr>
                                                    <td scope="row"><?= $p->id_nav ?></td>
                                                    <td><?= $p->text ?></td>
                                                    <td><?= $p->link ?></td>
                                                    <td><a onclick="obrisi(<?= $p->id_nav ?>, 'removeNavigation.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                    <td><a href="?page=admin&adminPage=updateNavigation&id=<?= $p->id_nav ?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                                </tr>
                                                <?php } ?>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
