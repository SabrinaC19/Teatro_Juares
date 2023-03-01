<?php 

  namespace TeatroJuares\Content\modelo;

  use TeatroJuares\Content\config\connect\connectDB as connectDB;


class dashboardModelo extends connectDB{

  private $conex;

    public function __construct(){

        parent::__construct();

        $this->conex = parent::activeDB();
    }

    public function nroPersonal(){

        try{
          
          $cantPersonal = $this->conex->prepare("SELECT COUNT(*) FROM `tblusuarios` WHERE `rol_Id` = 2 OR `rol_Id` = 3 OR `rol_Id` = 4");
          $cantPersonal->execute();
  
          return current($cantPersonal->fetch());
        }
        catch(exception $error){
  
          return $error;
        }
    }

    public function nroClientes(){

        try{
          
          $cantClientes = $this->conex->prepare("SELECT COUNT(*) FROM `tblclientes`");
          $cantClientes->execute();
  
          return current($cantClientes->fetch());
        }
        catch(exception $error){
  
          return $error;
        }
    }  

    public function nroEventos(){

      try{
        
        $cantEvento = $this->conex->prepare("SELECT COUNT(*) FROM `tbleventos`");
        $cantEvento->execute();

        return current($cantEvento->fetch());
      }
      catch(exception $error){

        return $error;
      }
    }

    public function nroCompras(){

        try{
          
          $cantVentas = $this->conex->prepare("SELECT COUNT(*) FROM `tblcompras`");
          $cantVentas->execute();
  
          return current($cantVentas->fetch());
        }
        catch(exception $error){
  
          return $error;
        }
    }

    public function getMostrarCita() {

      return $this->mostrarCita();
    }

    private function mostrarCita() {

      $vista = $this->conex->prepare("SELECT `nroCita`, `nombreEvento`, `servicio`, `fechaCita`, `horaCita` FROM `tblcitasreservacion` WHERE `estadoCita` = 2 AND `fechaCita` >= CURDATE() ORDER BY `fechaCita`, `horaCita` ASC LIMIT 3");

      $vista->execute();

      $consultarCita = $vista->fetchAll();

      return $consultarCita;

    } 
}

?>