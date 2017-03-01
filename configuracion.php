<?php
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
		<link rel="icon" type="image/png" href="http://caminahaciasantiago.esy.es/sys-images/favicon.png" />
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Camina hacia Santiago: Configuración</title>
		<link rel="stylesheet" href="style/css/body.css">
		<link rel="stylesheet" href="style/css/estructura.css">
		<link rel="stylesheet" href="style/css/menu.css">
		<link rel="stylesheet" href="style/css/perfil.css">
		<link rel="stylesheet" href="style/css/configuracion.css"/>
		<script src="style/js/jQuery.js"></script>
		<script src="style/js/jQueryGeneral.js"></script>
		<script src="style/js/comprobar.js"></script>
		<script src="style/js/ajax.js"></script>
		<script src="style/js/configuracion.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<header id="mainhead">
				<div class="blanco">
					<a href="http://caminahaciasantiago.esy.es/" id="tit"><div class="ico-tit"></div>Camina hacia Santiago</a>
					<nav id="pcnav">
						<ul>
							<?php
								if ($logged == true) {
									?>
									<li id="imgLog"><a href="http://caminahaciasantiago.esy.es/imagenes.php">Imágenes<div class="ico derecha" id="imagenes"></div></a>
										<ul id="dropImg" class="imgMenu">
											<li><a href="http://caminahaciasantiago.esy.es/imagenes.php?action=upload">Subir mi imágen</a></li>
											<li><a href="http://caminahaciasantiago.esy.es/imagenes.php?action=myImages">Ver mis Imágenes</a></li>
										</ul>
									</li>
									<?php
								} else {
									?>
									<li id = "imgUnlog"><a href = "http://caminahaciasantiago.esy.es/imagenes.php">Imágenes<div class = "ico derecha" id = "imagenes"></div></a></li>
									<?php
								}
							?>
							<li><a href="http://caminahaciasantiago.esy.es/foro.php">Foro<div class="ico derecha" id="foro"></div></a></li>
							<li><a href="http://caminahaciasantiago.esy.es/contacto.php">Contáctanos</a></li>
							<?php
								if (isset ($_SESSION["logged"])) {
									if ($_SESSION["logged"]) {
										?>
										<li><a class="user"><div id="user" class="user ico izquierda"></div><?= explode (" ", $_SESSION['user'])[0];?>
												<div class="ico flechaAbajo derecha"></div></a>
											<ul class="userMenu cerrar">
												<li><a href="http://caminahaciasantiago.esy.es/configuracion.php">Perfil<div class="ico" id="config"></div></a></li>
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
							<li><a href="http://caminahaciasantiago.esy.es/imagenes.php">Imágenes</a></li>
							<li><a href="http://caminahaciasantiago.esy.es/foro.php">Foro</a></li>
							<li><a href="http://caminahaciasantiago.esy.es/contacto.php">Contáctanos</a></li>
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
												<li><a href="http://caminahaciasantiago.esy.es/configuracion.php">Perfil</a></li>
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
			</header>
			<main>
				<?php if ($logged) {?>
						<form action="#" method="POST" id="modificarPerfil">
							<div class="categoria">
								<div class="ico user-form ico-ses"></div>
								<input type="text" value="<?= $_SESSION['user']?>" placeholder="Nombre" id="name">
							</div>
							<div class="categoria">
								<input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido..." value="<?= $_SESSION['apellido1']?>">
								<input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido... (Opcional)" value="<?php
								if (isset ($_SESSION['apellido2'])) {
									echo $_SESSION['apellido2'];
								}
								?>">
							</div>
							<div class="categoria">
								<div class="ico ico-ses" id="telefono"></div><input type="text" name="telefono" id="telefono" placeholder="Teléfono de contacto... " value="<?php if (isset($_SESSION['telefono'])) {echo $_SESSION['telefono'];}?>">
							</div>
							<div class="categoria">
								<div class="ico ico-ses correo"></div><input type="mail" name="mailreg" id="mailreg" placeholder="Correo electrónico... " value="<?=$_SESSION['correo']?>">
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
							echo "<script>alert('Debes estar conectado con  tu cuenta para tener acceso a esta página.');window.location = 'http://caminahaciasantiago.esy.es/';</script>";
						}
					?>
					</div>
				</form>
			</main>
		</div>
	</body>
</html>
