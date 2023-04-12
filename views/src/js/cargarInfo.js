window.addEventListener('load', function() {
    
  });
  

function cargarInfo(id_notif) {
   
    console.log("cargando");
    cargarTexto(id_notif);
    var modalH = new bootstrap.Modal(document.getElementById('modalInfoNotf'));
    var modalBody = document.querySelector('#modalInfoNotf .modal-body');
    var imgsDiv = document.querySelector('#modalInfoNotf .imgs');
    // Realizar una solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/BicRobmvc/controllers/notifController.php?accion=selectImgs&id_notif=" + id_notif, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var imgUrls = JSON.parse(xhr.responseText);
                // Limpiar div "imgsDiv"
                while (imgsDiv.firstChild) {
                    imgsDiv.removeChild(imgsDiv.firstChild);
                }
                // Agregar las imágenes al div "imgsDiv"
                for (var i = 0; i < imgUrls.length; i++) {
                    var img = document.createElement('img');
                    img.src = "/BicRobmvc/views/src/imgNotif/" + imgUrls[i]["archivo"];
                    img.style.maxWidth = "40%";
                    img.style.margin = "1%";
                    imgsDiv.appendChild(img);
                }
            }
        }
    };
    xhr.send();
    modalH.show();

}

function cargarTexto(id_notif) {


    // Realizar una solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/BicRobmvc/controllers/notifController.php?accion=selectO&id_notif=" + id_notif, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Obtener la respuesta JSON y mostrar los datos en el modal
                var resp = JSON.parse(xhr.responseText);
                console.log(resp);
                var fecha = document.getElementById("fechaN");
                var hora = document.getElementById("horaN");
                var cont = document.getElementById("contN");
                var bici = document.getElementById("biciN");


                fecha.textContent = resp[0]["fecha"];
                hora.textContent = resp[0]["hora"];
                cont.textContent = resp[0]["contenido"];
                bici.textContent = resp[0]["marca"] +" "+ resp[0]["modelo"]+" "+resp[0]["year"];
                


            }
        }
    };
    xhr.send();
}

//function cargarImgs(id_notif) {
    var modalH = new bootstrap.Modal(document.getElementById('modalInfoNotf'));
    var modalBody = document.querySelector('#modalInfoNotf .modal-body');
    var imgsDiv = document.querySelector('#modalInfoNotf .imgs');
    // Realizar una solicitud AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/BicRobmvc/controllers/notifController.php?accion=selectImgs&id_notif=" + id_notif, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var imgUrls = JSON.parse(xhr.responseText);
                // Limpiar div "imgsDiv"
                while (imgsDiv.firstChild) {
                    imgsDiv.removeChild(imgsDiv.firstChild);
                }
                // Agregar las imágenes al div "imgsDiv"
                for (var i = 0; i < imgUrls.length; i++) {
                    var img = document.createElement('img');
                    img.src = "/BicRobmvc/views/src/imgNotif/" + imgUrls[i]["archivo"];
                    img.style.maxWidth = "100%";
                    img.style.border = "1px solid red";
                    imgsDiv.appendChild(img);
                }
            }
        }
    };
    xhr.send();
//}