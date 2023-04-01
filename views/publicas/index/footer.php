
</body>
<script>
    // Obtener el formulario y el botón de búsqueda
      var form = document.querySelector(".d-flex");
      var btnBuscar = document.querySelector("#buscar");
      
      var formLog = document.getElementById("loginForm");

    

      // Escuchar el evento de envío del formulario
      form.addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener el valor del campo de número de serie
        var numSerie = document.querySelector("#input-num-serie").value;

        if (numSerie == "") {
          alert("Por favor, ingrese un número de serie válido");
          return;
        }

        // Crear una solicitud HTTP
        var xhr = new XMLHttpRequest();

        // Definir qué hacer en la respuesta de la solicitud
        xhr.onreadystatechange = function() {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              // Mostrar la respuesta en la página sin recargarla
              document.querySelector("#resultado-busqueda").innerHTML = xhr.responseText;
              var miModal = document.querySelector('#modalBusq');
              var modal = new bootstrap.Modal(miModal);
              modal.show();

              // Función para cerrar el modal al hacer clic en el botón "Cerrar"
              document.querySelector('#modalBusq .modal-footer button').addEventListener('click', function() {
                modal.hide()
              });

              // Función para cerrar el modal al hacer clic en el botón "X" en la esquina superior derecha
              document.querySelector('#modalBusq .modal-header button').addEventListener('click', function() {
                 modal.hide()
              });

            } else {
              alert("Hubo un error al realizar la búsqueda");
            }
          }
        }

        // Abrir la solicitud con el método GET y la URL del archivo PHP
        xhr.open("GET", "buscar_bicicleta.php?num_serie=" + numSerie, true);

        // Enviar la solicitud
        xhr.send();
      });

</script>
</html>