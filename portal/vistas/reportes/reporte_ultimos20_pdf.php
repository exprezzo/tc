<?php
require_once '../php_libs/fpdf/fpdf.php';

class ReporteUltimos20Pdf extends fpdf{
	// Tabla simple
	var $agrupar=false;
	function __construct() {
       parent::__construct('L');
       // print "In SubClass constructor\n";
   }
	function BasicTable()
	{				
		$tw=0;
		
		$idxAgrupados=-1;
		$groupDataIndex='';
		for($i=0; $i<sizeof($this->columns); $i++ ){
			$col=$this->columns[$i];
			
			if ( isset($col['groupInfo']) ){
				$idxAgrupados=$i;
				$groupDataIndex=$col['dataIndex'];
			}else{
				$tw+=empty( $col['width'] ) ? 40 : $col['width'];
			}			
		}		
				
		// Datos
		$ultimoGrupo=-1;
		
		$piezas=0;
		$importeTot=0;
		
		foreach($this->res['datos'] as $row)
		 {			
			foreach($this->columns as $col){
				$w=empty( $col['width'] ) ? 40 : $col['width'];
				$di=$col['dataIndex'];
				$val=$row[$di];
				
				//Antes de imprimir revisa si debe agrupar los datos
				if ($di == 'cantidad'){
					$piezas+=$val;
				}else if ($di == 'importe'){
					$importeTot+=$val;
				}
				
				if ( $this->agrupar && $di == $groupDataIndex ){
					if ( $ultimoGrupo != $val ){
						$ultimoGrupo = $val;			
						$this->SetFont('Courier','B',12);
						$this->SetTextColor(255,255,255);
						$this->SetFillColor(0,0,0);
						$this->Cell($tw,6,$val ,1,1,'',1);
						$this->SetTextColor(0,0,0);
					}
				}else{
					$this->SetFont('Courier','',12);
					$align=empty( $col['align'] ) ? '' : $col['align'];				
					if ($di == 'importe'){
						$val = '$'.number_format($val,2,'.',',');
					}
					$this->Cell($w,6,$val,1,0,$align);
				}			
			}
				
			$this->Ln();
		}
		
		$gw= empty( $this->columns[$idxAgrupados]['width']) ? 40:$this->columns[$idxAgrupados]['width'];			
		$wTotal = ( $this->agrupar )? $tw : $tw +  $gw;
		$importeTot = number_format($importeTot,2,'.',',');
		$this->cell( $wTotal, 6, 'Total General:  $'.$importeTot,0,0,'R');
	}


	function Header()
	{
		$this->SetFont('Courier','',16);
		$this->Cell(40,10,'QUE SE VENDE MENOS (ultimos 20)',0,1);
		$this->Cell(79,10,'Totalizado por Modelo.',0,0);		
		
		$this->SetFont('Courier','',14);
		$this->Cell(30,10, ' Fechas: ',0,0,'',0);
		
		setlocale(LC_TIME, 'spanish');
		
		
		
		
		// $diai=$this->fechai->format('d');
		// $mesi= strftime('%b', $this->fechai->getTimestamp() );
		// $añoi=$this->fechai->format('Y');
		
		$diai=$this->fechai[2];
		$mesi=$this->fechai[1];
		$añoi=$this->fechai[0];
		
		// $diaf=$this->fechaf->format('d');
		// $mesf= strftime('%b', $this->fechaf->getTimestamp() );
		// $añof=$this->fechaf->format('Y');
		
		$diaf=$this->fechaf[2];
		$mesf=$this->fechaf[1];
		$añof=$this->fechaf[0];
		
		$this->Cell(100,10, ' '."$diai/$mesi/$añoi".' -  '."$diaf/$mesf/$añof",0,1,'',0);
		
		// $6272757.25
		// $6272757.25


		// 
		
		foreach($this->columns as $header){			
			if (isset($header['groupInfo']) &&  $this->agrupar) continue;
			
			$this->SetFont('Courier','',12);
			$w=empty( $header['width'] ) ? 40 : $header['width'];
			$this->SetFillColor(204,204,255);
			
			$this->Cell($w,7,$header['header'],1,0,'',1);
			
		}
		$this->ln();
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
				'width'=>50
			),
			array(		
				'header'=>'Cantidad',
				'dataIndex'=>'cantidad',
				'width'=>30,
				'align'=>'R'
			),			
			array(		
				'header'=>'Descripcion',
				'dataIndex'=>'descripcion',
				'width'=>130
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