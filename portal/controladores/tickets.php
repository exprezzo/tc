<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/ticket_modelo.php';
class tickets extends Controlador{
	var $modelo="ticket";
	var $campos=array('fechasinc','tienda','clave','fecha','hora','subtotal','iva','total','cliente','estatus','factura','efectivo','vales','cheques','otros','descuento','cortecaja','clientenombre','cxcob','usuario','vendedor','colonia','dolares','tipocambio','clavevale','sinc','id');
	var $pk="id";
	var $nombre="tickets";
	
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