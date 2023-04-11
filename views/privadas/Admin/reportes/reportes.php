<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<?php include_once ("../recursos/navAdm.php"); ?>
    <div class="container">
        <button onClick="selectEnc('Municipio','reportes')">Cargar</button>
        <h1 class="text-center">Estadisticas de robos de bicicletas</h1>
        <canvas id="grafico"></canvas>
    </div>
</body>
<script>


function selectEnc(columna, tabla) {
  const formData = new FormData();
  formData.append("columna", columna);
  formData.append("tabla", tabla);

  fetch("/BicRobmvc/controllers/statsController.php?accion=selectEnc", {
    method: "POST",
    body: formData
  })
    .then(response => {
      if (!response.ok) {
        throw new Error("Error al enviar el formulario");
      }
      return response.json();
    })
    .then(data => {
      generarGrafico(data, columna);
    })
    .catch(error => {
      console.error(error);
    });
}

function generarGrafico(json, columna) {
  const datos = JSON.parse(json);

  const estados = {};
  datos.forEach(dato => {
    estados[dato[columna]] = dato.cantidad;
  });

  const labels = Object.keys(estados);
  const data = Object.values(estados);

  const datosGrafica = {
    labels: labels,
    datasets: [{
      label: 'Cantidad',
      data: data,
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  };

  const opciones = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  };

  const ctx = document.getElementById('grafico').getContext('2d');
  const grafico = new Chart(ctx, {
    type: 'bar',
    data: datosGrafica,
    options: opciones
  });
}



</script>
</html>