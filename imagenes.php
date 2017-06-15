<?php
  //Indicamos que la página es la de imágenes
  $pagina = "imagenes";
  //Importamos el header
  include "header.php";
?>
<!-- Miramos si quiere subir archivos y está loggeado, si es así, mostramos el formulario para subir archivos -->
<?php if (isset ($_GET['action']) && $_GET['action'] == "upload" && isset ($_SESSION['logged']) && $_SESSION['logged'] == "true") { ?>
    <form action="sistema/subirImagen.php" method="POST" id="importar" enctype="multipart/form-data">
      <input type="file" accept="image/png, .jpg" name="foto">
      <input type="submit">
    </form>
  <?php } ?>
<main>
</main>
<?php
  //Importamos el footer
  include "footer.php";
?>