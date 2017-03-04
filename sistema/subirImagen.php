<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */
	include("conexion.php");
	session_start ();
	$conn = conectar ();
	$tamano = $_FILES["foto"]['size'];
	$tipo = $_FILES["foto"]['type'];
	$foto = $_FILES["foto"]['name'];
	$foto = md5 ($foto);
	$ano = date ("Y");
	$mes = date ("m");
	$dia = date ("d");
	$hora = date ("H");
	$minutos = date ("i");
	$segundos = date ("s");
	$fecha = $ano . "" . $mes . "" . $dia . "" . $hora . "" . $minutos . "" . $segundos;
	$foto = $fecha . " " . $foto;
	$destino = "../img/";
	try {
		$query = "INSERT INTO imagenes (hash, iduser) VALUES ('" . $foto . "', '" . $_SESSION['userID'] . "');";
		$resultadoInsertar = $conn->query ($query);
		if (!$resultadoInsertar) {
			$_SESSION['err'] = "errImg";
			header ("Location: /imagenes.php?action=upload");
			exit ();
		} else {
			move_uploaded_file ($_FILES['foto']['tmp_name'], $destino . $foto);
			$_SESSION['err'] = "none";
			header ("Location: /imagenes.php?action=upload");
		}

		$conn = null;
		$quert = null;
	} catch (PDOException $e) {
		echo "ERROR: " . $e->getMessage () . "<br>";
		die ();
	}	
