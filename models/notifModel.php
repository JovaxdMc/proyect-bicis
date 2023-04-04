<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class notifModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarNotif($id_notif,$id_usrReport,$id_usrNotif,$id_bic,$contenido) {
        $sql = "INSERT INTO notificaciones VALUES ( :id_notf , :id_usrReport , :id_usrNotif , :id_bic , :contenido , 1)";
        $stmt = $this->conexion->prepare($sql);
        error_log($sql);
        $stmt->bindParam(":id_notf", $id_notif);
        $stmt->bindParam(":id_usrReport", $id_usrReport);
        $stmt->bindParam(":id_usrNotif", $id_usrNotif);
        $stmt->bindParam(":id_bic", $id_bic);
        $stmt->bindParam(":contenido", $contenido);
        $stmt->execute();
        
    }

    
    public function insertarImgNotif($archivo,$id_notif) {
        $sql = "INSERT INTO imagenes_rep VALUES ('null' , :archivo , :id_notif )";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":archivo", $archivo);
        $stmt->bindParam(":id_notif", $id_notif);
        $stmt->execute();
        
    }
}

$conexion = new Conexion();
$notifModel = new notifModel($conexion);

?>