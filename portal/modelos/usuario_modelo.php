<?php
class usuarioModelo extends Modelo{
	var $tabla="system_users";
	var $campos=array('id','nick','pass','email','rol','fbid','name','picture','originalName');
	var $pk="id";
	function login($username, $pass){
		//si el username es un email, se busca por email y pass
		//si no, se busca por username y pass

		global $DB_CONFIG;
		$_PASS_AES=$DB_CONFIG['PASS_AES'];
				
		if ( filter_var($username, FILTER_VALIDATE_EMAIL) ) {
			$sql = 'SELECT * FROM '.$this->tabla.' WHERE email=:username and :pass=AES_DECRYPT(pass, "'.$_PASS_AES.'")';
		}else{
			$sql = 'SELECT * FROM '.$this->tabla.' WHERE nick=:username and :pass=AES_DECRYPT(pass, "'.$_PASS_AES.'")';
		}									
		
		$con = $this->getPdo();
		$sth = $con->prepare($sql);		
		$sth->bindValue(':username',$username, PDO::PARAM_STR);
		$sth->bindValue(':pass',$pass, PDO::PARAM_STR);
		
		$sth->execute();
		$modelos = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		if ( empty($modelos) ){
			return array('success'=>false);
		}
		
		if ( sizeof($modelos) > 1 ){
			throw new Exception("El usuario está duplicado"); //TODO: agregar numero de error, crear una exception MiEscepcion
		}
		
		$this->registrarEnSesion($modelos[0]);
		$_SESSION['logoutUrl'] = '/users/logout';		
		return array(
			'success'=>true,
			'datos'=>$modelos[0]
		);		
	}
	
		function registrarEnSesion($userInfo){
		$_SESSION['isLoged']=true;
		$_SESSION['userInfo']=$userInfo;

	}
	function logout(){
		unset($_SESSION['isLoged']);
		unset($_SESSION['userInfo']);	
		unset($_SESSION['logoutUrl']);		
	}
	
	function nuevo($params){
		return parent::nuevo($params);
	}
	
	function guardar( $params ){
		global $DB_CONFIG;
		$_PASS_AES = $DB_CONFIG['PASS_AES'];
		$dbh=$this->getConexion();
		
		$id=$params['id'];
		// $nombre=$params['nombre'];		
		if ( empty($id) ){
			//           CREAR
			// $sql='INSERT INTO '.$this->tabla.' SET nombre=:nombre, fecha_de_creacion= now()';
			$sql='INSERT INTO '.$this->tabla.' SET ';
			foreach($params as $key=>$val){
				if ($key=='pass'){
					$sql.='pass=AES_ENCRYPT(:pass, "'.$_PASS_AES.'"),';
				}else{
					$sql.="$key=:$key, ";
				}				
			}
			$sql=substr($sql, 0, strlen($sql)-2 );
			
			// nombre=:nombre';
			$sth = $dbh->prepare($sql);
			foreach($params as $key=>$val){
				$bind=":$key";
				if ($key=='pass' && empty($val) ){
					return array('success'=>false,'msg'=>'Ingrese un password');
				}
				$sth->bindValue($bind, $val,PDO::PARAM_STR);
			}
			// $sth->bindValue(":nombre",$nombre,PDO::PARAM_STR);					
			$msg=$this->nombre.' Creado';	
		}else{
			//	         ACTUALIZAR
			// $sql='UPDATE '.$this->tabla.' SET nombre=:nombre WHERE id=:id, fecha_de_actualizacion=now()';
			// $sql='UPDATE '.$this->tabla.' SET nombre=:nombre WHERE id=:id';
			$sql='UPDATE '.$this->tabla.' SET ';
			foreach($params as $key=>$val){
				if ($key==$this->pk ) continue;
				
				if ($key=='pass' ){
					if ( !empty($val) ) $sql.='pass=AES_ENCRYPT(:pass, "'.$_PASS_AES.'"),';
				}else{
					$sql.="$key=:$key, ";
				}
				
			}
			$sql=substr($sql, 0, strlen($sql)-2 );
			$sql.=' WHERE '.$this->pk.'=:'.$this->pk;
			
			// nombre=:nombre';
			$sth = $dbh->prepare($sql);							
			foreach($params as $key=>$val){
				if ($key=='pass' && empty($val)) continue;
				$bind=":$key";							
				$sth->bindValue($bind, $val,PDO::PARAM_STR);					
			}
			
			$msg=$this->nombre.' Actualizado';	
		}
		$success = $sth->execute();
		
		
		if ($success != true){
			$error=$sth->errorInfo();			
			$success=false; //plionasmo apropósito
			$msg=$error[2];						
			$datos=array();
		}else{
			// $success = rowCount();			
			if ( empty( $id) ){
				$id=$dbh->lastInsertId();
			}
			$datos=$this->obtener(
				array( $this->pk =>$id )
			);
		}
		
		return array(
			'success'	=>$success,			
			'datos' 	=>$datos,
			'msg'		=>$msg
		);	
				
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