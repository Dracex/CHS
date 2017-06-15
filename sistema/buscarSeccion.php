<?php
  //Incluimos el archivo de conexión a la BD, iniciamos sesión y nos conectamos a la BD
  include("conexion.php");
  session_start ();

  $conn = conectar ();  

  //Buscamos todas las secciones disponibles en la base de datos y las mostramos
  try {
    $stmt = $conn->prepare ('SELECT * FROM seccion');
    $stmt->execute ();
    while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
      echo '<div class = "secciones">';
      echo '<div class = "encabezado">';
      echo '<h1>' . $datos['nombre'] . '</h1>';
      echo '</div>';
      $stmt2 = $conn->prepare ('SELECT * FROM subSeccion where idSeccion = ' . $datos['id']);
      $stmt2->execute ();
      while ($datos2 = $stmt2->fetch (PDO::FETCH_ASSOC)) {
        $stmt4 = $conn->prepare ('SELECT count(*) as total FROM hilos where idSeccion = ' . $datos['id']);
        $stmt4->execute ();
        $hilos = $stmt4->fetch (PDO::FETCH_ASSOC);
        echo '<a href="/foro.php?idSeccion=' . $datos2['id'] . '" class="seccion">';
        echo '<h2>' . $datos2['nombre'] . '</h2>';
        echo '<div class="descripcion">';
        echo $datos2['descripcion'];
        echo '</div>';
        echo '<div class="informacion">';
        $stmt3 = $conn->prepare ('SELECT count(*) as total FROM mensaje where idSeccion = ' . $datos['id']);
        $stmt3->execute ();
        $mensajes = $stmt3->fetch (PDO::FETCH_ASSOC);

        echo 'Hilos: ' . $hilos['total'] . ' | Mensajes: ' . $mensajes['total'];
        echo '</div>';
        echo '</a>';
      }
      echo "</div>";
    }
  } catch (Exception $e) {
    echo "ERROR: " . $e;
  }