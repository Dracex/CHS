<?php
  //Incluimos el archivo de la conexion, iniciamos sesión y nos creamos la conexión a la BD
  include("conexion.php");
  session_start ();

  $conn = conectar ();

  //Buscamos todos los mensajes de un hilo en concreto y le damos la opción de responder en el hilo
  try {
    $stmt = $conn->prepare ('SELECT nombre FROM hilos where id = ' . $_GET['idHilo']);
    $stmt->execute ();
    $titulo = $stmt->fetch (PDO::FETCH_ASSOC);
    echo '<div class="mensajes">';
    echo '<div class="encabezado">';
    echo '<h1>' . $titulo['nombre'] . '</h1>';
    echo '<a href="/foro.php?idSeccion=' . $_GET['idSeccion'] . '" class="volver"><div id="volver"></div></a>';
    echo '</div>';

    $stmt2 = $conn->prepare ('SELECT * FROM mensaje where idHilo = ' . $_GET['idHilo']);
    $stmt2->execute ();
    while ($datos2 = $stmt2->fetch (PDO::FETCH_ASSOC)) {
      echo '<div class = "mensaje">';
      echo '<div class = "datosUsuario">';
      $stmt3 = $conn->prepare ('SELECT nombre FROM users where id = ' . $datos2['idCreador']);
      $stmt3->execute ();
      $nombre = $stmt3->fetch (PDO::FETCH_ASSOC);
      $stmt4 = $conn->prepare ('SELECT count(*) as total FROM mensaje where idCreador = ' . $datos2['idCreador']);
      $stmt4->execute ();
      $mensajes = $stmt4->fetch (PDO::FETCH_ASSOC);
      echo '<p>' . $nombre['nombre'] . '</p>';
      echo '<p>' . $datos2['fecha'] . '</p>';
      echo '<p>Mensajes totales: ' . $mensajes['total'] . '</p>';
      echo '</div>';
      echo '<p>' . $datos2['contenido'] . '</p>';
      echo '</div>';
    }
    if ($logged) {
      echo '<div class="agregar">';
      ?>
      <form method="POST" action="sistema/nuevoMensaje.php">
        <div class="categoria">
          <textarea name="descripcion" style="resize: none; width: 100%" placeholder="Mensaje..."></textarea>
        </div>
        <input type="hidden" name="idSeccion" value="<?= $_GET['idSeccion']; ?>">
        <input type="hidden" name="section" value="false">
        <input type="hidden" name="hilo" value="<?= $_GET['idHilo'] ?>">
        <input type="submit" value="Enviar!">
      </form>
      <?php
      echo '</div>';
    }
    echo '</div>';
  } catch (Exception $ex) {
    echo "ERROR: " . $ex;
  }