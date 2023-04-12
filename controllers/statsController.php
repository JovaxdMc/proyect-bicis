<?php
include_once(__DIR__ . '/../config/conexion.php');

class biciController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            if ($accion == 'insert') {
                
            }else if($accion == 'selectEnc'){
                $columna=$_POST["columna"];
                $tabla=$_POST["tabla"];
                $this->selectEnc($columna,$tabla);
            }else if($accion == 'selectMunic'){
                $columnaEstado=$_POST["columnaEstado"];
                $columnaMunicipio=$_POST["columnaMunicipio"];
                $estado=$_POST["estado"];
                $tabla=$_POST["tabla"];
                $this->selectMunic($estado, $tabla, $columnaEstado, $columnaMunicipio);
            }else if($accion == 'selectIndex'){
                $extra=$_POST["extra"];
                $this->selectIndex($extra);
            }else if($accion == 'SelectRepJson'){
                $id = $_POST["id"];
                $param = $_POST["param"];
                $this->SelectRepJson( $id,$param);
            }else if($accion == 'SelectRepUsrJson'){
                $id_b = $_POST["id_b"];
                $this->SelectRepUsrJson($id_b);
            }else if($accion == 'updtNs'){
                $this->updtNs();
            }
        } else {
            // La clave 'accion' no está definida en $_GET
            // Se puede proporcionar un valor predeterminado o mostrar un mensaje de error
            //error_log("Error GET");
        }
    }

    public function selectEnc($columna,$tabla){
        include_once(__DIR__ . '/../models/statsModel.php');
        $statsModel = new statsModel($this->conexion);
        $resultado = $statsModel->selectEnc($columna,$tabla);               
        // Decodificar la cadena JSON en una matriz PHP
        echo json_encode($resultado);        
    } 
    public function selectMunic($estado, $tabla, $columnaEstado, $columnaMunicipio){
        include_once(__DIR__ . '/../models/statsModel.php');
        $statsModel = new statsModel($this->conexion);
        $resultado = $statsModel->selectMunic($estado, $tabla, $columnaEstado, $columnaMunicipio);               
        // Decodificar la cadena JSON en una matriz PHP
        echo json_encode($resultado);        
    }
   
    
   
    
}try {
    $conexion = new Conexion();
    $biciController = new biciController($conexion);
} catch (Exception $e) {
    echo 'error'.$e->getMessage();
}