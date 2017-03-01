<?php

	include("conexion.php");
	session_start ();
	$user_user = trim ($_POST['userreg']);
	$apellido1_user = trim ($_POST['apellido1']);
	$apellido2_user = trim ($_POST['apellido2']);
	$contra_user = trim ($_POST['passreg']);
	$contra2_user = trim ($_POST['pass2reg']);
	$mail_user = trim ($_POST['mailreg']);
	$mail2_user = trim ($_POST['mailreg2']);
	$activo = trim ($_POST['activo']);

	$conn = conectar ();

	try {
		$stmt = $conn->prepare ('SELECT * FROM users');
		$stmt->execute ();
		while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
			$mail_user = $mail_user;
			$mail_db = $datos['correo'];
			if ($mail_user == $mail_db) {
				$_SESSION['err'] = "user";
				header ("Location: http://caminahaciasantiago.esy.es/");
				exit ();
			}
		}
	} catch (Exception $errorQuery) {
		echo "ERROR";
	}

	try {
		$passEncrypted = password_hash ($contra_user, PASSWORD_BCRYPT);
		$insertar = "INSERT INTO users (nombre, apellido1, apellido2, contrasena, correo, activo) VALUES ('$user_user', '$apellido1_user', '$apellido2_user', '$passEncrypted', '$mail_user', $activo);";
		$resultadoInsertar = $conn->query ($insertar);
		if (!$resultadoInsertar) {
			$_SESSION['err'] = "err";
			header ("Location: http://caminahaciasantiago.esy.es/");
			exit ();
		} else {
			$_SESSION['err'] = "none";
			header ("Location: http://caminahaciasantiago.esy.es/");
			exit ();
		}
	} catch (PDOException $e) {
		echo "ERROR: " . $e->getMessage () . "<br>";
		die ();
	}
	$conn = "";
?>