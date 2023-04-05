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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloReporte.css">
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


        <div class="container contPrin mb-4">
            <div class="row m-2 p-2">
                <div class="col">
                    <div class="col-11 p-2 ConinfoBic">
                        <h2>Reportar Bicicleta como robada</h2>
                        <h3 class="mb-4"><?php echo $marca." ".$modelo." ".$year ?></h3>
                        <p><?php echo "Talla: ".$talla ?></p>
                        <p><?php echo "Rodada: ".$rodada ?></p>
                        <p><?php echo "Fecha de Registro: ".$fecha_reg ?></p>
                    </div>
                </div>
                <div class="col-6 p-2">
                    <img class="img-fluid max-width: 500px"
                        src="/BicRobmvc/views/src/imgBicis/<?php echo $fotoPrinc ?>">
                </div>
            </div>

            <div class="row m-2 p-2">
                <div class="col-4">
                    <div class="col p-2 ConinfoBic">
                        <h2>Datos del Robo</h2>
                        <form action="/BicRobmvc/controllers/reporteController.php?accion=insert" method="POST"
                            class="formReporte">
                            <div class="mb-3">
                                <label for="lugar" class="form-label w-100">Lugar del robo</label>
                                <input type="text" name="lugar" class="form-control w-100" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_rob" class="form-label w-100">Fecha</label>
                                <input type="text" name="fecha_rob" class="form-control w-100" required>
                            </div>
                            <div class="mb-3">
                                <label for="hora" class="form-label w-100">Hora</label>
                                <input type="text" name="hora" class="form-control w-100" required>
                            </div>
                            <div class="mb-3">
                                <label for="comentarios" class="form-label w-100">Comentarios</label>
                                <textarea name="comentarios" class="form-control w-100" rows="3" required></textarea>
                            </div>
                            <div class="btn-group">
                                <form action="/BicRobmvc/controllers/reporteController.php?accion=insert" method="POST"
                                    class="formReporte">
                                    <input type="hidden" name="id_bic" value="<?php echo $id_bic ?>">
                                    <button type="submit" class="btn btn-success m-1">Reportar</button>
                                    <button class="btn btn-cancel m-1">Cancelar</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-8 d-flex flex-wrap justify-content-between">
                    <?php
                        include_once ("../../../controllers/ImgBicController.php");
                        $ImgbiciController = new ImgbiciController($conexion);
                        $ImgbiciController->selecImgPriv($id_bic,"id_bic"); // llama al método select() del controlador
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="./reporte.js"></script>

</html>