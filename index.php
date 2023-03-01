<?php 

require "vendor/autoload.php";

use TeatroJuares\Content\config\settings\sysConfig as sysConfig;

	$globalConfig = new sysConfig();
	$globalConfig->existController();

use TeatroJuares\Content\controlador\frontController as frontController;

	$frontController = new frontController($_REQUEST);

 ?>