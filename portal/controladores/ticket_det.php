<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/ticket_det_modelo.php';
class ticket_det extends Controlador{
	var $modelo="ticket_det";
	var $campos=array('fechasinc','tienda','clave','numero','primario','cantidad','costo','precio','descripcion','folio','modo','mecanico','nivel','factor','cantidad1','cantidad2','iva','unidadfactor','costopromedio','descuento','nivelprecio','espera','precioiva','resurtido','sinc');
	var $pk="clave";
	var $nombre="ticket_det";
	
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