<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Editar la informacion de Bicicleta</title>
        <link rel="stylesheet" type="text/css" href="/BicRobmvc/views/src/css/estiloInfoBic.css">
        <link rel="stylesheet" type="text/css" href="/BicRobmvc/views/src/css/estiloCards.css">
        <link rel="stylesheet" type="text/css" href="/BicRobmvc/views/src/css/estiloCuenta.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body> <?php 
    include_once ('../res/nav.php');
    $idB=$_GET["id_b"];
    ?> <input type="hidden" id="idB" value="<?php echo $idB ?>">
        <div class="container">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="container paneltodo">
                            <div class="p-3 mb-4 rounded-3">
                                <div class="container py-1 my-3">
                                    <div class="row justify-content-between">
                                        <div class="col-5">
                                            <h1 id=titulo></h1>
                                            <div class="col" id="resultado-busqueda"></div>
                                            <div class="container paneldeinfous">
                                                <h3>Datos de la Bicicleta</h3>
                                                <p id="num_Serie"><b>Numero de serie: </b></p>
                                                <p id="Talla"><b>Talla: </b></p>
                                                <p id="Rodada"><b>Rodada: </b> </p>
                                                <p id="FechaRep"><b>Fecha del reporte: </b></p>
                                                <p id="FechaRobo"><b>Fecha del robo: </b></p>
                                                <p id="lugar"><b>Lugar del robo: </b></p>
                                                <p id="hora"><b>Hora: </b></p>
                                                <p id="coments"><b>Comentarios: </b></p>
                                            </div>
                                            <div class="container paneldeinfous">
                                                <h3>Datos del propietario</h3>
                                                <p id="propieP"><b>Propietario: </b></p>
                                                <p id="estado"><b>Estado: </b></p>
                                            </div>
                                            <div class="col-6">
                                                <img id="img" class="recimg" src="">
                                            </div>
                                            <h4>¿Tienes alguna informacion?</h4>
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#nuevComent"> Enviar Comentarios </button>
                                            <div class="modal fade " id="nuevComent" tabindex="-1"
                                                aria-labelledby="nuevComent" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content bg-dark text-light">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="nuevComent">Tengo informacion
                                                                sobre la bicicleta</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body"
                                                            style="max-height: 100%; overflow-y: auto;">
                                                            <form action="" id="nuevNotif" method="POST" enctype="multipart/form-data">
                                                                <div class="mb-3">
                                                                    <input type="hidden" id="id_usrReport"
                                                                        value="<?php echo $_SESSION["id"]; ?>">
                                                                    <input type="hidden" id="id_usrNotif"
                                                                        value="">

                                                                    <label for="contenido"
                                                                        class="form-label">Comentarios</label>
                                                                    <textarea name="contenido" id="contenidoNotf" cols="30"
                                                                        rows="10" class="form-control"></textarea>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="fotos"
                                                                        class="form-label">Comentarios</label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="image-input" class="form-label">Evidencias (Agrega fotos que sustenten los comentarios)</label>
                                                                    <input type="file" id="evicencias-input" accept="image/*" multiple >
                                                                    <div id="image-preview"></div>
                                                                </div>

                                                                <input type="submit" class="btn btn-success" value="Enviar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- "Panel de Mis Bicicletas" -->
                <div id="mi-panel">
                    <div>
                        <h5 class="text-center fs-1">Fotografias de la bicicleta</h5>
                        <div class="row">
                        </div>
                    </div>
                    <div class="panelContTodBicis" id="contenedor-cards"> <?php
                                include_once ("../../../controllers/ImgBicController.php");
                                $ImgbiciController = new ImgbiciController($conexion);
                                $ImgbiciController->selecImgPriv($idB,"id_bic"); // llama al método select() del controlador
                            ?> </div>
                </div>
            </div>
        </div>
        </div>
    </body>
    <script src="./cargarDatos.js"></script>
    <script src="/BicRobmvc/views/src/zoomImg.js"></script>

</html>