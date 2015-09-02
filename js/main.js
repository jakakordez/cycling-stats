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
   $("#btnIzvoz").click(function(){
     window.open("php/export.php");
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
