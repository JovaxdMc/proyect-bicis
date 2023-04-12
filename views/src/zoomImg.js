//importa este script en cualquier lugar en el que necesites que una imagen tenga un zoom

function mostrarVistaPrevia(imagen) {
    // Crear un elemento div para la vista previa
    const vistaPrevia = document.createElement("div");
    
    // Establecer el contenido HTML del div con la imagen en su tamaño completo
    vistaPrevia.innerHTML = `<img src="${imagen.src}" style="border-radius: 10px; max-width: 80%; max-height: 80%; width: auto; height: auto;">`;
    
    // Establecer el estilo CSS del div para que se superponga sobre el contenido existente
    vistaPrevia.style.position = "fixed";
    vistaPrevia.style.top = "0";
    vistaPrevia.style.left = "0";
    vistaPrevia.style.width = "100%";
    vistaPrevia.style.height = "100%";
    vistaPrevia.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
    vistaPrevia.style.display = "flex";
    vistaPrevia.style.justifyContent = "center";
    vistaPrevia.style.alignItems = "center";
    vistaPrevia.style.zIndex = "999";
    
    // Agregar el div a la página
    document.body.appendChild(vistaPrevia);
    
    // Establecer la posición y tamaño de la imagen en la vista previa
    const imagenVistaPrevia = vistaPrevia.querySelector("img");
    imagenVistaPrevia.style.position = "relative";
    imagenVistaPrevia.style.width = "100%";
    imagenVistaPrevia.style.height = "100%";
    imagenVistaPrevia.style.objectFit = "contain";
    imagenVistaPrevia.style.borderRadius = "10px";
    
    // Cuando el usuario haga clic en la vista previa, quitarla de la página
    vistaPrevia.onclick = function() {
        vistaPrevia.remove();
    }
    
    // Cuando el usuario redimensiona la ventana, ajustar el tamaño de la imagen en la vista previa
    window.onresize = function() {
      const anchoPantalla = window.innerWidth;
      const altoPantalla = window.innerHeight;
      const anchoImagen = imagenVistaPrevia.naturalWidth;
      const altoImagen = imagenVistaPrevia.naturalHeight;
      const escalaAncho = anchoPantalla * 0.8 / anchoImagen;
      const escalaAlto = altoPantalla * 0.8 / altoImagen;
      const escala = Math.min(escalaAncho, escalaAlto);
      const ancho = escala * anchoImagen;
      const alto = escala * altoImagen;
      imagenVistaPrevia.style.width = `${ancho}px`;
      imagenVistaPrevia.style.height = `${alto}px`;
      imagenVistaPrevia.style.transform = "translate(-50%, -50%)";
    }
  }
  