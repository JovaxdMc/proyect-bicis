<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class bicisModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerBicis($id_usr,$param,$orden) {
        $sql = "SELECT * FROM bicis WHERE $param = :id_u ".$orden;
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_u", $id_usr);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }
    public function obtenerBicisReportadas($extra) {
        $sql = "SELECT bicis.id_bic, img_prin, marca, id_reporte, modelo,talla, year, rodada, estatus, fecha_reporte, fecha_robo, Estado, Municipio, estado_rep 
        FROM bicis  
        INNER JOIN reportes 
        ON bicis.id_bic = reportes.id_bic 
        WHERE estatus = 'Reportado' AND estado_rep='activo' ".$extra;
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function obtenerBiciReporteJson($id,$param) {
        $sql = "SELECT bicis.id_bic, img_prin, num_serie, marca, modelo, talla, year, rodada, estatus, comprobante, id_reporte, fecha_reporte, fecha_robo, Estado, Municipio, hora, comentarios, estado_rep 
        FROM bicis  
        INNER JOIN reportes 
        ON bicis.id_bic = reportes.id_bic 
        WHERE $param = :id ;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //error_log("Resultado de la consulta: " . json_encode($resultados));
        return json_encode($resultados);
    }

    public function obtenerUsrReporteJson($id_b) {
        $sql = "SELECT id, nombre, apellido_p, apellido_m, estado, municipio, telefono, correo
        FROM bicis  
        INNER JOIN usuarios 
        ON bicis.id_u = usuarios.id 
        WHERE id_bic = :id ;";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id", $id_b);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //error_log("Resultado de la consulta: " . json_encode($resultados));
        return json_encode($resultados);
    }

    public function obtenerMarcas() {
        //error_log($id_bic.':'.$param);
        $sql = "SELECT DISTINCT marca FROM bicis WHERE estatus='Reportado'";
        //error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    

    public function insertarBici($img_prin,$num_s,$marca,$modelo,$talla,$year,$rodada,$comprobante,$fech_reg,$id_u) {
        $sql = "INSERT INTO bicis VALUES ('null',:img_prin,:num_s,:marca,:modelo,:talla,:anio,:rodada,'Registrada',:compro,:fech,:id_u)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":img_prin", $img_prin);
        $stmt->bindParam(":num_s", $num_s);
        $stmt->bindParam(":marca", $marca);
        $stmt->bindParam(":modelo", $modelo);
        $stmt->bindParam(":talla", $talla);
        $stmt->bindParam(":anio", $year);
        $stmt->bindParam(":rodada", $rodada);
        $stmt->bindParam(":compro", $comprobante);
        $stmt->bindParam(":fech", $fech_reg);
        $stmt->bindParam(":id_u", $id_u);
        $stmt->execute();
        return $stmt;
    }
}

$conexion = new Conexion();
$bicisModel = new bicisModel($conexion);
?>