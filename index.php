<?php
  //Indicamos que la página es la pagina de indice para poder importar correctamente los JS y los CSS
  $pagina = "index";
  //Importamos el header
  include "header.php"
?>
<main>
  <article>
    <?php
      //Incluimos el archivo de conexión para que conecte a la BD
      include("sistema/conexion.php");
      //Iniciaos sesion
      session_start ();

      //Iniciamos sesión en la BD
      $conn = conectar ();

      //Hacemos un select buscando todos los caminos
      try {
        $stmt = $conn->prepare ('SELECT * FROM caminos');
        $stmt->execute ();
        $stmt2 = $conn->prepare ('SELECT * FROM caminos');
        $stmt2->execute ();
        echo "<div class='pestanas'>";
        //En este while creamos una pestaña por cada camino introduciendo el nombre
        while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
          echo "<span class='pestana' id='" . $datos['id'] . "'>" . $datos['nombre'] . "</span>";
        }
        echo "</div>";
        echo "<div id='contenido'>";
        //En este while creamos un div por cada camino para tener la info
        while ($datos2 = $stmt2->fetch (PDO::FETCH_ASSOC)) {
          echo "<div class='" . $datos2['id'] . "'>";
          echo "<p>" . $datos2['camino'] . "</p><br>";
          echo "<a href='camino.php?camino=" . $datos2['id'] . "' class='mas'>Ver más...</a>";
          echo "</div>";
        }
        echo "</div>";
      } catch (Exception $ex) {
        echo "ERROR: " . $ex;
      }
    ?>
  </article>
</main>
<?php
  //Importamos el footer
  include "footer.php";
?>
<?php
  //Aquí sacamos un alert según el error que tenga en SESSION
  if (isset ($_SESSION['err'])) {
    $err = $_SESSION['err'];
    echo "<script>";
    switch ($err) {
      case 'notMail':
        echo "alert('El usuario introducido no es un correo electrónico.\nAsegurese de que es correcto.')";
        $_SESSION['err'] = "";
        break;

      case 'user':
        echo 'alert("Ya hay un usuario correo");';
        $_SESSION['err'] = "";
        break;

      case 'pass':
        echo 'alert("Las contraseñas no coinciden");';
        $_SESSION['err'] = "";
        break;

      case 'err':
        echo 'alert("Ha ocurrido un error al registrar");';
        $_SESSION['err'] = "";
        break;

      case 'bad':
        echo 'alert("Usuario/Contraseña no correctos");';
        $_SESSION['err'] = "";
        break;

      case 'noExists':
        echo 'alert("El usuario no ha sido encontrado en la base de datos");';
        $_SESSION['err'] = "";
        break;

      case 'errImg':
        echo "alert('Ha ocurrido un error al subir la imágen al servidor');";
        $_SESSION['err'] = "";
        break;

      case 'none()':
        echo 'alert("Registro realizado correctamente");';
        $_SESSION['err'] = "";
        break;

      case 'notSameMail':
        echo 'alert("Los correos no coinciden.");';
        $_SESSION['err'] = "";
        break;

      case 'notSamePass':
        echo 'alert("Las contraseñas no coinciden")';
        $_SESSION['err'] = "";
        break;
    }
    echo "</script>";
  }
?>