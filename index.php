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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <noscript>
            <link rel="stylesheet" href="/BicRobmvc/IndexPro/assets/css/images/noscript.css" />
        </noscript>
    </head>

    <body class="is-preload landing">
        <div id="page-wrapper">
            <!-- Header -->
            <header id="header">
                <h1 id="logo"><a href="index.php">Inicio</a></h1>
                <nav id="nav">
                    <a href="#" class="button primary" data-bs-toggle="modal" data-bs-target="#modalLog">Ingresar</a>
                </nav>
            </header>
            <div class="container">
                <div class="col" id="resultado-busqueda"></div>
                <div class="modal fade" id="modalLog" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header pnencab">
                                <h3>Iniciar Sesión</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning" id="alertError" role="alert" style="display:none;"> El
                                    usuario o contraseña no pueden estar vacios </div>
                                <form id="loginForm" action="" method="post" class="m-2 p-2">
                                    <img id="logo" src="/BicRobmvc/views/src/imgSis/log.png" style="width: 100px;"
                                        alt="Logo">
                                    <input type="text" id="user" name="user" pattern="[A-Za-z0-9_-]{1,15}"
                                        placeholder="Usuario">
                                    <input type="password" id="passw" name="passw" pattern="[A-Za-z0-9_-]{1,15}"
                                        placeholder="Contraseña">
                                    <input type="submit" class="btn btn-info" name="btnLog" value="Iniciar Sesión"><br>
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
                        <p>Juntos contra el robo de bicicletas mantengamos nuestra comunidad informada</p>
                    </header>
                    <span class="image"><img src="/BicRobmvc//views/src/imgSis/logopag.png" alt="" /></span>
                </div>
                <a href="#one" class="goto-next scrolly">Next</a>
            </section>
            <!-- One -->
            <section id="one" class="spotlight style1 bottom">
                <span class="image fit main"><img src="/BicRobmvc/IndexPro/images/pexels-pixabay-289869.jpg"
                        alt="" /></span>
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 col-12-medium">
                                <ul>
                                    <h2>Mision</h2>
                                    <p>Facilitar el proceso de recopilación de información detallada sobre las
                                        bicicletas robadas y ofrecer una plataforma donde los ciclistas puedan compartir
                                        estos reportes con la comunidad. </p>
                            </div>
                            <div class="col-4 col-12-medium">
                                <h2>Vision</h2>
                                <p>Queremos establecer una plataforma segura y confiable donde los usuarios puedan
                                    cargar información detallada sobre sus bicicletas robadas y permitir que la
                                    comunidad acceda a estos reportes para brindar cualquier información relevante que
                                    pueda ayudar en su recuperación. </p>
                            </div>
							<div class="col-4 col-12-medium">
                                <h2>Valores</h2>
                                <ul>
        <li>Seguridad: Priorizamos la seguridad de los ciclistas y su entorno, brindando un sistema confiable y protegiendo la privacidad de los usuarios.</li>
        <li>Colaboración: Fomentamos la colaboración activa entre la comunidad ciclista para ayudar en la recuperación de bicicletas robadas y promover una cultura de apoyo mutuo.</li>
        <li>Innovación: Buscamos constantemente mejorar y adaptar nuestro sistema web para ofrecer la mejor experiencia a los usuarios y estar a la vanguardia en la lucha contra el robo de bicicletas.</li>
        <li>Transparencia: Nos comprometemos a ser transparentes en nuestras acciones y en la gestión de los reportes de bicicletas robadas, promoviendo la confianza de los usuarios y la comunidad.</li>
    </ul>
                            </div>
                        </div>
                    </div>
                    <a href="#two" class="goto-next scrolly">Next</a>
            </section>
            <!-- Two -->
            <section id="two" class="spotlight style2 right">
                <span class="image fit main"><img src="/BicRobmvc/IndexPro/images/pexels-clem-onojeghuo-173294.jpg"
                        alt="" /></span>
                <div class="content">

<h2>Producto:</h2>
<p>Sistema web para reportar bicicletas robadas en México con una interfaz intuitiva y funcionalidades para subir y visualizar reportes.</p>

<h2>Precio:</h2>
<p>Acceso gratuito para las funciones básicas, con opciones adicionales o mejoradas que podrían tener un costo en el futuro.</p>

<h2>Promoción:</h2>
<p>Estrategias de marketing en línea, alianzas con organizaciones ciclistas y fomento de la participación activa de la comunidad en la difusión de reportes.</p>

<h2>Plaza (Distribución):</h2>
<p>Disponible en todo México, accesible desde cualquier dispositivo con conexión a internet, y colaboraciones con autoridades, tiendas y talleres de bicicletas.</p>

                </div>
            </section>
        </div>
        <!-- Scripts -->
        <script src="/BicRobmvc/IndexPro/assets/js/jquery.min.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/jquery.scrolly.min.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/jquery.dropotron.min.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/jquery.scrollex.min.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/browser.min.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/breakpoints.min.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/util.js"></script>
        <script src="/BicRobmvc/IndexPro/assets/js/main.js"></script> <?php 
include_once './views/publicas/index/footer.php';
?> <script>
        formLogin = document.getElementById("loginForm");
        alertError = document.getElementById("alertError");
        formLogin.addEventListener("submit", (event) => {
            event.preventDefault();
            var user = document.getElementById("user").value;
            var pass = document.getElementById("passw").value;
            // Verificar que las contraseñas coincidan
            if (user === "" || pass === "") {
                alertError.style.display = "block";
                return;
            }
            var datos = new FormData();
            datos.append("user", user);
            datos.append("passw", pass);
            fetch('/BicRobmvc/controllers/LoginControler.php?m=i', {
                method: 'POST',
                body: datos
            }).then(response => {
                if (!response.ok) {
                    throw new Error("Error al enviar el formulario");
                }
                return response.text();
            }).then(data => {
                console.log(data);
                if (data.error) {
                    Swal.fire({
                        title: '<h3 style="color:white;">Error al registrar al usuario</h3>',
                        text: '',
                        icon: 'error',
                        background: '#000',
                        backdrop: true,
                        confirmButtonColor: '#068'
                    });
                } else if (data === "usuario") {
                    window.location.href = "/BicRobmvc/views/privadas/index/indexL.php";
                } else if (data === "admin") {
                    // Redirigir al usuario a la página correspondiente de administrador
                    window.location.href = "/BicRobmvc/views/privadas/Admin/indexAdmin/indexAdm.php";
                } else {
                    Swal.fire({
                        title: '<h3 style="color:white;">Usuario o contraseña erroneos</h3>',
                        text: '',
                        icon: 'success',
                        background: '#000',
                        backdrop: true,
                        confirmButtonColor: '#068'
                    });
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });
        </script>
    </body>

</html>