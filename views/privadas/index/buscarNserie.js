// Obtener el formulario y el botón de búsqueda
var form = document.querySelector(".d-flex");
var btnBuscar = document.querySelector("#buscar");
var mod = document.getElementById("modalBusq");
var modalBody = document.querySelector("#modalBusq .modal-body");
var modal = new bootstrap.Modal(mod);
var btnCerr = document.getElementById("cerrar");

btnCerr.addEventListener("click", function(event){
  modal.hide();
});


form.addEventListener("submit", function(event) {
    event.preventDefault();
    var numSerie = document.querySelector("#input-num-serie").value;

    if (numSerie == "") {
        alert("Por favor, ingrese un número de serie válido");
        return;
    }

    var formData = new FormData();
    formData.append("id",numSerie);
    formData.append("param","num_serie");

    // Enviar los datos del formulario al servidor con fetch
    fetch("/BicRobmvc/controllers/biciController.php?accion=SelectRepJson", {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Error al enviar el formulario");
        }
        return response.json(); // Parsear la respuesta como un objeto JSON
      })
      .then(data => {  
        // Crear el HTML para mostrar los datos en el modal
        console.log(data);
        var json = JSON.parse(data);
        var html = `
          <h3>${json[0].marca}</h3>
          <img src="/BicRobmvc/views/src/imgBicis/${json[0].img_prin}" class="card-img-fixed-size" alt="${data[0].img_prin}">
          <p>Talla: ${json[0].talla}</p>
          <p>Rodada: ${json[0].rodada}</p>
          <p>Fecha del robo: ${json[0].fecha_robo}</p>
          <p>Lugar del robo: ${json[0].lugar}</p>
          <p>Hora del robo: ${json[0].hora}</p>
          <p>Comentarios:</p>
          <p>${json[0].comentarios}</p>
          <br>
          <a href="/BicRobmvc/views/privadas/infoBic/infoBic.php?id_b=${json[0].id_bic}" class="btn btn-success">Más información</a>
        `;
    
        // Agregar el HTML al contenido del modal
        modalBody.innerHTML = html;
    
        // Mostrar el modal
        modal.show();        
      })
      .catch(error => {
        console.error(error);
      });
    });    
