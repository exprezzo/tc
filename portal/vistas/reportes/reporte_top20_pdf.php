<?php
require_once '../php_libs/fpdf/fpdf.php';

class ReporteTop20Pdf extends fpdf{
	// Tabla simple
	function BasicTable()
	{		
		// Cabecera
		foreach($this->columns as $col){
			$this->SetFont('Courier','',12);
			$w=empty( $col['width'] ) ? 40 : $col['width'];
			$this->Cell($w,7,$col['header'],1);
		}
					
		$this->Ln();
		// Datos
		foreach($this->res['datos'] as $row)
		 {
			foreach($this->columns as $col){
				$w=empty( $col['width'] ) ? 40 : $col['width'];
				$di=$col['dataIndex'];
				$val=$row[$di];
				$this->SetFont('Courier','',12);
				$align=empty( $col['align'] ) ? '' : $col['align'];
				
				$this->Cell($w,6,$val,1,0,$align);
			}
				
			$this->Ln();
		}
	}


	function Header()
	{
		$this->SetFont('Courier','',16);
		$this->Cell(40,10,'QUE SE VENDE MAS (TOP 20)',0,1);
		$this->SetFont('Courier','',13);
		$this->Cell(40,10,'Totalizado por modelo y fecha');
		$this->Ln();
	}
	
	function imprimir(){
		
		$this->columns=array(
			array(
				'header'=>'Tienda',
				'dataIndex'=>'tienda',
				'w'=>100,
				'groupInfo'=>array()
			),
			array(
				'header'=>'Modelo',
				'dataIndex'=>'modelo',
				'width'=>40
			),
			array(
				'header'=>'Clave',
				'dataIndex'=>'clavesecundaria',
				'width'=>40
				),
			array(
				'header'=>'Cantidad',
				'dataIndex'=>'cantidad',
				'width'=>40
			),
			array(
				'header'=>'Descripcion',
				'dataIndex'=>'nombre',
				'width'=>60
			),
			array(
				'header'=>'Importe',
				'dataIndex'=>'importe',
				'width'=>20,
				'align'=>'R'
			)
		);
		
		$this->AddPage();
		$this->BasicTable();
		
		$this->SetFont('Courier','',13);
		$this->Cell(40,10,'Total');
		$this->Cell(40,10,'Importe');
		
		$this->output();
	}
	
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Courier','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
	}
}
?>