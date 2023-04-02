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

    public function obtenerBiciReporteJson($numSerie) {
        $sql = "SELECT b.id_bic, b.img_prin, b.num_serie, b.marca, b.modelo, b.talla, b.year, b.rodada, b.estatus, b.comprobante, r.id_reporte, r.fecha_reporte, r.fecha_robo, r.lugar, r.hora, r.comentarios, r.estado_rep 
        FROM bicis b 
        INNER JOIN reportes r 
        ON b.id_bic = r.id_bic 
        WHERE b.num_serie= :ns ;";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":ns", $numSerie);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($resultados);
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