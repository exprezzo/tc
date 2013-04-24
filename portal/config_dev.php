<?php
$DB_CONFIG=array(
	'DB_SERVER'	=>'mysql.nixiweb.com',
	'DB_NAME'	=>'u705515576_escrupul',
	'DB_USER'	=>'u705515576_escru',
	'DB_PASS'	=>'BFEwwZvu6J',
	'PASS_AES'  =>'tc94s43s'
);
	
if ( !isset( $APP_CONFIG ) ) {
	$APP_CONFIG=array(
		'nombre'=>'Escrupulos',
		'tema'=>'redmond'
	);
}


$_LOGIN_REDIRECT_PATH = 'sistema';
$_DEFAULT_CONTROLLER='paginas';
?>