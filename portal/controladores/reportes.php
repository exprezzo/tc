<?php

require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_no_vendidos_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_ventas_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_top20_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_ultimos20_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/modelos/tienda_modelo.php';

class Reportes extends Controlador{
	
	function novendidos(){		
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		$vista->mostrar();		
	}
	
	function top20(){		
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		$vista->mostrar();		
	}
	
	function ultimos20(){
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		$vista->mostrar();
	}
	
	function vendidos(){
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		$vista->mostrar();
	}
	function vendidosPdf(){	
		$sql='SELECT t.tienda as nombreTienda,
		"modelo" as modelo, a.clavesecundaria, tkd.cantidad,tkd.descripcion, (tkd.cantidad * tkd.precioiva) as  importe
		FROM tick_int tk
		LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  
		LEFT JOIN tiendas t ON t.clave = tk.tienda
		LEFT JOIN articulos2 a ON a.clave = tkd.primario
		WHERE tk.fecha >=:fechai AND tk.fecha <= :fechaf		
		ORDER BY tk.fecha DESC limit 0, 1000';
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();		
		$sth=$pdo->prepare($sql);

		$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
			
		
		$sth->bindValue(':fechai', $fechai->format('Y-m-d') ,PDO::PARAM_STR);
		$sth->bindValue(':fechaf', $fechaf->format('Y-m-d') ,PDO::PARAM_STR);
		
		$exito=$sth->execute();
		
		if (  !$exito ) {
			$res=$modelo->getError( $sth );
			print_r( $res );
			exit;
		}
		
		$res=array(
			'success'=>true,
			'datos'=> $sth->fetchAll(PDO::FETCH_ASSOC),			
		);
	
		// print_r($res); exit;
		
		$pdf=new ReporteVentasPdf();
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
	
	function ultimos20Pdf(){	
		$res=array(
			'success'=>true,
			'datos'=>array(),
			'total'=>0
		);	
	
		$pdf=new ReporteUltimos20Pdf();
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
	
	function top20Pdf(){	
		$res=array(
			'success'=>true,
			'datos'=>array(),
			'total'=>0
		);	
	
		$pdf=new ReporteTop20Pdf();
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
	
	function noVendidosPdf(){	
		$res=array(
			'success'=>true,
			'datos'=>array(),
			'total'=>0
		);	
	
		$pdf=new ReporteNoVendidosPdf();
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
	
	
	function novendidosPdf_old(){		
		set_time_limit ( 120 );
		
		$mod=new Modelo();
		$pdo=$mod->getPdo();
		
		
		$filtros=array(
			array(
				'filterOperator'=>'greaterorequal',
				'filterValue'=>$_REQUEST['fechai'],
				'dataKey'=>'fechai',
				'field'=>'fecha',
			),
			array(
				'filterOperator'=>'lessorequal',
				'filterValue'=>$_REQUEST['fechaf'],
				'dataKey'=>'fechaf',
				'field'=>'fecha',
			)			
		);
		
		
		$strFiltros=$mod->cadenaDeFiltros($filtros);		
		
		// echo $strFiltros; exit;
		$sql='SELECT count(clave) as total from articulos2 WHERE clave NOT IN (select distinct(td.primario) FROM tick_int t
		LEFT JOIN tick_det td ON td.clave = t.clave'.$strFiltros.')';		
		
		$sth = $pdo->prepare($sql);
		
		// echo  $sql; exit;
		$mod->bindFiltros($sth, $filtros);
		
		
		
		$exito=$sth->execute();
		if ( !$exito ){
			$error= $mod->getError( $sth );
			echo json_encode(  $error ); exit;
			return $error;
		}		
		 // echo 'hasta aká'; exit;
		
		$datos=$sth->fetchAll( PDO::FETCH_ASSOC);
		$total=$datos[0]['total'];
		
		print_r($total); exit;
		
		$sql='SELECT count(clave) as total from articulos2 WHERE clave NOT IN (select td.primario FROM tick_int t
		LEFT JOIN tick_det td ON td.clave = t.clave'.$strFiltros.')';		
		
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
	
		$pdf=new ReporteNoVendidosPdf('L');
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
	
	function top20Pdf_old(){				
		set_time_limit ( 120 );
		
		$mod=new Modelo();
		$pdo=$mod->getPdo();
		
		
		$filtros=array(
			array(
				'filterOperator'=>'greaterorequal',
				'filterValue'=>$_REQUEST['fechai'],
				'dataKey'=>'fechai',
				'field'=>'fecha',
			),
			array(
				'filterOperator'=>'lessorequal',
				'filterValue'=>$_REQUEST['fechaf'],
				'dataKey'=>'fechaf',
				'field'=>'fecha',
			)			
		);
		
		
		$strFiltros=$mod->cadenaDeFiltros($filtros);		
		
		// echo $strFiltros; exit;
		$sql='SELECT count( distinct(td.primario) ) as total from tick_int t
		left join tick_det td ON td.clave = t.clave		
		'.$strFiltros.')';		
		
		$sth = $pdo->prepare($sql);
		
		 echo  $sql; exit;
		$mod->bindFiltros($sth, $filtros);
		
		
		
		$exito=$sth->execute();
		if ( !$exito ){
			$error= $mod->getError( $sth );
			echo json_encode(  $error ); exit;
			return $error;
		}		
		 // echo 'hasta aká'; exit;
		
		$datos=$sth->fetchAll( PDO::FETCH_ASSOC);
		$total=$datos[0]['total'];
		
		print_r($total); exit;
		
		$sql='SELECT count(clave) as total from articulos2 WHERE clave NOT IN (select td.primario FROM tick_int t
		LEFT JOIN tick_det td ON td.clave = t.clave'.$strFiltros.')';		
		
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
	
		$pdf=new ReporteTop20Pdf();
		$pdf->res = $res;
		
		$pdf->imprimir();
		exit;
	}
}
?>