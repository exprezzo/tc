<style>
.loginForm{
	display:inline-block;
	padding:10px;
	border:#d4cfcf 1px solid; border-radius: 3px; background:white; 
	webkit-box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.75);-moz-box-shadow:    7px 7px 5px rgba(50, 50, 50, 0.75);box-shadow: 7px 7px 5px rgba(50, 50, 50, 0.75);
	
	
	height: 184px;
	width: 158px;
	left: 50%;
	margin-left: -90px;
	position: absolute;
	top: 50% !important;
	margin-top: -100px;
}
</style>

<form class="loginForm" action="<?php echo $APP_URL_BASE.$_PETICION->modulo; ?>/usuarios/login" METHOD="POST" style="text-align:center">
	<?
	if  ( !empty($this->errores) ){
		// print_r ($this->errores);
	}
	?>
	<h2>Login</h2>
	<input name="username" placeholder="nick">
	<br>
	<br>
	<input type="password" name="pass" placeholder="pass">
	<br>
	<br>
	<input type="submit">
</form>