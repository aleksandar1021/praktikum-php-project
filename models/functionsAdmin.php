<?php

function printTable(){
    $fajl = file("data/log.txt");  
    echo('<table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Time</th>
                <th scope="col">IP address</th>
                <th scope="col">page</th>
                <th scope="col">page</th>
            </tr>
        </thead>
        <tbody>');
            foreach($fajl as $index => $f){
                list($time, $ip, $page) = explode("__", $f);
                echo("<tr>
                    <td>$index</td>
                    <td>$time</td>
                    <td>$ip</td>
                    <td>$page</td>
                    <td><a href='models/removeLog.php?id=$index'><button type='button' class='btn obrisi btn-danger'>Remove</button></a></td>
                </tr>");
            }                                
            echo('</tbody>');
    echo('</table>');
}


function newUsersStatistic(){
    $upit = "SELECT COUNT(*) AS broj
            FROM korisnik
            WHERE datum = CURDATE()";
    global $konekcija;
    $res = $konekcija->query($upit);
    $result = $res -> fetch();
 
    return $result->broj;
}

function numberOfVisitedPerPage(){
    $logFile = 'data/log.txt';
    $pristupi = array();
    if (file_exists($logFile)) {
        $linije = file($logFile);
        foreach ($linije as $linija) {
            list($datum, $ip, $strana) = explode(separator, $linija);
            $vremePristupa = strtotime($datum);
            if ($vremePristupa >= strtotime('-24 hours')) {
                if (isset($pristupi[$strana])) {
                    $pristupi[$strana]++;
                } else {
                    $pristupi[$strana] = 1;
                }
            }
        }
    }

    return $pristupi;
}

function procenatPoStranama(){
    $file = 'data/log.txt';
    $kolicinaPristupa = 0;
    $ulazak = array();

    if (file_exists($file)) {
        $red = file($file);
        foreach ($red as $r) {
            list($datum, $ip, $strana) = explode(separator, $r);
            if (isset($ulazak[$strana])) {
                $ulazak[$strana]++;
            } else {
                $ulazak[$strana] = 1;
            }
            
            $kolicinaPristupa++;
        }
    }

    $statistika = array();
    foreach ($ulazak as $strana => $brojPristupa) {
        $procenat = ($brojPristupa / $kolicinaPristupa) * 100;
        $statistika[$strana] = $procenat;
    }
    return $statistika;
}

function dohvatiSve($tabela){
    global $konekcija;
    $upit = "SELECT * FROM $tabela";
    $stm = $konekcija->prepare($upit);
    $stm->execute();
    $rez = $stm->fetchAll();
    return $rez;
}

function getNewsletter(){
    global $konekcija;
    $upitPoruke = "SELECT n.mail, n.id_novosti, k.ime, k.prezime FROM novosti n JOIN korisnik k on k.id_korisnik = n.id_korisnik";
    $stm = $konekcija->prepare($upitPoruke);
    $stm->execute();
    $poruke = $stm->fetchAll();
    return $poruke;
}


?>