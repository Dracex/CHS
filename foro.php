<?php
  //Indicamos que esta página es la del foro e importamos el header
  $pagina = "foro";
  include "header.php";
?>
<main>
  <?php
    //Según la variable que reciba por GET importa un archivo u otro
    if (empty ($_GET['idHilo']) && empty ($_GET['idSeccion'])) {
      include "sistema/buscarSeccion.php";
    } elseif (isset ($_GET['idHilo'])) {
      include "sistema/buscarMensajes.php";
    } elseif (isset ($_GET['idSeccion'])) {
      include "sistema/buscarHilos.php";
    }
  ?>
</main>
<?php
  //Importamos el footer
  include "footer.php";
?>