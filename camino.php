<?php
  //Indicamos que esta pagina es el index2 (aunque sea la de camino) e importamos el header
  $pagina = "index2";
  include "header.php"
?>
<main>
  <?php
    //Importamos el archivo que contiene la conexión a la BD e iniciamos sesión y nos conectamos
    include("sistema/conexion.php");
    session_start ();

    $conn = conectar ();

    //Buscamos la info de los caminos para mostrarla
    try {
      $stmt = $conn->prepare ('SELECT descCamino FROM caminos where id = "' . $caminoUser . '"');
      $stmt->execute ();
      $datos = $stmt->fetch (PDO::FETCH_ASSOC);
      echo "<article id='camino'>";
      echo $datos['descCamino'] . "<br><br><a href='/' style='color: black' class='mas'>Volver</a>";
      echo "</article>";
    } catch (Exception $ex) {
      echo "ERROR: " . $ex;
    }
  ?>
</main>
<?php
  //Incluimos el footer
  include 'footer.php';
?>