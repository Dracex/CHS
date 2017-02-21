<?php

	include("conexion.php");
	session_start ();
	$conn = conectar ();
	$imagenes = [];

	//Receive the index of the next image to load and using the scandir php function echo the corresponding image from the img folder
	$index = $_POST['index'] - 2;
//	$index = 1;
//	$directorioRaiz = "../img/1486984442/14/86/";
	$directorioRaiz = "../img/";
	$carpetaRaiz = scandir ($directorioRaiz, 1);
//	echo $_SESSION['action'];
	if (isset ($_SESSION['action']) && $_SESSION['action'] == "myImages") {
		$stmt = $conn->prepare ("select hash from imagenes where iduser = " . $_SESSION['userID']);
		$stmt->execute ();
		while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
			if (isset ($datos['hash'])) {
				array_push ($imagenes, $datos['hash']);
			}
		}
		if (isset ($imagenes[$index])) {
			echo "img/" . $imagenes[$index];
		}
	} else {
		$tamano = sizeof ($carpetaRaiz);
		unset ($carpetaRaiz[$tamano - 1]);
		unset ($carpetaRaiz[$tamano - 2]);
		if (isset ($carpetaRaiz[$index])) {
			echo "img/" . $carpetaRaiz[$index];
		}
	}