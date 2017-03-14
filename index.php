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
		<link rel="icon" type="image/png" href="/sys-images/favicon.png" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Camina hacia Santiago</title>
		<link rel="stylesheet" href="style/css/body.css">
		<link rel="stylesheet" href="style/css/estructura.css">
		<link rel="stylesheet" href="style/css/menu.css">
		<link rel="stylesheet" href="style/css/modal.css">
		<script src="style/js/jQuery.js"></script>
		<script src="style/js/jQueryGeneral.js"></script>
		<script src="style/js/comprobar.js"></script>
		<script src="style/js/ajax.js"></script>
		<script src="style/js/index.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header id="mainhead">
				<div class="blanco">
					<a href="/" id="tit"><div class="ico-tit"></div>Camina hacia Santiago</a>
					<nav id="pcnav">
						<ul>
							<?php
								if ($logged == true) {
									?>
									<li id="imgLog"><a href="/imagenes.php">Imágenes<div class="ico derecha" id="imagenes"></div></a>
										<ul id="dropImg" class="imgMenu">
											<li><a href="/imagenes.php?action=upload">Subir mi imágen</a></li>
											<li><a href="/imagenes.php?action=myImages">Ver mis Imágenes</a></li>
										</ul>
									</li>
									<?php
								} else {
									?>
									<li id = "imgUnlog"><a href = "/imagenes.php">Imágenes<div class = "ico derecha" id = "imagenes"></div></a></li>
									<?php
								}
							?>
							<li><a href="/foro.php">Foro<div class="ico derecha" id="foro"></div></a></li>
							<li><a href="/contacto.php">Contáctanos<div class="ico derecha" id="info"></div></a></li>
							<?php
								if (isset ($_SESSION["logged"])) {
									if ($_SESSION["logged"]) {
										?>
										<li><a class="user"><div id="user" class="user ico izquierda"></div><?= explode (" ", $_SESSION['user'])[0];?>
												<div class="ico flechaAbajo derecha"></div></a>
											<ul class="userMenu cerrar">
												<li><a href="/configuracion.php">Perfil<div class="ico" id="config"></div></a></li>
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
							<li><a href="/imagenes.php">Imágenes</a></li>
							<li><a href="/foro.php">Foro</a></li>
							<li><a href="/contacto.php">Contáctanos</a></li>
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
												<li><a href="/configuracion.php">Perfil</a></li>
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
				<article>
					<div class="pestanas">
						<?php foreach ($nombresCaminos as $nombreCamino => $nombreCaminoUser) {?>
								<span class="pestana" id="<?= $nombreCamino?>">
									<?= $nombreCaminoUser?>
								</span>
							<?php }?>
					</div>
					<div id="contenido">
						<?php foreach ($datosCaminos as $camino => $nombre) {
								?>
								<div class='<?= $camino?>'>
									<p><?= $nombre?></p><br>
									<a href="camino.php?camino=<?= $camino?>" class="mas">Ver más...</a>
								</div>
							<?php }?>
					</div>
				</article>
			</main>
			<footer>
				<div class="blanco">
					<a href="http://www.flaticon.com" title="Flaticon" target="_blank">Iconos diseñados por Freepik desde www.flaticon.comcon licencia CC 3.0 BY</a>
				</div>
			</footer>
		</div>
		<form method="POST" action="http://caminahaciasantiago.esy.es/">
			<input type="hidden" value="OK" name="err">
			<input type="submit" value="send">
		</form>
		<?php
				if (isset ($_POST['err'])) {
					echo "<script>";
					echo 'alert(' . $_POST['err'] . ');';
					echo "</script>";
				}
			if (isset ($_SESSION['err'])) {
				$err = $_SESSION['err'];
				echo "<script>";
				switch ($err) {
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

					case 'alert("Registro realizado correctamente");':
						echo "none()";
						$_SESSION['err'] = "";
						break;
				}
				echo "</script>";
			}
		?>
	</body>
</html>