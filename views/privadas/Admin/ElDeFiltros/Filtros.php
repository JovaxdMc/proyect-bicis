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
                <div class="col-12" style="text-align: center;">
                    <h1 class="mt-4">Reportes De Robo Activos</h1>
                </div>
            </div>
            <form class="d-flex mt-4 p-2" role="search">
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
                    <button onclick="buscar('List')">Aplicar Filtro</button>
                </div>
            </div>
            <div class="row justify-content-center mt-4 panelcontenido">
                <div class="col-12 justify-content-center text-lg-center p-2">
                    <div class="panel" >

                        <div class="container">
                            <div class="col m-2 p-2">
                                <div class="row">

                                    <ul class="list-group p-2" id="bicicletas">
                                         <?php
                                            //echo "/BicRobmvc/controllers/biciController.php";
                                            include_once ("../../../../controllers/biciController.php");
                                            $biciController = new biciController($conexion);
                                            $biciController->selectIndexList("ORDER BY id_reporte DESC"); // llama al método select() del controlador 
                                        ?>
                                        </ul>
                                </div>
                            </div>
                        </div>







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