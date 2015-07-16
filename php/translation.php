<?php

$GLOBALS['translation']['en_US'] = array(
  'Kolo' => 'Cycling',
  'Pregled' => 'Overview',
  'Obdobje' => 'Period',
  'Razdalja' => 'Distance',
  'Čas' => 'Time',
  'Povprečna' => 'Average',
  'Najvišja' => 'Maximum',
  'Najnižja' => 'Minimum',
  'hitrost' => 'speed',
  'temperatura' => 'temperature',
  'Zapisi' => 'Records',
  'Dodaj zapis' => 'Add record',
  'Mesec' => 'Month',
  'Energija' => 'Energy',
  'Uredi' => 'Edit',
  'Shrani' => 'Save',
  'januar' => 'January',
  'februar' => 'February',
  'marec' => 'March',
  'april' => 'April',
  'maj' => 'May',
  'junij' => 'June',
  'julij' => 'July',
  'avgust' => 'August',
  'september' => 'September',
  'oktober' => 'October',
  'november' => 'November',
  'december' => 'December'
);

function gs($value){
   if($GLOBALS['lan'] == 'sl_SI') echo $value;
   else echo $GLOBALS['translation'][$GLOBALS['lan']][$value];
}

function getMonths(){
   getMonth("januar");
   getMonth("februar");
   getMonth("marec");
   getMonth("april");
   getMonth("maj");
   getMonth("junij");
   getMonth("julij");
   getMonth("avgust");
   getMonth("september");
   getMonth("oktober");
   getMonth("november");
   getMonth("december");
}

function getMonth($v){
   echo "<option value='";
   gs($v);
   echo "'>";
   gs($v);
   echo "</option>";
}

function getMonthNumber($m){
   $meseci = array("januar"=>1, "februar"=>2, "marec"=>3, "april"=>4, "maj"=>5, "junij"=>6, "julij"=>7, "avgust"=>8, "september"=>9, "oktober"=>10, "november"=>11, "december"=>12);
	$k = array_search($m, $GLOBALS['translation'][$GLOBALS['lan']]);
   return $meseci[$k];
}

?>
