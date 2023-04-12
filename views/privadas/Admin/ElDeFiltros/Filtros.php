<?php
  session_start();
  if (empty($_SESSION["id"] and $_SESSION["id"]!="admin")) {
    header("location: /BicRobmvc/index.php");
  }else{
    
  }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Registro De Usuarios</title>
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloFiltros.css">
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloLista.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Registro Usuarios</title>
    </head> <?php include_once ("../recursos/navAdm.php"); ?>

    <body class="bg-black">
        <div class="paneluno m-4 p.2">
            <div class="row p-2">
                <div class="row justify-content-end paneltitulosymas">
                    <div class="col-7">
                        <h3>Reportes de Bicicletas activas</h3>
                    </div>
                    <div class="col-3">
                        <input type="text" class="form-control" id="num_serie" name="num_serie"
                            placeholder="Ingrese el número de serie...">
                    </div>
                    <div class="col-2">
                        <select class="form-select" name="filtro" id="filtro">
                            <option value="">Seleccione una opción</option>
                            <option value="ubicacion">Ubicación</option>
                            <option value="num_serie">Número de serie</option>
                            <option value="fecha">Fecha</option>
                        </select>
                    </div>
                </div>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar por número de serie"
                        aria-label="Search" id="input-num-serie">
                    <button class="btn btn-outline-success" id="buscar" type="submit">Buscar</button>
                </form>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Filtrar por: </h4>
                        <label for="Marca">Marca:</label>
                        <select id="Marca" name="Marca">
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
                            <option value=" ORDER BY id_reporte DESC">Mas recientes primero</option>
                            <option value=" ORDER BY id_reporte ASC">Mas antiguos primero</option>
                        </select>
                        <button onclick="buscar()">Aplicar Filtro</button>
                    </div>
                </div>
                <div class="row justify-content-center mt-4 panelcontenido">
                    <div class="col-12 justify-content-center text-lg-center">
                        <div class="panel" id="bicicletas">

                            <ul class="list-group ">
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">
                                            <h2 class="nombreBic">Giant Trance 2019</h2>
                                        </div>
                                        <div class="col-lg-8">
                                            <h4 class="text-center"><b>Datos del reporte</b></h4>
                                            <p class="">Fecha de reporte: 2023-04-07</p>
                                            <p class="">Fecha del robo: 2023-07-06</p>
                                            <p class="">Lugar donde se robó:</p>
                                            <p class="">Guadalajara Jalisco</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <img src="/BicRobmvc/views/src/imgBicis/fotoPrin_8572c08698.png"
                                                alt="Imagen de la bicicleta" class="card-img-top">
                                        </div>
                                        <div class="col-lg-12"><button type="button" class="btn btn-primary"
                                                onclick="window.location.href='/BicRobmvc/views/privadas/infoBic/infoBic.php?id_b=35'">Más
                                                información</button></div>
                                    </div>
                                </li> <?php

                
                            //echo "/BicRobmvc/controllers/biciController.php";
                            include_once ("../../../../controllers/biciController.php");
                            $biciController = new biciController($conexion);
                            $biciController->selectIndexList("ORDER BY id_reporte DESC"); // llama al método select() del controlador 
                        ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="modal fade" id="modalBusq" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="miModalLabel">ENCONTRADO</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"
                                        id="cerrar">
                                        <span aria-hidden="true">X</span>
                                    </button>
                                </div>
                                <div class="container eymen">
                                    <div class="dosps">
                                        <div class="modal-body">
                                            <img src="" style="max-width: 90%; max-height: 90%; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/BicRobmvc/views\privadas\index\buscarNserie.js"></script>

</html>