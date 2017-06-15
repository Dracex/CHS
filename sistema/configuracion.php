<?php
  //Incluimos el archivo de conexión iniciamos sesión 
  include("conexion.php");
  session_start ();

  //Recibimos por parametro las variables de los datos del usuario
  $nombre = $_POST['nombre'];
  $apellido1 = $_POST['apellido1'];

  //Nos conectamos a la BD
  $conn = conectar ();

  //Si telefono no está vacío la pone en una variable local si no, la variable local la deja vacía
  if (!empty ($_POST['telefono'])) {
    $telefono = $_POST['telefono'];
  } else {
    $telefono = "";
  }

  //Si apellido2 no está vacío la pone en una variable local si no, la variable local la deja vacía
  if (!empty ($_POST['apellido2'])) {
    $apellido2 = $_POST['apellido2'];
  } else {
    $apellido = "";
  }

  //Si los correos no están vacíos los pone en una variable local si no, la variable local la deja vacía
  if (!empty ($_POST['mailreg2']) && !empty ($_POST['mailreg'])) {
    $mailreg = $_POST['mailreg'];
    $mailreg2 = $_POST['mailreg2'];
    if ($mailreg == $mailreg2) {
      $mail = $mailreg;
    } else {
      $_SESSION['err'] = "notSameMail";
    }
  } else {
    $mail = $_SESSION['mail'];
  }
  
  //Comprueba que las contraseñas sean iguales y concuerden con la que tiene el usuario
  if (!empty ($_POST['passreg']) && !empty ($_POST['pass2reg'])) {
    if ($_POST['passreg'] == $_POST["pass2reg"]) {
      $contraseñas = true;
      $query = "UPDATE users SET nombre = '" . $nombre . "', apellido1 = '" . $apellido1 . "', apellido2 = '" . $apellido2 . "', telefono = '" . $telefono . "', correo = '" . $mail . "' where id = " . $_SESSION['userID'];
      $resultadoInsertar = $conn->query ($query);
      if (!$resultadoInsertar) {
        $_SESSION['err'] = "errModify";
        header ("Location: /configuracion.php");
      } else {
//        echo $query;
        $_SESSION['err'] = "successModify";
        header ("Location: /configuracion.php");
      }
    } else {
      $contraseñas = false;
      $_SESSION['err'] = "notSamePass";
      header ("Location: /configuracion.php");
    }
  } else {
    $_SESSION['err'] = "emptyPass";
    header ("Location: /configuracion.php");
  }