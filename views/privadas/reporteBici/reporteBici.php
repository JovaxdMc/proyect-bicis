<?php
  session_start();
  if (empty($_SESSION["id"])) {
    header("location: /BicRobmvc/index.php");
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
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js">
    </script>
</head>

<body> <?php 
    include_once ('../res/nav.php');
    ?> <div class="container"> <?php
        $idB=$_GET["id_b"];
		include_once ("../../../controllers/biciController.php");
        $biciController = new biciController($conexion);
        $resultado_selectU=$biciController->selectU($idB,"id_bic",""); // llama al método select() del controlador
        
        $id_bic = $resultado_selectU[0]['id_bic'];
        $fotoPrinc = $resultado_selectU[0]['fotoPrinc'];
        $num_serie = $resultado_selectU[0]['num_serie'];
        $marca = $resultado_selectU[0]['marca'];
        $modelo = $resultado_selectU[0]['modelo'];
        $talla = $resultado_selectU[0]['talla'];
        $year = $resultado_selectU[0]['year'];
        $rodada = $resultado_selectU[0]['rodada'];
        $estatus = $resultado_selectU[0]['estatus'];
        $fecha_reg = $resultado_selectU[0]['fecha_reg'];
        $comprobante = $resultado_selectU[0]['comprobante'];
	?>


        <div class="container contPrin mb-4">
            <div class="row m-2 p-2">
                <div class="col">
                    <div class="col-11 p-2 ConinfoBic">
                        <h2>Reportar Bicicleta como robada</h2>
                        <h3 class="mb-4"><?php echo $marca." ".$modelo." ".$year ?></h3>
                        <p><?php echo "Talla: ".$talla ?></p>
                        <p><?php echo "Rodada: ".$rodada ?></p>
                        <p><?php echo "Fecha de Registro: ".$fecha_reg ?></p>
                    </div>
                </div>
                <div class="col-6 p-2">
                    <img class="img-fluid max-width: 500px"
                        src="/BicRobmvc/views/src/imgBicis/<?php echo $fotoPrinc ?>">
                </div>
            </div>

            <div class="row m-2 p-2">
                <div class="col-4">
                    <div class="col p-2 ConinfoBic">
                        <h2>Datos del Robo</h2>
                        <form action="/BicRobmvc/controllers/reporteController.php?accion=insert" method="POST"
                            class="formReporte">
                            <div class="mb-3">
                                <label for="lugar" class="form-label w-100">Estado</label>
                                <div class="input-group">
                                    <select name="Estado" id="Estado" required onchange="cargarCiudades()"
                                        class="form-control">
                                        <option value="">Seleccione un Estado</option>
                                        <option value="Aguascalientes">Aguascalientes</option>
                                        <option value="Baja California">Baja California</option>
                                        <option value="Baja California Sur">Baja California Sur</option>
                                        <option value="Campeche">Campeche</option>
                                        <option value="Chiapas">Chiapas</option>
                                        <option value="Chihuahua">Chihuahua</option>
                                        <option value="Coahuila">Coahuila</option>
                                        <option value="Colima">Colima</option>
                                        <option value="Durango">Durango</option>
                                        <option value="Estado de México">Estado de México</option>
                                        <option value="Guanajuato">Guanajuato</option>
                                        <option value="Guerrero">Guerrero</option>
                                        <option value="Hidalgo">Hidalgo</option>
                                        <option value="Jalisco">Jalisco</option>
                                        <option value="Michoacán">Michoacán</option>
                                        <option value="Morelos">Morelos</option>
                                        <option value="Nayarit">Nayarit</option>
                                        <option value="Nuevo León">Nuevo León</option>
                                        <option value="Oaxaca">Oaxaca</option>
                                        <option value="Puebla">Puebla</option>
                                        <option value="Querétaro">Querétaro</option>
                                        <option value="Quintana Roo">Quintana Roo</option>
                                        <option value="San Luis Potosí">San Luis Potosí</option>
                                        <option value="Sinaloa">Sinaloa</option>
                                        <option value="Sonora">Sonora</option>
                                        <option value="Tabasco">Tabasco</option>
                                        <option value="Tamaulipas">Tamaulipas</option>
                                        <option value="Tlaxcala">Tlaxcala</option>
                                        <option value="Veracruz">Veracruz</option>
                                        <option value="Yucatán">Yucatán</option>
                                        <option value="Zacatecas">Zacatecas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lugar" class="form-label w-100">Municipio</label>
                                <select name="Municipio" id="Municipio" required class="form-control w-100">
                                    <option value="">Seleccione una ciudad</option>
                                </select>
                                <script>
                                // Obtener los elementos select del estado y de la ciudad
                                const estadoSelect = document.getElementById("Estado");
                                const ciudadSelect = document.getElementById("Municipio");

                                // Definir un objeto con las ciudades disponibles para cada estado
                                const ciudadesPorEstado = {
                                    "Aguascalientes": ["Aguascalientes", "Asientos", "Calvillo", "Jesús María",
                                        "Rincón de Romos", "San José de Gracia", "Tepezalá"
                                    ],
                                    "Baja California": ["Ensenada", "Mexicali", "Tijuana", "Tecate", "Rosarito",
                                        "Playas de Rosarito", "San Quintín", "San Felipe"
                                    ],
                                    "Baja California Sur": ["La Paz", "Los Cabos", "Loreto", "Comondú",
                                        "Mulegé",
                                        "Guerrero Negro", "Santa Rosalía", "Ciudad Constitución"
                                    ],
                                    "Campeche": ["Campeche", "Calkiní", "Ciudad del Carmen", "Champotón",
                                        "Hecelchakán", "Hopelchén", "Tenabo", "Escárcega"
                                    ],
                                    "Chiapas": ["Tuxtla Gutiérrez", "Tapachula", "San Cristóbal de las Casas",
                                        "Palenque", "Comitán", "Villaflores", "Huixtla", "Cintalapa"
                                    ],
                                    "Chihuahua": ["Chihuahua", "Ciudad Juárez", "Cuauhtémoc", "Delicias",
                                        "Hidalgo del Parral", "Nuevo Casas Grandes", "Camargo", "Meoqui"
                                    ],
                                    "Coahuila": ["Saltillo", "Torreón", "Monclova", "Piedras Negras",
                                        "Nueva Rosita", "San Pedro", "Acuña", "Frontera"
                                    ],
                                    "Colima": ["Colima", "Manzanillo", "Tecomán", "Villa de Álvarez", "Armería",
                                        "Minatitlán", "Ixtlahuacán", "Coquimatlán"
                                    ],
                                    "Durango": ["Durango", "Gómez Palacio", "Ciudad Lerdo", "Canatlán",
                                        "Peñón Blanco", "El Salto", "Vicente Guerrero", "El Oro"
                                    ],
                                    "Estado de México": ["Toluca", "Nezahualcóyotl", "Naucalpan de Juárez",
                                        "Ecatepec de Morelos", "Chimalhuacán", "Texcoco",
                                        "Tlalnepantla de Baz",
                                        "Cuautitlán Izcalli"
                                    ],
                                    "Guanajuato": ["León", "Irapuato", "Celaya", "Salamanca", "Silao",
                                        "Guanajuato",
                                        "San Miguel de Allende", "Dolores Hidalgo"
                                    ],
                                    "Guerrero": ["Acapulco de Juárez", "Chilpancingo de los Bravo",
                                        "Iguala de la Independencia", "Taxco de Alarcón",
                                        "Zihuatanejo de Azueta", "Chilapa de Álvarez", "Arcelia",
                                        "Tlapa de Comonfort"
                                    ],
                                    "Hidalgo": ["Pachuca de Soto", "Tula de Allende", "Tulancingo de Bravo",
                                        "Actopan", "Mineral de la Reforma", "Tepeji del Río",
                                        "Atotonilco el Grande", "Ixmiquilpan"
                                    ],
                                    "Michoacán": ["Morelia", "Uruapan", "Lázaro Cárdenas", "Zamora",
                                        "Apatzingán"
                                    ],
                                    "Morelos": ["Cuernavaca", "Jiutepec", "Temixco", "Yautepec", "Oaxtepec"],
                                    "Nayarit": ["Tepic", "Bahía de Banderas", "Xalisco", "Tecuala",
                                        "Compostela"
                                    ],
                                    "Nuevo León": ["Monterrey", "Guadalupe", "San Nicolás de los Garza",
                                        "Apodaca",
                                        "Santa Catarina"
                                    ],
                                    "Oaxaca": ["Oaxaca de Juárez", "Salina Cruz", "Juchitán de Zaragoza",
                                        "Tuxtepec", "Huajuapan de León"
                                    ],
                                    "Jalisco": ["Guadalajara", "Zapopan", "Tlaquepaque", "Tonalá",
                                        "Puerto Vallarta", "Lagos de Moreno", "Autlán de Navarro", "Ocotlán"
                                    ],
                                    "Morelos": ["Cuernavaca", "Jiutepec", "Temixco", "Yautepec", "Oaxtepec",
                                        "Puente de Ixtla", "Joquicingo", "Xochitepec"
                                    ],
                                    "Nayarit": ["Tepic", "Bahía de Banderas", "Xalisco", "Tecuala",
                                        "Compostela",
                                        "Ixtlán del Río", "Acaponeta", "Tecuala"
                                    ],
                                    "Nuevo León": ["Monterrey", "Guadalupe", "San Nicolás de los Garza",
                                        "Apodaca",
                                        "Santa Catarina", "San Pedro Garza García", "Linares", "García"
                                    ],
                                    "Oaxaca": ["Oaxaca de Juárez", "Salina Cruz", "Juchitán de Zaragoza",
                                        "Tuxtepec", "Huajuapan de León", "Puerto Escondido",
                                        "Miahuatlán de Porfirio Díaz", "San Pedro Pochutla"
                                    ],
                                    "Puebla": ["Puebla de Zaragoza", "Tehuacán",
                                        "San Martín Texmelucan de Labastida", "Atlixco",
                                        "Izúcar de Matamoros",
                                        "Teziutlán", "Cholula de Rivadabia", "Huauchinango"
                                    ],
                                    "Querétaro": ["Santiago de Querétaro", "San Juan del Río", "Corregidora",
                                        "El Marqués", "Tequisquiapan", "Amealco de Bonfil",
                                        "Cadereyta de Montes", "Ezequiel Montes"
                                    ],
                                    "Quintana Roo": ["Cancún", "Chetumal", "Playa del Carmen", "Cozumel",
                                        "Tulum",
                                        "Isla Mujeres", "Felipe Carrillo Puerto", "Bacalar"
                                    ],
                                    "San Luis Potosí": ["San Luis Potosí", "Ciudad Valles", "Matehuala",
                                        "Rioverde",
                                        "Tamazunchale", "Soledad de Graciano Sánchez", "Salinas de Hidalgo",
                                        "Cárdenas"
                                    ],
                                    "Sinaloa": ["Culiacán Rosales", "Mazatlán", "Los Mochis", "Guamúchil",
                                        "El Fuerte", "Escuinapa de Hidalgo", "Angostura", "Guasave"
                                    ],
                                    "Sonora": ["Hermosillo", "Ciudad Obregón", "Nogales",
                                        "San Luis Río Colorado",
                                        "Caborca",
                                    ],
                                    "Tabasco": ["Villahermosa", "Cárdenas", "Comalcalco", "Paraíso",
                                        "Tenosique"
                                    ],
                                    "Tamaulipas": ["Ciudad Victoria", "Nuevo Laredo", "Reynosa", "Matamoros",
                                        "Tampico"
                                    ],
                                    "Tlaxcala": ["Tlaxcala de Xicohténcatl", "Huamantla", "Chiautempan",
                                        "Apizaco",
                                        "Tlaxco"
                                    ],
                                    "Veracruz": ["Xalapa", "Veracruz", "Coatzacoalcos", "Minatitlán",
                                        "Córdoba"
                                    ],
                                    "Yucatán": ["Mérida", "Valladolid", "Izamal", "Tizimín", "Progreso"],
                                    "Zacatecas": ["Zacatecas", "Fresnillo", "Jerez", "Sombrerete", "Río Grande"]
                                };

                                // Función que actualiza las opciones de la ciudad según el estado seleccionado
                                function actualizarCiudades() {
                                    // Obtener el valor seleccionado del estado
                                    const estadoSeleccionado = estadoSelect.value;

                                    // Obtener las ciudades disponibles para el estado seleccionado
                                    const ciudadesDisponibles = ciudadesPorEstado[estadoSeleccionado];

                                    // Eliminar todas las opciones actuales de la ciudad
                                    ciudadSelect.innerHTML = "";

                                    // Agregar una opción por cada ciudad disponible
                                    ciudadesDisponibles.forEach(function(ciudad) {
                                        const option = document.createElement("option");
                                        option.value = ciudad;
                                        option.text = ciudad;
                                        ciudadSelect.add(option);
                                    });

                                    // Si no hay ciudades disponibles para el estado seleccionado, agregar una opción indicando que no hay ciudades
                                    if (ciudadesDisponibles.length === 0) {
                                        const option = document.createElement("option");
                                        option.value = "";
                                        option.text = "No hay ciudades disponibles para este estado";
                                        ciudadSelect.add(option);
                                    }
                                }

                                // Asignar la función actualizarCiudades al evento change del select del estado
                                estadoSelect.addEventListener("change", actualizarCiudades);
                                </script>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_rob" class="form-label w-100">Fecha</label>
                                <input type="text" name="fecha_rob" class="form-control w-100" id="fecha_rob" required>
                            </div>
                            <div class="mb-3">
                                <label for="hora" class="form-label w-100">Hora</label>
                                <input type="text" name="hora" class="form-control w-100" required>
                            </div>
                            <div class="mb-3">
                                <label for="comentarios" class="form-label w-100">Comentarios</label>
                                <textarea name="comentarios" class="form-control w-100" rows="3" required></textarea>
                            </div>
                            <div class="btn-group">
                                <form action="/BicRobmvc/controllers/reporteController.php?accion=insert" method="POST"
                                    class="formReporte">
                                    <input type="hidden" name="id_bic" value="<?php echo $id_bic ?>">
                                    <button type="submit" class="btn btn-success m-1">Reportar</button>
                                    <button class="btn btn-cancel m-1">Cancelar</button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-8 d-flex flex-wrap justify-content-between">
                    <?php
                        include_once ("../../../controllers/ImgBicController.php");
                        $ImgbiciController = new ImgbiciController($conexion);
                        $ImgbiciController->selecImgPriv($id_bic,"id_bic"); // llama al método select() del controlador
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="./reporte.js"></script>
<script>
$(document).ready(function() {
    $('#fecha_rob').datepicker({
        format: 'dd/mm/yyyy',
        language: 'es',
        autoclose: true
    });
});
</script>





</html>