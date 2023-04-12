
console.log("Importado correctamente");
// Vista previa de la imagen principal
function previewImage(input) {
  var preview = document.getElementById('imgPreview');
  var file    = input.files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
    preview.style.display = "block";
  } else {
    preview.src = "";
    preview.style.display = "none";
  }
}

// Vista previa del archivo PDF del comprobante
function previewPDF(input) {
  var preview = document.getElementById('pdfPreview');
  var file    = input.files[0];
  var reader  = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  }

  if (file) {
    reader.readAsDataURL(file);
    preview.style.display = "block";
  } else {
    preview.src = "";
    preview.style.display = "none";
  }
}

// Función para cancelar la selección de la imagen
function cancelImage() {
  var preview = document.getElementById('imgPreview');
  var fileInput = document.getElementById('fotoPrin');
  preview.src = "";
  preview.style.display = "none";
  fileInput.value = "";
}

// Función para cancelar la selección del archivo PDF
function cancelPDF() {
  var preview = document.getElementById('pdfPreview');
  var fileInput = document.getElementById('comprobante');
  preview.src = "";
  preview.style.display = "none";
  fileInput.value = "";
}

var formNb = document.getElementById("nuevBic");
var miModal = document.getElementById('nuevBicMod');
var modal = new bootstrap.Modal(miModal);

document.getElementById('nuevBic').addEventListener('submit',function(e){
    e.preventDefault();

    //objeto FormData para recopilar los datos del formulario
    const formData = new FormData(this);

    // Cree una solicitud AJAX
    const xhr = new XMLHttpRequest();

    // Define la función de devolución de llamada para manejar la respuesta
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Actualiza la sección del DOM con la respuesta del servidor
        const seccionActualizable = document.getElementById('bicis');
        //seccionActualizable.innerHTML = xhr.responseText;
        modal.hide();
        formNb.reset();

        Swal.fire({
          title:'<h3 style="color:white;">Bicicleta registrada correctamente</h3>',
          text: '',
          icon: 'success',
          background:'#000',
          backdrop:true,
          confirmButtonColor:'#068'
        });

        cargarImgs();
        
      }
    };
    
    // Abre la solicitud AJAX
    xhr.open('POST', '/BicRobmvc/controllers/biciController.php?accion=insert');
    // Envíe la solicitud con los datos del formulario
    xhr.send(formData);
});

cargarImgs();
function cargarImgs() {
  // Obtener el contenedor de imágenes
  const imageContainer = document.getElementById("bicis-div");

  // Obtener el ID del bicicletarío
  const id_u = document.getElementById("id_u").value;
  console.log(id_u);

  // Crear una instancia de XMLHttpRequest
  const xhr = new XMLHttpRequest();

  // Configurar la solicitud
  xhr.open("POST", "/BicRobmvc/controllers/biciController.php?accion=select", true);

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
  formData.append("id", id_u);
  formData.append("param", "id_u");
  formData.append("extra", " ");

  // Enviar la solicitud
  xhr.send(formData);

  //console.log("Solicitud de carga de imágenes enviada.");
}
function marcarRecuperada(id){

  // Crear un objeto FormData y agregar los datos del formulario
  var formData = new FormData();
  formData.append("id", id);
  

  // Enviar los datos del formulario al servidor con fetch
  fetch("/BicRobmvc/controllers/reporteController.php?accion=finalizar", {
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
        title:'<h3 style="color:white;"> Reporte finalizado Correctamente</h3>',
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