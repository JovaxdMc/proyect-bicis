<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Panel de Información</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloIndex.css">
    <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloCards.css">
    <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="abc">
        <nav class="navbar navbar-expand-lg" data-bs-theme="black">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/BicRobmvc/views/src/imgSis/logopag.png" alt="Bootstrap" width="50" height="45">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../catBicis/catBicis.php"
                                style="color: white">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../info/info.html" style="color: white">Información</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar por número de serie"
                            aria-label="Search" id="input-num-serie">
                        <button class="btn btn-outline-success" id="buscar" type="submit">Buscar</button>
                    </form>
                </div>
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link">
                            <img src="/BicRobmvc/views/src/imgUsrs/<?php echo $_SESSION["imgPerfil"]?>"
                                alt="Foto de perfil" width="40" height="40">
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="/BicRobmvc/views/privadas/cuentaUsr/cuentaUsr.php">Mi
                                    cuenta</a></li>
                            <li><a class="dropdown-item" href="/BicRobmvc/controllers/LoginControler.php?m=o">Salir</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="col" id="resultado-busqueda">
        </div>
    </div>

    <div id="carouselExampleAutoplaying" class="carousel slide carru" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/BicRobmvc/views/src/imgCarrusel/carrusel1.jpeg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="/BicRobmvc/views/src/imgCarrusel/carrusel2.jpeg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="/BicRobmvc/views/src/imgCarrusel/carrusel3.jpeg" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="/BicRobmvc/views/src/imgCarrusel/carrusel4.jpeg" class="d-block w-100">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="row justify-content-between p-2 m-4">
        <div class=" col-7 panelactreciente">
            <h3>Actividad Reciente</h3>
            <div class="panel">
                <?php
                    //echo "/BicRobmvc/controllers/biciController.php";
                    include_once ("../../../controllers/biciController.php");
                    $biciController = new biciController($conexion);
                    $biciController->selectIndex("Reportado","estatus","ORDER BY id_bic ASC"); // llama al método select() del controlador 
                ?>
            </div>
        </div>

        <div class="col-4 ">
            <div class="panel row text-white info">
                <img src="/BicRobmvc/views/src/imgSis/infogra.jpeg" alt="">
            </div>
        </div>
    </div>

</body>
<script>
// Obtener el formulario y el botón de búsqueda
var form = document.querySelector(".d-flex");
var btnBuscar = document.querySelector("#buscar");


// Escuchar el evento de envío del formulario
form.addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    // Obtener el valor del campo de número de serie
    var numSerie = document.querySelector("#input-num-serie").value;

    if (numSerie == "") {
        alert("Por favor, ingrese un número de serie válido");
        return;
    }

    // Crear una solicitud HTTP
    var xhr = new XMLHttpRequest();

    // Definir qué hacer en la respuesta de la solicitud
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Mostrar la respuesta en la página sin recargarla
                document.querySelector("#resultado-busqueda").innerHTML = xhr.responseText;
                var miModal = document.querySelector('#modalBusq');
                var modal = new bootstrap.Modal(miModal);
                modal.show();

                // Función para cerrar el modal al hacer clic en el botón "Cerrar"
                document.querySelector('#modalBusq .modal-footer button').addEventListener('click',
                    function() {
                        modal.hide()
                    });

                // Función para cerrar el modal al hacer clic en el botón "X" en la esquina superior derecha
                document.querySelector('#modalBusq .modal-header button').addEventListener('click',
                    function() {
                        modal.hide()
                    });

            } else {
                alert("Hubo un error al realizar la búsqueda");
            }
        }
    }

    // Abrir la solicitud con el método GET y la URL del archivo PHP
    xhr.open("GET", "buscar_bicicleta.php?num_serie=" + numSerie, true);

    // Enviar la solicitud
    xhr.send();
});
</script>

</html>