cargarImgs();
function cargarImgs() {
  // Obtener el contenedor de imágenes
  const imageContainer = document.getElementById("contenedor-cards");

  // Obtener el ID del bicicletarío
  const id_bic = document.getElementById("id_bic").value;
  console.log(id_bic);

  // Crear una instancia de XMLHttpRequest
  const xhr = new XMLHttpRequest();

  // Configurar la solicitud
  xhr.open("POST", "/BicRobmvc/controllers/ImgBicController.php?accion=select", true);

  // Configurar la respuesta
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) {
      // Actualizar el contenido del contenedor
      imageContainer.innerHTML = xhr.response;
      
      //console.log("Contenido del contenedor cargado exitosamente.");
      //console.log("response: "+xhr.response);
    } else {
      console.error("Error al cargar el contenido del contenedor.");
    }
  };

  // Configurar el error
  xhr.onerror = function () {
    //console.error("Error al cargar el contenido del contenedor.");
  };

  // Configurar los datos de la solicitud
  const formData = new FormData();
  formData.append("id_bic", id_bic);
  formData.append("par", "id_bic");

  // Enviar la solicitud
  xhr.send(formData);

  //console.log("Solicitud de carga de imágenes enviada.");

  
}
function cargarBotones(){
    // Obtener todos los botones "Eliminar"
    var deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
      button.addEventListener('click', (event) => {
        event.preventDefault();
        //console.log("borrando");
        const id = button.dataset.id;
        if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
          fetch('/BicRobmvc/controllers/ImgBicController.php?accion=delete&id=' + id + '&param=id_img')
            .then(response => {
              if (!response.ok) {
                throw new Error('Error al eliminar la imagen');
              }
              button.parentNode.remove();
            })
            .catch(error => {
              console.error(error);
            });
        }
      });
    });
    
  
  
  // Obtener todos los botones "Editar"
  editBtns = document.querySelectorAll(".edit-btn");
  
  // Agregar un evento "click" a cada botón "Editar"
  editBtns.forEach(function(editBtn) {
    editBtn.addEventListener("click", function() {
        id_img=editBtn.dataset.id;
        var miModal = document.querySelector('#modalNImg[data-id="' + id_img + '"]');
    
        var modal = new bootstrap.Modal(miModal);
  
        modal.show();
        
        // Agregar un event listener al documento para cerrar el formulario si se hace clic en cualquier lugar de la página que no sea el formulario
        
    });
  });
}