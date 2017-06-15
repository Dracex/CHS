<?php
  //Incluimos el archivo de la conexión, iniciamos sesión e iniciamos sesión
  include("conexion.php");
  session_start ();

  $conn = conectar ();

  try {
    //Buscamos todos los hilos y los sacamos en la pantalla
    $stmt = $conn->prepare ('SELECT nombre FROM subSeccion where idSeccion = ' . $_GET['idSeccion']);
    $stmt->execute ();
    while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
      echo '<div class="hilos">';
      echo '<div class="encabezado">';
      echo '<h1>' . $datos['nombre'] . '</h1>';
      echo '<a href="/foro.php" class="volver"><div id="volver"></div></a>';
      echo '</div>';
      $stmt2 = $conn->prepare ('SELECT * FROM hilos where idSeccion = ' . $_GET['idSeccion']);
      $stmt2->execute ();
      while ($datos2 = $stmt2->fetch (PDO::FETCH_ASSOC)) {
        $data = $datos;
        echo '<a href="/foro.php?idSeccion=' . $_GET['idSeccion'] . '&idHilo=' . $datos2['id'] . '" class="hilo">';
        echo '<h2>' . $datos2['nombre'] . '</h2>';
        echo '<div class="descripcion">';
        $stmt3 = $conn->prepare ('SELECT nombre FROM users where id = ' . $datos2['idCreador']);
        $stmt3->execute ();
        $iniciado = $stmt3->fetch (PDO::FETCH_ASSOC);
        echo 'Iniciado por ' . $iniciado['nombre'] . ", " . $datos2['fecha'];
        echo '</div>';
        echo '</a>';
      }
      if ($logged) {
        //Si el usuario está conectado le damos la opción para crear un nuevo hilo
        echo '<div class="agregar">';
        if (empty ($data)) {
          echo "<h3>Aún no hay hilos en esta sección, ¡Se el primero en crear un hilo!</h3>";
        } else {
          echo "<h3>¿Tienes una duda? ¡Crea un nuevo hilo!</h3>";
        }
        ?>
        <form method="POST" action="sistema/nuevoMensaje.php">
          <div class="categoria">
            <input type="text" name="titulo" placeholder="Título...">
          </div>
          <div class="categoria">
            <textarea name="descripcion" style="resize: none; width: 100%" placeholder="Mensaje..."></textarea>
          </div>
          <input type="hidden" name="idSeccion" value="<?= $_GET['idSeccion']; ?>">
        <input type="hidden" name="section" value="true">
          <input type="submit" value="Enviar!">
        </form>
        <?php
        echo '</div>';
      } else {
        //Si no está conectado, le informamos de que no hay hilos creados
        if (empty ($data)) {
          echo '<div class="descripcion">';
          echo 'No hay hilos creados para esta sección';
          echo '</div>';
        }
      }
      echo '</div>';
    }
  } catch (Exception $ex) {
    echo "ERROR: " . $ex;
  }