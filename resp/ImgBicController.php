<?php
include_once(__DIR__ . '/../config/conexion.php');

class ImgbiciController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            error_log("valor recibido= ".$accion);
            if ($accion == 'select') {
                $this->selecImg();
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

    public function selecImg($id_bic,$param){
        include_once(__DIR__ . '/../models/imgBicModel.php');
        $imgBicModel = new imgBicModel($this->conexion);
        $resultado = $imgBicModel->obtenerImgs($id_bic,$param); 
        foreach ($resultado as $fila) { 
            $id_img=$fila["id_img"];
            $nom_arch=$fila["nombre_arch"];
            $titulo=$fila["titulo"];
            $descripcion=$fila["descripcion"];

            echo '<div class="img-container" data-id="'.$id_img.'"" >';
            echo '<button class="delete-btn" data-id="'.$id_img.'"><i class="fas fa-trash"></i></button>';
            echo '<button class="edit-btn" data-id="'.$id_img.'"><i class="fas fa-pencil-alt"></i></button>';
            echo '<img src="/BicRobmvc/views/src/imgBicis/'.$nom_arch.'" alt="Imagen 1" class="card-img-top card-img-fixed-size">';
            echo '<h3 class="titl">'.$titulo.'</h3>';
            echo '<p class="desc">'.$descripcion.'</p>';
            
            echo '<div class="modal fade" id="modalNImg" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true" data-id="'.$id_img.'">';
            echo '<div class="modal-dialog" role="document">';
            echo '<div class="modal-content">';
            echo '<div class="modal-header">';
            echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="modal-body">';

            echo '<form class="edit-form"  method="post"">';
            echo'<input type="hidden" name="id_img" value="'.$id_img.'">';
            echo'<label for="titulo" class="text-center fs-1">Título</label>';
            echo'<input type="text" name="titulo" value="'.$titulo.'">';
            //echo '<img src="/BicRobmvc/views/src/imgBicis/'.$nom_arch.'" alt="Imagen 1" class="card-img-top card-img-fixed-size">';
            echo '<input type="file" id="imgEdit" class="imgEdit" name="imgEdit" accept="image/*"  >';
            echo'<input type="hidden" name="imgAct" value="'.$nom_arch.'">';
            echo '<img id="imgprevE" class="prevs" src="/BicRobmvc/views/src/imgBicis/'.$nom_arch.'" alt="Vista previa de la imagen" style="max-width: 100%; max-height: 200px;">';
            echo'<label for="descripcion">Descripción:</label>';
            echo'<textarea name="descripcion">'.$descripcion.'</textarea>';
            echo'<button type="submit" class="btn btn-success btn">Guardar cambios</button>';
            echo'<button type="button" class="btn btn-danger cancel-btn " data-bs-dismiss="modal" >Cancelar</button>';
            echo'</form>';

            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

           
        }

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