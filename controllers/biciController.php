<?php
include_once(__DIR__ . '/../config/conexion.php');

class biciController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            if ($accion == 'insert') {
                $this->insert();
            }else if($accion == 'select'){
                $id=$_POST["id"];
                $param=$_POST["param"];
                $extra=$_POST["extra"];
                $this->select($id,$param,$extra);
            }else if($accion == 'selectIndex'){
                $id=$_POST["id"];
                $param=$_POST["param"];
                $extra=$_POST["extra"];
                $this->selectIndex($id_u,$param,$orden);
            }else if($accion == 'delete'){
                $this->insertImgs();
            }else if($accion == 'elim'){
                $this->insertImgs();
            }else if($accion == 'updt'){
                $this->insertImgs();
            }
        } else {
            // La clave 'accion' no está definida en $_GET
            // Se puede proporcionar un valor predeterminado o mostrar un mensaje de error
            //error_log("Error GET");
        }
    }

   

    
    public function select($id_u,$param,$orden){
        include_once(__DIR__ . '/../models/bicisModel.php');
        if (!empty($id_u)) {
            $bicisModel = new bicisModel($this->conexion);
            ob_start(); // Iniciar el almacenamiento en búfer de salida
            $resultado = $bicisModel->obtenerBicis($id_u,$param,$orden);           
            foreach ($resultado as $fila) {    
                $id_bic=$fila["id_bic"];
                $fotoPrinc=$fila["img_prin"];
                $num_serie=$fila["num_serie"];
                $marca=$fila["marca"];
                $modelo=$fila["modelo"];
                $talla=$fila["talla"];
                $year=$fila["year"];
                $rodada=$fila["rodada"];
                $estatus=$fila["estatus"];
                $fecha_reg=$fila["fecha_reg"];
                $comprobante=$fila["comprobante"];

                echo'<div class="card-container">';
                echo'<div class="card bg-dark text-white border-secondary border border-2" >';
                echo'<h4 class="nombreBic">'.$marca." ".$modelo." ".$year.'</h4>';
                echo'<div class="imgContCard">';
                echo'<img src="/BicRobmvc/views/src/imgBicis/'.$fotoPrinc.'" alt="Imagen de la bicicleta" class="imgCard text-center">';
                echo'</div>';

                echo'<p class="estatus">'.$estatus.'</p>';
                echo'<p class="fecha">'.$fecha_reg.'</p>';
                echo'<div class="btn-group">'; 
                if($estatus=="Reportado"){
                    echo '<button class="btn btn-danger" onclick="window.location.href=\'../marcarRecuperada/Bicrecuperada.php?id_b='.$id_bic.'\'">Marcar como recuperada</button>';
                }else if($estatus=="Registrada"){
                    echo'<button class="btn btn-danger" onclick="window.location.href=\'/BicRobmvc/views/privadas/reporteBici/reporteBici.php?id_b='.$id_bic.'\'">Reportar Robada</button>';
                }
                echo'<button class="btn btn-success"  onclick="window.location.href=\'/BicRobmvc/views/privadas/editarBicicleta/editBici.php?id_b='.$id_bic.'\'">Editar Informacion</button>';
                echo'</div>';
                echo'</div>';
                echo'</div>';
            }
            $html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo
            //error_log($html);
            echo $html;
        } else {
            $error = $bicisModel->conexion->errorInfo();
            throw new Exception('Error de conexión');
        }
    }
    public function selectIndex($id_u,$param,$orden){
        include_once(__DIR__ . '/../models/bicisModel.php');
        if (!empty($id_u)) {
            $bicisModel = new bicisModel($this->conexion);
            $resultado = $bicisModel->obtenerBicis($id_u,$param,$orden);           
            foreach ($resultado as $fila) {    
                $id_bic=$fila["id_bic"];
                $fotoPrinc=$fila["img_prin"];
                $num_serie=$fila["num_serie"];
                $marca=$fila["marca"];
                $modelo=$fila["modelo"];
                $talla=$fila["talla"];
                $year=$fila["year"];
                $rodada=$fila["rodada"];
                $estatus=$fila["estatus"];
                $fecha_reg=$fila["fecha_reg"];
                $comprobante=$fila["comprobante"];

                echo'<div class="card-container">';
                echo'<div class="card bg-dark text-white border-secondary border border-2" style="width: 18rem;">';
                echo'<h3 class="nombreBic">'.$marca." ".$modelo." ".$year.'</h3>';
                echo'<div class="imgContCard">';
                echo'<img src="/BicRobmvc/views/src/imgBicis/'.$fotoPrinc.'" alt="Imagen de la bicicleta" class="card-img-top text-center">';
                echo'</div>';
                echo'<p class="estatus">'.$estatus.'</p>';
                echo'<p class="fecha">'.$fecha_reg.'</p>';
                echo'<button type="button" class="btn btn-primary" onclick="window.location.href=\'/BicRobmvc/views/privadas/infoBic/infoBic.php?id_b='.$id_bic.'\'">Mas informacion</button>';
                echo'</div>';
                echo'</div>';
                
            }
        } else {
            $error = $bicisModel->conexion->errorInfo();
            throw new Exception('Error de conexión');
        }
    }

    public function selectU($id_u,$param,$orden){
        include_once(__DIR__ . '/../models/bicisModel.php');
        $resultado = array(); // Arreglo para almacenar los resultados
    
        if (!empty($id_u)) {
            $bicisModel = new bicisModel($this->conexion);
            $resultado_db = $bicisModel->obtenerBicis($id_u,$param,$orden);
    
            foreach ($resultado_db as $fila) {    
                $resultado[] = array(
                    'id_bic' => $fila["id_bic"],
                    'fotoPrinc' => $fila["img_prin"],
                    'num_serie' => $fila["num_serie"],
                    'marca' => $fila["marca"],
                    'modelo' => $fila["modelo"],
                    'talla' => $fila["talla"],
                    'year' => $fila["year"],
                    'rodada' => $fila["rodada"],
                    'estatus' => $fila["estatus"],
                    'fecha_reg' => $fila["fecha_reg"],
                    'comprobante' => $fila["comprobante"],
                );
            }
        } else {
            $error = $bicisModel->conexion->errorInfo();
            throw new Exception('Error de conexión');
        }
    
        return $resultado; // Devuelve el arreglo de resultados
    }
    
    public function insert(){
        error_log("Entre a insertar");
        include_once(__DIR__ . '/../models/bicisModel.php');
        $idu=$_POST["id_u"];
        $num_serie=$_POST["num_serie"];
        $marca=$_POST["marca"];
        $modelo=$_POST["modelo"];
        $talla=$_POST["talla"];
        $year=$_POST["year"];
        $rodada=$_POST["rodada"];
        $fecha_reg=date('Y-m-d');

        $rutaComprobantes=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/comprobantes'; //Ruta de almacenamiento de las facturas
        $rutaFotos=$_SERVER['DOCUMENT_ROOT'].'/BicRobmvc/views/src/imgBicis';

        $nomComprobante = $_FILES['comprobante']['tmp_name'];  //Nombre del archivo para el sistema
        $comprobante = $_FILES['comprobante']['name'];  //nombre del archivo
        $ext=explode('.',$comprobante); //quitamos la extencion
        $renom = "comprobante_".substr(sha1($comprobante.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
        
        $nomfComp=$renom.".".$ext[1]; //Unimos lo anterior para generar el nombre final

        $nomFotoPrin = $_FILES['fotoPrin']['tmp_name'];  //Nombre del archivo para el sistema
        $fotoPrin = $_FILES['fotoPrin']['name'];  //nombre del archivo
        $extFoto=explode('.',$fotoPrin); //quitamos la extencion
        $renomF = "fotoPrin_".substr(sha1($fotoPrin.time()), 0, 10); //Renombramos con el formato "factira_"+10caracteres aleatorios de tiempo
        
        $nomfFoto=$renomF.".".$extFoto[1]; //Unimos lo anterior para generar el nombre final

        $bicisModel = new bicisModel($this->conexion);
        $resultado = $bicisModel->insertarBici($nomfFoto,$num_serie,$marca,$modelo,$talla,$year,$rodada,$nomfComp,$fecha_reg,$idu);  

        if ($resultado) {
            move_uploaded_file($nomComprobante, $rutaComprobantes.'/'.$nomfComp); //Movemos el archivo a la ruta
            move_uploaded_file($nomFotoPrin, $rutaFotos.'/'.$nomfFoto); //Movemos el archivo a la ruta
            //echo "El registro ha sido insertado exitosamente.";
          } else {
            //echo "Ha ocurrido un error al insertar el registro.";
          }
    }

    
    
}

try {
    $conexion = new Conexion();
    $biciController = new biciController($conexion);
} catch (Exception $e) {
    echo 'error'.$e->getMessage();
}




