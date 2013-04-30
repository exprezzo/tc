<?php
require_once '../php_libs/fpdf/fpdf.php';

class ReporteVentasPdf extends fpdf{
	// Tabla simple
	function __construct() {
       parent::__construct('L');
       // print "In SubClass constructor\n";
   }
	function BasicTable()
	{				
		$tw=0;
		
		$idxAgrupados=-1;
		for($i=0; $i<sizeof($this->columns); $i++ ){
			$col=$this->columns[$i];
			
			if ( isset($col['groupInfo']) ){
				$idxAgrupados=$i;
			}else{
				$tw+=empty( $col['width'] ) ? 40 : $col['width'];
			}			
		}
		
		// if ($idxAgrupados>-1){
			// $this->SetFont('Courier','',12);
			// $this->Cell($tw,7,$this->columns[$idxAgrupados]['header'] ,1);
			// $this->ln();
		// }
		
		
		
		// Cabecera		
		foreach($this->columns as $col){
			// if ( isset($col['groupInfo']) ) continue;
			
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
		$this->Cell(40,10,'QUE SE VENDE MAS EN TODAS LAS TIENDAS',0,1);
		$this->Cell(40,10,'Totalizado por Modelo ',0,1);
	}
	
	function imprimir(){
		
		$this->columns=array(			
			array(		
				'header'=>'Tienda',
				'dataIndex'=>'nombreTienda',
				'width'=>20,
				'groupInfo'=>array()
			),
			array(		
				'header'=>'Modelo',
				'dataIndex'=>'modelo',
				'width'=>20
			),
			array(		
				'header'=>'Clave',
				'dataIndex'=>'clavesecundaria',
				'width'=>30
			),
			array(		
				'header'=>'Cantidad',
				'dataIndex'=>'cantidad',
				'width'=>30
			),			
			array(		
				'header'=>'Descripcion',
				'dataIndex'=>'descripcion',
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
		$this->BasicTable($this->columns, $this->res['datos'] );
		
		$this->output();
	}
	
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
	}
}
?>