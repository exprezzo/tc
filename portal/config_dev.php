<?php
$DB_CONFIG=array(
	'DB_SERVER'	=>'mysql.nixiweb.com',
	'DB_NAME'	=>'u672516699_escrupu',
	'DB_USER'	=>'u672516699_escru',
	'DB_PASS'	=>'q99nNJJDXE',
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