<?php
include_once(__DIR__ . '/../config/conexion.php');

class ImgbiciController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            error_log("valor recibido= ".$accion);
            if ($accion == 'select') {
                $id_bic=$_POST["id_bic"];
                $param=$_POST["par"];
                error_log($id_bic.$param);
                $this->selecImg($id_bic,$param);
            }else if($accion == 'insert'){
                $this->insertImg();
            }else if($accion == 'delete'){
                if(isset($_GET["id"])and isset($_GET["param"])){
                    $id=$_GET["id"];
                    $param=$_GET["param"];
                    $this->deleteImg($id,$param);
                }
            }else if($accion == 'update'){
                $this->updateImg();
            }
        } 
    }

    public function selecImg($id_bic, $param){
        include_once(__DIR__ . '/../models/imgBicModel.php');
        $imgBicModel = new imgBicModel($this->conexion);
        $resultado = $imgBicModel->obtenerImgs($id_bic,$param); 
    
        ob_start(); // Iniciar el almacenamiento en búfer de salida
        foreach ($resultado as $fila) { 
            $id_img=$fila["id_img"];
            $nom_arch=$fila["nombre_arch"];
            $titulo=$fila["titulo"];
            $descripcion=$fila["descripcion"];
            
            echo'<div class="card-container">';
            echo '<div class="img-container card bg-dark text-white border-secondary border border-2" data-id="'.$id_img.'"" >';
            echo '<div class="button-containerImg">';
            echo '<button class="delete-btn" data-id="'.$id_img.'"><i class="fas fa-trash"></i></button>';
            echo '<button class="edit-btn" data-id="'.$id_img.'"><i class="fas fa-pencil-alt"></i></button>';
            echo '</div>';
            echo'<div class="imgContCard">';
            echo '<img src="/BicRobmvc/views/src/imgBicis/'.$nom_arch.'" alt="Imagen 1" class="imgCard text-center">';
            echo'</div>';

            echo '<h3 class="titl">'.$titulo.'</h3>';
            echo '<p class="desc">'.$descripcion.'</p>';
            
            // Incluir un elemento oculto con la información de la tarjeta
            echo '<div class="card-info" style="display:none;">';
            echo '<p class="card-id">'.$id_img.'</p>';
            echo '<p class="card-title">'.$titulo.'</p>';
            echo '<p class="card-description">'.$descripcion.'</p>';
            echo '<p class="card-image">'.$nom_arch.'</p>';
            echo '</div>';
            echo '</div>';
            echo'</div>';
        }
        $html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo
        //error_log($html);
        echo $html;
    }
    public function selecImgPriv($id_bic, $param){
        include_once(__DIR__ . '/../models/imgBicModel.php');
        $imgBicModel = new imgBicModel($this->conexion);
        $resultado = $imgBicModel->obtenerImgs($id_bic,$param); 
    
        ob_start(); // Iniciar el almacenamiento en búfer de salida
        foreach ($resultado as $fila) { 
            $id_img=$fila["id_img"];
            $nom_arch=$fila["nombre_arch"];
            $titulo=$fila["titulo"];
            $descripcion=$fila["descripcion"];
            
            echo'<div class="card-container">';
            echo '<div class="img-container card bg-dark text-white border-secondary border border-2" style="width: 18rem;" data-id="'.$id_img.'"" >';
            echo '<div class="button-container">';
            echo '</div>';
            echo '<h3 class="titl">'.$titulo.'</h3>';
            echo '<img src="/BicRobmvc/views/src/imgBicis/'.$nom_arch.'" alt="Imagen 1" class="card-img-top card-img-fixed-size" onclick="mostrarVistaPrevia(this)" >';
            echo '<p class="desc">'.$descripcion.'</p>';
            
            // Incluir un elemento oculto con la información de la tarjeta
            echo '</div>';
            echo'</div>';
        }
        $html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo
        //error_log($html);
        echo $html;
    }
    
    public function deleteImgServ($id){
        $imgBicModel = new imgBicModel($this->conexion);
        $nombre_img = $imgBicModel->obtener_nombre_archivo($id);
        $ruta_imagen =$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgBicis/' . $nombre_img;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
            error_log("La imagen $nombre_img ha sido eliminada del servidor.");
        } else {
            error_log("No se pudo encontrar la imagen $nombre_img en el servidor.");
        }
    }
    public function deleteImg($id,$param){
        include_once(__DIR__ . '/../models/imgBicModel.php');
        $imgBicModel = new imgBicModel($this->conexion);
        $this->deleteImgServ($id);
        $resultado = $imgBicModel->elimImgs($id,$param);
        // Eliminar el archivo del servidor
       
    }

    public function insertImg(){
        include_once(__DIR__ . '/../models/imgBicModel.php');
        error_log("Insertando 69");
        $id_bic = $_POST["id_bic"];
        $titulo = $_POST["title"];
        $desc = $_POST["description"];

        $rutaFotos=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgBicis';
        $nomFotoPrin = $_FILES['image']['tmp_name'];  //Nombre del archivo para el sistema
        $fotoPrin = $_FILES['image']['name'];  //nombre del archivo
        $extFoto=explode('.',$fotoPrin); //quitamos la extencion
        $renomF = "img_".substr(sha1($fotoPrin.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
        $nomfFoto=$renomF.".".$extFoto[1]; //Unimos lo anterior para generar el nombre final
    
        $imgBicModel = new imgBicModel($this->conexion);
        $resultado = $imgBicModel->insertarImgBic($id_bic,$nomfFoto,$titulo,$desc);
        if ($resultado) {
            move_uploaded_file($nomFotoPrin, $rutaFotos.'/'.$nomfFoto); //Movemos el archivo a la ruta
            //echo "El registro ha sido insertado exitosamente.";
          } else {
            $errorInfo = $resultado->errorInfo();
            error_log( "Ha ocurrido un error al insertar el registro: " . $errorInfo[2]);
            //echo "Ha ocurrido un error al insertar el registro.";
          }
        }

        public function updateImg(){
            include_once(__DIR__ . '/../models/imgBicModel.php');
    
            $id_img = $_POST["id_img"];
            error_log("Id de imagen= $id_img");
            $titulo = $_POST["titulo"];
            $desc = $_POST["descripcion"];

            if(isset($_FILES['arch'])){
                $this->deleteImgServ($id_img);
                $rutaFotos=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgBicis';
                $nomFotoPrin = $_FILES['arch']['tmp_name'];  //Nombre del archivo para el sistema
                $fotoPrin = $_FILES['arch']['name'];  //nombre del archivo
                $extFoto=explode('.',$fotoPrin); //quitamos la extencion
                $renomF = "img_".substr(sha1($fotoPrin.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
                $nomfFoto=$renomF.".".$extFoto[1]; //Unimos lo anterior para generar el nombre final
                move_uploaded_file($nomFotoPrin, $rutaFotos.'/'.$nomfFoto); //Movemos el archivo a la ruta
            }else if(isset($_POST['archAct'])){
                $nomfFoto=$_POST['archAct'];
            }
            $imgBicModel = new imgBicModel($this->conexion);
            $resultado = $imgBicModel->editarImgBic($id_img,$nomfFoto,$titulo,$desc);
    
            if ($resultado) {
                error_log("El registro se ah actualizado correctamente");
              } else {
                error_log("Ha ocurrido un error al actualizar el registro");
              }
            }
    }
    
try {
    $conexion = new Conexion();
    $ImgbiciController= new ImgbiciController($conexion);
} catch (Exception $e) {
    echo 'error 2'.$e->getMessage();
}