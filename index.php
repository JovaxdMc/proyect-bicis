<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>BicRob</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1,
			user-scalable=no" />
		<link rel="stylesheet" href="/BicRobmvc/IndexPro/assets/css/main.css" />
		<link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloIndex2.css">

		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
		<link rel="stylesheet"
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload landing">
		<div id="page-wrapper">

			<!-- Header -->
			<header id="header">
				<h1 id="logo"><a href="index.html">Inicio</a></h1>
				<nav id="nav">
					<a href="#" class="button primary" data-bs-toggle="modal"
						data-bs-target="#modalLog">Ingresar</a>
				</nav>
			</header>
			<div class="container">
				<div class="col" id="resultado-busqueda"></div>
				<div class="modal fade" id="modalLog" tabindex="-1" role="dialog"
					aria-labelledby="miModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header pnencab">
								<h3>Iniciar Sesión</h3>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="alert alert-warning" id="alertError" role="alert"
									style="display:none;">
									El usuario o contraseña no pueden estar vacios
								</div>
								<form id="loginForm" action="" method="post" class="m-2 p-2">
									<img id="logo" src="./views/src/imgSis/log.png" style="width: 100px;"
										alt="Logo">
									<input type="text" id="user" name="user" pattern="[A-Za-z0-9_-]{1,15}"
										placeholder="Usuario">
									<input type="password" id="passw" name="passw"
										pattern="[A-Za-z0-9_-]{1,15}"
										placeholder="Contraseña">
									<input type="submit" name="btnLog" value="Iniciar Sesión"><br>
									<a href="/BicRobmvc/views/publicas/registroUsr/regUsr.php"
										class="btn btn-success">Registrarse</a>
									<br>
									<a href="#">¿Olvidó su contraseña? Recuperar</a>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Banner -->
			<section id="banner">
				<div class="content">
					<header>
						<h2>Reporta y visualiza</h2>
						<p>Juntos contra el robo de bicicletas mantengamos nuetras comunidad
							informada</p>
					</header>
					<span class="image"><img src="images/imgprimera.jpg" alt="" /></span>
				</div>
				<a href="#one" class="goto-next scrolly">Next</a>
			</section>

			<!-- One -->
			<section id="one" class="spotlight style1 bottom">
				<span class="image fit main"><img src="images/pexels-pixabay-289869.jpg"
						alt="" /></span>
				<div class="content">
					<div class="container">
						<div class="row">
							<div class="col-4 col-12-medium">
								<header>
									<h2>Consejos para prevenir el robo de bicicletas en México</h2>
									<p>Protege tu inversión y evita el robo de tu bicicleta</p>
								</header>
							</div>
							<div class="col-4 col-12-medium">
								<ul>
									<li>Utiliza candados de alta seguridad: Invierte en un buen candado y
										utiliza al menos dos, preferiblemente de diferentes tipos, para
										asegurar tanto el cuadro como las ruedas de tu bicicleta.</li>
									<li>Estaciona en lugares seguros: Opta por estacionar tu bicicleta en
										áreas bien iluminadas y concurridas. Evita dejarla en lugares oscuros
										o solitarios.</li>
									<li>No dejes objetos de valor: Evita dejar objetos de valor como luces,
										herramientas o accesorios en tu bicicleta, ya que esto podría atraer a
										los ladrones.</li>
								</ul>
							</div>
							<div class="col-4 col-12-medium">
								<p>Recuerda que la prevención es la mejor herramienta para evitar el
									robo de bicicletas. Asegúrate de seguir estos consejos y tomar
									precauciones adicionales según tu entorno y ubicación. ¡Protege tu
									bicicleta y disfruta de tu viaje de manera segura!</p>
							</div>

						</div>
					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</section>

				<!-- Two -->
				<section id="two" class="spotlight style2 right">
					<span class="image fit main"><img
							src="images/pexels-clem-onojeghuo-173294.jpg" alt="" /></span>
					<div class="content">
						<header>
							<h2>Consejos para prevenir el robo de bicicletas</h2>
							<p>Protege tu bicicleta y evita ser víctima de robos</p>
						</header>
						<p>El robo de bicicletas es un problema común en muchas ciudades. Para
							proteger tu bicicleta y evitar ser víctima de robos, considera los
							siguientes consejos:</p>
						<ul>
							<li>Utiliza candados de alta seguridad y asegura tanto el cuadro como las
								ruedas de tu bicicleta.</li>
							<li>Estaciona tu bicicleta en lugares seguros, evitando áreas oscuras o
								solitarias.</li>
							<li>No dejes objetos de valor en tu bicicleta, ya que esto podría atraer
								a los ladrones.</li>
						</ul>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
				</section>
			</div>

			<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

		</body>
	</html>