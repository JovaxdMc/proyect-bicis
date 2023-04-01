<?php
include_once(__DIR__ . '/../config/conexion.php');

class usrsController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];

            error_log("valor recibido= ".$accion);
            if ($accion == 'select') {
                $id=$_POST["id"];
                $columna=$_POST["columna"];
                $extra=$_POST["extra"];
                $this->selectRep($id,$columna,$extra);

            }else if($accion == 'insert'){
                $this->insertUsr();

            }else if($accion == 'delete'){
                if(isset($_GET["id"]) and isset($_GET["param"])){
                    $id=$_GET["id"];
                    $param=$_GET["param"];
                    $this->deleteRep($id,$param);

                }
            }else if($accion == 'update'){
                $this->updateRep();
            }else if($accion == 'updtImgPerf'){
                $this->updtImgPerf();
            }
        } 
    }

    public function selectRep($id,$columna,$extra){
       
    }

    public function insertUsr(){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $nombre =$_POST["nombre"];
        $userN =$_POST["Usern"];
        $apeM =$_POST["apellidoM"];
        $apeP =$_POST["apellidoP"];
        $estado =$_POST["estado"];
        $ciudad =$_POST["ciudad"];
        $tel =$_POST["telefono"];
        $mail =$_POST["email"];
        $pas1 =$_POST["pass1"];

        $ruta=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgUsrs';
        $imagen = $_FILES['fotoUsr']['name'];  //nombre del archivo
        $temp_file = $_FILES['fotoUsr']['tmp_name'];
        $ext=explode('.',$imagen);//obtenemos la extenciom
        $renom = "fotoU_".substr(sha1($imagen.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
        $nomf = $renom.".".$ext[1];

        $usrsModel = new usrsModel($this->conexion);
        $resultado = $usrsModel->usrRegistro($nombre,$apeP,$apeM,$estado,$ciudad,$mail,$tel,$userN,$pas1,$nomf);
        if ($resultado) {
            move_uploaded_file($temp_file, $ruta.'/'.$nomf); 
            //echo "<script>alert('El usuario se registro correctamente.');</script>";
                error_log("El usuario se registro correctamente");
                header("Location: /BicRobmvc/index.php");
            } else {
                error_log("Error al registrar el usuario");
            }
        }

    public function deleteRep(){
       
    }

    public function updateRep(){
       
    }

    public function deleteImgServ($id_u){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $usrsModel = new usrsModel($this->conexion);
        $nombre_img = $usrsModel->obtener_nombre_archivo($id_u);
        error_log("Imagen del servidor: $nombre_img");
        $ruta_imagen =$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgUsrs/' . $nombre_img;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
            error_log("La imagen $nombre_img ha sido eliminada del servidor.");
        } else {
            error_log("No se pudo encontrar la imagen $nombre_img en el servidor.");
            error_log("Ruta= $ruta_imagen");

        }
    }

    public function updtImgPerf(){
        
        $id_u = $_POST['id_u'];
        error_log("id:".$id_u);
        if(isset($_FILES['imgN'])){
            $this->deleteImgServ($id_u);//Borramos la imagen del servidor
            $rutaFotos=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgUsrs'; //Ruta de almacenamiento de las fotos de perfil en el servidor
            error_log("NuevaImagen0=$rutaFotos");
            $nomFotoPrin = $_FILES['imgN']['tmp_name'];  //Nombre del archivo para el sistema
            $fotoPrin = $_FILES['imgN']['name'];  //nombre del archivo
            error_log("NuevaImagen1=$fotoPrin");
            $extFoto=explode('.',$fotoPrin); //quitamos la extencion
            $renomF = "fotoU_".substr(sha1($fotoPrin.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
            $nomfFoto=$renomF.".".$extFoto[1]; //Unimos lo anterior para generar el nombre final
            error_log("NuevaImagen=$nomfFoto");
            if(move_uploaded_file($nomFotoPrin, $rutaFotos.'/'.$nomfFoto)){//Movemos el archivo a la ruta)
                $usrsModel = new usrsModel($this->conexion);
                $resultado = $usrsModel->editarImgUsr($id_u,$nomfFoto);
                session_start();
                $_SESSION["imgPerfil"]=$nomfFoto;
                session_write_close();
                if ($resultado) {
                    error_log("El registro se ah actualizado correctamente");
                  } else {
                    error_log("Ha ocurrido un error al actualizar el registro");
                  }
                }
        }else{
                error_log("Error al subir la foto nueva al servidot". $_FILES["imgN"]["error"]);
        }        
    }      
        

    }
    
try {
    $conexion = new Conexion();
    $usrsController= new usrsController($conexion);
} catch (Exception $e) {
    echo 'error 2'.$e->getMessage();
}