<?php
  //Incluimos el archivo de la conexión de la BD y nos conectamos a ella
  include("conexion.php");
  session_start ();
  $conn = conectar ();
  //Recogemos los datos de la imágen/es
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
  //Cambiamos el nombre de la imágen encriptando el nombre de esta y añadiendole la fecha y la hora del servidor
  $fecha = $ano . "" . $mes . "" . $dia . "" . $hora . "" . $minutos . "" . $segundos;
  $foto = $fecha . " " . $foto;
  $destino = "../img/";
  try {
    //Insertamos los datos de la imágen en la BD
    $query = "INSERT INTO imagenes (hash, iduser) VALUES ('" . $foto . "', '" . $_SESSION['userID'] . "');";
    $resultadoInsertar = $conn->query ($query);
    //Si no se subió correctamente informamos de que hubo un error
    if (!$resultadoInsertar) {
      $_SESSION['err'] = "errImg";
      header ("Location: /imagenes.php?action=upload");
      exit ();
    } else {
      //Si se subió correctamente informamos al usuario
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
