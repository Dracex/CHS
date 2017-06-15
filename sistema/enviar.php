<?php

  //Iniciamos sesión y recogemos las variables de $_POST y enviamos el correo
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
	$mensaje = $nombre . " " . $apellido1 . $apellido2 . " con correo " . $correo . ": \n" . $mensaje;
	$mensaje = wordwrap ($mensaje);

//	echo $correo . "<br>";
//	echo $mensaje;
	if (mail ("christianjroche@gmail.com", "Formulario de contacto CHS", $mensaje)) {
		$_SESSION['mailSent'] = "true";
		header ("Location: /contacto.php");
	} else {
		$_SESSION['mailSent'] = "false";
		header ("Location: /contacto.php");
	}