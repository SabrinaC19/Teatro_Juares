<?php 

  namespace TeatroJuares\Content\modelo;

  use TeatroJuares\Content\config\connect\connectDB as connectDB;
  use \PDO;
  use \PDOException;
  use TeatroJuares\Content\modelo\reporteModelo as reporteModelo;

class eventoModelo extends connectDB{

   private $conex;

    // variable de eventos //

    private $nroEvento; 
    private $nombreEvento; 
    private $director;
    private $fechaEvento;
    private $horaEventoIni;
    private $horaEventoFin;
    private $categoriaEvento; 
    private $descripcion;
    private $imagenEvento;
    private $patioEstado;
    private $palcosEstado;
    private $galeriaEstado;

    private $precioPat;
    private $precioPal;
    private $precioGal;

    private $asientosPat;
    private $asientosPal;
    private $asientosGal;
    private $asientosActuPat;
    private $asientosActuPal;
    private $asientosActuGal;

    // variables de categorias //

    private $nroCategoria; 
    private $nombreCategoria;

    public function __construct(){

        parent::__construct();

        $this->conex = parent::activeDB();
    }

   // Validar evento //

    private function validarEvento($nombre, $director, $fecha, $horaIni, $horaFin, $categoria, 
    $descripcion, $foto, $patioCheck, $palcosCheck, $galeriaCheck){

      if(preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.\-¡!¿?]{1,20}$/", $nombre)){

        $validarBD = $this->conex->prepare("SELECT `nombre` FROM `tbleventos` WHERE `estadoEvento` =  1 and `nombre` = ?");

        $validarBD->bindValue(1, $nombre);

        $validarBD->execute();

        $validarNombreEvento = $validarBD->fetchAll();

        if (isset($validarNombreEvento[0])){ 

            $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Ya hay un evento que se encuentra registrado con ese nombre');
            echo json_encode($respuesta);
            die();
        }
        else{
  
          $this->nombreEvento= $nombre;
        }
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en el nombre del evento');
        echo json_encode($respuesta);
        die();
      }

      if(preg_match_all("/^[a-zA-ZÀ-ÿ\ \u00f1\u00d1]{1,20}$/", $director) || $director == ""){

        if($director == ""){

          $this->director = "No hay director";
        }
        else{
          
          $this->director = $director; 
        }
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en el director del evento');
        echo json_encode($respuesta);
        die();
      }

      if(strtotime($fecha) > strtotime(date("Y-m-d"))){

        $this->fechaEvento = $fecha;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la fecha del evento');
        echo json_encode($respuesta);
        die();
      }

      if($horaIni != null){

        $horaSeg = ((substr($horaIni,0, 2) * 60)*60) + (substr($horaIni, 3, 5)* 60);
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de inicio del evento');
        echo json_encode($respuesta);
        die();
      }

      if (28800 <= $horaSeg && $horaSeg < 79200){

        $this->horaEventoIni = $horaIni;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de inicio del evento');
        echo json_encode($respuesta);
        die();
      }

      if($horaFin != null){

        $horaSegFin = ((substr($horaFin,0, 2) * 60)*60) + (substr($horaFin, 3, 5)* 60);
      }
      else{


        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" =>  'Error en la hora de finalización del evento');
        echo json_encode($respuesta);
        die();
      }

      if (28800 <= $horaSegFin && $horaSegFin < 79200 && $horaSegFin >= $horaSeg){

        $this->horaEventoFin = $horaFin;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de finalización del evento');
        echo json_encode($respuesta);
        die();
      }

      $validarBD = $this->conex->prepare("SELECT  `fechaEvento`, `horaInicio`, `horaFinal` FROM `tbleventos` WHERE `estadoEvento` =  1 and `fechaEvento` = ?");

      $validarBD->bindValue(1, $fecha);
    
      $validarBD->execute();

      $validarFechaEvento = $validarBD->fetchAll();

