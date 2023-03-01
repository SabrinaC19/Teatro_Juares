<?php 

namespace TeatroJuares\Content\controlador;

use TeatroJuares\Content\config\settings\sysConfig as sysConfig;

session_start();

class frontController extends sysConfig {

	private $url;
	private $directory;
	private $controller;

	public function __construct ($request) {

		if (isset($_REQUEST["url"])) {
				$this->url = $_REQUEST["url"];
				$objSys = new sysConfig();
				$this->directory = $objSys->_Dir_();
				$this->controller = $objSys->_Contro_();
				$this->_ValidateURL();
			}
			else{
				die("<script>location='?url=home'</script>");
			}
	}

	private function _ValidateURL(){

		$validar = preg_match_all("/^[a-zA-Z0-9-@\/.=:_#$ ]{1,700}$/", $this->url);

		if ($validar == true) {
			
			$this->_loadPage($this->url);
		
		} else {

			die("Ingresa una URL valida");
		}
	}

	private function _loadPage($url) {

		if (file_exists($this->directory.$url.$this->controller)) {
			
			require_once($this->directory.$url.$this->controller);
		
		} else {

			$url = "inicio";

			if(file_exists($this->directory.$url.$this->controller)){

				die("<script>location='?url=inicio'</script>");

			} else{

				die("<script>location='?url=error'</script>");
				}
		} 
	}

}

 ?>