<?php
class articulosModelo extends Modelo{
	var $tabla="articulos";
	var $campos=array('clave','clavesecundaria','nombre','grupo','presentacion','depto','dcategoria','tipo','ultimoproveedor','costo','precio1','precio2','precio3','precio4','precio5','talla','descuentomax','ultimaconsulta','reorden','reordendes','utilidadventa','utilidadventa2','utilidadventa3','utilidadventa4','utilidadventa5','utilidadventa1sis','utilidadventa2sis','utilidadventa3sis','utilidadventa4sis','utilidadventa5sis','utilidadFactor','utilidadFactorsis','IVA','FactorConv','UnidadConv','CostoPromedio','PrecioFactor','ExistenciaF','subgrupo','subMarcas','Emaxima');
	var $pk="clave";
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	function guardar($params){
		return parent::guardar($params);
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::buscar($params);
	}
}
?>