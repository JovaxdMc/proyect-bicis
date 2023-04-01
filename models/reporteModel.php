<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class reporteModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerReportes($id,$param,$orden) {
        $sql = "SELECT * FROM reportes WHERE $param = :id_u ".$orden;
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_u", $id_usr);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    

    public function insertarReporte($id_bic,$fecha_rep,$fecha_rob,$lugar,$hora,$comentarios) {
        $sql = "INSERT INTO reportes VALUES ('null',:id_bic,:fecha_rep,:fecha_rob,:lugar,:hora,:comentarios,'activo')";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_bic", $id_bic);
        $stmt->bindParam(":fecha_rep", $fecha_rep);
        $stmt->bindParam(":fecha_rob", $fecha_rob);
        $stmt->bindParam(":lugar", $lugar);
        $stmt->bindParam(":hora", $hora);
        $stmt->bindParam(":comentarios", $comentarios);
        $stmt->execute();
        error_log($sql);
        return $stmt;
    }

    public function actualizarEstadoBic($id_bic){
        $sql = "UPDATE bicis SET estatus='Reportado' WHERE id_bic=:id_bic"; 
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_bic", $id_bic);
        $stmt->execute();
        //error_log($stmt);
        return $stmt;
    }
}

$conexion = new Conexion();
$reporteModel = new reporteModel($conexion);

?>