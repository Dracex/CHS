<?php
  //Indicamos que la página es la de contacto e importamos el header
  $pagina = "contacto";
  include "header.php"
?>
<main>
  <h1>Contáctanos!</h1>
  <form action="sistema/enviar.php" method="POST">
    <!-- 
      Si el usuario no está conectado el formulario sale vacío
      Si está conectado el formulario sale relleno y no se pueden modificar los datos 
    -->
    <?php if ($logged == false) { ?>
        <div class="categoria">
          <div class="ico user-form ico-ses"></div>
          <input type="text" name="name" placeholder="Nombre" id="name">
        </div>
        <div class="categoria2">
          <input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido...">
          <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido... (Opcional)">
        </div>
        <div class="categoria">
          <div class="ico ico-ses correo"></div><input type="mail" name="mail" id="mail" placeholder="Correo electrónico... ">
        </div>
      <?php } else { ?>
        <div class="categoria">
          <div class="ico user-form ico-ses"></div>
          <input type="text" name="name" placeholder="Nombre" id="name" value="<?= $_SESSION['user'] ?>" readonly="readonly">
        </div>
        <div class="categoria2">
          <input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido..." readonly="readonly" value="<?= $_SESSION['apellido1'] ?>">
          <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido... (Opcional)" readonly="readonly" value="<?= $_SESSION['apellido2'] ?>" readonly="readonly">
        </div>
        <div class="categoria">
          <div class="ico ico-ses correo"></div><input type="mail" name="mail" id="mail" placeholder="Correo electrónico... " value="<?= $_SESSION['correo'] ?>" readonly="readonly">
        </div>
      <?php } ?>
    <textarea placeholder="Déjanos tu mensaje aquí..." name="mensaje"></textarea>
    <input type="submit" value="Mandar">
  </form>
</main>
<?php
  //Include footer
  include "footer.php";
?>
<?php
  //Saca un alert en función de si el correo se envió correctamente o no
  if (isset ($_SESSION['mailSent'])) {
    echo "<script>";
    if ($_SESSION['mailSent'] == "true") {
      echo "alert('Mensaje enviado correctamente. Gracias por ponerte en contacto con nosotros.')";
    } elseif ($_SESSION['mailSent'] == "false") {
      echo "alert('El mensaje no ha sido enviado correctamente')";
    }
    echo "</script>";
  }
  unset ($_SESSION['mailSent']);
?>