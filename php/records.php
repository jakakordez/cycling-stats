<?php
include "sql.php";
$statement = $db->prepare("select *, CONCAT(MONTHNAME(Leto), ' ', YEAR(Leto)) as Mesec from zapisi order by Leto");
$statement->execute();
while($row = $statement->fetch()){
	echo "<tr id='z".$row['idZapisi']."'><td>".$row['Mesec']."</td><td>".$row['Razdalja']."</td><td>".$row['Cas']."</td><td>".$row['PovpHitrost']."</td>";
	echo "<td>".$row['MaxHitrost']."</td><td>".$row['MinTemp']."</td><td>".$row['MaxTemp']."</td><td>".$row['Kalorije']."</td>";
	echo "<td><div class='button' onClick='edit(".$row['idZapisi'].");'><img src='edit.png'></div><div class='button' onClick='delRecord(".$row['idZapisi'].");'><img src='delete.png'></div></tr>";
}
?>