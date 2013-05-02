<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style>
.loginForm{
	display:inline-block;
	padding:10px;
	
	
	
	height: 184px;
	color:white;
	left: 50%;
	margin-left: -90px;
	position: absolute;
	top: 50% !important;
	margin-top: -100px;
}
body{
	background-color:black;
}
label.error{
	color:red;
}
</style>
	<?php 
	$rutaTema='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/themes/hot-sneaks/jquery-ui.css'; 	
	?>
	<link href="<?php echo $rutaTema; ?>" rel="stylesheet" type="text/css" />
	
	<script src="<?php echo $_APP_PATH; ?>web/libs/jquery-1.8.3.js"></script>
	<script src="<?php echo $_APP_PATH; ?>web/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>  
<!--Wijmo Widgets CSS-->	
	<link href="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />			
	<!--link href="/css/themes/blitzer/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
	<!--Wijmo Widgets JavaScript-->
	<script src="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.js" type="text/javascript"></script>
	<script src="<?php echo $_APP_PATH; ?>web/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.js" type="text/javascript"></script>
	<script>
		$().ready(function(){			
			$('input').wijtextbox();		
			$('[type="submit"]').button();		
		});
	</script>
	
</head>
<body>
<form class="loginForm" action="<?php echo $APP_URL_BASE.$_PETICION->modulo; ?>/usuarios/login" METHOD="POST" style="text-align:center">
	<?
	if  ( !empty($this->errores) ){
		 // print_r ($this->errores);
	}
	?>
	<h2>Login</h2>
	<input name="username" placeholder="nombre de usuario" autofocus><br>
	<?php 
		if ( !empty($this->errores['username'] ) ){
			echo '<label class="error">'.$this->errores['username'].'</label><br>';
		}
	?>	
	<br>
	<input type="password" name="pass" placeholder="contraseña"><br>
	<?php 
		if ( !empty($this->errores['pass'] ) ){
			echo '<label class="error">'.$this->errores['pass'].'</label><br>';
		}
	?>	
	<br>
	<input type="submit" value="Entrar">
</form>
</body>
</html>