<?php
include "sql.php";
$query = "SELECT ROUND(SUM(`Razdalja`), 1) as Razdalja, HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(Cas)))) as Ure, MINUTE(SEC_TO_TIME(SUM(TIME_TO_SEC(Cas)))) as Minute, ROUND(AVG(`PovpHitrost`), 2) as PovpHitrost, ROUND(MAX(`MaxHitrost`), 1) as MaxHitrost, MIN(`MinTemp`) as MinTemp, MAX(`MaxTemp`) as MaxTemp, ROUND(SUM(`Kalorije`)*0.004184, 2) as Kalorije FROM `zapisi` WHERE Leto>= STR_TO_DATE('".$_POST['start']."', '%d.%m.%Y') AND Leto < STR_TO_DATE('".$_POST['stop']."', '%d.%m.%Y') ORDER BY Leto";
$stats = $db->prepare($query);
$stats->execute();
$result['sum'] = $stats->FetchAll();

$query = "SELECT CONCAT(MONTHNAME(Leto), ' ', YEAR(Leto)) as Mesec, ROUND(Razdalja, 1) as Razdalja, TIME_TO_SEC(Cas) as Sekunde, PovpHitrost, MaxHitrost, MinTemp, MaxTemp, ROUND(Kalorije*0.004184, 2) as Kalorije FROM `zapisi` WHERE Leto>= STR_TO_DATE('".$_POST['start']."', '%d.%m.%Y') AND Leto < STR_TO_DATE('".$_POST['stop']."', '%d.%m.%Y') ORDER BY Leto";
$stats = $db->prepare($query);
$stats->execute();

$result['chart'] = $stats->FetchAll();
echo json_encode($result);
?>
