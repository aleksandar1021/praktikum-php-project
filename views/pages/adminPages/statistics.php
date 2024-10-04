<h5 class="text-uppercase mb-2 text-secondary">Total page access statistics in percentage:</h5>

<?php
     $statistika = procenatPoStranama();
     foreach ($statistika as $stranica => $procenat) {
        $procenat = round($procenat,2);
        $stranica = trim($stranica);
        echo "Page: $stranica, Access percentage: $procenat%<br>";
     }
?>

<h5 class="text-uppercase mb-2 mt-5 text-secondary">Showing how many accesses there were to each page in the last 24 hours:</h5>
<?php
    $pristupi = numberOfVisitedPerPage();
    foreach ($pristupi as $stranica => $brojPristupa) {
        $stranica = trim($stranica);
        echo "Page: $stranica, number of visits: $brojPristupa<br>";
    }
?>

<h5 class="text-uppercase text-secondary mb-1 mt-5">The number of users who logged in on the current day:</h5>
<p class="text-danger font-weight-bold"><?=newUsersStatistic()?></p>






