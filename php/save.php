<?php
include "sql.php";
if($_POST['idZapisi'] == 0){
	$query = "INSERT INTO zapisi (idZapisi) VALUES (NULL)";
	$stats = $db->prepare($query);
	$stats->execute();
	$_POST['idZapisi'] = $db->lastInsertId();
}

$qr = "UPDATE zapisi SET Leto=STR_TO_DATE('1. ".getMonthNumber($_POST['mesec'])." ".$_POST['leto']."', '%e. %m %Y'), Razdalja=".fltdb($_POST['razdalja']).", Cas='".$_POST['ura'].":".$_POST['minuta'].":".$_POST['sekunda']."', PovpHitrost=".fltdb($_POST['povpHitrost']).", MaxHitrost=".fltdb($_POST['maxHitrost']).", MinTemp=".fltdb($_POST['minTemp']).", MaxTemp=".$_POST['maxTemp'].", Kalorije=".$_POST['energija']." WHERE idZapisi=".$_POST['idZapisi'];
$q = $db->query($qr);
print_r($db->errorInfo());

?>
