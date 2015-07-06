$(function(){
	$(".shadow").click(function(){
		hidePopup();
	});
	$(".popup input").numeric({decimal:","});
	$(".popup select").change(function(){
		$(".popup h2").html($(this).val()+" "+$(".popup #leto").val());
	});
	$(".popup #leto").on('input', function(){
		$(".popup h2").html($(".popup select").val()+" "+$(".popup #leto").val());
	});
});

function edit(id){
	if(id > 0){
		var c = $("tr#z"+id).children();
		var mes = c.eq(0).html().split(' ');
		$(".popup select").val(mes[0]);
		fill("leto", mes[1]);
		$(".popup h2").html(mes[0]+" "+$(".popup #leto").val());
		var cas = c.eq(2).html().split(':');
		fill("ura",cas[0]);
		fill("minuta", cas[1]);
		fill("sekunda", cas[2]);
		fill("razdalja", c.eq(1).html());
		fill("povpHitrost", c.eq(3).html());
		fill("maxHitrost", c.eq(4).html());
		fill("minTemp", c.eq(5).html());
		fill("maxTemp", c.eq(6).html());
		fill("energija", c.eq(7).html());
	}
	else{
		$(".popup select").val(1);
		fill("leto", new Date().getFullYear());
		$(".popup h2").html(" "+$(".popup #leto").val());
		fill("ura",0);
		fill("minuta", 0);
		fill("sekunda", 0);
		fill("razdalja", 0);
		fill("povpHitrost", 0);
		fill("maxHitrost", 0);
		fill("minTemp", 0);
		fill("maxTemp", 0);
		fill("energija", 0);
	}
	showPopup("form");
	$(".btnShrani").unbind().click(function(){
		$.post("php/save.php", {idZapisi: id, leto: g("leto"), ura: g("ura"), minuta: g("minuta"), sekunda: g("sekunda"), razdalja: g("razdalja"), povpHitrost: g("povpHitrost"), maxHitrost: g("maxHitrost"), minTemp: g("minTemp"), maxTemp: g("maxTemp"), energija: g("energija"), mesec: $(".popup select").val()}, function(){
			hidePopup();
			loadRecords();
		});
	});
}
contains = function(a, it) { return a.indexOf(it) != -1; };

function delRecord(id){
	showPopup("dialog");
	$("#btnDa,#btnNe").unbind().click(function(){
		hidePopup();
	});
	$("#btnDa").click(function(){
		$.post("php/delete.php", { idZapisi: id}, function(){
			loadStats();
			loadRecords();
		});
	});
}

function fill(id, value)
{
	value += "";
	$(".popup #"+id).val((contains(value, "."))?value.replace(".", ","):value);
}

function g(id){
	return $(".popup #"+id).val();
}

function showPopup(cls){
	$(".popup."+cls).fadeIn();
	$(".shadow").fadeIn();
}

function hidePopup(){
	$(".popup").fadeOut();
	$(".shadow").fadeOut();

}
