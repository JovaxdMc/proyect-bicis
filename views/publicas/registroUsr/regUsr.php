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
        <link rel="stylesheet" href="/BicRobmvc/views/src/css/estiloRegUsr.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/fdcbc345f8.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg" style="background-color: #2b3035;" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/BicRobmvc/views/src/imgSis/logopag.png" alt="Bootstrap" width="50" height="45">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../catBicis/catBicis.php"
                                style="color: white">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../info/info.html" style="color: white">Información</a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
        </nav>

        <body class="bg-image">
            <div class="container">
                <div class="panel">
                    <h1>Registro de Usuarios</h1>
                    <form action="/BicRobmvc/controllers/usrsController.php?accion=insert" method="POST" id="formUsr"
                        enctype="multipart/form-data">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="required">
                        <br>
                        <label for="apellidos">Apellido Paterno:</label>
                        <input type="text" name="apellidoP" id="apellidoP" class="required">
                        <br>
                        <label for="apellidos">Apellido Materno:</label>
                        <input type="text" name="apellidoM" id="apellidoM" class="required">
                        <br>
                        <label for="Usern">Nombre de Usuario:</label>
                        <input type="text" name="Usern" id="Usern" class="required">
                        <br>
                        <label for="fotoUsr">Foto principal:</label>
                        <input type="file" name="fotoUsr" id="fotoPrin" accept="image/*"
                            onchange="previewImage(this);"><br>
                        <img id="imgPreview" style="display:none; width: 500px; height: 400px;"><br>
                        <button type="button" onclick="cancelImage();">Cancelar selección</button><br>
                        <br>
                        <label for="estado">Estado:</label>
                        <select name="estado" id="estado" class="required" onchange="cargarCiudades()">
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
                        <label for="ciudad">Ciudad:</label>
                        <select name="ciudad" id="ciudad" class="required">
                            <option value="">Seleccione una ciudad</option>
                        </select>
                        <br>
                        <label for="telefono">Número de Celular:</label>
                        <input type="tel" name="telefono" id="telefono" class="required">
                        <br>
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" name="email" id="email" class="required">
                        <br>
                        <label for="contraseña">Contraseña:</label>
                        <input type="password" name="pass1" id="contraseña" class="required">
                        <br>
                        <label for="confirmar_contraseña">Confirmar Contraseña:</label>
                        <input type="password" name="pass2" id="confirmar_contraseña" class="required">
                        <br>
                        <input type="submit" value="Registrarse" class="btn btn-success">
                    </form>
                    <div class="alert alert-danger" role="alert" id="alertaCamposObligatorios" style="display: none;">
                        Por favor complete todos los campos obligatorios. </div>
                </div>
            </div>
        </body>
        <script>
        var form = document.getElementById('formUsr');
        var submitButton = form.querySelector('[type="submit"]');
        submitButton.addEventListener('click', function(event) {
            var pass1 = document.getElementById('contraseña').value;
            var pass2 = document.getElementById('confirmar_contraseña').value;
            if (!validarFormulario()) {
              event.preventDefault();
            }
            if (pass1 !== pass2) {
                event.preventDefault();
                alert("Las contraseñas no coinciden, por favor, inténtelo de nuevo.");
                return;
            }
        });
        // Vista previa de la imagen principal
        function previewImage(input) {
            var archivo = input.files[0];
            var tipoArchivo = archivo.type;
            if (!tipoArchivo.startsWith('image/')) {
                Swal.fire({
                    title: '<h3 style="color:white;">ERROR</h3>',
                    text: 'Por favor seleccione un archivo de imagen valido',
                    icon: 'error',
                    background: '#000',
                    backdrop: true,
                    confirmButtonColor: '#068'
                });
                input.value = '';
                return false;
            }
            var preview = document.getElementById('imgPreview');
            var file = input.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
            }
            if (file) {
                reader.readAsDataURL(file);
                preview.style.display = "block";
            } else {
                preview.src = "";
                preview.style.display = "none";
            }
        }
        // Función para cancelar la selección de la imagen
        function cancelImage() {
            var preview = document.getElementById('imgPreview');
            var fileInput = document.getElementById('fotoPrin');
            preview.src = "";
            preview.style.display = "none";
            fileInput.value = "";
        }
        // Obtener los elementos select del estado y de la ciudad
        const estadoSelect = document.getElementById("estado");
        const ciudadSelect = document.getElementById("ciudad");
        // Definir un objeto con las ciudades disponibles para cada estado
        const ciudadesPorEstado = {
            "Aguascalientes": ["Aguascalientes", "Asientos", "Calvillo", "Jesús María", "Rincón de Romos",
                "San José de Gracia", "Tepezalá"
            ],
            "Baja California": ["Ensenada", "Mexicali", "Tijuana", "Tecate", "Rosarito", "Playas de Rosarito",
                "San Quintín", "San Felipe"
            ],
            "Baja California Sur": ["La Paz", "Los Cabos", "Loreto", "Comondú", "Mulegé", "Guerrero Negro",
                "Santa Rosalía", "Ciudad Constitución"
            ],
            "Campeche": ["Campeche", "Calkiní", "Ciudad del Carmen", "Champotón", "Hecelchakán", "Hopelchén",
                "Tenabo", "Escárcega"
            ],
            "Chiapas": ["Tuxtla Gutiérrez", "Tapachula", "San Cristóbal de las Casas", "Palenque", "Comitán",
                "Villaflores", "Huixtla", "Cintalapa"
            ],
            "Chihuahua": ["Chihuahua", "Ciudad Juárez", "Cuauhtémoc", "Delicias", "Hidalgo del Parral",
                "Nuevo Casas Grandes", "Camargo", "Meoqui"
            ],
            "Coahuila": ["Saltillo", "Torreón", "Monclova", "Piedras Negras", "Nueva Rosita", "San Pedro", "Acuña",
                "Frontera"
            ],
            "Colima": ["Colima", "Manzanillo", "Tecomán", "Villa de Álvarez", "Armería", "Minatitlán",
                "Ixtlahuacán", "Coquimatlán"
            ],
            "Durango": ["Durango", "Gómez Palacio", "Ciudad Lerdo", "Canatlán", "Peñón Blanco", "El Salto",
                "Vicente Guerrero", "El Oro"
            ],
            "Estado de México": ["Toluca", "Nezahualcóyotl", "Naucalpan de Juárez", "Ecatepec de Morelos",
                "Chimalhuacán", "Texcoco", "Tlalnepantla de Baz", "Cuautitlán Izcalli"
            ],
            "Guanajuato": ["León", "Irapuato", "Celaya", "Salamanca", "Silao", "Guanajuato",
                "San Miguel de Allende", "Dolores Hidalgo"
            ],
            "Guerrero": ["Acapulco de Juárez", "Chilpancingo de los Bravo", "Iguala de la Independencia",
                "Taxco de Alarcón", "Zihuatanejo de Azueta", "Chilapa de Álvarez", "Arcelia",
                "Tlapa de Comonfort"
            ],
            "Hidalgo": ["Pachuca de Soto", "Tula de Allende", "Tulancingo de Bravo", "Actopan",
                "Mineral de la Reforma", "Tepeji del Río", "Atotonilco el Grande", "Ixmiquilpan"
            ],
            "Michoacán": ["Morelia", "Uruapan", "Lázaro Cárdenas", "Zamora", "Apatzingán"],
            "Morelos": ["Cuernavaca", "Jiutepec", "Temixco", "Yautepec", "Oaxtepec"],
            "Nayarit": ["Tepic", "Bahía de Banderas", "Xalisco", "Tecuala", "Compostela"],
            "Nuevo León": ["Monterrey", "Guadalupe", "San Nicolás de los Garza", "Apodaca", "Santa Catarina"],
            "Oaxaca": ["Oaxaca de Juárez", "Salina Cruz", "Juchitán de Zaragoza", "Tuxtepec", "Huajuapan de León"],
            "Jalisco": ["Guadalajara", "Zapopan", "Tlaquepaque", "Tonalá", "Puerto Vallarta", "Lagos de Moreno",
                "Autlán de Navarro", "Ocotlán"
            ],
            "Morelos": ["Cuernavaca", "Jiutepec", "Temixco", "Yautepec", "Oaxtepec", "Puente de Ixtla",
                "Joquicingo", "Xochitepec"
            ],
            "Nayarit": ["Tepic", "Bahía de Banderas", "Xalisco", "Tecuala", "Compostela", "Ixtlán del Río",
                "Acaponeta", "Tecuala"
            ],
            "Nuevo León": ["Monterrey", "Guadalupe", "San Nicolás de los Garza", "Apodaca", "Santa Catarina",
                "San Pedro Garza García", "Linares", "García"
            ],
            "Oaxaca": ["Oaxaca de Juárez", "Salina Cruz", "Juchitán de Zaragoza", "Tuxtepec", "Huajuapan de León",
                "Puerto Escondido", "Miahuatlán de Porfirio Díaz", "San Pedro Pochutla"
            ],
            "Puebla": ["Puebla de Zaragoza", "Tehuacán", "San Martín Texmelucan de Labastida", "Atlixco",
                "Izúcar de Matamoros", "Teziutlán", "Cholula de Rivadabia", "Huauchinango"
            ],
            "Querétaro": ["Santiago de Querétaro", "San Juan del Río", "Corregidora", "El Marqués", "Tequisquiapan",
                "Amealco de Bonfil", "Cadereyta de Montes", "Ezequiel Montes"
            ],
            "Quintana Roo": ["Cancún", "Chetumal", "Playa del Carmen", "Cozumel", "Tulum", "Isla Mujeres",
                "Felipe Carrillo Puerto", "Bacalar"
            ],
            "San Luis Potosí": ["San Luis Potosí", "Ciudad Valles", "Matehuala", "Rioverde", "Tamazunchale",
                "Soledad de Graciano Sánchez", "Salinas de Hidalgo", "Cárdenas"
            ],
            "Sinaloa": ["Culiacán Rosales", "Mazatlán", "Los Mochis", "Guamúchil", "El Fuerte",
                "Escuinapa de Hidalgo", "Angostura", "Guasave"
            ],
            "Sonora": ["Hermosillo", "Ciudad Obregón", "Nogales", "San Luis Río Colorado", "Caborca", ],
            "Tabasco": ["Villahermosa", "Cárdenas", "Comalcalco", "Paraíso", "Tenosique"],
            "Tamaulipas": ["Ciudad Victoria", "Nuevo Laredo", "Reynosa", "Matamoros", "Tampico"],
            "Tlaxcala": ["Tlaxcala de Xicohténcatl", "Huamantla", "Chiautempan", "Apizaco", "Tlaxco"],
            "Veracruz": ["Xalapa", "Veracruz", "Coatzacoalcos", "Minatitlán", "Córdoba"],
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
        // función para verificar si hay campos obligatorios vacíos al enviar el formulario
        function validarFormulario() {
            var camposObligatorios = document.getElementsByClassName('required');
            var hayCamposVacios = false;
            for (var i = 0; i < camposObligatorios.length; i++) {
                if (camposObligatorios[i].value.trim() == '') {
                    hayCamposVacios = true;
                    break;
                }
            }
            if (hayCamposVacios) {
                document.getElementById('alertaCamposObligatorios').style.display = 'block';
                return false;
            } else {
                return true;
            }
        }
        </script>

</html>