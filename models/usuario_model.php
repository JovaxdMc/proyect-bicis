<?php
include_once('../config/conexion.php');

class UsuarioModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerUsuario($usuario, $pass) {
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND pass = :pass";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":pass", $pass);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$conexion = new Conexion();
$usuarioModel = new UsuarioModel($conexion);