      if (isset($validarFechaEvento[0])){

        foreach($validarFechaEvento as $datos){

          if($datos['horaInicio'] <= $horaIni &&  $horaIni <= $datos['horaFinal']){

          $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de inicio del evento. Ya hay un evento programado a esa hora');
          echo json_encode($respuesta);
          die();
          }

          if($datos['horaInicio'] <= $horaFin &&  $horaFin <= $datos['horaFinal']){

            $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de Finalización del evento. Ya hay un evento programado a esa hora');
            echo json_encode($respuesta);
            die();
          }
        }
      }

      if($categoria != 0){

        $this->categoriaEvento = $categoria; 
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'No se selecciono una categoria');
        echo json_encode($respuesta);
        die();
      }

      if(10 < strlen($descripcion) && strlen($descripcion) <150){

        $this->descripcion = $descripcion;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la descripción del evento');
        echo json_encode($respuesta);
        die();
      }

      $this->imagenEvento = $foto;

      if($patioCheck != null){

        $this->patioEstado = 1;
      }
      else{

        $this->patioEstado = 0;
      }

      if($palcosCheck != null){

        $this->palcosEstado = 1;
      }
      else{

        $this->palcosEstado = 0;
      }

      if($galeriaCheck != null){

        $this->galeriaEstado = 1;
      }
      else{

        $this->galeriaEstado = 0;
      }
    }

    private function validarEventoU($nombre, $director, $fecha, $horaIni, $horaFin, $categoria, 
    $descripcion, $foto, $patioCheck, $palcosCheck, $galeriaCheck){

      if(preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.\-¡!¿?]{1,20}$/", $nombre)){
        
        $this->nombreEvento= $nombre;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en el nombre del evento');
        echo json_encode($respuesta);
        die();
      }

      if(preg_match_all("/^[a-zA-ZÀ-ÿ\ \u00f1\u00d1]{1,20}$/", $director) || $director == ""){

        if($director == ""){

          $this->director = "No hay director";
        }
        else{
          
          $this->director = $director; 
        }
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en el director del evento');
        echo json_encode($respuesta);
        die();
      }

      if(strtotime($fecha) >= strtotime(date("Y-m-d"))){

        $this->fechaEvento = $fecha;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la fecha del evento');
        echo json_encode($respuesta);
        die();
      }

      $this->horaEventoIni = $horaIni;
      
      $this->horaEventoFin = $horaFin;
      
      $validarBD = $this->conex->prepare("SELECT  `nroEvento`, `fechaEvento`, `horaInicio`, `horaFinal` FROM `tbleventos` WHERE `estadoEvento` =  1 and `fechaEvento` = ?");
      $validarBD->bindValue(1, $fecha);
      $validarBD->execute();

      $validarFechaEvento = $validarBD->fetchAll();

      if (isset($validarFechaEvento[0])){

        foreach($validarFechaEvento as $datos){

          if($datos['horaInicio'] <= $horaIni &&  $horaIni <= $datos['horaFinal'] && $datos['nroEvento'] != $this->nroEvento){

          $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de inicio del evento. Ya hay un evento programado a esa hora');
          echo json_encode($respuesta);
          die();
          }

          if($datos['horaInicio'] <= $horaFin &&  $horaFin <= $datos['horaFinal'] && $datos['nroEvento'] != $this->nroEvento){

            $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la hora de Finalización del evento. Ya hay un evento programado a esa hora');
            echo json_encode($respuesta);
            die();
          }
        }
      }

      if($categoria != 0){

        $this->categoriaEvento = $categoria; 
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'No se selecciono una categoria');
        echo json_encode($respuesta);
        die();
      }

      if(10 < strlen($descripcion) && strlen($descripcion) <150){

        $this->descripcion = $descripcion;
      }
      else{

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => 'Error en la descripción del evento');
        echo json_encode($respuesta);
        die();
      }

      $this->imagenEvento = $foto;

      if($patioCheck != null){

        $this->patioEstado = 1;
      }
      else{

        $this->patioEstado = 0;
      }

      if($palcosCheck != null){

        $this->palcosEstado = 1;
      }
      else{

        $this->palcosEstado = 0;
      }

      if($galeriaCheck != null){

        $this->galeriaEstado = 1;
      }
      else{

        $this->galeriaEstado = 0;
      }
    }

    // insertar evento //

    public function getCEvento($nombre, $director, $fecha, $horaIni, $horaFin, $categoria, 
    $descripcion, $foto, $patioCheck, $palcosCheck, $galeriaCheck){
      
      $this->validarEvento($nombre, $director, $fecha, $horaIni, $horaFin, $categoria, 
      $descripcion, $foto, $patioCheck, $palcosCheck, $galeriaCheck);
      $this->insertarEvento();
    }

    private function insertarEvento(){

      try{

          $nuevoEvento = $this->conex->prepare("INSERT INTO `tbleventos`(`nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `imagenEvento`, `patioStatus`, `palcoStatus`, `galeriaStatus`, `estadoEvento`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
          $nuevoEvento->bindValue(1, $this->nombreEvento); 
          $nuevoEvento->bindValue(2, $this->descripcion); 
          $nuevoEvento->bindValue(3, $this->fechaEvento); 
          $nuevoEvento->bindValue(4, $this->horaEventoIni); 
          $nuevoEvento->bindValue(5, $this->horaEventoFin); 
          $nuevoEvento->bindValue(6, $this->categoriaEvento); 
          $nuevoEvento->bindValue(7, $this->director); 
          $nuevoEvento->bindValue(8, $this->imagenEvento);
          $nuevoEvento->bindValue(9, $this->patioEstado); 
          $nuevoEvento->bindValue(10, $this->palcosEstado);  
          $nuevoEvento->bindValue(11, $this->galeriaEstado);
          $nuevoEvento->bindValue(12, 1);    
          $nuevoEvento->execute(); 

          $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "El evento fue creado exitosamente");
          echo json_encode($respuesta);
          die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      } 
    }

    // consultar eventos //

    public function consultarEvento(){

      try{
        
        $consultarEvento = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `director`, `imagenEvento`, tblcategoria.nombreCategoria FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `estadoEvento` = 1;");
        $consultarEvento->execute();

        $respuesta = $consultarEvento->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

    // actualizar evento //

    public function actualizarEventoBuscar($id){

      try{

        $buscar = $this->conex->prepare("SELECT * FROM `tbleventos` WHERE `estadoEvento` = 1 AND `nroEvento`= ? ");

        $buscar->bindValue(1, $id); 
        
        $buscar->execute(); 
        $respuesta = $buscar->fetchAll(PDO::FETCH_ASSOC);
  
        echo json_encode($respuesta);

        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

    public function getUEvento($id, $nombre, $director, $fecha, $horaIni, $horaFin, $categoria, 
    $descripcion, $foto, $patioCheck, $palcosCheck, $galeriaCheck){
      
      $this->nroEvento = $id;
      $this->validarEventoU($nombre, $director, $fecha, $horaIni, $horaFin, $categoria, 
      $descripcion, $foto, $patioCheck, $palcosCheck, $galeriaCheck);
      $this->actualizarEvento();
    }

    private function actualizarEvento(){
      
      try{

        $actuEvento = $this->conex->prepare("UPDATE `tbleventos` SET `nombre`= ?,`descripcion`= ?,`fechaEvento`= ?,`horaInicio`= ?,`horaFinal`= ?,`categoriaEvento`= ?,`director`= ?,`imagenEvento`= ?, `patioStatus`= ?, `palcoStatus`= ?, `galeriaStatus`= ? WHERE `estadoEvento` = 1 AND `nroEvento`= ?");

        $actuEvento->bindValue(1, $this->nombreEvento); 
        $actuEvento->bindValue(2, $this->descripcion); 
        $actuEvento->bindValue(3, $this->fechaEvento); 
        $actuEvento->bindValue(4, $this->horaEventoIni); 
        $actuEvento->bindValue(5, $this->horaEventoFin); 
        $actuEvento->bindValue(6, $this->categoriaEvento); 
        $actuEvento->bindValue(7, $this->director); 
        $actuEvento->bindValue(8, $this->imagenEvento);
        $actuEvento->bindValue(9, $this->patioEstado); 
        $actuEvento->bindValue(10, $this->palcosEstado);  
        $actuEvento->bindValue(11, $this->galeriaEstado);
        $actuEvento->bindValue(12, $this->nroEvento);    
        $actuEvento->execute(); 

        $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "El evento fue actualizado exitosamente");
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }    

    // eliminar evento //

    public function getDeventos($id){

      $this->nroEvento = $id;
      
      $this->eliminarEvento();
    }

    private function eliminarEvento(){
      
      try{

        $elimEvento = $this->conex->prepare("UPDATE `tbleventos` SET `estadoEvento`='0' WHERE `estadoEvento` = 1 AND `nroEvento` = ?");
        $elimEvento->bindValue(1, $this->nroEvento); 
        $elimEvento->execute(); 

        $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "El evento fue eliminado exitosamente");
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

    // cantidad eventos //

    public function nroEventos(){

      try{
        
        $cantEvento = $this->conex->prepare("SELECT COUNT(*) FROM `tbleventos`");
        $cantEvento->execute();
  
        $respuesta = array("nro" => current($cantEvento->fetch()));
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){
  
        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

    // consultar asientos //

    public function consultarAsientos($id){

      try{

        $buscarStatus = $this->conex->prepare("SELECT `nroEvento`, `patioStatus`, `palcoStatus`, `galeriaStatus` FROM `tbleventos` WHERE `estadoEvento` = 1 AND `nroEvento`= ? ");

        $buscarStatus->bindValue(1, $id); 
        
        $buscarStatus->execute(); 
        $respuestaStatus = $buscarStatus->fetchAll(PDO::FETCH_ASSOC);

        $consultarAsientos = $this->conex->prepare("SELECT  `precioArea`, `codAsiento` FROM `tblasientosdisponible` WHERE
        `numEvento` = ? AND `estado` = 1");

        $consultarAsientos->bindValue(1, $id);

        $consultarAsientos->execute();
        $asientoEncontrado = $consultarAsientos->fetchAll(PDO::FETCH_ASSOC);

        if(isset($asientoEncontrado[0])){

          $respuesta = array($respuestaStatus, $asientoEncontrado);
          echo json_encode($respuesta);
          die();
        }
        else{

          echo json_encode($respuestaStatus);
          die();
        }
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

    // actualizar asientos //

    public function getUAsientos($id, $precioPat, $precioPal, $precioGal, $asientosPat,
    $asientosPal, $asientosGal, $asientosActuPat, $asientosActuPal, $asientosActuGal){
      
      $this->nroEvento = $id;
      $this->precioPat = $precioPat;
      $this->precioPal = $precioPal;
      $this->precioGal = $precioGal;
      $this->asientosPat = $asientosPat;
      $this->asientosPal = $asientosPal;
      $this->asientosGal = $asientosGal;
      $this->asientosActuPat = $asientosActuPat;
      $this->asientosActuPal = $asientosActuPal;
      $this->asientosActuGal = $asientosActuGal;

      $this->actualizarAsientos();
    }

    private function actualizarAsientos(){
      
      try{

        if($this->asientosPat != 0){

          foreach($this->asientosPat as $asiento){

            $verificarAsientosReg = $this->conex->prepare("SELECT `estado`, `precioArea`, `codAsiento`, `numEvento` FROM `tblasientosdisponible` WHERE
            `numEvento` = ? AND `codAsiento` = ?");

            $verificarAsientosReg->bindValue(1, $this->nroEvento);
            $verificarAsientosReg->bindValue(2, $asiento);

            $verificarAsientosReg->execute();

            $asientoEncontrado = $verificarAsientosReg->fetchAll();

            if(isset($asientoEncontrado[0])){

              $actuPatio= $this->conex->prepare("UPDATE `tblasientosdisponible` SET `estado`= ? ,`precioArea`= ? WHERE
              `numEvento` = ? AND `codAsiento` = ?");

              $actuPatio->bindValue(1, 1); 
              $actuPatio->bindValue(2, $this->precioPat); 
              $actuPatio->bindValue(3, $this->nroEvento);  
              $actuPatio->bindValue(4, $asiento); 

              $actuPatio->execute();
            }
            else{

              $insertPatio= $this->conex->prepare("INSERT INTO `tblasientosdisponible`(`estado`, `precioArea`, `codAsiento`, `numEvento`) VALUES (?,?,?,?)");

              $insertPatio->bindValue(1, 1); 
              $insertPatio->bindValue(2, $this->precioPat); 
              $insertPatio->bindValue(3, $asiento); 
              $insertPatio->bindValue(4, $this->nroEvento);  
              
              $insertPatio->execute(); 
            }
          }
        }

        if($this->asientosActuPat != 0){

          foreach($this->asientosActuPat as $asiento){

            $desPatio= $this->conex->prepare("UPDATE `tblasientosdisponible` SET `estado`= ? ,`precioArea`= ? WHERE
            `numEvento` = ? AND `codAsiento` = ? AND `estado`= 1");

            $desPatio->bindValue(1, 0); 
            $desPatio->bindValue(2, $this->precioPat); 
            $desPatio->bindValue(3, $this->nroEvento);  
            $desPatio->bindValue(4, $asiento); 

            $desPatio->execute(); 
          }
        }

        if($this->asientosPal != 0){

          foreach($this->asientosPal as $asiento){

            $verificarAsientosReg = $this->conex->prepare("SELECT `estado`, `precioArea`, `codAsiento`, `numEvento` FROM `tblasientosdisponible` WHERE
            `numEvento` = ? AND `codAsiento` = ?");

            $verificarAsientosReg->bindValue(1, $this->nroEvento);
            $verificarAsientosReg->bindValue(2, $asiento);

            $verificarAsientosReg->execute();

            $asientoEncontrado = $verificarAsientosReg->fetchAll();

            if(isset($asientoEncontrado[0])){

              $actuPalcos= $this->conex->prepare("UPDATE `tblasientosdisponible` SET `estado`= ? ,`precioArea`= ? WHERE
              `numEvento` = ? AND `codAsiento` = ?");

              $actuPalcos->bindValue(1, 1); 
              $actuPalcos->bindValue(2, $this->precioPal); 
              $actuPalcos->bindValue(3, $this->nroEvento);  
              $actuPalcos->bindValue(4, $asiento); 

              $actuPalcos->execute();
            }
            else{

              $insertPalcos= $this->conex->prepare("INSERT INTO `tblasientosdisponible`(`estado`, `precioArea`, `codAsiento`, `numEvento`) VALUES (?,?,?,?)");

              $insertPalcos->bindValue(1, 1); 
              $insertPalcos->bindValue(2, $this->precioPal); 
              $insertPalcos->bindValue(3, $asiento); 
              $insertPalcos->bindValue(4, $this->nroEvento);  
              
              $insertPalcos->execute();
            }
          }
        }

        if($this->asientosActuPal != 0){

          foreach($this->asientosActuPal as $asiento){

            $desPalcos= $this->conex->prepare("UPDATE `tblasientosdisponible` SET `estado`= ? ,`precioArea`= ? WHERE
            `numEvento` = ? AND `codAsiento` = ? AND `estado`= 1");

            $desPalcos->bindValue(1, 0); 
            $desPalcos->bindValue(2, $this->precioPal); 
            $desPalcos->bindValue(3, $this->nroEvento);  
            $desPalcos->bindValue(4, $asiento); 

            $desPalcos->execute(); 
          }
        }

        if($this->asientosGal != 0){

          foreach($this->asientosGal as $asiento){

            $verificarAsientosReg = $this->conex->prepare("SELECT `estado`, `precioArea`, `codAsiento`, `numEvento` FROM `tblasientosdisponible` WHERE
            `numEvento` = ? AND `codAsiento` = ?");

            $verificarAsientosReg->bindValue(1, $this->nroEvento);
            $verificarAsientosReg->bindValue(2, $asiento);

            $verificarAsientosReg->execute();

            $asientoEncontrado = $verificarAsientosReg->fetchAll();

            if(isset($asientoEncontrado[0])){

              $actuGaleria= $this->conex->prepare("UPDATE `tblasientosdisponible` SET `estado`= ? ,`precioArea`= ? WHERE
              `numEvento` = ? AND `codAsiento` = ?");

              $actuGaleria->bindValue(1, 1); 
              $actuGaleria->bindValue(2, $this->precioGal); 
              $actuGaleria->bindValue(3, $this->nroEvento);  
              $actuGaleria->bindValue(4, $asiento); 

              $actuGaleria->execute();
            }
            else{

              $insertGaleria= $this->conex->prepare("INSERT INTO `tblasientosdisponible`(`estado`, `precioArea`, `codAsiento`, `numEvento`) VALUES (?,?,?,?)");

              $insertGaleria->bindValue(1, 1); 
              $insertGaleria->bindValue(2, $this->precioGal); 
              $insertGaleria->bindValue(3, $asiento); 
              $insertGaleria->bindValue(4, $this->nroEvento);  
              
              $insertGaleria->execute(); 
            }
          }
        }

        if($this->asientosActuGal != 0){

          foreach($this->asientosActuGal as $asiento){

            $desGaleria= $this->conex->prepare("UPDATE `tblasientosdisponible` SET `estado`= ? ,`precioArea`= ? WHERE
            `numEvento` = ? AND `codAsiento` = ? AND `estado`= 1");

            $desGaleria->bindValue(1, 0); 
            $desGaleria->bindValue(2, $this->precioGal); 
            $desGaleria->bindValue(3, $this->nroEvento);  
            $desGaleria->bindValue(4, $asiento); 

            $desGaleria->execute(); 
          }
        }

        $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "El evento fue actualizado exitosamente");
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }  

    // Generar reporte //

    public function reporteConsulta($fechaInicial, $fechaFinal, $categoria, $estado){

      if($fechaInicial != null && $fechaFinal != null){

        date_default_timezone_set("America/Caracas");
        $today = date('Y/m/d');

        if (strtotime($fechaInicial) >= strtotime($today)){

          return(
            "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                  icon: 'error',
                  title: 'Error en la fecha inicial'
                })
            </script>"
          );
        }
    
        if (strtotime($fechaFinal) > strtotime($today)){

          return(
            "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                  icon: 'error',
                  title: 'Error en la fecha Final'
                })
            </script>"
          );
        }

        if (strtotime($fechaInicial) > strtotime($fechaFinal)){

          return(
            "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                  icon: 'error',
                  title: 'La fecha inicial no puede ser mayor a la fecha Final'
                })
            </script>"
          );
        }

        if ($categoria == 0 && $estado == 2) {

          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `fechaEvento` BETWEEN ? AND ?");
          $reporte->bindValue(1, $fechaInicial); 
          $reporte->bindValue(2, $fechaFinal); 
        }
        elseif ($categoria != 0 && $estado == 2) {
          
          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `fechaEvento` BETWEEN ? AND ? AND `categoriaEvento` = ?");
          $reporte->bindValue(1, $fechaInicial); 
          $reporte->bindValue(2, $fechaFinal); 
          $reporte->bindValue(3, $categoria); 
        }
        elseif ($categoria == 0 && $estado != 2) {
          
          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `fechaEvento` BETWEEN ? AND ? AND `estadoEvento` = ?");
          $reporte->bindValue(1, $fechaInicial); 
          $reporte->bindValue(2, $fechaFinal); 
          $reporte->bindValue(3, $estado); 
        }
        elseif ($categoria != 0 && $estado != 2) {
          
          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `fechaEvento` BETWEEN ? AND ? AND `categoriaEvento` = ? AND `estadoEvento` = ?");
          $reporte->bindValue(1, $fechaInicial); 
          $reporte->bindValue(2, $fechaFinal); 
          $reporte->bindValue(3, $categoria); 
          $reporte->bindValue(4, $estado); 
        }
        else{

          return(
            "<script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.addEventListener('mouseenter', Swal.stopTimer)
                      toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                  icon: 'error',
                  title: 'No se ha podido generar el reporte'
                })
            </script>"
          );
        }
      }
      else{

        if ($categoria == 0 && $estado == 2) {

          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria");
        }
        elseif ($categoria != 0 && $estado == 2) {
          
          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `categoriaEvento` = ?");
          $reporte->bindValue(1, $categoria); 
        }
        elseif ($categoria == 0 && $estado != 2) {
          
          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `estadoEvento` = ?");
          $reporte->bindValue(1, $estado); 
        }
        elseif ($categoria != 0 && $estado != 2) {
          
          $reporte = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `descripcion`, `fechaEvento`, `horaInicio`, `horaFinal`, `categoriaEvento`, `director`, `estadoEvento`, `nombreCategoria` FROM `tbleventos` INNER JOIN tblcategoria ON tbleventos.categoriaEvento = tblcategoria.idCategoria WHERE `categoriaEvento` = ? AND `estadoEvento` = ?");
          $reporte->bindValue(1, $categoria); 
          $reporte->bindValue(2, $estado); 
        }
        else{

          return(
            "<script>
              const Toast = Swal.mixin({
                toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  timerProgressBar: true,
                  didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
              })

              Toast.fire({
                icon: 'error',
                title: 'No se ha podido generar el reporte''
              })
            </script>"
          );
        }
      }

    
      $reporte->execute();
    
      $respuesta = $reporte->fetchAll();

      if(isset($respuesta[0])){

        $pdf = new reporteModelo("L");
        $pdf->setTitle("Reporte de Eventos");

        return $pdf->crearReporteEventos($respuesta);
      }
      else{

        return(
          "<script>
            const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      }
            })

            Toast.fire({
              icon: 'error',
              title: 'No se encontraron datos para crear el reporte'
            })
          </script>"
        );
      }
    }

    // TABLA CATEGORIAS //

  // validar categoria //

    private function validarCategoria($nombre){

      if(preg_match_all("/^[a-zA-ZÀ-ÿ\u00f1\u00d10-9_\ \.\-¡!¿?]{1,20}$/", $nombre)){ 

          $validarBD = $this->conex->prepare("SELECT `nombreCategoria` FROM `tblcategoria` WHERE `status` = 1 AND `nombreCategoria` = ?");
          $validarBD->bindValue(1, $nombre);
          $validarBD->execute();

          $validarCategorias = $validarBD->fetchAll();      

          if (isset($validarCategorias[0])){

              $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => "La categoría se encuentra registrada");
              echo json_encode($respuesta);
              die();
          }
          else{

            $this->nombreCategoria = $nombre;
          }
      }
      else{

          $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => "Error en el nombre de la categoría");
          echo json_encode($respuesta);
          die();
      }
    }

  // insertar categoria //

    public function getCCategoria($nombre){
      
      $this->validarCategoria($nombre);
      $this->insertarCategoria();
    }

    private function insertarCategoria(){

      try{

          $nuevaCategoria = $this->conex->prepare("INSERT INTO `tblcategoria`(`nombreCategoria`, `status`) VALUES (?, ?)");
          $nuevaCategoria->bindValue(1, $this->nombreCategoria); 
          $nuevaCategoria->bindValue(2, 1);   
          $nuevaCategoria->execute(); 

          $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "La categoría fue creada exitosamente");
          echo json_encode($respuesta);
          die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      } 
    }

  // Consultar categorias //

    public function consultarCategorias(){

      try{
        
        $categorias = $this->conex->prepare("SELECT * FROM `tblcategoria` WHERE `status` = 1");
        $categorias->execute();

        $respuesta = $categorias->fetchAll(\PDO::FETCH_OBJ);
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        return $error;
      }
    }

  // Actualizar categoria //

    public function actualizarCategBuscar($id){

      try{

        $buscar = $this->conex->prepare("SELECT * FROM `tblcategoria` WHERE `status` = 1 AND `idCategoria`= ? ");

        $buscar->bindValue(1, $id); 
        
        $buscar->execute(); 
        $respuesta = $buscar->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($respuesta);

        die();
      }
      catch(\exception $error){

        return $error;
      }
    }

    public function getUCategoria($id, $nombre){
      
      $this->nroCategoria = $id;
      $this->validarCategoria($nombre);
      $this->actualizarCategoria();
    }

    private function actualizarCategoria(){

      try{

        $actuCategoria = $this->conex->prepare("UPDATE `tblcategoria` SET `nombreCategoria`= ? WHERE `status` = 1 AND `idCategoria`= ?");
        $actuCategoria->bindValue(1, $this->nombreCategoria);
        $actuCategoria->bindValue(2, $this->nroCategoria);    
        $actuCategoria->execute(); 

        $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "La categoría fue actualizada exitosamente");
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

   // Eliminar categoria //

    public function getDCategoria($id){

      $this->nroCategoria = $id;
      
      $this->eliminarCategoria();
    }

    private function eliminarCategoria(){

      try{

        $elimCategoria = $this->conex->prepare("UPDATE `tblcategoria` SET `status`= 0 WHERE `status`= 1 AND `idCategoria`= ?");
        $elimCategoria->bindValue(1, $this->nroCategoria); 
        $elimCategoria->execute(); 

        $respuesta = array("status" => 1, "tipo" => "success", "mensaje" => "La categoría fue eliminada exitosamente");
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }

  // cantidad categorias //

    public function nroCategorias(){

      try{
        
        $cantCategoria = $this->conex->prepare("SELECT COUNT(*) FROM `tblcategoria`");
        $cantCategoria->execute();

        $respuesta = array("nro" => current($cantCategoria->fetch()));
        echo json_encode($respuesta);
        die();
      }
      catch(\exception $error){

        $respuesta = array("status" => 2, "tipo" => "error", "mensaje" => error);
        echo json_encode($respuesta);
        die();
      }
    }


  // cartelera eventos //

    public function mostrarCartelera(){

        $mostrar = $this->conex->prepare("SELECT `nroEvento`, `nombre`, `fechaEvento`, `horaInicio`, `categoriaEvento`, tblcategoria.nombreCategoria  FROM `tbleventos` INNER JOIN `tblCategoria` ON  tblCategoria.idCategoria = `categoriaEvento` WHERE `estadoEvento` = 1");
        $mostrar->execute();
        $verCartelera = $mostrar->fetchAll();

        return $verCartelera;
    }

    public function getEvento($id){

      $query = $this->conex->prepare("SELECT *, tblcategoria.nombreCategoria FROM `tbleventos` INNER JOIN `tblCategoria` ON tblCategoria.idCategoria = `categoriaEvento` WHERE `nroEvento` = ?");
      $query->bindValue(1, $id);
      $query->execute();
      $evento = $query->fetchAll();
      return $evento;

    }
  }
?>
