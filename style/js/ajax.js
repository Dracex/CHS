/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
	
	$("#mailreg").focusin(function() {
		if ($("#mensaje").length) {
			$("#mensaje").animate({
					opacity: 0,
					left: $("#mailreg").position().left + $("#mailreg").width() - $("#mensaje").width() + 10,
				}, 500)
		}
	})

	$("#mailreg").focusout(function () {
//		alert("cargado");
		$.post("sistema/comprobarUsuarios.php", {
			correos: $("#mailreg").val()
		}, function (data, status) {
			if (data == "false") {
				$("#mensaje").remove();
				$("#registro fieldset").append("<div id='mensaje'>El correo introducido existe</div>");
				$("#mensaje").css("backgroundColor", "#F66");
				$("#mensaje").css("border", "2px solid #F44");
				$("#mensaje").css("left", $("#mailreg").position().left + $("#mailreg").width() - $("#mensaje").width() + 10);
				$("#mensaje").css("top", $("#mailreg").position().top + 5);
				$("#mensaje").css("opacity", "0");
				$("#mensaje").animate({
					opacity: 1,
					left: $("#mailreg").position().left + $("#mailreg").width() + 10,
				}, 500)
			} else {
				$("#mensaje").remove();
				$("#registro fieldset").append("<div id='mensaje'>El correo introducido no existe</div>");
				$("#mensaje").css("backgroundColor", "#6F6");
				$("#mensaje").css("border", "2px solid #4F4");
				$("#mensaje").css("left", $("#mailreg").position().left + $("#mailreg").width() - $("#mensaje").width() + 10);
				$("#mensaje").css("top", $("#mailreg").position().top + 5);
				$("#mensaje").css("opacity", "0");
				$("#mensaje").animate({
					opacity: 1,
					left: $("#mailreg").position().left + $("#mailreg").width() + 10,
				}, 500)
//				$("#mensaje").delay(1000).css('zIndex', '10');
			}
		});
	})
})