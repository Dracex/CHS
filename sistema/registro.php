<?php
  //Incluimos el archivo de conexión a la base de datos
  //Le hacemos el trim a todos los campos recibidos por el formulario
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

  //Nos conectamos a la BD
	$conn = conectar ();

	try {
    //Buscamos todos los usuarios
		$stmt = $conn->prepare ('SELECT * FROM users');
		$stmt->execute ();
    //Recorremos todo el array y buscamos si ya existe el correo, no lo puede crear porque ya existe
		while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
			$mail_user = $mail_user;
			$mail_db = $datos['correo'];
			if ($mail_user == $mail_db) {
				$_SESSION['err'] = "user";
				header ("Location: /");
				exit ();
			}
		}
	} catch (Exception $errorQuery) {
		echo "ERROR";
	}

	try {
    //Encripto la contraseña y la introducimos
		$passEncrypted = password_hash ($contra_user, PASSWORD_BCRYPT);
		$insertar = "INSERT INTO users (nombre, apellido1, apellido2, contrasena, correo, activo) VALUES ('$user_user', '$apellido1_user', '$apellido2_user', '$passEncrypted', '$mail_user', $activo);";
		$resultadoInsertar = $conn->query ($insertar);
    //Si falla sacamos el error sino, mostramos que se registró correctamente
		if (!$resultadoInsertar) {
			$_SESSION['err'] = "err";
			header ("Location: /");
			exit ();
		} else {
			$_SESSION['err'] = "none";
			header ("Location: /");
			exit ();
		}
	} catch (PDOException $e) {
		echo "ERROR: " . $e->getMessage () . "<br>";
		die ();
	}
	$conn = "";
?>