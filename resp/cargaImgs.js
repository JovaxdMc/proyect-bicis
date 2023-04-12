console.log("Aca andamos");

const imageInput = document.getElementById("image");
const previewImage = document.getElementById("preview");

imageInput.addEventListener("change", () => {
  const file = imageInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (event) => {
      previewImage.src = event.target.result;
      previewImage.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

  function cancelImage() {
    var preview = document.getElementById('preview');
    var fileInput = document.getElementById('image');
    preview.src = "";
    preview.style.display = "none";
    fileInput.value = "";
  }

  const formContainer = document.getElementById("formAddImg");
  var miModal = document.getElementById('modalNbic');
  var modal = new bootstrap.Modal(miModal);

  formContainer.addEventListener("submit", (event) => {
    event.preventDefault();
    const id_bic = document.getElementById("id_bic").value;
    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const image = document.getElementById("image").files[0];

    const formData = new FormData();
    formData.append("id_bic", id_bic);
    formData.append("title", title);
    formData.append("description", description);
    formData.append("image", image);

    fetch("/BicRobmvc/controllers/ImgBicController.php?accion=insert", {
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
          console.log(data);
          previewImage.src = "#";
          previewImage.style.display = "none";
          modal.hide();
          event.target.reset();
          location.reload(); // Agregado
      })
      .catch(error => {
          console.error(error);
      });
  });

// Obtener todos los botones "Eliminar"
const deleteButtons = document.querySelectorAll('.delete-btn');
deleteButtons.forEach(button => {
  button.addEventListener('click', (event) => {
    event.preventDefault();
    const id = button.dataset.id;
    if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
      fetch('/BicRobmvc/controllers/ImgBicController.php?accion=delete&id='+id+'&param=id_img')
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
  
     var var modal = new bootstrap.Modal(miModal);

      modal.show();
      
      // Agregar un event listener al documento para cerrar el formulario si se hace clic en cualquier lugar de la página que no sea el formulario
      
  });
});



// Obtener todos los formularios de edición
var editForms = document.querySelectorAll(".edit-form");
// Agregar un evento "submit" a cada formulario
editForms.forEach(function(editForm) {
  editForm.addEventListener("submit", function(event) {
      // Prevenir que se recargue la página
      event.preventDefault();
      
      // Obtener los datos del formulario
      var idImg = this.querySelector('input[name="id_img"]').value;
      var titulo = this.querySelector('input[name="titulo"]').value;
      var descripcion = this.querySelector('textarea[name="descripcion"]').value;
      var arch = this.querySelector('input[name="imgEdit"]').files[0];
      var archAct = this.querySelector('input[name="imgAct"]').value;

      // Crear un objeto FormData y agregar los datos del formulario
      var formData = new FormData();
      formData.append("id_img", idImg);
      formData.append("titulo", titulo);
      formData.append("descripcion", descripcion);
      formData.append("arch", arch);
      formData.append("archAct", archAct);
      

      // Enviar los datos del formulario al servidor con AJAX
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              // Obtener el nuevo contenido del elemento <div class="container cards">
              var newContent = this.responseText;
              // Actualizar el contenido del elemento <div class="container cards">
              document.querySelector('.container.cards').innerHTML = newContent;
          }
      };
      xhttp.open("POST", "/BicRobmvc/controllers/ImgBicController.php?accion=update", true);
      xhttp.send(formData);
  });
});



const imgImputs = document.querySelectorAll(".imgEdit");
imgImputs.forEach(function(imgImp) {
  imgImp.addEventListener("change", function() {
    const file = imgImp.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (event) => {
        const previewImg = imgImp.parentNode.querySelector("#imgprevE");
        previewImg.src = ""; 
        previewImg.src = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
});

