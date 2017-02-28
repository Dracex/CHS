<?php
	include "contenido/contenido.php";
	session_start ();
	if (isset ($_SESSION['logged']) && $_SESSION['logged'] == true) {
		$logged = $_SESSION['logged'];
	} else {
		$logged = false;
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="icon" type="image/png" href="http://localhost/CaminaASantiago/public_html/sys-images/favicon.png" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Camina hacia Santiago</title>
		<link rel="stylesheet" href="style/css/body.css">
		<link rel="stylesheet" href="style/css/estructura.css">
		<link rel="stylesheet" href="style/css/menu.css">
		<link rel="stylesheet" href="style/css/modal.css">
		<link rel="stylesheet" href="style/css/contacto.css"/>
		<script src="style/js/jQuery.js"></script>
		<script src="style/js/jQueryGeneral.js"></script>
		<script src="style/js/comprobar.js"></script>
		<script src="style/js/ajax.js"></script>
		<script src="style/js/contacto.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header id="mainhead">
				<div class="blanco">
					<a href="http://localhost/CaminaASantiago/public_html/" id="tit"><div class="ico-tit"></div>Camina hacia Santiago</a>
					<nav id="pcnav">
						<ul>
							<?php
								if ($logged == true) {
									?>
									<li id="imgLog"><a href="http://localhost/CaminaASantiago/public_html/imagenes.php">Imágenes<div class="ico derecha" id="imagenes"></div></a>
										<ul id="dropImg" class="imgMenu">
											<li><a href="http://localhost/CaminaASantiago/public_html/imagenes.php?action=upload">Subir mi imágen</a></li>
											<li><a href="http://localhost/CaminaASantiago/public_html/imagenes.php?action=myImages">Ver mis Imágenes</a></li>
										</ul>
									</li>
									<?php
								} else {
									?>
									<li id = "imgUnlog"><a href = "http://localhost/CaminaASantiago/public_html/imagenes.php">Imágenes<div class = "ico derecha" id = "imagenes"></div></a></li>
									<?php
								}
							?>
							<li><a href="#">Foro<div class="ico derecha" id="foro"></div></a></li>
							<li><a href="http://localhost/CaminaASantiago/public_html/contacto.php">Contáctanos<div class="ico derecha" id="info"></div></a></li>
							<?php
								if (isset ($_SESSION["logged"])) {
									if ($_SESSION["logged"]) {
										?>
										<li><a class="user"><div id="user" class="user ico izquierda"></div><?= explode (" ", $_SESSION['user'])[0];?>
												<div class="ico flechaAbajo derecha"></div></a>
											<ul class="userMenu cerrar">
												<li><a href="http://localhost/CaminaASantiago/public_html/configuracion.php">Perfil<div class="ico" id="config"></div></a></li>
												<li><a class="logout">Cerrar Sesión<div class="ico" id="logout"></div></a></li>
											</ul>
										</li>
									<?php }?>
								<?php } else {?>
									<li><a class="li-ses">Entrar<div class="ico flechaAbajo derecha"></div></a></li>
								<?php }?>
						</ul>
					</nav>
					<nav id="phonenav">
						<span class="icon"><div class="ico" id="menu"></div></span>
						<ul id="ul-phone" class="cerrar">
							<li><a href="http://localhost/CaminaASantiago/public_html/imagenes.php">Imágenes</a></li>
							<li><a href="#">Foro</a></li>
							<li><a href="#">Sobre...</a></li>
							<?php
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
												<li><a href="http://localhost/CaminaASantiago/public_html/configuracion.php">Perfil</a></li>
												<li><a class="logout">Cerrar Sesión</div></a></li>
											</ul>
										</li>
									<?php }?>
								<?php } else {?>
									<li><a class="li-ses">Entrar</a></li>
								<?php }?>
						</ul>
					</nav>
				</div>
				<div id="myModal" class="modal">
					<div class="modal-content">
						<span class="close">&times;</span>
						<div id="entrar">
							<form action="sistema/conectar.php" method="POST">
								<!--<form id="entrar" method="POST">-->
								<h2>Login</h2>
								<fieldset>
									<p class="error">No puede haber campos vacíos</p>
	<!--									<p class="error userlog">No puedes dejar campos en blanco</p>
										<p class="error passlog">No puedes dejar campos en blanco</p>-->
									<div>
										<div class="ico user-form ico-ses"></div><input type="mail" name="maillog" id="userlog" placeholder="Correo electrónico...">
									</div>
									<div>
										<div class="ico pass-form ico-ses"></div><input type="password" name="passlog" id="passlog" placeholder="Contraseña... ">
									</div>
									<div class="check">
										<p class="texto1"><input type="checkbox" name="save" id="save">Mantener la sesión iniciada</p>
									</div>
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
			</header>
			<main>
				<h1>Contáctanos!</h1>
				<form action="sistema/enviar.php" method="POST">
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
					<textarea placeholder="Déjanos tu mensaje aquí..." name="mensaje"></textarea>
					<input type="submit" value="Mandar">
				</form>
			</main>
			<footer>
				<div class="blanco">
					<a href="http://www.flaticon.com" title="Flaticon" target="_blank">Iconos diseñados por Freepik desde www.flaticon.comcon licencia CC 3.0 BY</a>
				</div>
			</footer>
	</body>
</html>