<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/estiloReportesGraf.css">
        <title>Document</title>
    </head>
    <!DOCTYPE html>
    <html>

        <head>
            <!-- Tus etiquetas meta, enlaces a archivos CSS y scripts JS aquí -->
        </head>

        <body style="background-color: black;"> <?php include_once ("../recursos/navAdm.php"); ?> <div class="row">
                <div class="col-12 m-4 p-2 panelfondo">
                    <div class="row">
                        <div class="container" style="background-color: #212529;!important">
                            <div class="col-12 m-4 ">
                                <div class="row panelcontodo">
                                    <h1 class="text-center">Robo de bicicletas por estados</h1>
                                    <canvas id="grafico"></canvas>
                                </div>
                            </div>
                            <div class="col">
                                <h1 class="text-center">Robo de bicicletas por Municipio</h1>
                                <label for="Estado">Estado: </label>
                                <select id="Estado" name="Estado">
                                    <option value=" ">---------</option>
                                </select>
                                <button class="btn btn-info" onclick="selectMunicipio()">Aplicar</button>
                                <canvas id="graficoMun"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

    </html>
    <script>
    window.addEventListener('load', function() {
        selectEnc('Estado', 'reportes');
        llenarEstados();
    });

    function selectEnc(columna, tabla) {
        const formData = new FormData();
        formData.append("columna", columna);
        formData.append("tabla", tabla);
        fetch("/BicRobmvc/controllers/statsController.php?accion=selectEnc", {
            method: "POST",
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error("Error al enviar el formulario");
            }
            return response.json();
        }).then(data => {
            generarGrafico(data, columna);
        }).catch(error => {
            console.error(error);
        });
    }

    function llenarEstados() {
        // Obtener el elemento select
        var selectEstado = document.getElementById("Estado");
        // Llamar a la función PHP que genera las opciones del select
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/BicRobmvc/controllers/filtroController.php?accion=llenarEstados", true);
        xhr.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // Almacenar el resultado generado en una variable JavaScript
                var opciones = this.responseText;
                //console.log(opciones);
                // Agregar el resultado al select utilizando innerHTML
                selectEstado.innerHTML = opciones;
            }
        };
        xhr.send();
    }

    function selectMunicipio() {
        const formData = new FormData();
        var selectEstado = document.getElementById("Estado");
        formData.append("columnaEstado", 'Estado');
        formData.append("columnaMunicipio", 'Municipio');
        formData.append("estado", selectEstado.value);
        formData.append("tabla", 'reportes');
        fetch("/BicRobmvc/controllers/statsController.php?accion=selectMunic", {
            method: "POST",
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error("Error al enviar el formulario");
            }
            return response.json();
        }).then(data => {
            console.log(data);
            generarGraficoMun(data, 'Municipio');
        }).catch(error => {
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
                        beginAtZero: true,
                        stepSize: 5 // especifica el tamaño de los intervalos entre los valores en el eje Y
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

    function generarGraficoMun(json, columna) {
        // Obtener el objeto del gráfico existente
        var chart = Chart.getChart("graficoMun");
        // Destruir el gráfico existente
        if (chart) {
            chart.destroy();
        }
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
                        beginAtZero: true,
                        stepSize: 5 // especifica el tamaño de los intervalos entre los valores en el eje Y
                    }
                }]
            }
        };
        const ctx = document.getElementById('graficoMun').getContext('2d');
        const grafico = new Chart(ctx, {
            type: 'bar',
            data: datosGrafica,
            options: opciones
        });
    }
    </script>

</html>