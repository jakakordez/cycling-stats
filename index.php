   <?php
 include "php/sql.php";
?>
<!doctype html>
<html>
	<head>
		<title>Kolo</title>
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
		<script>
			var curStop, curStart;
			$(function(){
				loadStats();
				loadRecords();
				$("select").change(function(){
					loadStats();
				});
				$(".stat").click(function(){
					var id = $(this).find(".statValue").attr('id');
					if(id != "obdobje" && id != selectGraph){
						//if((selectGraph == "minTemp" && id != "maxTemp") || (selectGraph == "maxTemp" && id != "minTemp"))
						{
							selectGraph = id;
							draw(chartData);
						}
					}
				});
				$("#btnDodaj").click(function(){
					edit(0);
				});
			});

			function loadRecords(){
				$.get("php/records.php", function(data){
					$("#recordsBody").html(data);
				});
			}
			var stats, chartData;
			function loadStats(){
				if($("#timeStart").val() != curStart || $("#timeEnd").val() != curStop){
					curStart = $("#timeStart").val();
					curStop = $("#timeEnd").val();
					$.post("php/stats.php", {start: $("#timeStart").val(), stop: $("#timeEnd").val()}, function(data){
						stats = data.sum[0];
						chartData = data.chart;
						if(data.chart.length > 0){
							console.log(data);
							$(".stats #razdalja").html(stats.Razdalja+" <div class='small'>km</div>");
							$(".stats #cas").html(stats.Ure+"h <div class='small'>"+stats.Minute+"min</div>");
							$(".stats #povpHitrost").html(stats.PovpHitrost+" <div class='small'>km/h</div>");
							$(".stats #maxHitrost").html(stats.MaxHitrost+" <div class='small'>km/h</div>");
							$(".stats #minTemp").html(stats.MinTemp+" <div class='small'>°C</div>");
							$(".stats #maxTemp").html(stats.MaxTemp+" <div class='small'>°C</div>");
							$(".stats #energija").html(stats.Kalorije+" <div class='small'>kJ</div>");
							draw(chartData);
						}
					}, "JSON");
				}
			}
		</script>
	</head>
	<body>
		<div class="wrapper">
			<div class="title">
				<h1>Kolo</h1>
			</div>
			<div class="section">
				<h2>Pregled</h2>
				<div class="graph">
					<canvas id="myChart" width="800" height="400"></canvas>
				</div>
				<div class="stats">
					<div class="stat">
						<div class="statText"><span>Obdobje</span></div>
						<div class="statValue" id="obdobje"><select id="timeStart"><?php getMesecOptions($meseci); ?></select><br /><select id="timeEnd"><?php getMesecOptions($meseci, true); ?></select></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Razdalja</span></div>
						<div class="statValue" id="razdalja"></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Čas</span></div>
						<div class="statValue" id="cas"></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Povprečna<br> hitrost</span></div>
						<div class="statValue" id="povpHitrost"></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Najvišja<br> hitrost</span></div>
						<div class="statValue" id="maxHitrost"></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Najnižja<br> temperatura</span></div>
						<div class="statValue" id="minTemp"></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Najvišja<br> temperatura</span></div>
						<div class="statValue" id="maxTemp"></div>
					</div>
					<div class="stat">
						<div class="statText"><span>Energija</span></div>
						<div class="statValue" id="energija"></div>
					</div>
				</div>
			</div>
			<div class="section">
				<h2>Zapisi</h2>
				<button id="btnDodaj">Dodaj zapis</button>
				<div class="CSSTableGenerator">
				<table>
					<thead>
					<tr>
						<th>Mesec</th>
						<th>Razdalja</th>
						<th>Čas</th>
						<th>Povprečna<br> hitrost</th>
						<th>Najvišja<br> hitrost</th>
						<th>Najnižja<br> temperatura</th>
						<th>Najvišja<br> temperatura</th>
						<th>Energija</th>
						<th>Uredi</th>
					</tr>
					</thead>
					<tbody id="recordsBody"></tbody>
				</table>
				</div>
			</div>
			<div class="section">
				<br><br><br><br>
			</div>
		</div>

		<div class="shadow"></div>
		<div class="popup form">
			<h2 id="title">April 2015</h2>
			<div class="item"><div class="itemTitle">Mesec: </div><select id="mesec">
				<option value="januar">januar</option>
				<option value="februar">februar</option>
				<option value="marec">marec</option>
				<option value="april">april</option>
				<option value="maj">maj</option>
				<option value="junij">junij</option>
				<option value="julij">julij</option>
				<option value="avgust">avgust</option>
				<option value="september">september</option>
				<option value="oktober">oktober</option>
				<option value="november">november</option>
				<option value="december">december</option>
				</select><input type="text" id="leto" placeholder="Leto">
			</div>
			<div class="item"><div class="itemTitle">Razdalja: </div><input type="text" id="razdalja"> km</div>
			<div class="item"><div class="itemTitle timepicker">Čas: </div><input type="text" id="ura"> h <input type="text" id="minuta"> min <input type="text" id="sekunda"> s</div>
			<div class="item"><div class="itemTitle">Povprečna hitrost: </div><input type="text" id="povpHitrost"> km/h   </div>
			<div class="item"><div class="itemTitle">Najvišja hitrost: </div><input type="text" id="maxHitrost"> km/h   </div>
			<div class="item"><div class="itemTitle">Najnižja temperatura: </div><input type="text" id="minTemp"> °C</div>
			<div class="item"><div class="itemTitle">Najvišja temperatura: </div><input type="text" id="maxTemp"> °C</div>
			<div class="item"><div class="itemTitle">Energija: </div><input type="text" id="energija"> cal</div>
			<button class="btnShrani">Shrani</button>
		</div>
		<div class="popup dialog">
			<h2 id="title">Ali ste prepričani?</h2>
			<button id="btnDa">Da</button>
			<button id="btnNe">Ne</button>
		</div>
	</body>
</html>
