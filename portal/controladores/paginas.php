<?php
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/pagina_modelo.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/paginas/primer_reporte_pdf.php';

class paginas extends Controlador{
	var $modelo="pagina";
	var $campos=array('id','texto_menu','contenido','orden','codigo');
	var $pk="id";
	var $nombre="paginas";
	
	function nuevo(){
		$campos=$this->campos;
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($campos); $i++){
			$obj[$campos[$i]]='';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');		
	}
	
	function primerReporte(){
		$pdf=new PrimerReportePdf();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Hola, Mundo!');
		$pdf->output();
		exit;		
	}
	
	
	function guardar(){
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>