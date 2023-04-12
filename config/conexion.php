<?php
class Conexion extends PDO{
  private $host;
  private $bd;
  private $usr;
  private $passw;
  private $puerto;
 
  public function __construct(){
      $config = parse_ini_file(__DIR__ . '/../config/config.ini');
      $this->host = $config['host'];
      $this->bd = $config['dbname'];
      $this->usr = $config['username'];
      $this->passw = $config['password'];
      $this->puerto = $config['port'];

      try{
          parent::__construct('mysql:host='.$this->host.';dbname='.$this->bd.';charset=utf8',$this->usr,$this->passw,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
      }catch(PDOException $e){
          echo 'error: '.$e->getMessage();
      }
  }
}
?>
