<?php

  /*
   * To change this license header, choose License Headers in Project Properties.
   * To change this template file, choose Tools | Templates
   * and open the template in the editor.
   */

  //Incluimos el archivo que conecta a la BD y nos conectamos a ella
  require "conexion.php";

  $conn = conectar (); 

  //Comprobamos el correo si existe devolvemos true sino devolvemos false
  $correo = $_POST['correos'];
//$correo = "christianjroche@gmail.com";
  $sql = $conn->prepare ("SELECT correo from users where correo = '" . $correo . "'");
  $sql->execute ();
  $veces = $sql->rowCount ();
//echo $veces;
  if ($veces > 0) {
    echo "false";
  } else {
    echo "true";
  }
