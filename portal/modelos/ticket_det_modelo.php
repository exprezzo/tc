<?php
class ticket_detModelo extends Modelo{
	var $tabla="tick_det";
	var $campos=array('fechasinc','tienda','clave','numero','primario','cantidad','costo','precio','descripcion','folio','modo','mecanico','nivel','factor','cantidad1','cantidad2','iva','unidadfactor','costopromedio','descuento','nivelprecio','espera','precioiva','resurtido','sinc');
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