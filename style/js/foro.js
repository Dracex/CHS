/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
	var ancho = $("#respuestaRapida").width();
	$("textarea").width(ancho-5);

	$(window).resize(function () {
		var ancho = $("#respuestaRapida").width();
		$("textarea").width(ancho-5);
	})
})