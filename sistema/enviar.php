<?php

	session_start ();
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
	$mensaje = $nombre . " " . $apellido1 . $apellido2 . " con correo: " . $correo . ": " . $mensaje;
	$mensaje = wordwrap ($mensaje);

//	echo $correo . "<br>";
//	echo $mensaje;
	$enviado = mail ("christianjroche@gmail.com", "Formulario de contacto CHS", $mensaje);
	if ($enviado == true) {
		$_SESSION['mailSent'] = "true";
		header ("Location: http://caminahaciasantiago.esy.es/contacto.php");
	} else {
		$_SESSION['mailSent'] = "false";
		header ("Location: http://caminahaciasantiago.esy.es/contacto.php");
	}