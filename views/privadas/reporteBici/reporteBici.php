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

	?> <h1>Reportar Bicicleta como robada</h1>
            <div class="detail-panel">
                <div class="row">
                    <div class="col-6">
                        <h2><?php echo $marca." ".$modelo." ".$year ?></h2>
                        <p><?php echo "Talla: ".$talla ?></p>
                        <p><?php echo "Rodada: ".$rodada ?></p>
                        <p><?php echo "Fecha de Registro: ".$fecha_reg ?></p>
                    </div>
                    <div class="col-6 contenedorImg">
                        <img class="imgBicPrin" src="/BicRobmvc/views/src/imgBicis/<?php echo $fotoPrinc ?>"
                            alt="Imagen de la bicicleta">
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <h3>Datos del Robo</h3>
                        <div class="btn-group">
                            <form action="/BicRobmvc/controllers/reporteController.php?accion=insert" method="POST" class="formReporte">
                                <input type="hidden" name="id_bic" value="<?php echo $id_bic ?>">
                                <label for="lugar">Lugar del robo</label>
                                <input type="text" name="lugar" required></input>
                                <label for="fecha_rob">Fecha</label>
                                <input type="text" name="fecha_rob" required></input>
                                <label for="hora">Hora</label>
                                <input type="text" name="hora" required></input>
                                <label for="comentarios">Comentarios</label>
                                <textarea name="comentarios" cols="30" rows="10" required></textarea>
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-success">Reportar</button>
                                    <button class="btn btn-cancel">Cancelar</button>
                                </div>
                            </form>
                        </div>
                        </div> 

                        <div class="col-6">
                            <?php
                                include_once ("../../../controllers/ImgBicController.php");
                                $ImgbiciController = new ImgbiciController($conexion);
                                $ImgbiciController->selecImgPriv($id_bic,"id_bic"); // llama al método select() del controlador
                            ?> 
                        </div>
                        
                    </div>
                </div>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade " id="modalAlert" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-dark text-light">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalAlertLabel">[IMPORTANTE]</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>En este apartado podras reportar tu bicicleta como robada, pero toma en cuenta que
                                    esto no es una denuncia como tal, esto solo permitira que tu bicicleta se pueda
                                    encontrar en el buscador de bicicletas robadas, ademas de que permitira a las
                                    autoridades ver la informacion de tu bicicleta para ayudar a su recuperacion, te
                                    invitamos a realizar la denuncia correspondiente al Ministerio publico </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Entendido</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <?php 
//footer include_once '/views/privadas/index/';
?> </body>
    <script src="./reporte.js"></script>

</html>