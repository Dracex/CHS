/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

	$("#butEntrar").click(function () {
		var user = $("#userlog").val();
		var pass = $("#passlog").val();
	})

	$("#entrar input").focusOut(function () {
		var flag = "false";
		$("#entrar input[type='mail'], #entrar input[type='password']").each(function () {
			var campo = $.trim($(this).val());
			$(this).val(campo);
			if (campo.length < 1) {
				flag = "true";
			}
		})
		console.log(flag);
		if (flag == "true") {
			$(".error").fadeIn(500);
		} else {
			$(".error").fadeOut(500);
		}

	});
})
