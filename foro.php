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
		<link rel="stylesheet" href="style/css/foro.css">
		<script src="style/js/jQuery.js"></script>
		<script src="style/js/jQueryGeneral.js"></script>
		<script src="style/js/comprobar.js"></script>
		<script src="style/js/ajax.js"></script>
		<script src="/style/js/foro.js"></script>
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
				<?php if (empty ($_GET['action'])) {?>
						<div class="secciones">
							<div class="encabezado">
								<h1>Comunidad: Normas, sugerencias...</h1>
							</div>
							<a href="/foro.php?action=normas" class="seccion">
								<h2>Normas del foro, sugerencias...</h2>
								<div class="descripcion">
									Colabora para que vayamos mejorando cada dia, leete las normas del foro para un correcto uso de este. También puedes dejar tus opiniones en lo que creas que poemos mejorar.
								</div>
								<div class="informacion">
									Temas: 0 | Mensaje: 0 (Al no contener nada, no está programado)
								</div>
							</a>
							<a href="/foro.php?action=nuevosUsuarios" class="seccion">
								<h2>Usuarios nuevos...</h2>
								<div class="descripcion">
									Si sois nuevos usuarios en el foro, pasaros por aquí, y presentaros, será un placer para nosotros daros la bienvenida!
								</div>
								<div class="informacion">
									Temas: 1 | Mensaje: 1
								</div>
							</a>
						</div>
						<div class="secciones">
							<div class="encabezado">
								<h1>Dudas generales</h1>
							</div>
							<a href="#" class="seccion">
								<h2>Albergues...</h2>
								<div class="descripcion">
									Aquí dispondrás de información acerca de los albergues (También podeis dejar vuestras críticas)
								</div>
								<div class="informacion">
									Temas: 0 | Mensaje: 0 (Al no contener nada, no está programado)
								</div>
							</a>
						</div>
					<?php }?>
				<?php if (isset ($_GET['action']) && $_GET['action'] == "nuevosUsuarios") {?>
						<div class="hilos">
							<div class="encabezado">
								<h1>Presentación</h1>
								<a href="/foro.php" class="volver"><div id="volver"></div></a>
							</div>
							<a href="/foro.php?action=1-Hola!-Me-llamo-Christian" class="hilo">
								<h2>Hola! Me llamo Christian</h2>
								<div class="descripcion">
									Iniciado por Christian, 01/03/2017 - 16:54
								</div>
								<div class="informacion">
									Respuestas: 1 | Visitas: 3
								</div>
							</a>
						</div>
					<?php }?>
				<?php if (isset ($_GET['action']) && $_GET['action'] == "1-Hola!-Me-llamo-Christian") {?>
						<div class="mensajes">
							<div class="encabezado">
								<h1>Hola! Me llamo Christian!</h1>
								<a href="/foro.php?action=nuevosUsuarios" class="volver"><div id="volver"></div></a>
							</div>
							<div class="mensaje">
								<div class="datosUsuario">
									<p>Christian</p>
									<p>01/03/2017 - 16:54</p>
									<p>Mensajes totales: 1</p>
								</div>
								<p>Hola! Me llamo Christian, soy de Mallorca y tengo 20 años</p>
							</div>
							<div class="mensaje">
								<div class="datosUsuario">
									<p>Otro que no es Christian</p>
									<p>01/03/2017 - 17:03</p>
									<p>Mensajes totales: 1</p>
								</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque volutpat eleifend magna, tempus venenatis urna volutpat eget. Cras laoreet quam a eros dictum, tempus fermentum nisl pretium. Ut vehicula nulla vel tincidunt efficitur. Phasellus malesuada id lectus sit amet efficitur. Duis leo tortor, egestas nec semper at, rhoncus vel dui. Suspendisse erat ex, ultrices non dapibus ac, lacinia a dolor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas sed pulvinar justo. Phasellus id dolor nisl. Quisque pellentesque, nisi ut eleifend hendrerit, tortor augue condimentum diam, id vehicula turpis lacus eget tellus. Sed et tortor gravida, eleifend erat non, bibendum turpis. Cras facilisis enim dignissim nibh molestie lacinia. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce non interdum urna, et ullamcorper leo. Cras eu eros urna. Quisque vitae risus euismod, blandit orci nec, euismod dui.

									Nam a aliquet quam. Integer nec elit aliquam nisi convallis tempor. Praesent pharetra venenatis arcu, vitae suscipit ex rutrum nec. Sed scelerisque quam quis lectus maximus mollis. Aenean mollis aliquet fermentum. Nam posuere lectus sapien, eget porta sapien efficitur vel. Sed mattis diam eu ante pulvinar, ut egestas dolor fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut a auctor tortor. Suspendisse dictum magna mi, eu ultrices nisi tincidunt ut. Praesent quis varius justo. Praesent ut dolor interdum orci malesuada hendrerit. Pellentesque elementum purus erat, fringilla sollicitudin quam tincidunt non. Suspendisse id lorem feugiat, auctor erat eu, egestas elit. In rhoncus felis imperdiet sagittis dapibus. Proin nec nulla semper, rutrum erat blandit, sagittis erat.

									Curabitur lobortis lacinia turpis, ut auctor sem facilisis et. Donec a aliquet erat. Fusce lobortis id mi tristique auctor. Nulla feugiat aliquam massa malesuada convallis. Curabitur a velit vel justo rutrum malesuada et quis erat. Pellentesque egestas sagittis ornare. Suspendisse sollicitudin enim in libero feugiat, ut elementum nunc ornare.

									Nulla ultrices diam id ante vulputate, sit amet gravida elit gravida. Integer eu molestie enim. Fusce efficitur neque nec metus dictum hendrerit. Nam tincidunt urna in tristique egestas. Donec rutrum varius nisi vel imperdiet. Suspendisse potenti. Fusce non tempus quam. Pellentesque venenatis felis et tempor congue.

									Ut vulputate augue sollicitudin neque vehicula luctus. Praesent cursus porttitor accumsan. Nam tincidunt ligula quis imperdiet vulputate. In ullamcorper, tellus sit amet pellentesque congue, ipsum sapien fringilla felis, sed lobortis mauris justo vitae risus. Vestibulum pretium, ex a molestie pulvinar, neque mauris gravida ipsum, et lacinia augue turpis finibus justo. Quisque viverra, augue vel accumsan volutpat, sem ligula viverra felis, ut pretium nisi mi vel magna. In pharetra nisl purus. Nunc at gravida ex. Nulla vitae erat ipsum. In lobortis erat eget interdum rutrum. Nunc lobortis eu justo eget sagittis. Fusce ultrices dui a urna sodales, eu fringilla ligula imperdiet. Phasellus tristique dui malesuada lectus facilisis interdum. Vestibulum varius, nulla ac hendrerit dapibus, leo velit tempus justo, in rhoncus metus eros vel nibh. Suspendisse efficitur sem vehicula sapien vulputate, molestie accumsan lacus hendrerit. </p>
							</div>
						</div>
						<?php if ($logged == true) {?>
							<form action="#" method="POST" id="respuestaRapida">
								<textarea placeholder="Respuesta rápida..." name="respuesta"></textarea>
								<input type="submit" value="Responder!" id="responder">
							</form>
						<?php }?>
					<?php }?>
			</main>
			<footer>
				<div class = "blanco">
					<a href = "http://www.flaticon.com" title = "Flaticon" target = "_blank">Iconos diseñados por Freepik desde www.flaticon.comcon licencia CC 3.0 BY</a>
				</div>
			</footer>
		</div>
	</body>
</html>