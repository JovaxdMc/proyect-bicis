cargarBotones();

const imageMod = document.getElementById("cardImage");
const previewImageCard = document.getElementById("cardImagePreview");

imageMod.addEventListener("change", () => {
  const file = imageMod.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (event) => {
      previewImageCard.src = event.target.result;
      previewImageCard.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});



const cancelButton = document.querySelector('.cancel-btn');
const editForm = document.querySelector('#editForm');

cancelButton.addEventListener('click', () => {
  editForm.reset();
});


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
      cargarBotones();
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
  cargarEditForm();
  // Obtener todos los botones "Eliminar"
  var deleteButtons = document.querySelectorAll('.delete-btn');
  deleteButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      event.preventDefault();
      //console.log("borrando");
      const id = button.dataset.id;


      Swal.fire({
        title: 'Importante',
        text: "Estas seguro de borrar la foto",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        background:'#000',
        confirmButtonText: 'Si, borrala!',
        cancelButtonText:'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch('/BicRobmvc/controllers/ImgBicController.php?accion=delete&id=' + id + '&param=id_img')
          .then(response => {
            if (!response.ok) {
              throw new Error('Error al eliminar la imagen');
            }
            //button.parentNode.remove();
            Swal.fire({
              title:'<h3 style="color:white;"> Imagen eliminada correctamente</h3>',
              text: '',
              icon: 'success',
              background:'#000',
              backdrop:true,
              confirmButtonColor:'#068'
              
            });
            cargarImgs();
          })
          .catch(error => {
            console.error(error);
          });
        }
      })
    });
  });
  
}
function cargarEditForm(){
  // Seleccionar el modal y los campos del formulario
const Modal = document.getElementById("editModal");
const editModal = new bootstrap.Modal(Modal);
const cardIdInput = document.getElementById("cardId");
const cardTitleInput = document.getElementById("cardTitle");
const cardImageInput = document.getElementById("cardImage");
const cardImageAct = document.getElementById("imgAct");
const cardImagePreview = document.getElementById("cardImagePreview");
const cardDescriptionInput = document.getElementById("cardDescription");

// Seleccionar todos los botones de editar
var editButtons = document.querySelectorAll(".edit-btn");
// Agregar un evento de clic a cada botón de editar
editButtons.forEach((editButton) => {

  editButton.addEventListener("click", () => {
    // Obtener el ID de la tarjeta seleccionada
    const cardId = editButton.getAttribute("data-id");
    //console.log("Editando");

    // Obtener la información de la tarjeta seleccionada
    const cardInfoElement = document.querySelector('.img-container[data-id="' + cardId + '"] .card-info');
    const cardTitle = cardInfoElement.querySelector('.card-title').textContent;
    const cardDescription = cardInfoElement.querySelector('.card-description').textContent;
    const cardImage = cardInfoElement.querySelector('.card-image').textContent;

    // Cargar la información de la tarjeta en el formulario del modal
    cardIdInput.value = cardId;
    cardTitleInput.value = cardTitle;
    cardDescriptionInput.value = cardDescription;
    cardImagePreview.src = '/BicRobmvc/views/src/imgBicis/' + cardImage;
    cardImageAct.value = cardImage;

    // Mostrar el modal
    editModal.show();
  });


});

  const editSubmitButton = document.getElementById("editSubmit");
  editSubmitButton.addEventListener("click", function (event) {
    // Prevenir que se recargue la página
    event.preventDefault();
   

    // Obtener el formulario del botón de submit
    const editForm = editSubmitButton.closest("form");

    // Obtener los datos del formulario
    var idImg = editForm.querySelector('input[id="cardId"]').value;
    var titulo = editForm.querySelector('input[id="cardTitle"]').value;
    var descripcion = editForm.querySelector('textarea[id="cardDescription"]').value;
    var arch = editForm.querySelector('input[id="cardImage"]').files[0];
    var archAct = editForm.querySelector('input[id="imgAct"]').value;

    var panelImg = document.getElementById("image-container");

    // Crear un objeto FormData y agregar los datos del formulario
    var formData = new FormData();
    formData.append("id_img", idImg);
    formData.append("titulo", titulo);
    formData.append("descripcion", descripcion);
    formData.append("arch", arch);
    formData.append("archAct", archAct);

    // Enviar los datos del formulario al servidor con fetch
    fetch("/BicRobmvc/controllers/ImgBicController.php?accion=update", {
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
        //const imageContainer = document.getElementById("image-container");
        //imageContainer.innerHTML = data;
        //const editModal = new bootstrap.Modal(document.getElementById("editModal"));
        Swal.fire({
          title:'<h3 style="color:white;"> Imagen actualizada correctamente</h3>',
          text: '',
          icon: 'success',
          background:'#000',
          backdrop:true,
          confirmButtonColor:'#068'
        });
        cargarImgs();
        editModal.hide();

      })
      .catch(error => {
        console.error(error);
      });
  });


}