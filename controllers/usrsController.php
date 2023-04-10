<?php
include_once(__DIR__ . '/../config/conexion.php');

class usrsController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            error_log("valor recibido= ".$accion);
            if ($accion == 'select') {
                $id=$_POST["id"];
                $columna=$_POST["columna"];
                $extra=$_POST["extra"];
                $this->selectRep($id,$columna,$extra);

            }else if($accion == ''){
                $this->insertUsr();

            }else if($accion == 'registro'){
               
                
                $this->registroUsr();

            }else if($accion == 'selectA'){
                $extra=$_POST["extra"];
                $this->selectA($extra);

            }else if($accion == 'delete'){
                if(isset($_GET["id"]) and isset($_GET["param"])){
                    $id=$_GET["id"];
                    $param=$_GET["param"];
                    $this->deleteRep($id,$param);
                }
            }else if($accion == 'update'){
                $this->updateUsr();
            }else if($accion == 'updtImgPerf'){
                $this->updtImgPerf();
            }else if($accion == 'updtDatosContacto'){
                $this->updtDatosContacto();
            }
        } 
    }

   // public function selectA(){
   //    include_once(__DIR__ . '/../models/usrsModel.php');
   //     $usrsModel = new usrsModel($this->conexion);
   //     $resultado = $usrsModel->selectA();               
        // Decodificar la cadena JSON en una matriz PHP
   //     echo json_encode($resultado);          
   // }

   public function selectA($extra) {
    include_once(__DIR__ . '/../models/usrsModel.php');
    $usrsModel = new usrsModel($this->conexion);
    $resultado = $usrsModel->selectA($extra);
    if (count($resultado) == 0) {
        echo "error";
    } else {
    // Generar la tabla HTML
    $tabla = '<table>';
    $tabla .= '<thead><tr><th>Id</th><th>Nombre</th><th>Apellido_p</th><th>Apellido_m</th><th>Estado</th><th>Municipio</th><th>Correo</th><th>Teléfono</th><th>usuario</th><th>Acciones</th></tr></thead>';
    $tabla .= '<tbody>';
    
    foreach ($resultado as $fila) {
        $tabla .= '<tr>';
        $tabla .= '<td data-id="' . $fila['id'] . '">' . $fila['id'] . '</td>';
        $tabla .= '<td data-nombre="' . $fila['Nombre'] . '">' . $fila['Nombre'] . '</td>';
        $tabla .= '<td data-apellidoPaterno="' . $fila['Apellido_p'] . '">' . $fila['Apellido_p'] . '</td>';
        $tabla .= '<td data-apellidoMaterno="' . $fila['Apellido_m'] . '">' . $fila['Apellido_m'] . '</td>';
        $tabla .= '<td data-estado="' . $fila['Estado'] . '">' . $fila['Estado'] . '</td>';
        $tabla .= '<td data-municipio="' . $fila['Municipio'] . '">' . $fila['Municipio'] . '</td>';
        $tabla .= '<td data-correoElectronico="' . $fila['correo'] . '">' . $fila['correo'] . '</td>';
        $tabla .= '<td data-telefono="' . $fila['telefono'] . '">' . $fila['telefono'] . '</td>';
        $tabla .= '<td data-nombreUsuario="' . $fila['usuario'] . '">' . $fila['usuario'] . '</td>';
        $tabla .= '<td><button class="editar btn btn-success" onclick="Editar(' . $fila['id'] . ')"> <span class="fas fa-pencil-alt"></span></button> <button class="eliminar btn btn-danger" onclick="Eliminar(' . $fila['id'] . ')"><span class="fas fa-trash"></span></button></td>';
        $tabla .= '</tr>';
        
    }
    
    $tabla .= '</tbody></table>';
    
    // Devolver la tabla HTML
    echo $tabla;
    }
}

    public function insertUsr(){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $nombre =$_POST["nombre"];
        $userN =$_POST["Usern"];
        $apeM =$_POST["apellidoM"];
        $apeP =$_POST["apellidoP"];
        $estado =$_POST["estado"];
        $ciudad =$_POST["ciudad"];
        $tel =$_POST["telefono"];
        $mail =$_POST["email"];
        $pas1 =$_POST["pass1"];

        $ruta=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgUsrs';
        $imagen = $_FILES['fotoUsr']['name'];  //nombre del archivo
        $temp_file = $_FILES['fotoUsr']['tmp_name'];
        $ext=explode('.',$imagen);//obtenemos la extenciom
        $renom = "fotoU_".substr(sha1($imagen.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
        $nomf = $renom.".".$ext[1];

        $usrsModel = new usrsModel($this->conexion);
        $resultado = $usrsModel->usrRegistro($nombre,$apeP,$apeM,$estado,$ciudad,$mail,$tel,$userN,$pas1,"usuario",$nomf);
        if ($resultado) {
            move_uploaded_file($temp_file, $ruta.'/'.$nomf); 
            //echo "<script>alert('El usuario se registro correctamente.');</script>";
                error_log("El usuario se registro correctamente");
                header("Location: /BicRobmvc/index.php");
            } else {
                error_log("Error al registrar el usuario");
            }
        }
        
        public function registroUsr(){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $nombre =$_POST["nombre"];
        $apeM =$_POST["apellidoMaterno"];
        $apeP =$_POST["apellidoPaterno"];
        $estado =$_POST["estado"];
        $ciudad =$_POST["municipio"];
        $tel =$_POST["telefono"];
        $mail =$_POST["correoElectronico"];
        $userN =$_POST["nombreUsuario"];
        $pas1 =$_POST["pass1"];
        $tipoUsuario =$_POST["tipoUsuario"];
        $usrsModel = new usrsModel($this->conexion);
        $resultado = $usrsModel->usrRegistro($nombre,$apeP,$apeM,$estado,$ciudad,$mail,$tel,$userN,$pas1,$tipoUsuario,"");
        if ($resultado) {
            //echo "<script>alert('El usuario se registro correctamente.');</script>";
                echo "correcto";
            } else {
                echo "error";
            }
        }


    public function deleteImgServ($id_u){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $usrsModel = new usrsModel($this->conexion);
        $nombre_img = $usrsModel->obtener_nombre_archivo($id_u);
        error_log("Imagen del servidor: $nombre_img");
        $ruta_imagen =$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgUsrs/' . $nombre_img;
        if (file_exists($ruta_imagen)) {
            unlink($ruta_imagen);
            error_log("La imagen $nombre_img ha sido eliminada del servidor.");
        } else {
            error_log("No se pudo encontrar la imagen $nombre_img en el servidor.");
            error_log("Ruta= $ruta_imagen");

        }
    }

    public function updtImgPerf(){
        
        $id_u = $_POST['id_u'];
        error_log("id:".$id_u);
        if(isset($_FILES['imgN'])){
            $this->deleteImgServ($id_u);//Borramos la imagen del servidor
            $rutaFotos=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgUsrs'; //Ruta de almacenamiento de las fotos de perfil en el servidor
            error_log("NuevaImagen0=$rutaFotos");
            $nomFotoPrin = $_FILES['imgN']['tmp_name'];  //Nombre del archivo para el sistema
            $fotoPrin = $_FILES['imgN']['name'];  //nombre del archivo
            error_log("NuevaImagen1=$fotoPrin");
            $extFoto=explode('.',$fotoPrin); //quitamos la extencion
            $renomF = "fotoU_".substr(sha1($fotoPrin.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
            $nomfFoto=$renomF.".".$extFoto[1]; //Unimos lo anterior para generar el nombre final
            error_log("NuevaImagen=$nomfFoto");
            if(move_uploaded_file($nomFotoPrin, $rutaFotos.'/'.$nomfFoto)){//Movemos el archivo a la ruta)
                $usrsModel = new usrsModel($this->conexion);
                $resultado = $usrsModel->editarImgUsr($id_u,$nomfFoto);
                session_start();
                $_SESSION["imgPerfil"]=$nomfFoto;
                session_write_close();
                if ($resultado) {
                    error_log("El registro se ah actualizado correctamente");
                  } else {
                    error_log("Ha ocurrido un error al actualizar el registro");
                  }
                }
        }else{
                error_log("Error al subir la foto nueva al servidot". $_FILES["imgN"]["error"]);
        }        
    }      
    
    public function updtDatosContacto(){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $id_u = $_POST['id_u'];
        $Estado = $_POST['Estado'];
        $Municipio = $_POST['Municipio'];
        $Correo = $_POST['Correo'];
        $Telefono = $_POST['Telefono'];

        $usrsModel = new usrsModel($this->conexion);
        $resultado = $usrsModel->editarUsrDatosCont($id_u,$Estado,$Municipio,$Correo,$Telefono);
        if ($resultado) {
            session_start();
            $_SESSION["Estado"]=$Estado;
            $_SESSION["Municipio"]=$Municipio;
            $_SESSION["correo"]=$Correo;
            $_SESSION["telefono"]=$Telefono;
            session_write_close();

            echo "ok";
        } else {
            echo "error";
            }
        
       
    }    
    
    public function updateUsr(){
        include_once(__DIR__ . '/../models/usrsModel.php');
        $id_u = $_POST['idM'];
        $nombre = $_POST['nombrem'];
        $apellP = $_POST['apellidoPaternom'];
        $apellM = $_POST['apellidoMaternom'];
        $estado = $_POST['estadom'];
        $municipio = $_POST['municipiom'];
        $telefono = $_POST['telefonom'];
        $correo = $_POST['correoElectronicom'];
        $user = $_POST['nombreUsuariom'];
        $pass = $_POST['contraseñam'];
        $usrsModel = new usrsModel($this->conexion);
        $resultado = $usrsModel->editarUsr($id_u,$nombre,$apellP,$apellM,$estado,$municipio,$correo,$telefono,$user,$pass);
        
        }
       
    }      
        

    
try {
    $conexion = new Conexion();
    $usrsController= new usrsController($conexion);
} catch (Exception $e) {
    echo 'error 2'.$e->getMessage();
}