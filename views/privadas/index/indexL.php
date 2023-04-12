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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <a class="nav-link active" aria-current="page" href="/BicRobmvc/views/privadas/index/indexL.php"
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
                                <li><a class="dropdown-item"
                                        href="/BicRobmvc/controllers/LoginControler.php?m=o">Salir</a>
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
                    <img src="/BicRobmvc/views/src/imgCarrusel/carrusel (7).jpeg" class="d-block w-100">
                </div>
                <div class="carousel-item">
                    <img src="/BicRobmvc/views/src/imgCarrusel/carrusel (2).jpeg" class="d-block w-100">
                </div><div class="carousel-item">
                    <img src="/BicRobmvc/views/src/imgCarrusel/carrusel (3).jpeg" class="d-block w-100">
                </div><div class="carousel-item">
                    <img src="/BicRobmvc/views/src/imgCarrusel/carrusel (4).jpeg" class="d-block w-100">
                </div><div class="carousel-item">
                    <img src="/BicRobmvc/views/src/imgCarrusel/carrusel (5).jpeg" class="d-block w-100">
                </div><div class="carousel-item">
                    <img src="/BicRobmvc/views/src/imgCarrusel/carrusel (6).jpeg" class="d-block w-100">
               
                
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
            <div class=" col-12 panelactreciente">
                <h3>Actividad Reciente</h3>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Filtrar por: </h4>
                        <label for="Marca">Marca:</label>
                        <select id="Marca" name="Marca" >
                            <option value=" ">---------</option>
                        </select>
                        <label for="Estado">Estado:</label>
                        <select id="Estado" name="Estado">
                            <option value=" ">---------</option>
                        </select>
                        <label for="Municipio">Municipio:</label>
                        <select id="Municipio" name="Municipio">
                            <option value=" ">---------</option>
                        </select>
                        <label for="Orden">Ordenar:</label>
                        <select id="Orden" name="Orden">
                            <option value=" ORDER BY id_reporte ASC">Mas recientes primero</option>
                            <option value=" ORDER BY id_reporte DESC">Mas antiguos primero</option>
                        </select>

                        <button onclick="buscar(' ')">Aplicar Filtro</button>
                    </div>
                </div>
                <div class="panel" id="bicicletas"> <?php
                    //echo "/BicRobmvc/controllers/biciController.php";
                    include_once ("../../../controllers/biciController.php");
                    $biciController = new biciController($conexion);
                    $biciController->selectIndex("ORDER BY id_reporte DESC"); // llama al método select() del controlador 
                ?> </div>
            </div>
        </div>
        <div class="container">
            <div class="modal fade" id="modalBusq" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="miModalLabel">ENCONTRADO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" id="cerrar">
                                <span aria-hidden="true">X</span>
                            </button>
                        </div>
                        <div class="container eymen">
                            <div class="dosps">
                                <div class="modal-body">
                                    <img src=""
                                        style="max-width: 90%; max-height: 90%; object-fit: contain;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="./buscarNserie.js"></script>

</html>