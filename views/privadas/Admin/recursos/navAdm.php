<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/BicRobmvc/views/privadas/Admin/indexAdmin/indexAdm.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false"> Administracion </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item"
                                href="\BicRobmvc\views\privadas\Admin\admUsrs\admUsrs.php">Administracion de
                                usuarios</a></li>          
                         <li><a class="dropdown-item"
                                href="\BicRobmvc\views\privadas\Admin\reportes\reportes.php">Estadisticas</a></li>             
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="/BicRobmvc/views\privadas\Admin\ElDeFiltros\Filtros.php"
                        tabindex="-1" aria-disabled="true">Reportes de bicicletas</a>
                </li>
                <li class="nav-item"><a class="nav-link active"
                        href="/BicRobmvc/controllers/LoginControler.php?m=o">Salir</a></li>
            </ul>
        </div>
    </div>
</nav>