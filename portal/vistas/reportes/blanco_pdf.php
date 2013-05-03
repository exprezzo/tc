<?php
require_once '../php_libs/fpdf/fpdf.php';

class BlancoPdf extends fpdf{
	
	function __construct() {
       parent::__construct('L');
       // print "In SubClass constructor\n";
   }
	
	
	function imprimir(){
		
		
		$this->AddPage();			
		
		$this->output();
	}
	
}
?>