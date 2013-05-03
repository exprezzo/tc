<?php
require_once '../modulos/backend/controladores/usuarios.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/rol_modelo.php';

class usuarios2 extends Usuarios{
	var $modelo="usuario";
	var $campos=array('id','nick','pass','email','rol','fbid','name','picture','originalName');
	var $pk="id";
	var $nombre="usuarios";
	
	function login($username=null, $pass=null){		
		global $_LOGIN_REDIRECT_PATH;
		global $_APP_PATH;
		if (  isset($_SESSION['isLoged']) && $_SESSION['isLoged']===true ){			
			// echo 'asd'.$_LOGIN_REDIRECT_PATH;
			// echo $_APP_PATH.'<br>'.$_LOGIN_REDIRECT_PATH; exit;
			header('Location: '.$_LOGIN_REDIRECT_PATH);					
			
		}
		
		if ($_SERVER['REQUEST_METHOD']!='POST'){
			return $this->mostrarVista();
		}
		
		//cuando la peticion es POST, llegamos aca				
		//Primero se revisan los datos recibidos				
		if ($username == null && $pass==null){
			$imprimir=true;
			$username = isset($_POST['username'])? $_POST['username'] : '';
			$pass = isset($_POST['pass'])? $_POST['pass'] : ''; 
		}else{
			$imprimir=false;
		}
		
		$errores=array();		
		if ( empty($username) ){
			$errores['username']='This field is required';
		}
		
		if ( empty($pass) ){
			$errores['pass']='This field is required';			
		}
		
		$params=array(
			'username'=>$username
		);
		
		if (!empty($errores) ){
			//Si hay erroores, devolver la misma pagina mostrando los errores de validación
			$vista= $this->getVista();
			global $_PETICION;
			$vista->errores=$errores;
			
			$vista->valores=$params;			
			return $this->mostrarVista();
		}
		
		$mod=$this->getModel();
		$resp = $mod->login($username, $pass);
		
		if ($resp['success']==true){
			
			header('Location: '.$_LOGIN_REDIRECT_PATH); // 
			exit;
		}else{
			
			$vista = $this->getVista();
			global $_PETICION;
			$errores=array('pass'=>'Nombre de usuario y/o contrase&ntilde;a incorrecta');
			$vista->errores=$errores;
			$vista->valores=$params;
			return $this->mostrarVista();
		}
	}	
	
	function editar(){
		// header("Content-Type: text/html;charset=utf-8");
		
		$id=empty( $_REQUEST['id'])? 0 : $_REQUEST['id'];
		$model=$this->getModel();
		$params=array(
			'id'=>$id
		);
		
		$obj=$model->obtener( $params );		
		$obj['pass']='';
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		$rolMod = new rolModelo();
		$res = $rolMod->buscar( array() );				
		$vista->roles=$res['datos'];
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		// print_r($obj);
	}
	
	function nuevo(){		
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		$rolMod= new rolModelo();
		$res=$rolMod->buscar();
		$vista->roles = $res['datos'];
		
		
		global $_PETICION;		
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');		
	}
	
	
	
}
?>