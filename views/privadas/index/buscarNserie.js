// Obtener el formulario y el botón de búsqueda
var form = document.querySelector(".d-flex");
var btnBuscar = document.querySelector("#buscar");

form.addEventListener("submit", function(event) {
    event.preventDefault();
    var numSerie = document.querySelector("#input-num-serie").value;

    if (numSerie == "") {
        alert("Por favor, ingrese un número de serie válido");
        return;
    }

    var formData = new FormData();
    formData.append("numSerie", numSerie);

    // Enviar los datos del formulario al servidor con fetch
    fetch("/BicRobmvc/controllers/biciController.php?accion=SelectJson", {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Error al enviar el formulario");
        }
        return response.text();

      })
      .then(data => {
        console.log("dat" + data);

        Swal.fire({
          title:'<h3 style="color:white;"> Imagen actualizada correctamente</h3>',
          text: '',
          icon: 'success',
          background:'#000',
          backdrop:true,
          confirmButtonColor:'#068'
        });

      })
      .catch(error => {
        console.error(error);
      });
});
