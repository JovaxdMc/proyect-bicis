<?php
 $idN=$_GET["idN"];
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
  }else{
    
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
    ?> <div class="container">
        <input type="hidden" id="idN" value=>
            <!-- Button to trigger modal -->
            <button type="button" class="btn btn-primary" id="verNotif" onclick="cargarInfo('<?php echo $idN; ?>')"> Ver
                notificación </button>
            <!-- Modal -->

            
          

            <div class="container contPrin mb-4">
                <div class="row m-2 p-2">
                    <div class="col">
                        <div class="col-11 p-2 ConinfoBic">
                            <h2>Notificacion</h2>
                            
                            <br><br>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <img class="imgbictam" src="">
                    </div>
                </div>
            </div>
            <div class="container contPrin mb-4">
                <div class="row m-2 p-2">
                    <div class="col">
                        <div class="col-11 p-2 ConinfoBic">
                            <h1 style="text-align: center; margin-left: auto; margin-right: auto;">Contenido</h1>
                            <br>
                            
                            <div class="col-6">
                                <img class="imgbictam" src="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success m-1">Marcar como leído</button>
                        <a href="/BicRobmvc/views\privadas\cuentaUsr\cuentaUsr.php"
                            class="btn btn-cancel m-1">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="/BicRobmvc/views/src/zoomImg.js"></script>
    <script src="./carcarInfo.js"></script>
    
</html>