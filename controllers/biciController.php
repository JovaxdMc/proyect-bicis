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
                $extra=$_POST["extra"];
                $this->selectIndex($extra);
            }else if($accion == 'selectIndexList'){
                $extra=$_POST["extra"];
                $this->selectIndexList($extra);
            }else if($accion == 'SelectRepJson'){
                $id = $_POST["id"];
                $param = $_POST["param"];
                $this->SelectRepJson( $id,$param);
            }else if($accion == 'SelectRepUsrJson'){
                $id_b = $_POST["id_b"];
                $this->SelectRepUsrJson($id_b);
            }else if($accion == 'updtNs'){
                $this->updtNs();
            }
        } else {
            // La clave 'accion' no está definida en $_GET
            // Se puede proporcionar un valor predeterminado o mostrar un mensaje de error
            //error_log("Error GET");
        }
    }

   
    public function SelectRepJson($id,$param){

        include_once(__DIR__ . '/../models/bicisModel.php');
        if (!empty($id)) {
            $bicisModel = new bicisModel($this->conexion);
            $resultado = $bicisModel->obtenerBiciReporteJson($id,$param);               
            echo json_encode($resultado);
            }else {
            $error = $bicisModel->conexion->errorInfo();
            throw new Exception('Error de conexión');
        }
    }
     public function updtNs(){
        $id_b = $_POST["id_b"];
        $ns = $_POST["ns"];
        include_once(__DIR__ . '/../models/bicisModel.php');
        $bicisModel = new bicisModel($this->conexion);
        $resultado = $bicisModel->editarNs($id_b,$ns);               
        // Decodificar la cadena JSON en una matriz PHP 

        
    }
    
    public function SelectRepUsrJson($id_b){

        include_once(__DIR__ . '/../models/bicisModel.php');
        if (!empty($id_b)) {
            $bicisModel = new bicisModel($this->conexion);
            $resultado = $bicisModel->obtenerUsrReporteJson($id_b);               
            // Decodificar la cadena JSON en una matriz PHP
            echo json_encode($resultado);
           
            }else {
            $error = $bicisModel->conexion->errorInfo();
            throw new Exception('Error de conexión');
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
                    echo '<button class="btn btn-danger" onclick="marcarRecuperada(\''.$id_bic.'\');">Marcar como recuperada</button>';
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
    public function selectIndex($extra){
        include_once(__DIR__ . '/../models/bicisModel.php');
            $bicisModel = new bicisModel($this->conexion);
            $resultado = $bicisModel->obtenerBicisReportadas($extra);           
            foreach ($resultado as $fila) {    
                $id_bic=$fila["id_bic"];
                $fotoPrinc=$fila["img_prin"];
                $marca=$fila["marca"];
                $modelo=$fila["modelo"];
                $talla=$fila["talla"];
                $year=$fila["year"];
                $rodada=$fila["rodada"];
                $fecha_rep=$fila["fecha_reporte"];
                $fecha_robo=$fila["fecha_robo"];
                $Estado=$fila["Estado"];
                $Municipio=$fila["Municipio"];

                

                echo'<div class="card-container">';
                echo'<div class="card bg-dark text-white border-secondary border border-2" style="width: 18rem;">';
                echo'<h3 class="nombreBic">'.$marca." ".$modelo." ".$year.'</h3>';
                echo'<div class="imgContCard">';
                echo'<img src="/BicRobmvc/views/src/imgBicis/'.$fotoPrinc.'" alt="Imagen de la bicicleta" class="card-img-top text-center">';
                echo'</div>';
                echo'<p class="">Fecha de reporte: '.$fecha_rep.'</p>';
                echo'<p class="">Fecha del robo: '.$fecha_robo.'</p>';
                echo'<p class="">Lugar donde se robo:</p>';
                echo'<p class="">'.$Municipio.' '.$Estado.'</p>';
                
                    echo'<button type="button" class="btn btn-primary" onclick="window.location.href=\'/BicRobmvc/views/privadas/infoBic/infoBic.php?id_b='.$id_bic.'\'">Mas informacion</button>';
                    //header('location: \BicRobmvc\views\privadas\Admin\indexAdmin\indexAdm.php');

                
                echo'</div>';
                echo'</div>';
                
            }
        
    }
    public function selectIndexList($extra){
            include_once(__DIR__ . '/../models/bicisModel.php');
                $bicisModel = new bicisModel($this->conexion);
                $resultado = $bicisModel->obtenerBicisReportadas($extra);           
                foreach ($resultado as $fila) {    
                    $id_bic=$fila["id_bic"];
                    $fotoPrinc=$fila["img_prin"];
                    $marca=$fila["marca"];
                    $modelo=$fila["modelo"];
                    $talla=$fila["talla"];
                    $year=$fila["year"];
                    $rodada=$fila["rodada"];
                    $fecha_rep=$fila["fecha_reporte"];
                    $fecha_robo=$fila["fecha_robo"];
                    $Estado=$fila["Estado"];
                    $Municipio=$fila["Municipio"];

                    echo '<li class="list-group-item mt-4">';
                    echo '<div class="row align-items-center">';
                    echo '<div class="row">';
                    echo '<div class="col-12">';
                    echo '<div class="row">';
                    echo '<div class="col-6">';
                    echo '<div class="col" style="text-align: start;">';
                    echo '<div class="col">';
                    echo '<div class="row mt-2">';
                    echo '<h1 class="nombreBic">' . $marca . " " . $modelo . " " . $year . '</h1>';
                    echo '</div>';
                    echo '<div class="row m-2">';
                    echo '<h4 class=""><b>Datos del reporte</b></h4>';
                    echo '<h5 class="">Fecha de reporte: ' . $fecha_rep . '</h5>';
                    echo '<h5 class="">Fecha del robo: ' . $fecha_robo . '</h5>';
                    echo '<h5 class="">Lugar donde se robó: ' . $Municipio . ' ' . $Estado . '</h5>';
                    echo '</div>';
                    echo '<div class="row m-2">';
                    echo '<button type="button" class="btn btn-primary" onclick="window.location.href=\'/BicRobmvc/views/privadas/infoBic/infoBic.php?id_b=' . $id_bic . '\'">Ver detalles</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="col-6">';
                    echo '<img src="/BicRobmvc/views/src/imgBicis/' . $fotoPrinc . '" alt="Imagen de la bicicleta" class="card-img-top">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</li>';

                    

                    //header('location: \BicRobmvc\views\privadas\Admin\indexAdmin\indexAdm.php');

        
                    
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