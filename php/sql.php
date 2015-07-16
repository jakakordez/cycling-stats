<?php
	include "../config.php";
	include "translation.php";

	$options = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
	);

	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password, $options);
	$db->prepare("SET lc_time_names='".$GLOBALS['lan']."'")->execute();
	$meseci = $db->prepare("SELECT MONTH(Leto) as M, YEAR(Leto) as Y, CONCAT(MONTHNAME(Leto), ' ', YEAR(Leto)) as Mesec FROM `zapisi` group by Leto order by Leto");
	$meseci->execute();
	$meseci = $meseci->fetchAll();

	function getMesecOptions($meseci, $konec = false){
		for($i = 0; $i < sizeof($meseci); $i++){
			$mes = $meseci[$i];
			echo "<option value='1.".(($konec)?$mes['M']+1:$mes['M']).".".$mes['Y']."'>".$mes['Mesec']."</option>";
		}
	}

	function fltdb($val){
		return str_replace(",", ".", $val);

	}
?>
