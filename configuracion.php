<?php
  //Importamos el archivo para conectarnos a la base de data, indicamos que la página es la de configuración, importamos el header y nos conectamos a la BD
  include("sistema/conexion.php");
  $pagina = "configuracion";
  include "header.php";
  $conn = conectar ();
?>
<main>
  <?php
    //Si el usuario está conectado buscamos todos los datos del usuario y los ponemos en el formulario para que el ususario los vea y los pueda modificar
    if ($logged) {
      $stmt = $conn->prepare ('SELECT * FROM users where id = ' . $_SESSION['userID']);
      $stmt->execute ();
      while ($datos = $stmt->fetch (PDO::FETCH_ASSOC)) {
        $_SESSION['user'] = $datos['nombre'];
        $_SESSION['apellido1'] = $datos['apellido1'];
        $_SESSION['apellido2'] = $datos['apellido2'];
        $_SESSION['telefono'] = $datos['telefono'];
        $_SESSION['correo'] = $datos['correo'];
      }
      ?>
      <form action="sistema/configuracion.php" method="POST" id="modificarPerfil">
        <div class="categoria">
          <div class="ico user-form ico-ses"></div>
          <input type="text" value="<?= $_SESSION['user'] ?>" placeholder="Nombre" name="nombre" id="name">
        </div>
        <div class="categoria">
          <input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido..." value="<?= $_SESSION['apellido1'] ?>">
          <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido... (Opcional)" value="<?php
          if (isset ($_SESSION['apellido2'])) {
            echo $_SESSION['apellido2'];
          }
          ?>">
        </div>
        <div class="categoria">
          <div class="ico ico-ses" id="telefono"></div><input type="text" name="telefono" id="telefono" placeholder="Teléfono de contacto... " value="<?php
          if (isset ($_SESSION['telefono'])) {
            echo $_SESSION['telefono'];
          }
          ?>">
        </div>
        <div class="categoria">
          <div class="ico ico-ses correo"></div><input type="mail" name="mailreg" id="mailreg" placeholder="Correo electrónico... " value="<?= $_SESSION['mail'] ?>">
        </div>
        <div>
          <input type="mail" class="repetir" name="mailreg2" id="mailreg2" placeholder="Repetir correo electrónico... ">
        </div>
        <div class="categoria">
          <div class="ico pass-form ico-ses"></div><input type="password" name="passreg" id="passreg" placeholder="Contraseña... ">
        </div>
        <div>
          <input type="password" class="repetir" name="pass2reg" id="pass2reg" placeholder="Repetir contraseña... ">
        </div>
        <input type="submit" value="Guardar">
        <?php
      } else {
        echo "<script>alert('Debes estar conectado con  tu cuenta para tener acceso a esta página.');window.location = '/';</script>";
      }
    ?>
    </div>
  </form>
</main>
</div>
</body>
</html>
<?php
  //Sacamos un alert según el error que hay o si se modificó correctamente
  if (isset ($_SESSION['err'])) {
    $err = $_SESSION['err'];
    echo "<script>";
    switch ($err) {
      case 'errModify':
        echo 'alert("Ha ocurrido un error al modificar los datos.")';
        $_SESSION['err'] = "";
        break;

      case 'successModify':
        echo 'alert("Datos modificados correctamente")';
        $_SESSION['err'] = "";
        break;

      case 'emptyPass':
        echo 'alert("Debes verificar que eres el dueño de la cuenta.\n Para ello introduce las contraseñas.")';
        $_SESSION['err'] = "";
        break;
    }
    echo "</script>";
  }
?>