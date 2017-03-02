/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
	var ancho = $(".mensaje").width();
	$("textarea").width(ancho);

	$(window).resize(function () {
		var ancho = $(".mensaje").width();
		$("textarea").width(ancho);
	})
})