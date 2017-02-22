/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
	console.log("hola");
	var ancho = $("#name").width();
	console.log(ancho);
	ancho2 = ancho / 2;
	console.log(ancho2);
	$("#apellido1").width(ancho2);
	$("#apellido2").width(ancho2);
	$(".repetir").width(ancho + 30);

	$(document).resize(function () {
		console.log("hola");
		var ancho = $("#name").width();
		console.log(ancho);
		ancho2 = ancho / 2;
		console.log(ancho2);
		$("#apellido1").width(ancho2);
		$("#apellido2").width(ancho2);
		$(".repetir").width(ancho + 30);
	})
})