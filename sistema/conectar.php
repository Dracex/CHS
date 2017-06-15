<?php
  //Incluimos el archivo para conectarnos a la BD e iniciamos sesión
  include("conexion.php");
  session_start ();

  //Quitamos los espacios de delante y de despues del correo y de la contraseña
  $mail_user = trim ($_POST['maillog']);
  $contra_user = trim ($_POST['passlog']);

  //Nos conectamos a la BD
  $conn = conectar ();

  //Buscamos todos los usuarios creados y comprobamos que el correo introducido y la contraseña coinciden, si es así, se conecta, paso todos los dados a las variables $_SESSION y marcamos que está conectado
  try {
    $stmt = $conn->prepare ('SELECT * FROM users');
    $stmt->execute ();
    while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
      $mail_user = $mail_user;
      $mail_db = $datos['correo'];
      $contra_db = $datos['contrasena'];
      if ($mail_user == $mail_db) {
        $igual = password_verify ($contra_user, $contra_db);
        if ($igual) {
          $_SESSION['correo'] = $mail_db;
          $_SESSION['err'] = ""; 
          $_SESSION['logged'] = "true";
          $_SESSION['user'] = $datos['nombre'];
          $_SESSION['apellido1'] = $datos['apellido1'];
          $_SESSION['apellido2'] = $datos['apellido2'];
          $_SESSION['mail'] = $datos ['correo'];
          if (isset ($datos['telefono'])) {
            $_SESSION['telefono'] = $datos['telefono'];
          }
          $_SESSION['userID'] = $datos['id'];
          header ("Location: /");
          exit ();
        } else {
          $_SESSION['err'] = 'bad';
          header ("Location: /");

          exit ();
          echo "ERROR";
        }
      } else {
        $_SESSION['err'] = "noExists";
        header ("Location: /");
      }
    }
  } catch (Exception $errorQuery) {
    echo "ERROR";
  }
  $stmt = null;
  $conn = null;
?>