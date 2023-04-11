<?php
  session_start();
  if (!empty($_SESSION["id"])) {
    header("location: /BicRobmvc/views/privadas/index/indexL.php");
  }
  
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Información</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloIndex.css">
  <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloCards.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg" style="background-color: #2b3035;" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="/BicRobmvc/views/src/imgSis/logopag.png" alt="Bootstrap" width="50" height="45">
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../catBicis/catBicis.php" style="color: white">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../info/info.html" style="color: white">Información</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar por número de serie" aria-label="Search" id="input-num-serie">
            <button class="btn btn-outline-success" id="buscar" type="submit" >Buscar</button>
        </form>
      </div>
      <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" >
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLog">Iniciar Sesion</button>
                    </a>
                </li>
                
        </ul>
    </div>
  </nav>