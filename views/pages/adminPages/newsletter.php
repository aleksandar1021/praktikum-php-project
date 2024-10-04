            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Subscribed to the newsletter:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Mail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach(getNewsletter() as $p){?>
                                            <tr>
                                                <td scope="row"><?= $p->id_novosti ?></td>
                                                <td><?= $p->ime ?></td>
                                                <td><?= $p->prezime ?></td>
                                                <td><?= $p->mail ?></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            


           