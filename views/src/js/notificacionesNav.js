var idu = document.getElementById("id_usr_nav").value;

function actualizarNum(){
    const badge = document.querySelector('.badge');
    // Obtener el elemento de la sección de notificaciones
    const notifSection = document.querySelector(".dropdown-menu-end");

    // Obtener el número de elementos en la sección de notificaciones
    const notifCount = notifSection.children.length;

    // Obtener el elemento del recuadro de la barra de navegación
    const notifBadge = document.querySelector(".navbar .badge");

    // Actualizar el contenido del recuadro con el número de elementos
    notifBadge.textContent = notifCount.toString();
}

// Función para actualizar las notificaciones
function updateNotifications() {
    // Realizar una solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/BicRobmvc/controllers/notifController.php?accion=select&idUsr_R="+idu, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                 // Actualizar la sección de notificaciones con los nuevos datos
                 var notifications = JSON.parse(xhr.responseText);
                 var count = notifications.length;
                 var list = document.getElementById("notification-list");
                 list.innerHTML = "";
                 for (var i = 0; i < count; i++) {
                     var notification = notifications[i];
                     var listItem = document.createElement("li");
                     id = notification["id_notif"];
                     cont = notification["contenido"];
                     fecha = notification["fecha"];
                     hora = notification["hora"];
                     marca = notification["marca"];
                     modelo = notification["modelo"];
                     anio = notification["year"];

                     listItem.innerHTML = '<div class="panel" style="background-color: #424547; margin: 2px; border: 2px dashed #898f93; color: black;">'
                        + '<div class="dropdown-item" onclick="cargarInfo(\''+id+'\')" style="background-color: #ffffff; opacity: 0.9; transition: opacity 0.3s;">'
                        + 'Fecha: ' + fecha + ' Hora: ' + hora
                        + '<br>Nueva notificación para la bicicleta:'
                        + '<br>' + marca + ' ' + modelo + ' ' + anio
                        + '</div></div>';

                     list.appendChild(listItem);
                     actualizarNum();
                 }
                 var countBadge = document.getElementById("notification-count");
                 countBadge.innerText = count.toString();
            }
        }
    };
    xhr.send();
}

// Actualizar las notificaciones cada 30 segundos
//setInterval(updateNotifications, 5000);

// Actualizar las notificaciones al cargar la página
updateNotifications();
