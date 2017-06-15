$(document).ready(function () {
	if ($("#imgLog").length) {
		var elemento = $("#imgLog");
		var pos = elemento.position();
		var ancho = elemento.width();
		var izquierda = pos.left;
		$("#dropImg").css("left", izquierda);
		$("#dropImg").css("width", ancho);
	}

	$(window).resize(function () {
		if ($("#imgLog").length) {
			var elemento = $("#imgLog");
			var pos = elemento.position();
			var ancho = elemento.width();
			var izquierda = pos.left;
			$("#dropImg").css("left", izquierda);
			$("#dropImg").css("width", ancho);
		}
	})

	$(".li-ses").click(function () {
    $(".error").hide();
		$("#myModal").fadeIn(200);
		$("#myModal").css("display", "flex");

		if ($("registro").not("oculto")) {
			$("#registro").addClass("oculto");
		}

		if ($("#entrar").hasClass("oculto")) {
			$("#entrar").removeClass("oculto");
		}

		$("#entrar #userlog").focus();
	});

	$(".close").click(function () {
		$("#myModal").fadeOut(500);
	});

	$(".cambio").click(function () {
		$("#registro").toggleClass("oculto");
		$("#entrar").toggleClass("oculto");
		$("#registro #userreg").focus();
		$("#entrar #userlog").focus();
	});

	$(".ico").click(function () {
		$("#ul-phone").toggleClass("cerrar");
		$("#ul-phone").toggleClass("abrir");
		if ($("#ul-phone").hasClass("abrir")) {
			if ($(".userMenu").hasClass("abrir")) {
				$(".userMenu").toggleClass("cerrar");
				$(".userMenu").toggleClass("abrir");
			}
		}
	});

	$(".user").click(function () {
		$(".userMenu").toggleClass("cerrar");
		$(".userMenu").toggleClass("abrir");
	});

	$(".logout").click(function () {
		/*Confirm*/
		var confirmar = confirm("¿Seguro que deseas cerrar sesión?");
		if (confirmar) {
			window.location = "sistema/logout.php";
		}
	});
});
