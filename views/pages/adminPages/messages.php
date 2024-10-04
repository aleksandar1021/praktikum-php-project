                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Messages:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Name and lastname</th>
                                        <th scope="col">Mail</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Adress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach(dohvatiSve("kontakt") as $p){?>
                                            <tr>
                                                <td scope="row"><?= $p->id_kontakt ?></td>
                                                <td><?= $p->ime_prezime ?></td>
                                                <td><?= $p->k_mail ?></td>
                                                <td><?= $p->telefon ?></td>
                                                <td><?= $p->tip_korisnika ?></td>
                                                <td><?= $p->poruka ?></td>
                                                <td><?= $p->adresa?></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>