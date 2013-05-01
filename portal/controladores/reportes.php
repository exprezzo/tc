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
		$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];		
		
		if ( !empty($tienda) ){
			$filtroTienda = ' tk.tienda= '.$tienda.' AND ';
		}else{
			$filtroTienda = ' ';
		}
		
		
		$sql='SELECT  t.tienda as nombreTienda,
		"modelo" as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
		(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
		FROM tick_int tk
		LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  AND tkd.tienda = tk.tienda
		LEFT JOIN tiendas t ON t.clave = tk.tienda
		LEFT JOIN articulos2 a ON a.clave = tkd.primario				
		WHERE '.$filtroTienda.' tk.fecha >= "'.$fechai->format('Y-m-d').'" and tk.fecha <= "'.$fechaf->format('Y-m-d').'"
		GROUP BY a.grupo ORDER BY ';
		
		
		
		if ( $agrupar ){
			$orden=' tk.tienda ASC, cantidad DESC';
		}else{
			$orden=' cantidad DESC';
		}
		$sql.=$orden;
		
		 // echo $sql; exit;
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();						
		$sth = $pdo->query( $sql );
				
		if ( !$sth ) {
			$res=$modelo->getError(  );
			print_r( $res );
			exit;
		}
		
		$res=array(
			'success'=>true,
			'datos'=> $sth->fetchAll(PDO::FETCH_ASSOC),			
		);	
		
		$pdf=new ReporteVentasPdf();
		$pdf->res = $res;
		if ( $agrupar ){
			$pdf->agrupar=true;
		}
		$pdf->fechai=$fechai;
		$pdf->fechaf=$fechaf;
		
		$pdf->imprimir();
		exit;
	}
	
	function ultimos20Pdf(){	
		$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];		
		
		if ( !empty($tienda) ){
			$filtroTienda = ' tk.tienda= '.$tienda.' AND ';
		}else{
			$filtroTienda = ' ';
		}
		
		
			$modelo=new Modelo();
			$pdo=$modelo->getPdo();						
		if($agrupar){
			if ( !empty($tienda) ){
				$paramsTienda=array(
					'filtros'=>array(
						array(
							'filterOperator'=>'equals',
							'dataKey'=>'clave',
							'filterValue'=>$tienda
						)
					)				
				);
			}else{
				$paramsTienda=array();
			}
			
			
			$tiendaMod=new TiendaModelo();
			$tiendasRes=$tiendaMod->buscar( $paramsTienda );
			
			$tiendas=$tiendasRes['datos'];
			$resultados=array();
			
			
			
			foreach($tiendas as $tiendaObj){
				$tiendaId=$tiendaObj['clave'];
				$filtroTienda=' tk.tienda="'.$tiendaId.'" AND ';
				
				$sql='SELECT  t.tienda as nombreTienda,
				"modelo" as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
				(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
				FROM tick_int tk
				LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  AND tkd.tienda = tk.tienda
				LEFT JOIN tiendas t ON t.clave = tk.tienda
				LEFT JOIN articulos2 a ON a.clave = tkd.primario				
				WHERE '.$filtroTienda.' tk.fecha >= "'.$fechai->format('Y-m-d').'" and tk.fecha <= "'.$fechaf->format('Y-m-d').'"
				GROUP BY a.grupo ORDER BY cantidad ASC limit 0,20';
				
				// echo $sql; exit;
				$sth = $pdo->query( $sql );
					
				
				if ( !$sth ) {
					$res=$modelo->getError(  );
					print_r( $res );
					exit;
				}
				
				$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
				$resultados=array_merge($datos, $resultados);
			}
			$res=array(
				'success'=>true,
				'datos'=>$resultados
			);
		}else{
			$sql='SELECT  t.tienda as nombreTienda,
			"modelo" as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
			(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
			FROM tick_int tk
			LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  AND tkd.tienda = tk.tienda
			LEFT JOIN tiendas t ON t.clave = tk.tienda
			LEFT JOIN articulos2 a ON a.clave = tkd.primario				
			WHERE '.$filtroTienda.' tk.fecha >= "'.$fechai->format('Y-m-d').'" and tk.fecha <= "'.$fechaf->format('Y-m-d').'"
			GROUP BY a.grupo ORDER BY ';
			
			if ( $agrupar ){
				$orden=' tk.tienda ASC, cantidad ASC';
			}else{
				$orden=' cantidad ASC';
			}
			$sql.=$orden;
			
			$sql.=' LIMIT 0,20;';
			 
			 
			$sth = $pdo->query( $sql );
					
			if ( !$sth ) {
				$res=$modelo->getError(  );
				print_r( $res );
				exit;
			}
			
			$res=array(
				'success'=>true,
				'datos'=> $sth->fetchAll(PDO::FETCH_ASSOC),			
			);	
		}
		
		$pdf=new ReporteUltimos20Pdf();
		
		$pdf->res = $res;
		if ( $agrupar ){
			$pdf->agrupar=true;
		}
		$pdf->fechai=$fechai;
		$pdf->fechaf=$fechaf;
		
		$pdf->imprimir();
		exit;
	}
	
	function top20Pdf(){	
		$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];		
		
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();						
			
		if ( !empty($tienda) ){
			$filtroTienda = ' tk.tienda= '.$tienda.' AND ';
		}else{
			$filtroTienda = ' ';
		}
		
		if($agrupar){
			if ( !empty($tienda) ){
				$paramsTienda=array(
					'filtros'=>array(
						array(
							'filterOperator'=>'equals',
							'dataKey'=>'clave',
							'filterValue'=>$tienda
						)
					)				
				);
			}else{
				$paramsTienda=array();
			}
			
			
			$tiendaMod=new TiendaModelo();
			$tiendasRes=$tiendaMod->buscar( $paramsTienda );
			
			$tiendas=$tiendasRes['datos'];
			$resultados=array();
			
			
			
			foreach($tiendas as $tiendaObj){
				$tiendaId=$tiendaObj['clave'];
				$filtroTienda=' tk.tienda="'.$tiendaId.'" AND ';
				
				$sql='SELECT  t.tienda as nombreTienda,
				"modelo" as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
				(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
				FROM tick_int tk
				LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  AND tkd.tienda = tk.tienda
				LEFT JOIN tiendas t ON t.clave = tk.tienda
				LEFT JOIN articulos2 a ON a.clave = tkd.primario				
				WHERE '.$filtroTienda.' tk.fecha >= "'.$fechai->format('Y-m-d').'" and tk.fecha <= "'.$fechaf->format('Y-m-d').'"
				GROUP BY a.grupo ORDER BY cantidad DESC limit 0,20';
				
				// echo $sql; exit;
				$sth = $pdo->query( $sql );
					
				
				if ( !$sth ) {
					$res=$modelo->getError(  );
					print_r( $res );
					exit;
				}
				
				$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
				$resultados=array_merge($datos, $resultados);
			}
			$res=array(
				'success'=>true,
				'datos'=>$resultados
			);
		}else{
			$sql='SELECT  t.tienda as nombreTienda,
			"modelo" as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
			(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
			FROM tick_int tk
			LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  AND tkd.tienda = tk.tienda
			LEFT JOIN tiendas t ON t.clave = tk.tienda
			LEFT JOIN articulos2 a ON a.clave = tkd.primario				
			WHERE '.$filtroTienda.' tk.fecha >= "'.$fechai->format('Y-m-d').'" and tk.fecha <= "'.$fechaf->format('Y-m-d').'"
			GROUP BY a.grupo ORDER BY ';
			
			
			
			if ( $agrupar ){
				$orden=' tk.tienda ASC, cantidad DESC';
			}else{
				$orden=' cantidad DESC';
			}
			$sql.=$orden;
			
			$sql.=' LIMIT 0,20;';
			 
			 
			$modelo=new Modelo();
			$pdo=$modelo->getPdo();						
			$sth = $pdo->query( $sql );
					
			if ( !$sth ) {
				$res=$modelo->getError(  );
				print_r( $res );
				exit;
			}
			
			$res=array(
				'success'=>true,
				'datos'=> $sth->fetchAll(PDO::FETCH_ASSOC),			
			);	
		}
		
		
		
		
		$pdf=new ReporteTop20Pdf();
		
		$pdf->res = $res;
		if ( $agrupar ){
			$pdf->agrupar=true;
		}
		$pdf->fechai=$fechai;
		$pdf->fechaf=$fechaf;
		
		$pdf->imprimir();
		exit;
	
		
		
	}
	
	function noVendidosPdf(){	
		$fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		$fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];		
		
		if ( !empty($tienda) ){
			$paramsTienda=array(
				'filtros'=>array(
					array(
						'filterOperator'=>'equals',
						'dataKey'=>'clave',
						'filterValue'=>$tienda
					)
				)				
			);
		}else{
			$paramsTienda=array();
		}
		
		
		$tiendaMod=new TiendaModelo();
		$tiendasRes=$tiendaMod->buscar( $paramsTienda );
		
		$tiendas=$tiendasRes['datos'];
		$resultados=array();
		
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();						
		
		foreach($tiendas as $tiendaObj){
			$tiendaId=$tiendaObj['clave'];
			
			$sql='SELECT t.tienda nombreTienda, a.clavesecundaria, a.precio1,a.nombre,a.talla FROM articulos2 a 
			LEFT JOIN tiendas t ON t.clave ="'.$tiendaId.'"
			LEFT JOIN
				(SELECT  DISTINCT(tkd.primario) primario
					FROM tick_int tk
					LEFT JOIN tick_det tkd ON tkd.clave = tk.clave  AND tkd.tienda = tk.tienda		
					WHERE   tk.fecha >= "'.$fechai->format('Y-m-d').'" and tk.fecha <= "'.$fechaf->format('Y-m-d').'" AND tk.tienda ="'.$tiendaId.'"
					ORDER BY  primario DESC) b ON a.clave = b.primario
			WHERE b.primario IS NULL
			GROUP BY a.grupo';
			$sth = $pdo->query( $sql );
				
			if ( !$sth ) {
				$res=$modelo->getError(  );
				print_r( $res );
				exit;
			}
			
			$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
			$resultados = array_merge($datos, $resultados);
		}
		$res=array(
			'success'=>true,
			'datos'=>$resultados 
		);

		
		
		
		// if ( $agrupar ){
			// $orden=' tk.tienda ASC, cantidad DESC';
		// }else{
			// $orden=' cantidad DESC';
		// }
		// $sql.=$orden;
		
		 // echo $sql; exit;
		
		
		$pdf=new ReporteNoVendidosPdf();
		
		$pdf->res = $res;
		if ( $agrupar ){
			$pdf->agrupar=true;
		}
		$pdf->fechai=$fechai;
		$pdf->fechaf=$fechaf;
		
		$pdf->imprimir();
		exit;
		
		
	}
	
	
}
?>