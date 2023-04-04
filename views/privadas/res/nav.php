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
<script src="/BicRobmvc/views/src/js/notificacionesNaV.js"></script>