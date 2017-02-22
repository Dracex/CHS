<?php

	function conectar () {
		$username = "u155614104_db";
		$password = "9lRT+mX185Kg";
		try {
//			$conn = new PDO ('mysql:dbname=chs;host=localhost', "christian", "U8ETuqUW");
			$conn = new PDO ('mysql:dbname=u155614104_chs;host=mysql.hostinger.es', $username, $password);
		} catch (Exception $errorConexion) {
			echo "ERROR: $errorConexion";
		}
		return $conn;
	}

?>
