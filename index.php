   <?php
 include "php/sql.php";
?>
<!doctype html>
<html>
	<head>
		<title><?php gs("Kolo"); ?></title>
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="css/init.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/table.css">
		<link rel="stylesheet" type="text/css" href="css/color3.css">
		<script src="js/jquery.js"></script>
		<script src="js/Chart.js"></script>
		<script src="js/Graph.js"></script>
		<script src="js/jquery.numeric.js"></script>
		<script src="js/popup.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<div class="wrapper">
			<div class="title">
				<h1><?php gs("Kolo"); ?></h1>
			</div>
			<div class="section">
				<h2><?php gs("Pregled"); ?></h2>
				<div class="graph">
					<canvas id="myChart" width="800" height="400"></canvas>
				</div>
				<div class="stats">
					<div class="stat">
						<div class="statText"><span><?php gs("Obdobje"); ?></span></div>
						<div class="statValue" id="obdobje"><select id="timeStart"><?php getMesecOptions($meseci); ?></select><br /><select id="timeEnd"><?php getMesecOptions($meseci, true); ?></select></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Razdalja"); ?></span></div>
						<div class="statValue" id="razdalja"></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Čas"); ?></span></div>
						<div class="statValue" id="cas"></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Povprečna"); ?><br> <?php gs("hitrost"); ?></span></div>
						<div class="statValue" id="povpHitrost"></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Najvišja"); ?><br> <?php gs("hitrost"); ?></span></div>
						<div class="statValue" id="maxHitrost"></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Najnižja"); ?><br> <?php gs("temperatura"); ?></span></div>
						<div class="statValue" id="minTemp"></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Najvišja"); ?><br> <?php gs("temperatura"); ?></span></div>
						<div class="statValue" id="maxTemp"></div>
					</div>
					<div class="stat">
						<div class="statText"><span><?php gs("Energija"); ?></span></div>
						<div class="statValue" id="energija"></div>
					</div>
				</div>
			</div>
			<div class="section">
				<h2><?php gs("Zapisi"); ?></h2>
				<button id="btnDodaj"><?php gs("Dodaj zapis"); ?></button>
				<div class="CSSTableGenerator">
				<table>
					<thead>
					<tr>
						<th><?php gs("Mesec"); ?></th>
						<th><?php gs("Razdalja"); ?></th>
						<th><?php gs("Čas"); ?></th>
						<th><?php gs("Povprečna"); ?><br> <?php gs("hitrost"); ?></th>
						<th><?php gs("Najvišja"); ?><br> <?php gs("hitrost"); ?></th>
						<th><?php gs("Najnižja"); ?><br> <?php gs("temperatura"); ?></th>
						<th><?php gs("Najvišja"); ?><br> <?php gs("temperatura"); ?></th>
						<th><?php gs("Energija"); ?></th>
						<th><?php gs("Uredi"); ?></th>
					</tr>
					</thead>
					<tbody id="recordsBody"></tbody>
				</table>
				</div>
			</div>

      <div class="section">
        <h2><?php gs("Podatki"); ?></h2>
        <button id="btnIzvoz"><?php gs("Izvoz"); ?></button>
      </div>
      <div class="section">
				<br><br><br><br>
			</div>
		</div>

		<div class="shadow"></div>
		<div class="popup form">
			<h2 id="title">April 2015</h2>
			<div class="item"><div class="itemTitle"><?php gs("Mesec"); ?>: </div><select id="mesec">
            <?php getMonths(); ?>
         </select><input type="text" id="leto" placeholder="Leto">
			</div>
			<div class="item"><div class="itemTitle"><?php gs("Razdalja"); ?>: </div><input type="text" id="razdalja"> km</div>
			<div class="item"><div class="itemTitle timepicker"><?php gs("Čas"); ?>: </div><input type="text" id="ura"> h <input type="text" id="minuta"> min <input type="text" id="sekunda"> s</div>
			<div class="item"><div class="itemTitle"><?php gs("Povprečna"); ?> <?php gs("hitrost"); ?>: </div><input type="text" id="povpHitrost"> km/h   </div>
			<div class="item"><div class="itemTitle"><?php gs("Najvišja"); ?> <?php gs("hitrost"); ?>: </div><input type="text" id="maxHitrost"> km/h   </div>
			<div class="item"><div class="itemTitle"><?php gs("Najnižja"); ?> <?php gs("temperatura"); ?>: </div><input type="text" id="minTemp"> °C</div>
			<div class="item"><div class="itemTitle"><?php gs("Najvišja"); ?> <?php gs("temperatura"); ?>: </div><input type="text" id="maxTemp"> °C</div>
			<div class="item"><div class="itemTitle"><?php gs("Energija"); ?>: </div><input type="text" id="energija"> cal</div>
			<button class="btnShrani"><?php gs("Shrani"); ?></button>
		</div>
		<div class="popup dialog">
			<h2 id="title">Ali ste prepričani?</h2>
			<button id="btnDa"><?php gs("Da"); ?></button>
			<button id="btnNe"><?php gs("Ne"); ?></button>
		</div>
	</body>
</html>
