<?php

	namespace TeatroJuares\Content\modelo;

	use TeatroJuares\Content\config\connect\connectDB as connectDB;

	class clientesModelo extends connectDB{

		private $cedula;
		private $nombre;
		private $apellido;
		private $email;

		private $conex;

		public function __construct(){
			parent::__construct();

			$this->conex = parent::activeDB();
		}

		public function mostrarClientes(){

			$consulta = $this->conex->prepare("SELECT * FROM `tblclientes`");
			$consulta->execute();
			$resultado = $consulta->fetchAll();

			return $resultado;
		}


	}




?>