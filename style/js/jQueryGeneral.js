$(document).ready(function () {
	var mediaQuery = window.matchMedia("(min-width: 768px)");

	if (mediaQuery.matches) {
		$("#frances").addClass("activo");
		$(".frances").css("display", "block");
	} else {
		$("#frances").removeClass("activo");
		$(".frances").css("display", "inherit");
	}

	if ($("#imgLog").length) {
		var elemento = $("#imgLog");
		var pos = elemento.position();
		var ancho = elemento.width();
		var izquierda = pos.left;
		$("#dropImg").css("left", izquierda);
		$("#dropImg").css("width", ancho);
	}

	if ($("#importar").length) {
		$("main").css("marginTop", "20px");
	} else {
		$("main").css("marginTop", "70px");
	}

	$(window).resize(function () {
		var mediaQuery = window.matchMedia("(min-width: 768px)");
		if (mediaQuery.matches) {
			var elemento = $("#imgLog");
			var pos = elemento.position();
			var ancho = elemento.width();
			var izquierda = pos.left;
			$("#dropImg").css("left", izquierda);
			$("#dropImg").css("width", ancho);
			$("#frances").addClass("activo");
			$(".frances").css("display", "block");
		} else {
			$("#frances").removeClass("activo");
			$(".frances").css("display", "inherit");
		}
	});

	$(".pestana").click(function () {
		var mediaQuery = window.matchMedia("(min-width: 768px)");
		var elegido = $(this).attr("id");
		/*alert(elegido+"Pestana");*/

		if (mediaQuery.matches) {
			$("#contenido > div").hide();
			if ($(".pestanas > span").hasClass("activo")) {
				$(".pestanas > span").removeClass("activo");
			}

			$("#" + elegido).addClass("activo");
			$("." + elegido).show();
		} else {
			$(".pestanas > span").css("display", "none");
		}
	});

	$(".li-ses").click(function () {
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
