const badge = document.querySelector('.badge');
// Obtener el elemento de la sección de notificaciones
const notifSection = document.querySelector(".dropdown-menu-end");

// Obtener el número de elementos en la sección de notificaciones
const notifCount = notifSection.children.length;

// Obtener el elemento del recuadro de la barra de navegación
const notifBadge = document.querySelector(".navbar .badge");

// Actualizar el contenido del recuadro con el número de elementos
notifBadge.textContent = notifCount.toString();

// Función para actualizar las notificaciones
function updateNotifications() {
    // Realizar una solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/api/getNotifications", true);
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
                    listItem.innerHTML = '<a class="dropdown-item" href="#">' + notification.message + '</a>';
                    list.appendChild(listItem);
                }
                var countBadge = document.getElementById("notification-count");
                countBadge.innerText = count.toString();
            }
        }
    };
    xhr.send();
}

// Actualizar las notificaciones cada 30 segundos
setInterval(updateNotifications, 30000);

// Actualizar las notificaciones al cargar la página
updateNotifications();
