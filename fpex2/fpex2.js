$(document).ready(function () {

// Read and understand the html and css files

// When a link of class data-toggle tab is clicked, add the css active class to the correspondent li and remove the active css class form the li item which had it before.

	$("nav a").click(function () {
		var id = $(this).attr("href");
		for (var i = 0; i < 3; i++) {
			$(".tab-content > div").css("display", "none");
		}
		$("" + $(this).attr("href")).css("display", "inherit");
		$("" + $(this).attr("href")).removeClass("fade");
		console.log(id);
	})

// Also, add or remove the in and active classes to the divs inside tab-content to show or hide the respective panels

	$("nav > ul > li").click(function () {
		for (var i = 0; i < $("nav > ul > li").length; i++) {
			$("nav > ul > li").eq(i).removeClass("active");
		}
		$(this).addClass("active");
	})

// Use the fpex1 code to show the different familias from the json file	when the verFamilias link is clicked

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
//		console.log("Mostrando familias..");
	});
// Add a line to trigger the click event on the first panel when the document loads

	$("a[href='#verFamilias']").click();
// Copy/paste the tooltip handlers from fpex1
	$("#familias").on("click", ".tooltip", function () {
		$("#ofertaFamilia").text("");
//		console.log($(this).attr("id"));
		$.post("familiaFP.php", {
			codigo: $(this).attr("id")
		}, function (data, status) {
//			$("#load").attr("disabled", false);
			$("#ofertaFamilia").show();
			$("#familias").hide();
			$("#ofertaFamilia").append(data);
		});
	});
// When a familia is clicked, show the tables but this time get the individual cicles and search the different schools were you can study them. See solution.


// Write a line to initially make all the form elements disabled
	$("#addOffer > input").prop("disabled", true);
	$("#addOffer > select").prop("disabled", true);
// Write the onsingin event handler to hide the signin google button and show the logout button when we successfully log in to google.

	function onSignIn(googleUser) {
		var profile = googleUser.getBasicProfile();
		console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
		console.log('Name: ' + profile.getName());
		console.log('Image URL: ' + profile.getImageUrl());
		console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
	}



// Also enable all addOffer form elements


// When logout button is clicked, logout from google and then hide logout button, show signin button and disable form elements.

	$("#signOut").click(function() {
		var auth2 = gapi.auth2.getAuthInstance();
		auth2.signOut().then(function () {
			console.log('User signed out.');
		});
	});


// When submit event is triggered:	
//	// Create an object with the elements from the form to send to the php script
//	// Use the JSON function stringify to serialize the object
//	// Use the $.ajax method to post the json data to the addOffer.php script
//	//	 On success, reload the page using the location.reload() method
//	//	// On fail, show error in console
//	//	// Remember the data sent to the php must be in json format

});
