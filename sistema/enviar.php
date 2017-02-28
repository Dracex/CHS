<?php

	$nombre = $_POST['name'];
	$apellido1 = $_POST['apellido1'];
	$apellido2 = $_POST['apellido2'];
	if (empty ($apellido2)) {
		$apellido2 = "";
	} else {
		$apellido2 = " " . $apellido2;
	}
	$correo = $_POST['mail'];
	$mensaje = $_POST['mensaje'];
	$mensaje = $nombre . " " . $apellido1 . $apellido2 . ": " . $mensaje;
	$mensaje = wordwrap ($mensaje, 70, "<br>");

//	echo $correo . "<br>";
//	echo $mensaje;
	$enviado = mail ("christianjroche@gmail.com", "Contacto", $mensaje);
	if ($enviado == true) {
		echo "Correo enviado correctamente";
	} else {
		echo "El mensaje no ha sido enviado";
	}