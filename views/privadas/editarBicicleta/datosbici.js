
document.addEventListener("DOMContentLoaded", function() {
    var btnAddNs = document.getElementById("btnAddNs");

    btnAddNs.addEventListener("click", (event)=>{

        Swal.fire({
            title: '<h3 style="color:white;">Introduce el número de serie</h3>',
            html: '<p style="color:white;">Asegurate de que sea correcto, ya que por razones de seguridad no se podra cambiar posteriormente a menos que contactes un adminnistrador.</p>', // agregar subtítulo
  input: 'text',
            input: 'text', // tipo de entrada de texto
            inputAttributes: {
              style: 'max-width: 87%;' // establecer ancho máximo
            },
            background: '#000',
            backdrop: true,
            confirmButtonColor: '#068',
            showCancelButton: true, // mostrar el botón de cancelar
            cancelButtonText: 'Cancelar', // etiqueta del botón de cancelar
            confirmButtonText: 'Aceptar', // etiqueta del botón de confirmación
            inputValidator: (value) => { // validar el valor introducido en el campo de entrada
              if (!value) { // si el campo de entrada está vacío
                return 'Debes introducir un número de serie'; // mostrar un mensaje de error
              }
              // aquí puedes agregar tu propia validación del número de serie
            }
          }).then((result) => { // manejar el resultado del botón de confirmación
            if (result.isConfirmed) { // si el botón de confirmación es aceptado
              const numSerie = result.value; // obtener el valor del campo de entrada
              
              var xhr = new XMLHttpRequest();
                 xhr.open("GET", "/BicRobmvc/controllers/filtroController.php?accion=llenarEstados", true);
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                    // Almacenar el resultado generado en una variable JavaScript
                    var opciones = this.responseText;
                    //console.log(opciones);
                    // Agregar el resultado al select utilizando innerHTML
                    selectMarca.innerHTML = opciones;
                    }
                };
                xhr.send();
                

              
            }
          });
          
      
    });
      });