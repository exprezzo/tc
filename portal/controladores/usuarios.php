<?php
require_once '../modulos/backend/controladores/usuarios.php';
class usuarios2 extends Usuarios{
	var $modelo="usuario";
	var $campos=array('id','nick','pass','email','rol','fbid','name','picture','originalName');
	var $pk="id";
	var $nombre="usuarios";		
}
?>