<?php

require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_no_vendidos_pdf.php';

class Reportes extends Controlador{
	
	
	function novendidosPdf(){
		$mod=new Modelo();
		$pdo=$mod->getPdo();
		
		$sql='SELECT count(clave) as total from articulos2 WHERE clave NOT IN (select primario from tick_det)';		
		$sth = $pdo->prepare($sql);
		$exito=$sth->execute();
		if ( !$exito ){
			$error= $mod->getError( $sth );
			echo json_encode( $error );
			return $error;
		}		
		$datos=$sth->fetchAll( PDO::FETCH_ASSOC);
		$total=$datos[0]['total'];
		
		$sql='SELECT * from articulos2 WHERE clave NOT IN (select primario from tick_det)';		
		$sth = $pdo->prepare($sql);
		$exito=$sth->execute();
		if ( !$exito ){
			$error= $mod->getError( $sth );
			echo json_encode( $error );
			return $error;
		}		
		$datos=$sth->fetchAll( PDO::FETCH_ASSOC);
		
		$res=array(
			'success'=>true,
			'datos'=>$datos,
			'total'=>$total
		);
	
		$pdf=new ReporteNoVendidosPdf();
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
}
?>