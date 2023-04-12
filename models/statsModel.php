
<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class statsModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

 

    public function selectEnc($columna,$tabla) {
        $sql = "SELECT $columna, COUNT($columna) AS cantidad FROM $tabla GROUP BY $columna;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //error_log("Resultado de la consulta: " . json_encode($resultados));
        return json_encode($resultados);
    }

    public function selectMunic($estado, $tabla, $columnaEstado, $columnaMunicipio) {
        $sql = "SELECT $columnaMunicipio, COUNT(*) as cantidad
                FROM $tabla
                WHERE $columnaEstado = ?
                GROUP BY $columnaMunicipio;";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([$estado]);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //error_log("Resultado de la consulta: " . json_encode($resultados));
        return json_encode($resultados);
    }
    


}

$conexion = new Conexion();
$statsModel = new statsModel($conexion);

?>


