<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Editar la informacion de Bicicleta</title>
        <link rel="stylesheet" type="text/css" href="/BicRobmvc/views/src/css/estiloEditBicis.css">
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloForm.css">
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloCards.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body> <?php 
    include_once ('../res/nav.php');
    ?> <div class="container"> <?php
        $idB=$_GET["id_b"];
		include_once ("../../../controllers/biciController.php");
        $biciController = new biciController($conexion);
        $resultado_selectU=$biciController->selectU($idB,"id_bic",""); // llama al método select() del controlador
        
        $id_bic = $resultado_selectU[0]['id_bic'];
        $fotoPrinc = $resultado_selectU[0]['fotoPrinc'];
        $num_serie = $resultado_selectU[0]['num_serie'];
        $marca = $resultado_selectU[0]['marca'];
        $modelo = $resultado_selectU[0]['modelo'];
        $talla = $resultado_selectU[0]['talla'];
        $year = $resultado_selectU[0]['year'];
        $rodada = $resultado_selectU[0]['rodada'];
        $estatus = $resultado_selectU[0]['estatus'];
        $fecha_reg = $resultado_selectU[0]['fecha_reg'];
        $comprobante = $resultado_selectU[0]['comprobante'];
?>

            <!-- Panel 1 de info bici e imagen-->
            <div class="container ">
                <div class="col">
                    <div class="col-12 p-2 m-1 rounded-3 paneltitulo">
                        <div class="container">
                            <h1 style="text-align: center; margin-left: auto; margin-right: auto;">
                                <?php echo $marca." ".$modelo." ".$year ?></h1>
                            <div>
                            </div>
                            <div class="container ">
                                <div class="col-5">
                                    <div class="datosbicispanel">
                                        <div class="row">
                                            <div class="col">
                                                <h4>Datos de la Bicicleta</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <b>Numero de serie:</b> <?php
                                                if($num_serie==""){
                                                    echo '<button class="btn btn-success btn-sm" id="btnAddNs" >Agregar numero de serie</button>';
                                                }else{
                                                   echo $num_serie;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <b>Talla:</b> <?php echo $talla ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <b>Rodada:</b> <?php echo $rodada ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <b>Fecha de Registro:</b> <?php echo $fecha_reg ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <b>Propietario:</b>
                                                <?php echo $_SESSION["Nombre"]." ".$_SESSION["Apellido_p"]." ".$_SESSION["Apellido_m"] ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#modalPDF"> Ver comprobante </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <img class="imgbictam" src="/BicRobmvc/views/src/imgBicis/<?php echo $fotoPrinc ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Panel 2 Cards de bicis y demas -->
            <div class="container">
                <div class="col-12 p-2 m-1 rounded-3 paneltitulo">
                    <div class="row ">
                        <!-- Titulo panel 2 bicis y demas -->
                        <div class="container  justify-content-center ">
                            <div class="row misbic">
                                <h5 class="text-center fs-1">Fotografias de la bicicleta:</h5>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalNbic">AGREGAR FOTOS</button>
                            </div>
                        </div>
                        <div class="modal fade" id="modalNbic" tabindex="-1" role="dialog"
                            aria-labelledby="miModalLabel" aria-hidden="true">
                            <div class="modal-dialog bg-dark text-light" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="nuevBicMod">Agregar imagen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="max-height: 100%; overflow-y: auto;">
                                        <form action="post" method="POST" enctype="multipart/form-data" id="formAddImg">
                                            <!-- "Formulario del boton (Agregar)" -->
                                            <div class="mb-3">
                                                <input type="hidden" name="id_bic" id="id_bic" value=<?php echo $idB ?>>
                                                <label for="image" class="form-label">
                                                    <h5>Imagen:</h5>
                                                </label>
                                                <input type="file" id="image" name="image" accept="image/*"
                                                    class="form-control" required>
                                                <img id="preview" src="#" alt="Vista previa de la imagen"
                                                    class="vistaIMG">
                                            </div>
                                            <div class="mb-3">
                                                <label for="title" class="form-label">
                                                    <h5>Título: </h5>
                                                </label>
                                                <input type="text" id="title" name="title" class="form-control"
                                                    required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">
                                                    <h5>Descripción:</h5>
                                                </label>
                                                <textarea id="description" name="description" class="form-control"
                                                    required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-success">Agregar</button>
                                                <button id="close-form" class="btn btn-danger" type="button"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="panelContTodBicis" id="contenedor-cards">
                                <?php include_once ("../../../controllers/ImgBicController.php");
                                        $ImgbiciController = new ImgbiciController($conexion);
                                        $ImgbiciController->selecImg($id_bic,"id_bic"); // llama al método select() del controlador?> </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content bg-dark text-light">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar Imagen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 100%; overflow-y: auto;">
                                    <form class="edit-form" id="editForm">
                                        <input type="hidden" id="cardId">
                                        <div class="form-group">
                                            <label for="cardTitle">Título</label>
                                            <input type="text" class="form-control" id="cardTitle">
                                        </div>
                                        <div class="form-group">
                                            <label for="cardImage">Imagen</label>
                                            <input type="hidden" id="imgAct">
                                            <input type="file" class="form-control-file" id="cardImage">
                                            <img id="cardImagePreview" src="" alt="Vista previa de la imagen"
                                                style="max-width: 100%; max-height: 200px;">
                                        </div>
                                        <div class="form-group">
                                            <label for="cardDescription">Descripción</label>
                                            <textarea class="form-control" id="cardDescription"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-danger cancel-btn"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success btn" id="editSubmit">Guardar
                                            cambios</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="modalPDFLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPDFLabel">Comprobante</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <embed src="/BicRobmvc/views/src/comprobantes/<?php echo $comprobante; ?>"
                                        type="application/pdf"  />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
    <!-- <script src="./cargarCards.js"></script> -->
    <script src="./cargaImgs.js"></script>
    <script src="./nuevaImg.js"></script>
    <script src="./datosbici.js"></script>

</html>