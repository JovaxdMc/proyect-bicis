<?php 
    include_once './views/publicas/index/header.php';
?>

<div class="container">
    <div class="col" id="resultado-busqueda"></div>
    <div class="modal fade" id="modalLog" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pnencab">
                    <h3>Iniciar Sesión</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="loginForm" action="./controllers/LoginControler.php?m=i" method="post" class="m-2 p-2">
                        <img id="logo" src="./views/src/imgSis/log.png" style="width: 100px;" alt="Logo">
                        <input type="text" name="user" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Usuario">
                        <input type="password" name="passw" pattern="[A-Za-z0-9_-]{1,15}" placeholder="Contraseña">
                        <input type="submit" name="btnLog" value="Iniciar Sesión"><br>
                        <a href="/BicRobmvc/views/publicas/registroUsr/regUsr.php"
                            class="btn btn-success">Registrarse</a>
                        <br>
                        <a href="#">¿Olvidó su contraseña? Recuperar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="carouselExampleAutoplaying" class="carousel slide carru" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="/BicRobmvc/views/src/imgCarrusel/carrusel1.jpeg" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="/BicRobmvc/views/src/imgCarrusel/carrusel2.jpeg" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="/BicRobmvc/views/src/imgCarrusel/carrusel3.jpeg" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="/BicRobmvc/views/src/imgCarrusel/carrusel4.jpeg" class="d-block w-100">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>



<div class="row justify-content-between p-2 m-4">
    <div class=" col-7 panelactreciente">
        <h3 class="text-center">Actividad Reciente</h3>
        <div class="panel">
            <?php
                    //echo "/BicRobmvc/controllers/biciController.php";
                    include_once ("./controllers/biciController.php");
                    $biciController = new biciController($conexion);
                    $biciController->selectIndex("Reportado","estatus","ORDER BY id_bic ASC"); // llama al método select() del controlador
                          
                ?>
        </div>
    </div>
    <div class="col-4 ">
        <div class="panel row text-white info">
            <img src="/BicRobmvc/views/src/imgSis/infogra.jpeg" alt="">
        </div>
    </div>
</div>


<?php 
include_once './views/publicas/index/footer.php';
?>