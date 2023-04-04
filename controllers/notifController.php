<?php
include_once(__DIR__ . '/../config/conexion.php');

class notifController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            if ($accion == 'insert') {
                $id_usrR=$_POST["id_usrR"];
                $id_usrNotif=$_POST["id_usrNotif"];
                $id_bic=$_POST["id_bic"];
                $contenido=$_POST["contenido"];
                $this->insertNotif($id_usrR,$id_usrNotif,$id_bic,$contenido);
            }else if($accion == 'select'){
                $id_usrR = $_GET["idUsr_R"];
                $this->SelecNotif($id_usrR);
            }else if($accion == 'selectIndex'){
                
            }else if($accion == 'SelectRepJson'){
                
            }else if($accion == 'SelectRepUsrJson'){
                
            }else if($accion == 'updt'){
                
            }
        } else {
            // La clave 'accion' no está definida en $_GET
            // Se puede proporcionar un valor predeterminado o mostrar un mensaje de error
            //error_log("Error GET");
        }
    }

   
    public function insertNotif($id_usrR,$id_usrNotif,$id_bic,$contenido){
        include_once(__DIR__ . '/../models/notifModel.php');
        if (!empty($id_usrR)) {

            $fecha_actual = date("Y-m-d");
            $hora_actual = date("H:i");
            $random_string = substr(md5(mt_rand()), 0, 10);
            $id_notif = $random_string . "_" . $fecha_actual . "_" . $id_usrR;
            
            $notifModel = new notifModel($this->conexion);
            $notifModel->insertarNotif($id_notif,$id_usrR,$id_usrNotif,$id_bic,$contenido,$fecha_actual,$hora_actual);               
            // Decodificar la cadena JSON en una matriz PHP
            
            if(isset($_FILES['evidencias'])) {
                if (is_array($_FILES['evidencias']['tmp_name'])) {
                    $uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgNotif/';
                    foreach($_FILES['evidencias']['tmp_name'] as $key => $tmp_name) {
                      $file_name = $_FILES['evidencias']['name'][$key];
                      $file_tmp = $_FILES['evidencias']['tmp_name'][$key];
                      $file_type = $_FILES['evidencias']['type'][$key];
                      // Obtener la extensión del archivo cargado
                      $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                      // Generar un nombre aleatorio para el archivo
                      $random_name = 'notImg_'.uniqid('', true).".".$ext;
                      // Mover el archivo cargado al directorio de subida con el nuevo nombre
                      move_uploaded_file($file_tmp, $uploads_dir.$random_name);
                      $notifModel = new notifModel($this->conexion);
                      $notifModel->insertarImgNotif($random_name,$id_notif); 
                    }
                  } else {
                    // Si la variable no es un array, mostrar un mensaje de error o tomar alguna otra acción
                    error_log("El campo 'evidencias' no contiene archivos cargados.") ;
                  }
            } else {
              error_log("No se cargó ninguna imagen");
              
            }
           
           
            }else {
            $error = $notifController->conexion->errorInfo();
            throw new Exception('Error de conexión');
        }
    }
    
    public function SelecNotif($id_usrR){

        include_once(__DIR__ . '/../models/notifModel.php');
        if (!empty($id_usrR)) {
            $notifModel = new notifModel($this->conexion);
            $resultado = $notifModel->selectNotif($id_usrR);               
            // Decodificar la cadena JSON en una matriz PHP
            echo json_encode($resultado);
           
            }else {
            $error = $bicisModel->conexion->errorInfo();
            throw new Exception('Error de conexión');
        }
    }
    
   

    
    
}

try {
    $conexion = new Conexion();
    $notifController = new notifController($conexion);
} catch (Exception $e) {
    echo 'error'.$e->getMessage();
}