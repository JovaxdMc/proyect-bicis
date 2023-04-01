<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class imgBicModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerImgs($id_bic,$param) {
        //error_log($id_bic.':'.$param);
        $sql = "SELECT * FROM imagenes_bicis WHERE $param = :id_b";
        //error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_b", $id_bic);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function elimImgs($id,$param) {
        $sql = "DELETE FROM imagenes_bicis WHERE $param = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function insertarImgBic($id_bic,$arch,$titl,$desc) {
        $sql = "INSERT INTO imagenes_bicis VALUES ('null',:id_b,:arch,:titulo,:descr)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_b", $id_bic);
        $stmt->bindParam(":arch", $arch);
        $stmt->bindParam(":titulo", $titl);
        $stmt->bindParam(":descr", $desc);
        if ($stmt->execute()) {
            return $stmt;
            // La consulta se ejecutó correctamente
            // Código adicional aquí
            error_log("Imagen insertada correctamente");
        } else {
            $error = $stmt->errorInfo();
    error_log("Error al ejecutar la consulta: " . $error[2]);
            // Ocurrió un error durante la ejecución de la consulta
            // Código de manejo de errores aquí
        }
        
    }

    public function editarImgBic($id_img,$arch,$titl,$desc) {
        $sql = "UPDATE imagenes_bicis SET titulo=:titulo,descripcion=:descr,nombre_arch=:arch WHERE id_img=:id_img";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_img", $id_img);
        $stmt->bindParam(":titulo", $titl);
        $stmt->bindParam(":descr", $desc);
        $stmt->bindParam(":arch", $arch);
        $stmt->execute();
        return $stmt;
    }

    public function obtener_nombre_archivo($id_img) {
        $sql = "SELECT nombre_arch FROM imagenes_bicis WHERE id_img = :id_img";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam("id_img", $id_img);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log($resultado['nombre_arch']);
        return $resultado['nombre_arch'];
    }

}

$conexion = new Conexion();
$imgBicModel = new imgBicModel($conexion);


?>