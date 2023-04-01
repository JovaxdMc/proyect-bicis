<?php
include_once(__DIR__ . '/../config/conexion.php');

class reporteController {
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
                $this->insertRep();

            }else if($accion == 'delete'){
                if(isset($_GET["id"]) and isset($_GET["param"])){
                    $id=$_GET["id"];
                    $param=$_GET["param"];
                    $this->deleteRep($id,$param);

                }
            }else if($accion == 'update'){
                $this->updateRep();
            }
        } 
    }

    public function selectRep($id,$columna,$extra){
       
    }

    public function insertRep(){
    include_once(__DIR__ . '/../models/reporteModel.php');
       $id_bic=$_POST["id_bic"];
       $fecha_rob=$_POST["fecha_rob"];
       $lugar=$_POST["lugar"];
       $hora=$_POST["hora"];
       $comentarios=$_POST["comentarios"];

       $fecha_rep=date("Y-m-d");

       $reporteModel = new reporteModel($this->conexion);
       $resultado = $reporteModel->insertarReporte($id_bic,$fecha_rep,$fecha_rob,$lugar,$hora,$comentarios);
       if ($resultado) {
            error_log("El reporte se registro correctamente");
            $reporteModel->actualizarEstadoBic($id_bic);
            header("Location: /BicRobmvc/views/privadas/cuentaUsr/cuentaUsr.php");
        } else {
            error_log("Error al registrar el reporte");
        }
    }

    public function deleteRep(){
       
    }

    public function updateRep(){
       
    }

    }
    
try {
    $conexion = new Conexion();
    $reporteController= new reporteController($conexion);
} catch (Exception $e) {
    echo 'error 2'.$e->getMessage();
}