<?php
  session_start();
  if (empty($_SESSION["id"] and $_SESSION["id"]!="admin")) {
    header("location: /BicRobmvc/index.php");
  }else{
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registro De Usuarios</title>
    <link rel="stylesheet" href="/views/src/css/estiloIndexAdm.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-3KwYayMHoBdeCvRg2KIoPQaibfZK9+UVv5d7iTbRufeZ1Vc2IMKOVr5PeaSL0bjE" crossorigin="anonymous">

    <link href="/BicRobmvc/views/src/css/estiloIndexAdm.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Index Admins</title>
</head>
<?php include_once ("../recursos/navAdm.php"); ?>

<body class="bg-black">


    <div class="container panelq mt-4">
        <div class="col-12">
            <div class="row titulo mt-4">
                <h3>Administracion</h3>
            </div>
            <div class="row mt-3 p-3">
                <div class="col-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header" style="text-align: center;"><h5>Administración de Usuarios</h5> </div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: justify;">Esta sección ofrece una tabla con registros de usuarios y
                                        filtros
                                        de búsqueda para administrarlos. También permite el registro de nuevos usuarios
                                        si
                                        es necesario.</p>
                                    <div class="row">
                                        <a href="/BicRobmvc/views\privadas\Admin\admUsrs\admUsrs.php"
                                            class="btn botones">Ingresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header" style="text-align: center; "><h5>Estadisticas</h5></div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: justify;">Esta sección ofrece una tabla con registros de usuarios y
                                        filtros de búsqueda para administrarlos. También permite el registro de nuevos
                                        usuarios si es necesario. Además, se puede cargar una gráfica para visualizar la
                                        cantidad de reportes de ciertas zonas.</p>
                                    <div class="row">
                                        <a href="/BicRobmvc/views/privadas/Admin/reportes/reportes.php"
                                            class="btn botones">Ingresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header" style="text-align: center;"><h5>Administración de Usuarios</h5></div>
                                <div class="card-body">
                                    <p class="card-text" style="text-align: justify;">Esta sección ofrece una tabla con registros de usuarios y
                                        filtros
                                        de búsqueda para administrarlos. También permite el registro de nuevos usuarios
                                        si
                                        es necesario.</p>
                                    <div class="row">
                                        <a href="/BicRobmvc/views/privadas/Admin/ElDeFiltros/Filtros.php"
                                            class="btn botones">Ingresar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>