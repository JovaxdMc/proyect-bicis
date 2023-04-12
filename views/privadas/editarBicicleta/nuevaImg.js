
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

      Swal.fire({
        title:'<h3 style="color:white;"> Imagen Agregada correctamente</h3>',
        text: '',
        icon: 'success',
        background:'#000',
        backdrop:true,
        confirmButtonColor:'#068'
      });

      cargarImgs();
      cargarBotones();
      //location.reload(); // Agregado
    })
    .catch(error => {
      console.error(error);
    });
});
