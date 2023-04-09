<?php
include_once('LoginControler.php');
try {
    $loginController = new LoginController();
} catch (Exception $e) {
    echo $e->getMessage();
}

class LoginController {
    public function __construct() {
        if(isset($_GET['m'])){
            if($_GET['m']=='o'){
                $this->logout();
            }elseif($_GET['m']=='i'){
                $this->login();
            }
        }
    }

    public function login(){
        include_once('../models/usuario_model.php');
        $modelo = new UsuarioModel($conexion);
        if (!empty($_POST["user"]) && !empty($_POST["passw"])) {
            $usuario = $_POST["user"];
            $pass = $_POST["passw"];
    
            $usuarioModel = new UsuarioModel($conexion);
            $resultado = $usuarioModel->obtenerUsuario($usuario, $pass);
    
            if ($resultado) {
                session_start();
                $_SESSION["id"]=$resultado["id"];
                $_SESSION["Nombre"]=$resultado["Nombre"];
                $_SESSION["Apellido_p"]=$resultado["Apellido_p"];
                $_SESSION["Apellido_m"]=$resultado["Apellido_m"];
                $_SESSION["Estado"]=$resultado["Estado"];
                $_SESSION["Municipio"]=$resultado["Municipio"];
                $_SESSION["correo"]=$resultado["correo"];
                $_SESSION["telefono"]=$resultado["telefono"];
                $_SESSION["usuario"]=$resultado["usuario"];
                $_SESSION["tipo_u"]=$resultado["tipo_u"];
                $_SESSION["imgPerfil"]=$resultado["imgPerfil"];
                if($_SESSION["tipo_u"]=="usuario"){
                    header('location: ../views/privadas/index/indexL.php');
                }else if($_SESSION["tipo_u"]=="admin"){
                    header('location: \BicRobmvc\views\privadas\Admin\indexAdmin\indexAdm.php');
                }   
            } else {
                echo "Usuario o contraseña incorrectos";
            }
        }else{
            throw new Exception('Error de conexión');
        }
    }
    
    public function logout(){
        session_start();
        session_destroy();
        header("location: ../index.php");
    }
}
//echo "fuera";