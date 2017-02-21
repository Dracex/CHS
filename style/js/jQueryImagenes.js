$(document).ready(function () {
	$("main").on("click", ".imagen", function () {
		var src = $(this).attr('src');
		$("#imagen").attr("src", src);
		$("#modalImagen").fadeIn(300);
		$("#modalImagen").css("display", "flex");
	});

	$("#modalImagen .close").click(function () {
		$("#modalImagen").fadeOut(300);
		$("#imagen").attr("src", "");
		$("#modalImagen").css("display", "none");
	});
});