<?php 
include_once(__DIR__ .'/../config/conexion.php');
$conexion = new Conexion();
class usrsModel {
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerUsr($id,$param,$orden) {
        $sql = "";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam("", $id_usr);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function eliminarUsr($id) {
        $sql = "DELETE FROM usuarios WHERE id= :id";
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function selectA($extra){
        $sql = "SELECT * FROM usuarios WHERE tipo_u='usuario' $extra"  ;
        error_log($sql);
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    

    public function usrRegistro($nombre,$apeP,$apeM,$estado,$ciudad,$mail,$tel,$userN,$pas1,$tu,$nonf) {
        $sql = "INSERT INTO usuarios VALUES (NULL,:Nombr,:apeP,:apeM,:estado,:ciudad,:mail,:tel,:userN,:pas1,:tu,:nomf)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":Nombr", $nombre);
        $stmt->bindParam(":apeM", $apeM);
        $stmt->bindParam(":apeP", $apeP);
        $stmt->bindParam(":estado", $estado);
        $stmt->bindParam(":ciudad", $ciudad);
        $stmt->bindParam(":mail", $mail);
        $stmt->bindParam(":tel", $tel);
        $stmt->bindParam(":userN", $userN);
        $stmt->bindParam(":pas1", $pas1);
        $stmt->bindParam(":tu", $tu);
        $stmt->bindParam(":nomf", $nonf);
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


    public function editarImgUsr($id_u,$imgN) {
        $sql = "UPDATE usuarios SET imgPerfil=:imgN WHERE id=:id_iu";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":imgN", $imgN);
        $stmt->bindParam(":id_iu", $id_u);
        $stmt->execute();
        return $stmt;
    }
    
    public function editarUsrDatosCont($id_u,$Estado,$Municipio,$correo,$telefono) {
        $sql = "UPDATE usuarios SET Estado=:Estado , Municipio=:Municipio , correo = :correo , telefono = :telefono WHERE id=:id_u";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_u", $id_u);
        $stmt->bindParam(":Estado", $Estado);
        $stmt->bindParam(":Municipio", $Municipio);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->execute();
        return $stmt;
    }
    
    public function editarUsr($id_u,$nombre,$apellP,$apellM,$estado,$municipio,$correo,$telefono,$user,$pass) {
        $sql = "UPDATE usuarios SET id=:id_u ,Nombre=:Nombre , Apellido_p=:Apellido_p , Estado=:Estado , Municipio=:Municipio , correo = :correo , telefono = :telefono, usuario=:usuario , pass= :pass WHERE id=:id_u";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":id_u", $id_u);
        $stmt->bindParam(":Nombre", $nombre);
        $stmt->bindParam(":Apellido_p", $apellP);
        $stmt->bindParam(":Apellido:m", $apellM);
        $stmt->bindParam(":Estado", $estado);
        $stmt->bindParam(":Municipio", $municipio);
        $stmt->bindParam(":correo", $correo);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":usuario", $user);
        $stmt->bindParam(":pass", $pass);
        $stmt->execute();
        return $stmt;
    }

    public function obtener_nombre_archivo($id_usr) {
        $sql = "SELECT imgPerfil FROM usuarios WHERE id = :id_u";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam("id_u", $id_usr);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log($resultado['imgPerfil']);
        return $resultado['imgPerfil'];
    }





}

$conexion = new Conexion();
$usrsModel = new usrsModel($conexion);

?>