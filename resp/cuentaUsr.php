<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Información</title>
  
  <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloCuenta.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
    
</head>
<body>
<?php 
include_once ('../res/nav.php');
?>
<body>
    <div class="container">

        <div class="left-panel">
            <button class="edit-btn" data-id="'.$id_img.'"><i class="fas fa-pencil-alt"></i></button>
            <img class="profile-pic" src="/BicRobmvc/views/src/imgUsrs/<?php echo $_SESSION["imgPerfil"]?>"
                alt="Imagen de perfil">
            <div class="user-info">
                <h1>Nombre completo:
                    <?php echo $_SESSION["Nombre"] . ' ' . $_SESSION["Apellido_p"] . ' ' . $_SESSION["Apellido_m"]; ?>
                </h1>
                <p>Estado: <?php echo $_SESSION["Estado"]; ?></p>
                <p>Municipio: <?php echo $_SESSION["Municipio"]; ?></p>
                <p>Correo: <?php echo $_SESSION["correo"]; ?></p>
                <p>Numero de telefono: <?php echo $_SESSION["telefono"]; ?></p>
                <button type="button" class="btn btn-primary">Editar Informacion</button>
            </div>
        </div>

       
    

        <div class="right-panel">
            <h2>Articulos Publicados</h2>
                <!-- Botón para lanzar el modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                    Registrar Nueva Bicicleta
                </button>

                <!-- Modal scrollable -->
                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Registro de nueva Bicicleta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 900px; overflow-y: auto;">

                    <form action="" method="post" enctype="multipart/form-data" id="nuevBic">

                        <label for="fotoPrin">Foto principal:</label>
                        <input type="file" name="fotoPrin" id="fotoPrin" accept="image/*" onchange="previewImage(this);" required><br>
                        <img id="imgPreview" style="display:none; width: 500px; height: 400px;"><br>
                        <button type="button" onclick="cancelImage();">Cancelar selección</button><br>
                        <br>
                        <input type="hidden" name="id_u" value=<?php echo $_SESSION['id'] ?>>
                        <label for="num_serie">Número de serie: (En caso de no tenerlo posteriormente podras agregar imagenes con su descripcion para poder identificar tu bicicleta)</label>
                        <input type="text" name="num_serie" id="num_serie" ><br>

                        <label for="marca">Marca:</label>
                        <input type="text" name="marca" id="marca" required><br>

                        <label for="modelo">Modelo:</label>
                        <input type="text" name="modelo" id="modelo" required><br>

                        <label for="talla">Talla: (Para bicicletas sin tallas coloca M)</label>
                        <input type="text" name="talla" id="talla" required><br>

                        <label for="year">Año:</label>
                        <input type="number" name="year" id="year" min="1900" max="2099" required><br>

                        <label for="rodada">Rodada:</label>
                        <input type="text" name="rodada" id="rodada" required><br>

                        <!-- Vista previa y botón para "comprobante" -->

                        <label for="comprobante">Comprobante:</label>
                        <label for="comprobante">Sube tu archivo en formato PDF</label>
                        <input type="file" name="comprobante" id="comprobante" accept="pdf/*" required onchange="previewPDF(this);"><br>
                        <embed id="pdfPreview" src="" style="display: none; width: 700px; height: 600px;"><br>
                        <button type="button" onclick="cancelPDF();">Cancelar</button><br>


                        <input type="hidden" id="id_u" name="id_u" value="<?php echo $_SESSION['id'] ?>" required><br>
                        <button type="submit" name="enviar_img" class="btn btn-success">Registrar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                        </form>

                    </div>
                   
                    </div>
                </div>
                </div>
        </div>
            <div class="panel" id="bicis">
                <?php
                    //echo "/BicRobmvc/controllers/biciController.php";
                    include_once ("../../../controllers/biciController.php");
                    $biciController = new biciController($conexion);
                    $biciController->select($_SESSION["id"],"id_u"); // llama al método select() del controlador
                    
                    
                ?>
            </div>
        </div>

    </div>

    </body>
    <script src="./vistasPrev.js"></script>
</html>
