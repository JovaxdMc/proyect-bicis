<nav class="navbar navbar-expand-lg bg-black mb-4" style="background: #2b3035 !important">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="/BicRobmvc/views/src/imgSis/logopag.png" alt="Bootstrap" width="50" height="45">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/BicRobmvc/views/privadas/index/indexL.php"
                        style="color: white">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/BicRobmvc/views/privadas/index/indexL.php"
                        style="color: white">Información</a>
                </li>
            </ul>
        </div>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <img src="/BicRobmvc/views/src/imgUsrs/<?php echo $_SESSION["imgPerfil"]?>" alt="Foto de perfil"
                        width="40" height="40">
                    <input type="hidden" id="id_usr_nav" value="<?php echo $_SESSION["id"]?>">
                </a>
            </li>




            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span id="notification-count" class="badge badge-pill badge-danger">0</span>
                </a>
                <ul id="notification-list" class="dropdown-menu dropdown-menu-end">
                    <!-- Las notificaciones se agregarán aquí dinámicamente -->
                    <li class="dropdown-item">
                        <div class="notification-container">
                            <h5 class="notification-title">Título de la notificación 1</h5>
                            <p class="notification-message">Mensaje de la notificación 1</p>
                            <small class="notification-date">Fecha de la notificación 1</small>
                        </div>
                    </li>
                    <li class="dropdown-item">
                        <div class="notification-container">
                            <h5 class="notification-title">Título de la notificación 2</h5>
                            <p class="notification-message">Mensaje de la notificación 2</p>
                            <small class="notification-date">Fecha de la notificación 2</small>
                        </div>
                    </li>
                    <!-- Agrega más elementos <li> con el contenido de cada notificación -->
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/BicRobmvc/views/privadas/cuentaUsr/cuentaUsr.php">Mi cuenta</a>
                    </li>
                    <li><a class="dropdown-item" href="/BicRobmvc/controllers/LoginControler.php?m=o">Salir</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="modal fade" id="modalInfoNotf" tabindex="-1" role="dialog" aria-labelledby="modalInfoNotfLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #343434;">
            <div class="modal-header" style="background-color: #0a4757;">
                <h5 class="modal-title" id="modalInfoNotfLabel" style="color: white;">Detalles de la notificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: #ffffff;">
                <p>Fecha: <span id="fechaN"></span></p>
                <p>Hora: <span id="horaN"></span></p>
                <p>Contenido: <span id="contN"></span></p>
                <p>Bicicleta: <span id="biciN"></span></p>
                <div class="imgs" style="display: flex; flex-wrap: wrap; margin-top: 10px;">
                    <img src="imagen1.jpg">
                    <img src="imagen2.jpg">
                    <img src="imagen3.jpg">
                    <!-- Agrega aquí las imágenes adicionales con el mismo estilo de margen -->
                </div>
            </div>
        </div>
    </div>
</div>
















<script src="/BicRobmvc/views/src/js/notificacionesNaV.js"></script>
<script src="/BicRobmvc/views/src/js/cargarInfo.js"></script>