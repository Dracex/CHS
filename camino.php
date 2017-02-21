<?php
	$caminoUser = $_GET['camino'];
	include "contenido/contenido.php";

	if ($_GET) {
		foreach ($nombresCaminos as $nombreCamino => $nombreCaminoUser) {
			if ($caminoUser == $nombreCamino) {
				$titulo = $nombreCaminoUser;
				break;
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<link rel="icon" type="image/png" href="http://caminahaciasantiago.esy.es/sys-images/favicon.png" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Camina hacia Santiago</title>
		<link rel="stylesheet" href="style/css/body.css">
		<link rel="stylesheet" href="style/css/estructura.css">
		<link rel="stylesheet" href="style/css/menu.css">
		<link rel="stylesheet" href="style/css/modal.css">
		<script src="style/js/jQueryBasico.js"></script>
		<script src="style/js/jQuery.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header id="mainhead">
				<div class="blanco">
					<a href="http://caminahaciasantiago.esy.es/" id="tit"><div class="ico-tit"></div>Camina hacia Santiago</a>
					<nav id="pcnav">
						<ul>
							<li><a href="#">Imágenes<div class="ico derecha" id="imagenes"></div></a></li>
							<li><a href="#">Foro<div class="ico derecha" id="foro"></div></a></li>
							<li><a href="#">Sobre...<div class="ico derecha" id="info"></div></a></li>
							<?php if (isset($_SESSION['logged'])) { ?>
								<?php if ($_SESSION['logged']) { ?>
									<li><a class="user"><div id="user" class="user ico izquierda"></div><?=$_SESSION['user']?><div class="ico flechaAbajo derecha"></div></a>
										<ul class="userMenu cerrar">
											<li><a href="#">Configuración<div class="ico" id="config"></div></a></li>
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
							<li><a href="#">Imágenes<!--<div class="ico derecha" id="imagenes"></div>--></a></li>
							<li><a href="#">Foro<!--<div class="ico derecha" id="foro"></div>--></a></li>
							<li><a href="#">Sobre...<!--<div class="ico derecha" id="info"></div>--></a></li>
							<?php if (isset($_SESSION['logged'])) { ?>
								<?php if ($_SESSION['logged']) { ?>
									<li><a class="user"><!--<div id="user" class="user ico izquierda"></div>--><?=$_SESSION['user']?><!--<div class="ico flechaAbajo derecha"></div>--></a>
										<ul class="userMenu cerrar">
											<li><a href="#">Configuración<!--<div class="ico" id="config"></div>--></a></li>
											<li><a class="logout">Cerrar Sesión<!--<div class="ico" id="logout">--></div></a></li>
										</ul>
									</li>
								<?php } ?>
							<?php } else { ?>
								<li><a class="li-ses">Entrar<!--<div class="ico flechaAbajo derecha"></div>--></a></li>
							<?php } ?>
						</ul>
					</ul>
				</nav>
			</div>
			<div id="myModal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<div id="entrar">
						<form action="sistema/conectar.php" method="POST">
							<h2>Login</h2>
							<fieldset>
								<div>
									<div class="ico user-form ico-ses"></div><input type="text" name="userlog" id="userlog" placeholder="Usuario..." required>
								</div>
								<div>
									<div class="ico pass-form ico-ses"></div><input type="password" name="passlog" id="passlog" placeholder="Contraseña... " required>
								</div>
								<div class="check">
									<input type="checkbox" name="save" id="save" class="texto"><label for="save" id="lab-save">Mantener la sesión iniciada</label>
								</div>
								<input type="submit" value="Conectar">
								<p class="texto cambio">¿No tienes cuenta? Registrate aqui</p>
							</fieldset>
						</form>
					</div>
					<div id="registro" class="oculto">
						<form action="sistema/registro.php" method="POST">
							<h2>Registro</h2>
							<fieldset>
								<div>
									<div class="ico user-form ico-ses"></div><input type="text" name="userreg" id="userreg" placeholder="Usuario..." required>
								</div>
								<div>
									<div class="ico pass-form ico-ses"></div><input type="password" name="passreg" id="passreg" placeholder="Contraseña... " required>
								</div>
								<div>
									<div class="ico pass-form ico-ses"></div><input type="password" name="pass2reg" id="pass2reg" placeholder="Repetir contraseña... " required>
								</div>
								<div>
									<div class="ico ico-ses" id="correo"></div><input type="mail" name="mailreg" id="mailreg" placeholder="Correo electrónico... " required>
								</div>
								<div class="check">
									<input type="checkbox" name="terms" id="terms" class="texto" required><label for="terms" id="lab-terms">He leido y acepto los términos y condiciones</label>
								</div>
								<input type="hidden" name="activo" value="1">
								<input type="submit" value="Registrarse">
								<p class="texto cambio">¿Ya tienes cuenta? Inicia sesión aquí</p>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</header>
		<main>
			<?php foreach ($datosCaminos as $datosCamino => $datos) {
				$nombreCamino = key($datosCaminos);
				if ($caminoUser == $datosCamino) {
					echo "<article id='camino'>";
					echo "$datos";
					echo "</article>";
				}
			}
			?>
		</main>
		<footer>
			<div>Iconos diseñados por <a href="http://www.freepik.com" title="Freepik">Freepik</a> desde <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> con licencia <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
		</footer>
	</div>
</body>
</html>