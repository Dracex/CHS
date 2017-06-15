<?php
  //Incluimos el archivo que nos conecta a la base de datos y nos conectamos a la BD
  include("conexion.php");
  session_start ();
  $conn = conectar ();
  //Creamos el array de imagenes vacío y buscamos en el directorio
  $imagenes = [];
  $index = $_POST['index'] - 2;
  $directorioRaiz = "../img/";
  $carpetaRaiz = scandir ($directorioRaiz, 1);
  //Si la acción es myImages buscamos todas las imágenes de ese usuario en concreto, sino mostramos todas las demás imágenes
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