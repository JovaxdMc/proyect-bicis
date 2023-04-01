var btnEditFotoUsr = document.getElementById("btnEditarFoto");
var btnGuardFotoUsr = document.getElementById("btnGuardFoto");
var imgPerf = document.getElementById('imgPerf');
var idu = document.getElementById('id_u');
id="imgPerf"
var archivoSeleccionado;

btnEditFotoUsr.addEventListener("click",function (event){
    var input = document.createElement('input');
    input.type = 'file';
    input.onchange = function(e) {
      var file = e.target.files[0];
      if (file.type.indexOf('image/') === 0) { // Verifica si el archivo seleccionado es de tipo de imagen
        var lector = new FileReader();
        lector.onload = function(e) {
            archivoSeleccionado = file;
            imgPerf.src = e.target.result;
            btnGuardFotoUsr.style.display = 'block';
        }
        lector.readAsDataURL(file);
      } else {
        alert('Por favor, seleccione un archivo de imagen válido.'); // Muestra un mensaje de error si el archivo seleccionado no es de tipo de imagen
      }
    }
    input.click();
});

btnGuardFotoUsr.addEventListener("click",function(event){
  event.preventDefault();

  const formData = new FormData();
  formData.append("id_u", idu.value);
  formData.append("imgN", archivoSeleccionado);

  fetch("/BicRobmvc/controllers/usrsController.php?accion=updtImgPerf", {
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
        Swal.fire({
          title:'<h3 style="color:white;"> Imagen actualizada correctamente</h3>',
          text: '',
          icon: 'success',
          background:'#000',
          backdrop:true,
          confirmButtonColor:'#068'
        });
        btnGuardFotoUsr.style.display = 'none';
      
      })
      .catch(error => {
        console.error(error);
        Swal.fire({
          title:'<h3 style="color:white;"> Error al actualizar foto de perfil</h3>',
          text: '',
          icon: 'error',
          background:'#000',
          backdrop:true,
          confirmButtonColor:'#068'
        });
      });
});


