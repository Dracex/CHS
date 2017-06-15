$(document).ready(function () {
	var mediaQuery = window.matchMedia("(min-width: 768px)");

	if (mediaQuery.matches) {
		$("#primitivo").addClass("activo");
		$(".primitivo").css("display", "block");
	} else {
		$("#primitivo").removeClass("activo");
		$(".primitivo").css("display", "inherit");
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
			$("#primitivo").addClass("activo");
			$(".primitivo").css("display", "block");
		} else {
			$("#primitivo").removeClass("activo");
			$(".primitivo").css("display", "inherit");
		}
	});

	$(".pestana").click(function () {
		var mediaQuery = window.matchMedia("(min-width: 768px)");
		var elegido = $(this).attr("id");
		/* alert(elegido+"Pestana"); */

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
});