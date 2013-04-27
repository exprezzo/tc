<?php
require_once '../php_libs/fpdf/fpdf.php';

class ReporteVentasPdf extends fpdf{
	// Tabla simple
	function BasicTable($header, $data)
	{
		// Cabecera
		foreach($header as $col)
			$this->Cell(40,7,$col,1);
		$this->Ln();
		// Datos
		foreach($data as $row)
		{
			foreach($row as $col)
				$this->Cell(40,6,$col,1);
			$this->Ln();
		}
	}


	function Header()
	{
		$this->SetFont('Arial','B',16);
		$this->Cell(40,10,'QUE SE VENDE MAS EN TODAS LAS TIENDAS',0,1);
		$this->Cell(40,10,'Totalizado por Modelo ');
	}
	
	function imprimir(){
		
		$this->columns=array(
			array(		
				'header'=>'Clave',
				'dataIndex'=>'clavesecundaria'
				'w'=>100,
				'groupInfo'=>array()
			),
			array(		
				'header'=>'Cantidad',
				'dataIndex'=>'cantidad'
				'w'=>100,
				'groupInfo'=>array()
			)
		);
		
		
		$this->AddPage();			
		$foreach($this->res['datos'] as $info ){
			$this->SetFont('Arial','B',16);
			$this->Cell(40,10,'QUE SE VENDE MAS EN TODAS LAS TIENDAS',0,1);
			$this->Cell(40,10,'Totalizado por Modelo ');
		}
		$this->output();
	}
	
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
?>