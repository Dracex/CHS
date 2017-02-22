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

	$("#entrar input").focusout(function () {
		var flag = "false";
		$("#entrar input[type='mail'], #entrar input[type='password']").each(function () {
			var campo = $(this).val();
			if (campo.length < 1) {
				flag = "true";
			}
		})
		if (flag == "true") {
			$(".error").fadeIn(500);
		} else {
			$(".error").fadeOut(500);
		}

	});
})
