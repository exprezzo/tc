<?php
require_once '../php_libs/fpdf/fpdf.php';

class ReporteNoVendidosPdf extends fpdf{
	// Tabla simple
	var $agrupar=false;
	function __construct($agrupar) {
		if ($agrupar){
			parent::__construct('P');
		}else{
			parent::__construct('L');
		}
		$this->agrupar=$agrupar;
       
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
					if ($di == 'precio1'){
						$val = '$'.number_format($val,2,'.',',');
					}
					$this->Cell($w,6,$val,1,0,$align);
				}			
			}
				
			$this->Ln();
		}
		
		
	}


	function Header()
	{
		$this->SetFont('Courier','',16);
		$this->Cell(40,10,'Mercancia que no se movió en el siguiente periodo:',0,1);
		// $this->Cell(79,10,'Totalizado por Modelo.',0,0);		
		
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
				'header'=>'Clave',
				'dataIndex'=>'clavesecundaria',
				'width'=>40
			),
			array(		
				'header'=>'Precio',
				'dataIndex'=>'precio1',
				'width'=>20,
				'align'=>'R'
			),
			array(		
				'header'=>'Descripcion',
				'dataIndex'=>'nombre',
				'width'=>110
			),
			array(		
				'header'=>'Talla',
				'dataIndex'=>'talla',
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