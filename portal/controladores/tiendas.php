<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/tienda_modelo.php';
class tiendas extends Controlador{
	var $modelo="tienda";
	var $campos=array('clave','tienda');
	var $pk="clave";
	var $nombre="tiendas";
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function guardar(){
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>