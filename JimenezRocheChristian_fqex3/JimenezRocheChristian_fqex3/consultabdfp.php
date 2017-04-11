<?php

// Receive the json object with the parameters for querying the database - localitat, centre, limit. Make the query to the database and return the result also as json.
	try {
		$conn = new PDO ('mysql:dbname=oferta1314;host=localhost;charset=utf8', "christian", "U8ETuqUW");
//		$conn->exec ("SET CHARACTER SET utf8");
	} catch (Exception $ex) {
		echo $ex;
	}
	if (empty ($_POST['poblacion']) && empty($_POST['centros']) && empty($_POST['centro'])) {
		$stmt = $conn->prepare ('SELECT DISTINCT Localitat_centre FROM oferta1314 ORDER BY	Localitat_centre');
		$stmt->execute ();
		$datos = $stmt->fetchAll ();
		echo json_encode ($datos);
	}

	if (isset ($_POST['poblacion'])) {
		$stmt = $conn->prepare ("select Nom_centre, Clau_cicle, Descripcio_cicle from oferta1314 where Localitat_centre = '" . $_POST['poblacion'] . "';");
		$stmt->execute ();
		$datos = $stmt->fetchAll ();
		echo json_encode ($datos);
	}

	if (isset ($_POST['centros'])) {
		$stmt = $conn->prepare ("select DISTINCT Nom_centre from oferta1314 where Localitat_centre = '" . $_POST['centros'] . "'ORDER BY Nom_centre;");
		$stmt->execute ();
		$datos = $stmt->fetchAll ();
		echo json_encode ($datos);
	}
	
	if (isset($_POST['centro'])) {
		$stmt = $conn->prepare ("select Nom_centre, Clau_cicle, Descripcio_cicle from oferta1314 where Nom_centre = '" . $_POST['centro'] . "';");
		$stmt->execute ();
		$datos = $stmt->fetchAll ();
		echo json_encode ($datos);
	}
?>