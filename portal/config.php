<?php
$DB_CONFIG=array(
	'DB_SERVER'	=>'localhost',
	'DB_NAME'	=>'tc',
	'DB_USER'	=>'root',
	'DB_PASS'	=>'',
	'PASS_AES'  =>'tc94s43s'
);
	
if ( !isset( $APP_CONFIG ) ) {
	$APP_CONFIG=array(
		'nombre'=>'Escrupulos',
		'tema'=>'hot-sneaks'
	);
}


$_LOGIN_REDIRECT_PATH = 'sistema';
$_DEFAULT_CONTROLLER='paginas';
?>