var selectGraph = "razdalja";

function draw(data){
	console.log(selectGraph);
	$("#myChart").remove();
	$(".graph").html("<canvas id='myChart' width='800' height='400'></canvas>");
	var myChart;
	var dataset = [];
	dataset["label"] = "";
	dataset['fillColor'] = "rgba(151,187,205,0.5)";
	dataset['strokeColor'] = "rgba(151,187,205,1)";
	dataset['pointColor'] = "rgba(151,187,205,1)";
	dataset['pointStrokeColor'] = "#fff";
	dataset['pointHighlightFill'] = "#fff";
	dataset['pointHighlightStroke'] = "rgba(151,187,205,1)";
	dataset['data'] = [];
	var label = [];
	var ctx = $("#myChart").get(0).getContext("2d");
	myChart = new Chart(ctx);
	if(selectGraph != "minTemp" && selectGraph != "maxTemp"){
		for(var i = 0; i < data.length; i++){
			dataset['data'].push(data[i][getIndex(selectGraph)]);
			label.push(data[i].Mesec);
		}
		var data = {
			labels: label,
			datasets: [ dataset ]
		};
		var options = {scaleFontColor :"white", scaleGridLineColor : "rgba(255,255,255,.3)",  scaleShowVerticalLines: false};
		if(selectGraph == "povpHitrost") options.scaleBeginAtZero = true;
		if(selectGraph == "cas") options.scaleLabel="<%= (Number(value)/3600).toFixed(0) + ' h'%>";
		console.log(options);
		if(selectGraph != "povpHitrost")myChart.Bar(data, options);
		else myChart.Line(data, options);
	}
	else{
		dataset['fillColor'] = "rgba(201,237,255,0.5)";
		var dataset2 = [];
		dataset2["label"] = "Najvišja temperatura";
		dataset2['fillColor'] = "rgba(151,90,80,0.5)";
		dataset2['strokeColor'] = "rgba(151,90,80,1)";
		dataset2['pointColor'] = "rgba(151,90,80,1)";
		dataset2['pointStrokeColor'] = "#fff";
		dataset2['pointHighlightFill'] = "#fff";
		dataset2['pointHighlightStroke'] = "rgba(151,187,205,1)";
		dataset2['data'] = [];
		dataset.label = "Najnižja temperatura";
		for(var i = 0; i < data.length; i++){
			dataset['data'].push(data[i]["MinTemp"]);
			dataset2['data'].push(data[i]["MaxTemp"]);
			label.push(data[i].Mesec);
		}
		var data = {
			labels: label,
			datasets: [ dataset2, dataset ]
		};
		myChart.Line(data, { scaleBeginAtZero: true});
	}
}

function getIndex(id){
	switch(id){
		case "razdalja": return "Razdalja";
		case "cas": return "Sekunde";
		case "energija": return "Kalorije";
		case "povpHitrost":return "PovpHitrost";
		case "maxHitrost":return "MaxHitrost";
		case "minTemp":return "MinTemp";
		case "maxTemp":return "MaxTemp";
	}
}