<?php
  //Incluimos el archivo de la conexión a la BD y nos conectamos a ella
  include("conexion.php");
  session_start ();

  $conn = conectar ();

  try {
    //Recogemos la hora del mensaje, el título, la descripción, la id del usuario que lo escribió y la sección en la que se guarda
    $ano = date ("Y");
    $mes = date ("m");
    $dia = date ("d");
    $hora = date ("H");
    $minutos = date ("i");
    $fecha = $dia . "/" . $mes . "/" . $ano . " - " . $hora . ":" . $minutos;
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $idUser = $_SESSION['userID'];
    $idSeccion = $_POST['idSeccion'];

    if ($_POST['section'] == "true" ) {
      //Si no existe el hilo, lo crea con los datos recibidos
      $query = 'INSERT INTO hilos (nombre, idCreador, fecha, idSeccion) VALUES ("' . $titulo . '", ' . $idUser . ', "' . $fecha . '", ' . $idSeccion . ')';
      $resultadoInsertar = $conn->query ($query);

      $stmt4 = $conn->prepare ('SELECT count(*) as total FROM hilos');
      $stmt4->execute ();
      $hilos = $stmt4->fetch (PDO::FETCH_ASSOC);
    } else {
      $hilos['total'] = $_POST['hilo'];
    }
    
    //Una vez generado el hilo (o que ya existiera) inserta el mensaje dentro del hilo
    $query2 = 'INSERT INTO mensaje (contenido, idCreador, fecha, idHilo, idSeccion) VALUES ("' . $descripcion . '", ' . $idUser . ', "' . $fecha . '", ' . $hilos['total'] . ', ' . $idSeccion . ')';
    $resultadoInsertar2 = $conn->query ($query2);

    if (!$resultadoInsertar && !$resultadoInsertar2) {
      
    } else {
      header ("Location: http://caminahaciasantiago.esy.es/foro.php");
    }
  } catch (Exception $ex) {
    
  }
  