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
</head>

<body>
    <?php 
    include_once ('../res/nav.php');
    ?>
    <div class="container"> <?php
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

        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="container paneltodo">
                        <div class="p-3 mb-4 rounded-3">
                            <div class="container py-1 my-3">
                                <div class="row justify-content-between">
                                    <div class="col-5">
                                        <h1> <?php echo $marca." ".$modelo." ".$year ?></h1>
                                        <div class="col" id="resultado-busqueda"></div>
                                        <div class="container paneldeinfous">
                                            <h3>Datos de la Bicicleta</h3>
                                            <p><b>Numero de serie: </b><?php echo $num_serie ?></p>
                                            <p><b>Talla: </b> <?php echo $talla ?></p>
                                            <p><b>Rodada: </b> <?php echo $rodada ?></p>
                                            <p><b>Fecha de Registro: </b> <?php echo $fecha_reg ?></p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <img class="recimg"
                                            src="/BicRobmvc/views/src/imgBicis/<?php echo $fotoPrinc ?>">
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
                <h5 class="text-center fs-1">Mis Bicicletas:</h5>
                <div class="row">
                    <div class="col" id="resultado-busqueda"></div>
                    <div class="modal fade" id="modalNbic" tabindex="-1" role="dialog" aria-labelledby="miModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="post" method="POST" enctype="multipart/form-data" class="nuev-form"
                                        id="formAddImg">
                                        <!-- "Formulario del boton (Agregar)" -->
                                        <div class="col">
                                            <h2>Agregar imagen</h2>
                                            <input type="hidden" name="id_bic" id="id_bic" value=<?php echo $idB ?>>
                                        </div>
                                        <div class="col">
                                            <label for="image">
                                                <h5>Imagen:</h5>
                                            </label>
                                            <input type="file" id="image" name="image" accept="image/*" required>
                                            <img id="preview" src="#" alt="Vista previa de la imagen"
                                                style="display: none; max-width: 100%; max-height: 200px;">
                                        </div>
                                        <div class="col">
                                            <label for="title">
                                                <h5>Título: </h5>
                                            </label>
                                            <input type="text" id="title" name="title" required>
                                        </div>
                                        <div class="col">
                                            <label for="description">
                                                <h5>Descripción:</h5>
                                            </label>
                                            <textarea id="description" name="description" required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">Agregar</button>
                                        <button id="close-form" class="btn btn-danger" type="button">Cerrar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panelContTodBicis" id="contenedor-cards">
                        <?php
                                include_once ("../../../controllers/ImgBicController.php");
                                $ImgbiciController = new ImgbiciController($conexion);
                                $ImgbiciController->selecImgPriv($id_bic,"id_bic"); // llama al método select() del controlador
                            ?>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Editar
                                        Imagen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
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
                </div>
            </div>
        </div>
    </div>
</body>
<!-- <script src="./cargarCards.js"></script> -->



</html>