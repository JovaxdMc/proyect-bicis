document.addEventListener("DOMContentLoaded", function (event) {

    cargarTabla();
    var modalH = new bootstrap.Modal(document.getElementById('editarModal'));
    // Asignar el evento submit al formulario
    
});

cancelBusq = document.getElementById("cancelBusq");
cancelBusq = document.getElementById("cancelBusq");

cancelBusq.addEventListener("click", () => {
    busq.value = "";
    cargarTabla();
});



function cargarTabla() {
    busq = document.getElementById("busq-usr").value;
    if (busq == "") {
        param = "";
    } else {
        param = " AND usuario='" + busq + "'";
    }
    // Realizar una solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/BicRobmvc/controllers/usrsController.php?accion=selectA", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var resp = xhr.responseText;
                if (resp == "error") {
                    Swal.fire({
                        title: '<h3 style="color:white;"> No se encontro el usuario: ' + busq + '</h3>',
                        text: '',
                        icon: 'error',
                        background: '#000',
                        backdrop: true,
                        confirmButtonColor: '#068'

                    });
                } else {
                    var tabla = document.getElementById("tablaUsrs");
                    var tbody = tabla.getElementsByTagName("tbody")[0];
                    tbody.innerHTML = resp;
                }

            }
        }
    };
    var extra = "extra=" + param;
    xhr.send(extra);

}

function Editar(id) {
    var modalH = new bootstrap.Modal(document.getElementById('editarModal'));
    modalH.show();
    console.log("Editar: " + id);
    // Obtener la fila correspondiente al ID
    var fila = document.querySelector('td[data-id="' + id + '"]').parentNode;

    // Obtener los valores de las columnas
    var nombre = fila.querySelector('td[data-nombre]').dataset.nombre;
    var apellidoPaterno = fila.querySelector('td[data-apellidoPaterno]').dataset.apellidopaterno;
    var apellidoMaterno = fila.querySelector('td[data-apellidoMaterno]').dataset.apellidomaterno;
    var estado = fila.querySelector('td[data-estado]').dataset.estado;
    var municipio = fila.querySelector('td[data-municipio]').dataset.municipio;
    var correoElectronico = fila.querySelector('td[data-correoElectronico]').dataset.correoelectronico;
    var telefono = fila.querySelector('td[data-telefono]').dataset.telefono;
    var nombreUsuario = fila.querySelector('td[data-nombreusuario]').dataset.nombreusuario;

    // Llenar los campos del formulario en el modal
    document.getElementById("nombrem").value = nombre;
    document.getElementById("apellidoPaternom").value = apellidoPaterno;
    document.getElementById("apellidoMaternom").value = apellidoMaterno;
    document.getElementById("estadom").value = estado;
    document.getElementById("municipiom").value = municipio;
    document.getElementById("correoElectronicom").value = correoElectronico;
    document.getElementById("telefonom").value = telefono;
    document.getElementById("nombreUsuariom").value = nombreUsuario;

    // Mostrar el modal

}

// Obtener el formulario
var formEditarUsrs = document.getElementById('formEditarUsrs');

// Función para enviar el formulario a través de una petición fetch
function actualizarUsuario(event) {
  event.preventDefault();

  // Obtener los datos del formulario y construir el objeto FormData
  var formData = new FormData(formEditarUsrs);

  // Realizar la petición fetch con los datos del formulario
  fetch('/actualizar_usuario.php', {
    method: 'POST',
    body: formData
  })
  .then(function(response) {
    return response.text();
  })
  .then(function(texto) {
    console.log(texto);
    $('#modalEditar').modal('hide');
  })
  .catch(function(error) {
    console.error(error);
  });
}

// Asignar el evento submit al formulario
formEditarUsrs.addEventListener('submit', actualizarUsuario);

function Eliminar(id) {
    console.log("Eliminar: " + id);
}

var formulario = document.getElementById("formRegUsrs");
var botonEnviar = document.getElementById("registrar");

formRegUsrs.addEventListener("submit", (event) => {
    event.preventDefault();

    var nombre = document.getElementById("nombre").value;
    var apellidoPaterno = document.getElementById("apellidoPaterno").value;
    var apellidoMaterno = document.getElementById("apellidoMaterno").value;
    var estado = document.getElementById("estado").value;
    var municipio = document.getElementById("municipio").value;
    var telefono = document.getElementById("telefono").value;
    var correoElectronico = document.getElementById("correoElectronico").value;
    var nombreUsuario = document.getElementById("nombreUsuario").value;
    var tipoUsuario = document.getElementById("tipoUsuario").value;
    var contraseña = document.getElementById("contraseña").value;
    var confirmarContraseña = document.getElementById("confirmarContraseña").value;

    // Verificar que las contraseñas coincidan
    if (contraseña !== confirmarContraseña) {
        alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo.");
        return;
    }

    var datos = new FormData();
    datos.append("nombre", nombre);
    datos.append("apellidoPaterno", apellidoPaterno);
    datos.append("apellidoMaterno", apellidoMaterno);
    datos.append("estado", estado);
    datos.append("municipio", municipio);
    datos.append("telefono", telefono);
    datos.append("correoElectronico", correoElectronico);
    datos.append("nombreUsuario", nombreUsuario);
    datos.append("tipoUsuario", tipoUsuario);
    datos.append("pass1", contraseña);

    fetch('/BicRobmvc/controllers/usrsController.php?accion=registro', {
        method: 'POST',
        body: datos
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al enviar el formulario");
            }
            return response.text();
        })
        .then(data => {
            if (data.error) {
                Swal.fire({
                    title: '<h3 style="color:white;">Error al registrar al usuario</h3>',
                    text: '',
                    icon: 'error',
                    background: '#000',
                    backdrop: true,
                    confirmButtonColor: '#068'
                });
            } else {
                Swal.fire({
                    title: '<h3 style="color:white;">Usuario registrado con exito</h3>',
                    text: '',
                    icon: 'success',
                    background: '#000',
                    backdrop: true,
                    confirmButtonColor: '#068'
                });
                cargarTabla();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});





