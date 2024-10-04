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
                                    <th scope="col">Name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Mail</th>
                                    <th scope="col">Registration date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        foreach(dohvatiSve("korisnik") as $p){?>
                                        <tr>
                                            <td><?= $p->id_korisnik?></td>
                                            <td scope="row"><?= $p->ime ?></td>
                                            <td><?= $p->prezime ?></td>
                                            <td><?= $p->mail ?></td>
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




