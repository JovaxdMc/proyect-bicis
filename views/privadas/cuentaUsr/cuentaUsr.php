<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }else{
    
  }
?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Panel de Información</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloForm.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloCuenta.css">
        <style>
        .img-modal {
            max-width: 100%;
            height: auto;
        }
        </style>
    </head>

    <body class="body"> <?php 
include_once ('../res/nav.php');
?> <div class="container panFondprim">
            <div class="row justify-content-between">
                <div class="col-12">
                    <div class="container">
                        <div class="p-3 mb-4 rounded-3 fondopaneless">
                            <div class="container py-1 my-3">
                                <div class="row justify-content-center">
                                    <div class="col-auto" id="contImgCuenta">
                                        <button class="edit-btn float-end" data-id="'.$id_img.'" id="btnEditarFoto">
                                            <i class="fas fa-pencil-alt"></i></button>
                                        <button class="save-btn float-end" data-id="'.$id_img.'" id="btnGuardFoto">
                                            <i class="fa-solid fa-floppy-disk"></i></button>
                                        <img class="rounded-circle"
                                            style="width: 200px; height: 200px; overflow: hidden;"
                                            src="/BicRobmvc/views/src/imgUsrs/<?php echo $_SESSION["imgPerfil"]?>"
                                            alt="Imagen de perfil" id="imgPerf">
                                    </div>
                                    <div class="col-8 m-3">
                                        <div class="container ">
                                            <div class="row">
                                                <div class="col">
                                                    <b>Nombre completo:</b>
                                                    <?php echo $_SESSION["Nombre"] . ' ' . $_SESSION["Apellido_p"] . ' ' . $_SESSION["Apellido_m"]; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <b>Estado: </b> <?php echo $_SESSION["Estado"]; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <b>Municipio:</b> <?php echo $_SESSION["Municipio"]; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <b>Correo: </b> <?php echo $_SESSION["correo"]; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <b>Numero de telefono:</b> <?php echo $_SESSION["telefono"]; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#editarDatosU"> Editar Informacion </button>
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
            <div class="row">
                <div class="col">
                    <div class="container ">
                        <div class="p-3 mb-4 rounded-3 fondopaneless">
                            <div class="container-fluid py-3 my-3 ">
                                <div class="container text-center ">
                                    <h2>Articulos Publicados</h2>
                                    <!-- Botón para lanzar el modal -->
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#nuevBicMod"> Registrar Nueva Bicicleta </button>
                                </div>
                                <div class="panelContTodBicis" id="bicis-div"> <?php
                                    //echo "/BicRobmvc/controllers/biciController.php";
                                    include_once ("../../../controllers/biciController.php");
                                    $biciController = new biciController($conexion);
                                    $biciController->select($_SESSION["id"],"id_u","ORDER BY id_bic ASC"); // llama al método select() del controlador
                                ?> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="editarDatosU" tabindex="-1" aria-labelledby="editarDatosU" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarDatosU">Editar informacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 100%; overflow-y: auto;">
                        <form action="" method="post">
                            <input type="hidden" name="id_u" id="id_u" value="<?php echo $_SESSION['id'] ?>">
                            <div class="mb-3">
                                <label for="Estado" class="form-label">Estado:</label>
                                <input type="text" name="Estado" id="Estado" class="form-control" required
                                    value="<?php echo $_SESSION['Estado'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="Municipio" class="form-label">Municipio:</label>
                                <input type="text" name="Municipio" id="Municipio" class="form-control" required
                                    value="<?php echo $_SESSION['Municipio']?>">
                            </div>
                            <div class="mb-3">
                                <label for="Correo" class="form-label">Correo:</label>
                                <input type="text" name="Correo" id="Correo" class="form-control" required
                                    value="<?php echo $_SESSION['correo']?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Telefono de contacto:</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" required
                                    value="<?php echo $_SESSION['telefono']?>">
                            </div>
                            <button id="actdatos" class="btn btn-success">Actualizar datos</button>
                            <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade " id="nuevBicMod" tabindex="-1" aria-labelledby="nuevBicMod" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="nuevBicMod">Registro de nueva Bicicleta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 100%; overflow-y: auto;">
                        <form action="" method="post" enctype="multipart/form-data" id="nuevBic">
                            <div class="mb-3">
                                <label for="fotoPrin" class="form-label">Foto principal:</label>
                                <input type="file" name="fotoPrin" id="fotoPrin" accept="image/*"
                                    onchange="previewImage(this);" class="form-control" required>
                                <img id="imgPreview" class="vistaIMG">
                                <button type="button" onclick="cancelImage();"
                                    class="btn btn-danger btnCancelPrev">Cancelar</button><br>
                            </div>
                            <input type="hidden" name="id_u" id="id_u" value="<?php echo $_SESSION['id'] ?>">
                            <div class="mb-3">
                                <label for="num_serie" class="form-label">Número de serie:</label>
                                <input type="text" name="num_serie" id="num_serie" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca:</label>
                                <input type="text" name="marca" id="marca" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo:</label>
                                <input type="text" name="modelo" id="modelo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="talla" class="form-label">Talla:</label>
                                <input type="text" name="talla" id="talla" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Año:</label>
                                <input type="number" name="year" id="year" class="form-control" min="1900" max="2099"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="rodada" class="form-label">Rodada:</label>
                                <input type="text" name="rodada" id="rodada" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="comprobante" class="form-label">Comprobante:</label>
                                <label for="comprobante" class="form-label">Sube tu archivo en formato PDF</label>
                                <input type="file" name="comprobante" id="comprobante" accept="application/pdf"
                                    onchange="previewPDF(this);" class="form-control" required>
                                <embed class="vistPDF" id="pdfPreview" src="">
                                <button type="button" onclick="cancelPDF();"
                                    class="btn btn-danger btnCancelPrev">Cancelar</button><br>
                            </div>
                            <br>
                            <div class="mb-3 enviarForm">
                                <input type="hidden" id="id_u" name="id_u" value="<?php echo $_SESSION['id'] ?>"
                                    required>
                                <button type="submit" name="enviar_img" class="btn btn-success">Registrar</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="./vistasPrev.js"></script>
    <script src="./editar.js"></script>

</html>