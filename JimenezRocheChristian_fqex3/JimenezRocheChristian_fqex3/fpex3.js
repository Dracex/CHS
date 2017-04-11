$(document).ready(function () {

// When div with id filtres is clicked:
//	// Query the database to get all the different localitats and then populate the datalist localitats with the result.
	$("nav a").click(function () {
		var id = $(this).attr("href");
		if (id == "#filtres") {
			console.log("Activating filtres");
			$.post("consultabdfp.php", function (data, status) {
//				$("#dlLocalitats").append(data);
				var localidades = JSON.parse(data);
				for (var i = 0; i < localidades.length; i++) {
					$("#dlLocalitats").append("<option>" + localidades[i].Localitat_centre + "</objeto>");
				}
			});
		}
	})

	$("#lLocalitats").on("input", function () {
		var val = this.value;
		if ($('#dlLocalitats').find('option').filter(function () {
			return this.value.toUpperCase() === val.toUpperCase();
		}).length) {
			$.post("consultabdfp.php", {
				poblacion: $("#lLocalitats").val()
			}, function (data, status) {
				var poblacion = JSON.parse(data);
				for (var i = 0; i < poblacion.length; i++) {
					$("#ofertaFiltre").append("<table><tr><td>" + poblacion[i].Clau_cicle + "</td><td>" + poblacion[i].Descripcio_cicle + "</td><td>" + poblacion[i].Nom_centre + "</td></tr></table>");
				}
				$("#lCentres").removeAttr('disabled');
				$("#lCentres").val("");
				$.post("consultabdfp.php", {
					centros: $("#lLocalitats").val()
				}, function (data, status) {
					var centros = JSON.parse(data);
					$("#dlCentres").html("");
					for (var i = 0; i < centros.length; i++) {
						$("#dlCentres").append("<option>" + centros[i].Nom_centre + "</objeto>");
					}
				});
			});
		}
	})

	$("#lCentres").on("input", function () {
//		alert($("#lCentres").val());
		$.post("consultabdfp.php", {
			centro: $("#lCentres").val()
		}, function (data, status) {
			var centro = JSON.parse(data);
			$("#ofertaFiltre").html("");
			for (var i = 0; i < centro.length; i++) {
				$("#ofertaFiltre").append("<table><tr><td>" + centro[i].Clau_cicle + "</td><td>" + centro[i].Descripcio_cicle + "</td><td>" + centro[i].Nom_centre + "</td></tr></table>");
			}
		});
	});

// When an option from the localitats list is chosen:
//	// Send an ajax request to get the entries for the localitat chosen from the database.
//	// With the result, create table to show the info.
//	// Also enable and populate the datalist centres for that localitat


// When an option from the centres list is chosen:
//	// Send an ajax request to get the entries for the centre and localitat chosen from the database.
//	// With the result, create table to show the info.



// Append the rest of the code from exercices 1 and 2 also.
	$("nav a").click(function () {
		var id = $(this).attr("href");
		for (var i = 0; i < 3; i++) {
			$(".tab-content > div").css("display", "none");
		}
		$("" + $(this).attr("href")).css("display", "inherit");
		$("" + $(this).attr("href")).removeClass("fade");
		console.log(id);
	})

	$("nav > ul > li").click(function () {
		for (var i = 0; i < $("nav > ul > li").length; i++) {
			$("nav > ul > li").eq(i).removeClass("active");
		}
		$(this).addClass("active");
	})

	$("a[href='#verFamilias']").click(function () {
		var objFamilias = new Array();
		var showData = $('#familias');
		var familias = [];
		var descripcion = [];
		$.getJSON('oferta1314.json', function (data) {
			var oferta1314 = data.oferta1314.map(function (item) {
				if ($.inArray(item.Familia_cicle, familias) < 0) {
					familias.push(item.Familia_cicle);
					descripcion.push(item.Descripcio);
					objFamilias[item.Familia_cicle] = item.Id_centre + ", " + item.Illa_centre + ", " + item.Localitat_centre + ", " + item.Tipus_centre + ", " + item.Nom_centre + ", " + item.Clau_cicle + ", " + item.Familia_cicle + ", " + item.Nivell_cicle + ", " + item.Descripcio_cicle + ", " + item.Descripcio;
				}
			});
			showData.empty();
			if (oferta1314.length) {
				for (var i = 0; i < familias.length; i++) {
					showData.append("<div class='tooltip' id='" + familias[i] + "'><a href='javascript:void(0)'><img src='img/" + familias[i] + ".gif' /><span class='codi'>" + familias[i] + "</span><span class='tooltiptext'>" + descripcion[i] + "</span></a></div>");
				}
			}
		});
		showData.text('Loading the JSON file.');
		$("#ofertaFamilia").hide();
		$("#familias").show();
	});
	$("a[href='#verFamilias']").click();
	$("#familias").on("click", ".tooltip", function () {
		$("#ofertaFamilia").text("");
		$.post("familiaFP.php", {
			codigo: $(this).attr("id")
		}, function (data, status) {
			$("#ofertaFamilia").show();
			$("#familias").hide();
			$("#ofertaFamilia").append(data);
		});
	});
	$("#addOffer > input").prop("disabled", true);
	$("#addOffer > select").prop("disabled", true);
	$("#logout").click(function () {
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
			console.log('User signed out.');
			$(".g-signin2").show();
			$("#logout").hide();
		});
	});
});
function onSignIn(googleUser) {
	$(".g-signin2").hide();
	$("#logout").show();
	console.log("User signed in");
}