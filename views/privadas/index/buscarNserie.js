    // Esperar a que la página se cargue completamente
    window.onload = function() {
      llenarMarcas();
      llenarEstados();
      llenarMunicipios();
    };


    function llenarMarcas(){
      // Obtener el elemento select
      var selectMarca = document.getElementById("Marca");
    
      // Llamar a la función PHP que genera las opciones del select
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "/BicRobmvc/controllers/filtroController.php?accion=llenarMarca", true);
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          // Almacenar el resultado generado en una variable JavaScript
          var opciones = this.responseText;
          console.log(opciones);
          // Agregar el resultado al select utilizando innerHTML
          selectMarca.innerHTML = opciones;
        }
      };
      xhr.send();
    }
    function llenarEstados(){
      // Obtener el elemento select
      var selectMarca = document.getElementById("Estado");
      // Llamar a la función PHP que genera las opciones del select
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "/BicRobmvc/controllers/filtroController.php?accion=llenarEstados", true);
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          // Almacenar el resultado generado en una variable JavaScript
          var opciones = this.responseText;
          console.log(opciones);
          // Agregar el resultado al select utilizando innerHTML
          selectMarca.innerHTML = opciones;
        }
      };
      xhr.send();
    }
    function llenarMunicipios(){
      // Obtener el elemento select
      var selectMarca = document.getElementById("Municipio");
    
      // Llamar a la función PHP que genera las opciones del select
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "/BicRobmvc/controllers/filtroController.php?accion=llenarMunicipios", true);
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          // Almacenar el resultado generado en una variable JavaScript
          var opciones = this.responseText;
          console.log(opciones);
          // Agregar el resultado al select utilizando innerHTML
          selectMarca.innerHTML = opciones;
        }
      };
      xhr.send();
    }
// Obtener el formulario y el botón de búsqueda
var form = document.querySelector(".d-flex");
var btnBuscar = document.querySelector("#buscar");
var mod = document.getElementById("modalBusq");
var modalBody = document.querySelector("#modalBusq .modal-body");
var modal = new bootstrap.Modal(mod);
var btnCerr = document.getElementById("cerrar");

btnCerr.addEventListener("click", function(event){
  modal.hide();
});


form.addEventListener("submit", function(event) {
    event.preventDefault();
    var numSerie = document.querySelector("#input-num-serie").value;

    if (numSerie == "") {
      Swal.fire({
        title:'<h3 style="color:white;">Introduzca un numero de serie por favor</h3>',
        text: '',
        icon: 'error',
        background:'#000',
        backdrop:true,
        confirmButtonColor:'#068'
      });
        return;
    }

    var formData = new FormData();
    formData.append("id",numSerie);
    formData.append("param","num_serie");

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
        try {
          var json = JSON.parse(data);
          // Crear el HTML para mostrar los datos en el modal
          //console.log(data);
          var json = JSON.parse(data);
          var html = `
            <h3>${json[0].marca}</h3>
            <img src="/BicRobmvc/views/src/imgBicis/${json[0].img_prin}" class="card-img-fixed-size" alt="${data[0].img_prin}">
            <p>Talla: ${json[0].talla}</p>
            <p>Rodada: ${json[0].rodada}</p>
            <p>Fecha del robo: ${json[0].fecha_robo}</p>
            <p>Lugar del robo: ${json[0].lugar}</p>
            <p>Hora del robo: ${json[0].hora}</p>
            <p>Comentarios:</p>
            <p>${json[0].comentarios}</p>
            <br>
            <a href="/BicRobmvc/views/privadas/infoBic/infoBic.php?id_b=${json[0].id_bic}" class="btn btn-success">Más información</a>
          `;
      
          // Agregar el HTML al contenido del modal
          modalBody.innerHTML = html;
      
          // Mostrar el modal
          modal.show();  
        } catch (e) {
            Swal.fire({
              title:'<h3 style="color:white;">No se encontro el numero de serie</h3>',
              text: '',
              icon: 'error',
              background:'#000',
              backdrop:true,
              confirmButtonColor:'#068'
            });
              return;
        }
             
      })
      .catch(error => {
        console.error(error);
      });
    });    


    function buscar() {
      var Estado = document.getElementById("Estado").value;
      var Marca = document.getElementById("Marca").value;
      var Municipio = document.getElementById("Municipio").value;

      if(Estado=="def"){
        EstadoF=" ";
      }else{
        var EstadoF = " AND Estado='"+Estado+"' ";
      }

      if(Marca=="def"){
        MarcaF=" ";
      }else{
        var MarcaF = " AND Marca='"+Marca+"' ";
      }

      if(Municipio=="def"){
        MunicipioF=" ";
      }else{
        var MunicipioF = " AND Municipio='"+Municipio+"' ";
      }
     
      
     
      // Obtener el valor del input
      var panel = document.getElementById("bicicletas");
      
      // Crear una solicitud AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/BicRobmvc/controllers/biciController.php?accion=selectIndex", true);
    
      // Configurar los encabezados de la solicitud
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
      // Configurar la función de devolución de llamada para procesar la respuesta
      xhr.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
          // Procesar la respuesta
          console.log(this.responseText);
          panel.innerHTML=this.responseText;
        }
      };
    
      // Crear la cadena de consulta para enviar los datos
      var data = "extra="+MarcaF+EstadoF+MunicipioF;
      console.log(data);
    
      // Enviar la solicitud
      xhr.send(data);
    }

