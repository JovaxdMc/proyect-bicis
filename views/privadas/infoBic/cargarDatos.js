var idB = document.getElementById("idB");
var num_serieP = document.getElementById("num_Serie");
var tallaP = document.getElementById("Talla");
var RodadaP = document.getElementById("Rodada");
var FechaRepP = document.getElementById("FechaRep");
var FechaRobP = document.getElementById("FechaRobo");
var tituloH1 = document.getElementById("titulo");
var lugarP = document.getElementById("lugarRobo");
var horaP = document.getElementById("hora");
var comentsP = document.getElementById("coments");

var mod = document.getElementById("nuevComent");
var modal = new bootstrap.Modal(mod);


var imgPrinEt = document.getElementById("img");

var propieP = document.getElementById("propieP");
var estadoP = document.getElementById("estado");

id_usrNotif = document.getElementById("id_usrNotif");

function datosBici(){
    var formData = new FormData();
    formData.append("id",idB.value);
    formData.append("param","bicis.id_bic");

    // Enviar los datos del formulario al servidor con fetch
    fetch("/BicRobmvc/controllers/biciController.php?accion=SelectRepJson", {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Error al enviar el formulario");
        }
        return response.json(); // Parsear la respuesta como un objeto JSON
      })
      .then(data => {  
        
        //console.log(data);
        var json = JSON.parse(data);
        var id_bic = json[0].id_bic;
        var img_prin = json[0].img_prin;
        var num_serie = json[0].num_serie;
        var marca = json[0].marca;
        var modelo = json[0].modelo;
        var talla = json[0].talla;
        var year = json[0].year;
        var rodada = json[0].rodada;
        var estatus = json[0].estatus;
        var comprobante = json[0].comprobante;
        var id_reporte = json[0].id_reporte;
        var fecha_reporte = json[0].fecha_reporte;
        var fecha_robo = json[0].fecha_robo;
        var lugar = json[0].Estado +" "+ json[0].Municipio;
        var hora = json[0].hora;
        var comentarios = json[0].comentarios;
        var estado_rep = json[0].estado_rep;

        tituloH1.textContent += marca+" "+modelo+" "+year;
        num_serieP.textContent += num_serie;
        tallaP.textContent += talla;
        RodadaP.textContent += rodada;
        FechaRepP.textContent += fecha_reporte;
        FechaRobP.textContent += fecha_robo;
        lugarP.textContent += lugar;
        horaP.textContent += hora;
        comentsP.textContent += comentarios;
        
        
        imgPrinEt.src = "/BicRobmvc/views/src/imgBicis/"+img_prin;
          
      })
      .catch(error => {
        console.error(error);
      });
}

function datosUsr(){
    var formData = new FormData();
    formData.append("id_b",idB.value);

    // Enviar los datos del formulario al servidor con fetch
    fetch("/BicRobmvc/controllers/biciController.php?accion=SelectRepUsrJson", {
      method: "POST",
      body: formData
    })
      .then(response => {
        if (!response.ok) {
          throw new Error("Error al enviar el formulario");
        }
        return response.json(); // Parsear la respuesta como un objeto JSON
      })
      .then(data => {  
        // Crear el HTML para mostrar los datos en el modal
        //console.log(data);
        var json = JSON.parse(data);

        var id_usr = json[0].id;
        var nombre = json[0].nombre;
        var apellidoP = json[0].apellido_p;
        var apellidoM = json[0].apellido_m;
        var estado = json[0].estado;
        
        
        id_usrNotif.value = id_usr;
        propieP.textContent += nombre+" "+apellidoP+" "+apellidoM;
        estadoP.textContent = estado
    
          
      })
      .catch(error => {
        console.error(error);
      });
}


const imageForm = document.getElementById('image-form');
const imageInput = document.getElementById('evicencias-input');
const imagePreview = document.getElementById('image-preview');

imageInput.addEventListener('change', () => {
  Array.from(imageInput.files).forEach(file => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => {
      const imageItem = document.createElement('div');
      imageItem.classList.add('image-item');
      const image = document.createElement('img');
      image.src = reader.result;
      imageItem.appendChild(image);
      const cancelBtn = document.createElement('div');
      cancelBtn.classList.add('cancel-btn');
      cancelBtn.innerHTML = 'X';
      cancelBtn.addEventListener('click', () => {
        imageItem.remove();
      });
      imageItem.appendChild(cancelBtn);
      imagePreview.appendChild(imageItem);
    };
  });
});

id_usrReport = document.getElementById("id_usrReport");



formNotif = document.getElementById("nuevNotif");

formNotif.addEventListener("submit", (event) => {
    event.preventDefault();
    const id_usrRep = document.getElementById("id_usrReport").value;
    const id_usrNotif = document.getElementById("id_usrNotif").value;
    const contenido = document.getElementById("contenidoNotf").value;
    const evidencias = document.getElementById('evicencias-input');
    
    const formData = new FormData();

    formData.append("id_usrR", id_usrRep);
    formData.append("id_usrNotif", id_usrNotif);
    formData.append("id_bic", idB.value);
    formData.append("contenido", contenido);
    
    const files = evidencias.files;
    for (let i = 0; i < files.length; i++) {
      formData.append('evidencias[]', files[i]);
    }
    
  
    fetch("/BicRobmvc/controllers/notifController.php?accion=insert", {
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
          title:'<h3 style="color:white;">Comentarios enviados correctamente</h3>',
          text: '',
          icon: 'success',
          background:'#000',
          backdrop:true,
          confirmButtonColor:'#068'
        });
        modal.hide();
        formNotif.reset()
        evidencias.value = null;
        imagePreview.innerHTML="";
        //location.reload(); // Agregado
      })
      .catch(error => {
        console.error(error);
      });
  });
  


window.onload = datosBici();
window.onload = datosUsr();