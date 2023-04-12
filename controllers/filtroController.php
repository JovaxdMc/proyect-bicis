<?php
include_once(__DIR__ . '/../config/conexion.php');

class filtroController {
    public function __construct($conexion) {
        $this->conexion = $conexion;
        if (isset($_GET['accion'])){
            $accion=$_GET['accion'];
            if ($accion == 'llenarMarca') {
               $this->llenarMarca();
            }else if ($accion == 'llenarEstados') {
                $this->llenarEstados();
             }if ($accion == 'llenarMunicipios') {
                $this->llenarMunicipios();
             }
        } else {
            // La clave 'accion' no está definida en $_GET
            // Se puede proporcionar un valor predeterminado o mostrar un mensaje de error
            //error_log("Error GET");
        }
    }

    public function llenarMarca(){
        include_once(__DIR__ . '/../models/bicisModel.php');
            $bicisModel = new bicisModel($this->conexion);
            ob_start(); // Iniciar el almacenamiento en búfer de salida
            $resultado = $bicisModel->obtenerMarcas(); 
            echo '<option value="def">-----------</option>';          
            foreach ($resultado as $fila) {    
                echo '<option value="' . $fila["marca"] . '">' . $fila["marca"] . '</option>';
            }
            $html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo
            //error_log($html);
            echo $html;
    } 
    public function llenarEstados(){
        include_once(__DIR__ . '/../models/reporteModel.php');
            $reporteModel = new reporteModel($this->conexion);
            ob_start(); // Iniciar el almacenamiento en búfer de salida
            $resultado = $reporteModel->obtenerEstados(); 
            echo '<option value="def">-----------</option>';          
            foreach ($resultado as $fila) {    
                echo '<option value="' . $fila["Estado"] . '">' . $fila["Estado"] . '</option>';
            }
            $html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo
            //error_log($html);
            echo $html;
    } 
    public function llenarMunicipios(){
        include_once(__DIR__ . '/../models/reporteModel.php');
            $reporteModel = new reporteModel($this->conexion);
            ob_start(); // Iniciar el almacenamiento en búfer de salida
            $resultado = $reporteModel->obtenerMunicipios(); 
            echo '<option value="def">-----------</option>';          
            foreach ($resultado as $fila) {    
                echo '<option value="' . $fila["Municipio"] . '">' . $fila["Municipio"] . '</option>';
            }
            $html = ob_get_clean(); // Obtener el contenido del búfer y limpiarlo
            //error_log($html);
            echo $html;
    }

    
    
}

try {
    $conexion = new Conexion();
    $filtroController = new filtroController($conexion);
} catch (Exception $e) {
    echo 'error :'.$e->getMessage();
}