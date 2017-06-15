<?php
  //Iniciamos sesión y miramos si está conectado
  session_start ();
  if (isset ($_SESSION['logged']) && $_SESSION['logged'] == true) {
    $logged = $_SESSION['logged'];
  } else {
    $logged = false;
  }
  //Si la página es imágenes y obtenemos la acción que quiere realizar, si no está establecido ponemos que solo quiere ver
  if ($pagina == "imagenes") {
    if (isset ($_GET['action'])) {
      $_SESSION['action'] = $_GET['action'];
    } else {
      $_SESSION['action'] = "view";
    }
  }
  //Si la página es la de camino obtenemos el camino que quiere ver
  if ($pagina == "index2") {
    $caminoUser = $_GET['camino'];
    //include "contenido/contenido.php";
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="icon" type="image/png" href="/sys-images/favicon.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camina hacia Santiago</title>
    <link rel="stylesheet" href="style/css/body.css">
    <link rel="stylesheet" href="style/css/estructura.css">
    <link rel="stylesheet" href="style/css/menu.css">
    <link rel="stylesheet" href="style/css/modal.css">
    <?php
      //Según la página que sea, importamos un CSS u otro
      if (isset ($pagina)) {
        if ($pagina == "imagenes") {
          echo '<link rel="stylesheet" href="style/css/imagenes.css">';
        } elseif ($pagina == "contacto") {
          echo '<link rel="stylesheet" href="style/css/contacto.css"/>';
        } elseif ($pagina == "foro") {
          echo '<link rel="stylesheet" href="style/css/foro.css">';
        } elseif ($pagina == "configuracion") {
          echo '<link rel = "stylesheet" href = "style/css/configuracion.css">';
          echo '<link rel="stylesheet" href="style/css/perfil.css">';
        }
      }
    ?>

    <script src="style/js/jQuery.js"></script>
    <script src="style/js/jQueryGeneral.js"></script>
    <script src="style/js/comprobar.js"></script>
    <script src="style/js/ajax.js"></script>
    <?php
      //Según la página que sea, importamos un jQuery u otro
      if (isset ($pagina)) {
        if ($pagina == "index" || $pagina == "index2") {
          echo '<script src = "style/js/index.js"></script>';
        } elseif ($pagina == "imagenes") {
          echo '<script src="style/js/jQueryImagenes.js"></script>';
          echo '<script src="style/js/buscar.js"></script>';
        } elseif ($pagina == "contacto") {
          echo '<script src="style/js/contacto.js"></script>';
        } elseif ($pagina == "foro") {
          echo '<script src="/style/js/foro.js"></script>';
        } elseif ($pagina == "configuracion") {
          echo '<script src="style/js/configuracion.js"></script>';
        }
      }
    ?>
  </head>
  <body>
    <div id="wrapper">
      <header id="mainhead">
        <div class="blanco">
          <a href="/" id="tit"><div class="ico-tit"></div>Camina hacia Santiago</a>
          <nav id="pcnav">
            <ul>
              <?php
                //Si está conectado le mostramos al usuario la opción de subir imágen o de mostrar sus propias imágenes
                if ($logged == true) {
                  ?>
                  <li id="imgLog"><a href="/imagenes.php">Imágenes<div class="ico derecha" id="imagenes"></div></a>
                    <ul id="dropImg" class="imgMenu">
                      <li><a href="/imagenes.php?action=upload">Subir mi imágen</a></li>
                      <li><a href="/imagenes.php?action=myImages">Ver mis Imágenes</a></li>
                    </ul>
                  </li>
                  <?php
                    //Si no está conectado no le mostramos las opciones, solo puede ver todas las imágenes
                } else {
                  ?>
                  <li id = "imgUnlog"><a href = "/imagenes.php">Imágenes<div class = "ico derecha" id = "imagenes"></div></a></li>
                  <?php
                }
              ?>
              <li><a href="/foro.php">Foro<div class="ico derecha" id="foro"></div></a></li>
              <li><a href="/contacto.php">Contáctanos<div class="ico derecha" id="info"></div></a></li>
              <?php
                //Si está conectado ocultamos la opción de conectar/registrar y mostramos su nombre y cuando le hagas clic le permitimos modificar sus datos y cerrar la sesión
                if (isset ($_SESSION["logged"])) {
                  if ($_SESSION["logged"]) {
                    ?>
                    <li><a class="user"><div id="user" class="user ico izquierda"></div><?= explode (" ", $_SESSION['user'])[0]; ?>
                        <div class="ico flechaAbajo derecha"></div></a>
                      <ul class="userMenu cerrar">
                        <li><a href="/configuracion.php">Perfil<div class="ico" id="config"></div></a></li>
                        <li><a class="logout">Cerrar Sesión<div class="ico" id="logout"></div></a></li>
                      </ul>
                    </li>
                  <?php } ?>
                <?php } else { ?>
                  <li><a class="li-ses">Entrar<div class="ico flechaAbajo derecha"></div></a></li>
                <?php } ?>
            </ul>
          </nav>
          <nav id="phonenav">
            <span class="icon"><div class="ico" id="menu"></div></span>
            <ul id="ul-phone" class="cerrar">
              <li><a href="/imagenes.php">Imágenes</a></li>
              <li><a href="/foro.php">Foro</a></li>
              <li><a href="/contacto.php">Contáctanos</a></li>
              <?php
                //Este hace lo mismo, pero es el menú del movil
                if (isset ($_SESSION['logged'])) {
                  if ($_SESSION['logged']) {
                    ?>
                    <li><a class="user">
                        <?php
                        $primero = explode (" ", $_SESSION['user']);
                        echo $primero[0];
                        ?>
                      </a>
                      <ul class="userMenu cerrar">
                        <li><a href="/configuracion.php">Perfil</a></li>
                        <li><a class="logout">Cerrar Sesión</div></a></li>
                      </ul>
                    </li>
                  <?php } ?>
                <?php } else { ?>
                  <li><a class="li-ses">Entrar</a></li>
                <?php } ?>
            </ul>
          </nav>
        </div>
        <!--
          El modal para conectar o para registrarte
        -->
        <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <div id="entrar">
              <form action="sistema/conectar.php" method="POST">
                <!--<form id="entrar" method="POST">-->
                <h2>Login</h2>
                <fieldset>
                  <p class="error">No puede haber campos vacíos</p>
                  <div>
                    <div class="ico user-form ico-ses"></div><input type="text" name="maillog" id="userlog" placeholder="Correo electrónico...">
                  </div>
                  <div>
                    <div class="ico pass-form ico-ses"></div><input type="password" name="passlog" id="passlog" placeholder="Contraseña... ">
                  </div>
                  <!--<div class="check">
                    <p class="texto1"><input type="checkbox" name="save" id="save">Mantener la sesión iniciada</p>
                  </div>-->
                  <input id="butEntrar" type="submit" value="Conectar">
                  <p class="texto cambio">¿No tienes cuenta? Registrate aqui</p>
                </fieldset>
              </form>
            </div>
            <div id="registro" class="oculto">
              <!--<form action="sistema/registro.php" method="POST">-->
              <form action="" method="POST">
                <h2>Registro</h2>
                <fieldset>
                  <div class="categoria">
                    <div class="ico user-form ico-ses"></div><input type="text" id="userreg" name="userreg" placeholder="Nombre...">
                  </div>
                  <div class="apellidos">
                    <input type="text" name="apellido1" class="apellido1" placeholder="Primer apellido...">
                    <input type="text" name="apellido2" class="apellido2" placeholder="Segundo apellido... (Opcional)">
                  </div>
                  <div class="categoria">
                    <div class="ico ico-ses" id="telefono"></div><input type="text" name="telefono" id="telefono" placeholder="Teléfono de contacto... ">
                  </div>
                  <div class="categoria">
                    <div class="ico ico-ses correo"></div><input type="mail" name="mailreg" id="mailreg" placeholder="Correo electrónico... ">
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
                  <div class="check">
                    <p class="texto1"><input type="checkbox" name="terms" id="terms">He leido y acepto los términos y condiciones</p>
                  </div>
                  <input type="hidden" name="activo" value="1">
                  <input id="butRegistro" type="submit" value="Registrarse">
                  <p class="texto cambio">¿Ya tienes cuenta? Inicia sesión aquí</p>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
        <!-- 
          Este modal es solo para la página de imágenes para mostrar las imágenes en grande
        -->
        <div class="modal2" id="modalImagen">
          <div id="contenidoModalImagen">
            <span class="close">&times;</span>
            <img id="imagen" />
          </div>
        </div>
      </header>