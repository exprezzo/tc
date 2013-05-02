<?php
class ticketModelo extends Modelo{
	var $tabla="tick_int";
	var $campos=array('fechasinc','tienda','clave','fecha','hora','subtotal','iva','total','cliente','estatus','factura','efectivo','vales','cheques','otros','descuento','cortecaja','clientenombre','cxcob','usuario','vendedor','colonia','dolares','tipocambio','clavevale','sinc','id');
	var $pk="id";
	
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