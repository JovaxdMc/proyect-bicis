<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class notifModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function insertarNotif($id_notif,$id_usrR,$id_usrNotif,$id_bic,$contenido,$fecha_actual,$hora_actual) {
        $sql = "INSERT INTO notificaciones VALUES ( :id_notf , :id_usrReport , :id_usrNotif , :id_bic , :contenido , 1, :fecha , :hora)";
        $stmt = $this->conexion->prepare($sql);
        error_log($sql);
        $stmt->bindParam(":id_notf", $id_notif);
        $stmt->bindParam(":id_usrReport", $id_usrReport);
        $stmt->bindParam(":id_usrNotif", $id_usrNotif);
        $stmt->bindParam(":id_bic", $id_bic);
        $stmt->bindParam(":contenido", $contenido);
        $stmt->bindParam(":fecha", $fecha_actual);
        $stmt->bindParam(":hora", $hora_actual);
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

    public function selectNotif($id_usrR){
        $sql = "SELECT * FROM notificaciones 
                INNER JOIN bicis 
                ON notificaciones.id_bic = bicis.id_bic 
                WHERE id_usr_notif =  :idUsrR ";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":idUsrR", $id_usrR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function selectNotif1($id_notif){
        $sql = "SELECT * FROM notificaciones 
        INNER JOIN bicis 
        ON notificaciones.id_bic = bicis.id_bic 
        WHERE id_notif = :id_notif ";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_notif", $id_notif);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function selectImgNotif($id_notif){
        $sql = "SELECT * FROM imagenes_rep where id_notif = :id_notif ";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_notif", $id_notif);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

$conexion = new Conexion();
$notifModel = new notifModel($conexion);

?>