<?php

//	header ("Content-Type: application/json; charset=UTF-8");
//using the function file_get_contents, load the contents of the file oferta1314.json into a variable. Call json_decode to convert the contents of the file into a php object. Loop through the array of objects and get only those records which are from the familia profesional the codi of which has been passed from the js asynchronous call. echo the result array of objects in a json format using the json_encode function.
//	require "oferta1314.json";
	$codi = $_POST['codigo'];
//	$codi = "ADG";
	$json = file_get_contents ("oferta1314.json");
//	$json2 = '{"foo": 12345}';
	$datos = json_decode ($json);
	$cicle_keys = [];
	$cicle = [];
//	$datos2 = json_decode($json2);
//	print_r($datos2->foo);
//	print_r($datos->oferta1314[0]->Familia_cicle);
	for ($i = 0; $i < sizeof ($datos->oferta1314); $i++) {
		if ($datos->oferta1314[$i]->Familia_cicle == $codi) {
			echo "<img src='img/" . $codi . ".gif' /><h1>OFERTA FAMILIA PROFESSIONAL DE <br>" . $datos->oferta1314[$i]->Descripcio . "</h1>";
			break;
		}
	}

	for ($i = 0; $i < sizeof ($datos->oferta1314); $i++) {
		if ($codi == $datos->oferta1314[$i]->Familia_cicle) {
			if (!in_array ($datos->oferta1314[$i]->Clau_cicle, $cicle_keys)) {
				array_push ($cicle_keys, $datos->oferta1314[$i]->Clau_cicle);
			}
		}
	}

	for ($i = 0; $i < sizeof ($datos->oferta1314); $i++) {
		if ($codi == $datos->oferta1314[$i]->Familia_cicle) {
			if (array_key_exists ($datos->oferta1314[$i]->Clau_cicle, $cicle)) {
				$cicle[$datos->oferta1314[$i]->Clau_cicle] = $cicle[$datos->oferta1314[$i]->Clau_cicle] . ", " . $datos->oferta1314[$i]->Nom_centre;
			} else {
				$cicle[$datos->oferta1314[$i]->Clau_cicle] = $datos->oferta1314[$i]->Nom_centre;
				$descripcion[$datos->oferta1314[$i]->Clau_cicle] = $datos->oferta1314[$i]->Descripcio;
			}
		}
	}

	foreach ($cicle as $centro) {
		echo "<table><tr><td>Familia cicle</td><td>" . key ($cicle) . "</td></tr><tr><td>Descripción</td><td>" . $descripcion[key ($cicle)] . "</td></tr><tr><td>Centre(s)</td><td>" . $centro . "</td></tr></table><br>";
	}
?>