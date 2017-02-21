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
		var campo = $.trim($(this).val());
		$(this).val(campo);
//		alert("campo");
		if (campo == "") {
			$(".error").fadeIn(500);
		}

	});
})
