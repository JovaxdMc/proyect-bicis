<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Editar la informacion de Bicicleta</title>
        <link rel="stylesheet" type="text/css" href="/BicRobmvc/views/src/css/estiloEditBicis.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <style>
        .edit-form {
            display: flex;
            margin: auto;
            flex-direction: column;
        }
        </style>
    </head>

    <body style="background-color: rgb(250, 250, 250)"> <?php 
include_once ('../res/nav.php');
?> <div class="container" style="background-color: #EAEAEA"> <?php
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

	?> <div class="container">
                <h1 class="text-center fs-1"
                    style="text-align: center; width: 100%; margin-left: auto; margin-right: auto;">
                    <?php echo $marca." ".$modelo." ".$year ?></h1>
            </div>
            <div class="detail-panel">
                <div class="description">
                    <div>
                        <h2>Datos de la Bicicleta</h2>
                        <p>Numero de serie: <?php echo $num_serie ?></p>
                        <p><?php echo "Talla: ".$talla ?></p>
                        <p><?php echo "Rodada: ".$rodada ?></p>
                        <p><?php echo "Fecha de Registro: ".$fecha_reg ?></p>
                        <p>Dueño:
                            <?php echo $_SESSION["Nombre"]." ".$_SESSION["Apellido_p"]." ".$_SESSION["Apellido_m"] ?>
                        </p>
                    </div>
                </div>
                <div class="image-container">
                    <img src="/BicRobmvc/views/src/imgBicis/<?php echo $fotoPrinc ?>" alt="Imagen de la bicicleta">
                </div>
                <!-- "Panel de Mis Bicicletas" -->
                <div id="mi-panel">
                    <div>
                        <h5 class="text-center fs-1">Mis Bicicletas:</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalNbic">AGREGAR FOTOS</button>
                        <div class="row">
                            <div class="col" id="resultado-busqueda"></div>
                            <div class="modal fade" id="modalNbic" tabindex="-1" role="dialog"
                                aria-labelledby="miModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="post" method="POST" enctype="multipart/form-data"
                                                class="nuev-form" id="formAddImg">
                                                <!-- "Formulario del boton (Agregar)" -->
                                                <div class="col">
                                                    <h2>Agregar imagen</h2>
                                                    <input type="hidden" name="id_bic" id="id_bic"
                                                        value=<?php echo $idB ?>>
                                                </div>
                                                <div class="col">
                                                    <label for="image">
                                                        <h5>Imagen:</h5>
                                                    </label>
                                                    <input type="file" id="image" name="image" accept="image/*"
                                                        required>
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
                                                <button id="close-form" class="btn btn-danger"
                                                    type="button">Cerrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container cards"> <?php
                                include_once ("../../../controllers/ImgBicController.php");
                                $ImgbiciController = new ImgbiciController($conexion);
                                $ImgbiciController->selecImg($id_bic,"id_bic",""); // llama al método select() del controlador
                            
                            ?> </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
    <script src="./cargaImgs.js"></script>

</html>