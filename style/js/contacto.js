/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
	var ancho = $("#name").width();
	$("textarea").width(ancho);
	$("#apellido1").width(ancho);
	$("#apellido2").width(ancho);

	$(window).resize(function () {
		var ancho = $("#name").width();
		$("textarea").width(ancho);
		$("#apellido1").width(ancho);
		$("#apellido2").width(ancho);
	})
})