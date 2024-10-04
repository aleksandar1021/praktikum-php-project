<?php
        @session_start();
        include("../config/konekcija.php");

        if(isset($_POST["ime"])){
                
                $ime = $_POST["ime"];
                $prezime = $_POST["prezime"];
                $mejl = $_POST["mail"];
                $lozinka=$_POST['password'];
                $lozinka2 = $_POST['password2'];
                $regImePrezime = "/[A-Z][a-z]{2,30}$/";
                $regMejl="/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";
                $greske =[];
           
                if(!filter_var($mejl, FILTER_VALIDATE_EMAIL)){
                        $greske["mejlGreska"] = "Mail is not in good format!<br/>";
                }
                if(!preg_match($regImePrezime,$ime)){
                        $greske["greskaIme"]="Incorect user name!<br/>";
                }
                if(!preg_match($regImePrezime,$prezime)){
                        $greske["greskaPreime"]="Incorect user lastname!<br/>";
                }
                if(strlen($lozinka)<8){
                        $greske["greskaLozinka"]="Password is not in good format!<br/>";
                }
                if($lozinka != $lozinka2){
                        $greske["greskaLozinka2"]="Password do not match!<br/>";
                }

                
                if(!$greske){
                        $upit = "SELECT * FROM korisnik WHERE mail ='$mejl'";
                        $rezultat = $konekcija->query($upit)->fetch();
                        if($rezultat){
                                $greske["greskaPostoji"] = "User already exists with this email!";
                                echo $greske["greskaPostoji"];
                        }
                        else{
                                $kriptovana = sha1($lozinka);
                                $upitInsert = "INSERT INTO korisnik(mail, ime, prezime, id_uloga, lozinka) VALUES (:mejl,:ime,:prezime,2,:kriptovana)";
                                $stm = $konekcija->prepare($upitInsert);
                                $stm->bindParam(":mejl", $mejl);
                                $stm->bindParam(":ime", $ime);
                                $stm->bindParam(":prezime", $prezime);
                                $stm->bindParam(":kriptovana", $kriptovana);
                                $rez = $stm->execute();
                                http_response_code(200);
                                echo "Successful registration, go to the page <a href='?page=login'>Signin</a>";
                        }

                }
                
                

        }
   

?>