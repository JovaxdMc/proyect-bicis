
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
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
            rel="stylesheet">
        <link rel="stylesheet"
            href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-3KwYayMHoBdeCvRg2KIoPQaibfZK9+UVv5d7iTbRufeZ1Vc2IMKOVr5PeaSL0bjE"
            crossorigin="anonymous">


        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <title>Index Admins</title>
    </head>
    <?php include_once ("../recursos/navAdm.php"); ?>
    <body class="bg-black">

       


        <div class="container">
            <div class="PrimerPanel m-4 p-2">
                <div class="row tit">
                    <h3>Administracion</h3>
                </div>
                <div class="col-12 Iconosy">
                    <div class="row m-2">
                        <div class="col-6 ">
                            <h4>Administración de usuarios</h4>
                            <a href="/BicRobmvc/views\privadas\Admin\admUsrs\admUsrs.php" class="btn w-100 bordboton" style="color:
                                aliceblue;">
                                <div class="container">
                                    <i class="fa-solid fa-users" style="color:
                                        #1962e1; font-size: 2000%;"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 ">
                            <h4>Administración de Reportes</h4>
                            <a href="/BicRobmvc/views/privadas/Admin/ElDeFiltros/Filtros.html" class="btn w-100 bordboton" style="color:
                                aliceblue;">
                                <div class="container">
                                    <i class="fa-solid fa-table"  style="color:
                                    #1962e1;  font-size: 2000%;"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </body>
</html>