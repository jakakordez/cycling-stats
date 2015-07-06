<?php
include "sql.php";
$query = "DELETE FROM zapisi WHERE idZapisi = ".$_POST['idZapisi'];
$stats = $db->prepare($query);
$stats->execute();
?>