
document.addEventListener("DOMContentLoaded", function() {
    var btnAddNs = document.getElementById("btnAddNs");
    if (btnAddNs !== null) {
    btnAddNs.addEventListener("click", (event)=>{
        var id_bic = document.getElementById("id_bic").value;
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

             // Crear una solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/BicRobmvc/controllers/biciController.php?accion=updtNs", true);
                
                // Configurar los encabezados de la solicitud
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                
                // Configurar la función de devolución de llamada para procesar la respuesta
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                    // Procesar la respuesta
                    //console.log(this.responseText);
                    Swal.fire({
                        title:'<h3 style="color:white;">Numero de serie registrado correctamente</h3>',
                        text: '',
                        icon: 'success',
                        background:'#000',
                        backdrop:true,
                        confirmButtonColor:'#068',
                        showConfirmButton: true// mostrar el botón de confirmación
                      }).then((result) => { // manejar el resultado del botón de confirmación
                        if (result.isConfirmed) { // si el botón de confirmación es aceptado
                          location.reload(); // recargar la página
                        }
                      });
                    }
                };
                
                // Crear la cadena de consulta para enviar los datos
                var data = "id_b=" + id_bic + "&ns=" + numSerie;;
                //console.log(data);
                
                // Enviar la solicitud
                xhr.send(data);
                

              
            }
          });
          
      
    });
}
      });