<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/articulos_modelo.php';
class articulos extends Controlador{
	var $modelo="articulos";
	var $campos=array('clave','clavesecundaria','nombre','grupo','presentacion','depto','dcategoria','tipo','ultimoproveedor','costo','precio1','precio2','precio3','precio4','precio5','talla','descuentomax','ultimaconsulta','reorden','reordendes','utilidadventa','utilidadventa2','utilidadventa3','utilidadventa4','utilidadventa5','utilidadventa1sis','utilidadventa2sis','utilidadventa3sis','utilidadventa4sis','utilidadventa5sis','utilidadFactor','utilidadFactorsis','IVA','FactorConv','UnidadConv','CostoPromedio','PrecioFactor','ExistenciaF','subgrupo','subMarcas','Emaxima');
	var $pk="clave";
	var $nombre="articulos";
	
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