<?php
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/paginas/primer_reporte_pdf.php';

class Reportes extends Controlador{
	function primero(){
		echo '<div>
			<object data="/reportes/primeroPdf" type="application/pdf" width="100%" height="100%">
				alt : <a href="/reportes/primeroPdf">analisis.pdf</a>
			</object>
		</div>';
	}
	function primeroPdf(){
		$pdf=new PrimerReportePdf();
		$pdf->AddPage();
		
		// $pdf->Image( 'http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Primer|Reporte',60,30,90,0,'PNG' );
		
		$pdf->Image( 'http://png.findicons.com/files/icons/165/playground/128/shoe.png',60,30,90,0,'PNG' );
		
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Este es el primer reporte!');
		$pdf->output();
		exit;		
	}
	
	
	function segundo(){
		echo '<div>
			<object data="/reportes/segundoPdf" type="application/pdf" width="100%" height="100%">
				alt : <a href="/reportes/segundoPdf">analisis.pdf</a>
			</object>
		</div>';
	}
	function segundoPdf(){
		$pdf=new PrimerReportePdf();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Este es el segundo reporte!');
		$pdf->output();
		exit;		
	}
	
	function tercero(){
		echo '<div>
			<object data="/reportes/terceroPdf" type="application/pdf" width="100%" height="100%">
				alt : <a href="/reportes/terceroPdf">analisis.pdf</a>
			</object>
		</div>';
	}
	function terceroPdf(){
		$pdf=new PrimerReportePdf();
		$pdf->AddPage();
		
		
		$pdf->Image( 'http://png.findicons.com/files/icons/650/chanel/128/shanel_white_shoe.png',60,30,90,0,'PNG' );
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Este es el tercero reporte!');
		$pdf->output();
		exit;		
	}
	
	function cuarto(){
		echo '<div>
			<object data="/reportes/cuartoPdf" type="application/pdf" width="100%" height="100%">
				alt : <a href="/reportes/cuartoPdf">analisis.pdf</a>
			</object>
		</div>';
	}
	function cuartoPdf(){
		$pdf=new PrimerReportePdf();
		$pdf->AddPage();
		$pdf->Image( 'http://png.findicons.com/files/icons/649/gucci/128/gucci_shoe.png',60,30,90,0,'PNG' );
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Este es el cuarto reporte!');
		$pdf->output();
		exit;		
	}
	
	function quinto(){
		echo '<div>
			<object data="/reportes/quintoPdf" type="application/pdf" width="100%" height="100%">
				alt : <a href="/reportes/quintoPdf">analisis.pdf</a>
			</object>
		</div>';
	}
	function quintoPdf(){
		$pdf=new PrimerReportePdf();
		$pdf->AddPage();
		$pdf->Image( 'http://png.findicons.com/files/icons/650/chanel/128/chanel_pink_shoe.png',60,30,90,0,'PNG' );
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'¡Este es el quinto reporte!');
		$pdf->output();
		exit;		
	}
}
?>