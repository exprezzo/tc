<?php

require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_no_vendidos_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_ventas_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_top20_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/reporte_ultimos20_pdf.php';
require_once $APPS_PATH.$_PETICION->modulo.'/vistas/reportes/blanco_pdf.php';

require_once $APPS_PATH.$_PETICION->modulo.'/modelos/tienda_modelo.php';

class Reportes extends Controlador{
	function comisionesJson($imprimir=true){			
		if ( empty($_SESSION) || empty($_SESSION['isLoged']) || !( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2 || $_SESSION['userInfo']['rol']==3)  ) {
			echo 'No tiene suficientes privilegios para ver este reporte'; exit;
		}
		
		// $fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		// $fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		
		$fechai = explode('/', $_REQUEST['paging']['fechai']);
		$fechaf = explode('/', $_REQUEST['paging']['fechaf']);
		
		// $agrupar = ($_REQUEST['paging']['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['paging']['tienda'];		
		$articulo = empty($_REQUEST['paging']['articulo'])? '' : $_REQUEST['paging']['articulo'];		
		
		// $filtroArticulo = empty($articulo) ?  ' ' : ' tkd.descripcion LIKE "%'.$articulo.'%" AND ' ;		
		$filtroTienda =  empty($tienda)? ' ' : ' tkd.tienda= '.$tienda.' AND ';		
		
		$start = ($_REQUEST['paging']['pageIndex'] ) * $_REQUEST['paging']['pageSize'];		
		$limit = $_REQUEST['paging']['pageSize'];		
		
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();									
		
		$sql='SELECT  count( distinct concat(tkd.tienda,"-",ti.vendedor) ) as total
		FROM tick_det tkd 
		LEFT JOIN tiendas t ON t.clave = tkd.tienda
		LEFT JOIN tick_int ti ON ti.clave = tkd.clave AND ti.tienda = tkd.tienda
		LEFT JOIN vendedores v ON v.clave = ti.vendedor AND v.tienda = tkd.tienda
		WHERE '.$filtroTienda.' ti.estatus=0 AND tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
		ORDER BY  t.tienda ASC ';
				
		// echo $sql; exit;
		$sth = $pdo->query( $sql );
				
		if ( !$sth ) {
			$res=$modelo->getError(  );
			print_r( $res );
			exit;
		}
		
		$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
		$total=$datos[0]['total'];		
		
		$sql='SELECT  t.tienda as nombreTienda, concat(tkd.tienda,"-",ti.vendedor) as vendedor_tienda, concat( ifnull(v.nombre, "" ),"(",ti.vendedor,")") as vendedor_nombre,
		SUM(tkd.cantidad * tkd.precioiva) as  importe, SUM( if (  SUBSTRING(apartado,1,1)="A", tkd.cantidad * tkd.precioiva, 0 ))  as apartado,
		SUM( if (SUBSTRING(apartado,1,1)="A", 0, tkd.cantidad * tkd.precioiva ))  as noapartado
		FROM tick_det tkd 
		LEFT JOIN tiendas t ON t.clave = tkd.tienda
		LEFT JOIN tick_int ti ON ti.clave = tkd.clave AND ti.tienda = tkd.tienda
		LEFT JOIN vendedores v ON v.clave = ti.vendedor AND v.tienda = tkd.tienda
		WHERE '.$filtroTienda.' ti.estatus=0 AND tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
		GROUP BY vendedor_tienda ORDER BY  t.tienda ASC LIMIT '.$start.', '.$limit;
		
		// echo $sql; exit;
		
		$sth = $pdo->query( $sql );
				
		if ( !$sth ) {
			$res=$modelo->getError(  );
			print_r( $res );
			exit;
		}
		
		$res=array(
			'success'	=> true,
			'datos'		=> $sth->fetchAll(PDO::FETCH_ASSOC)			
		);	
		
		if ($imprimir){
			$resp = array(
				'success'=>$res['success'],
				// 'msg'=>$res['msg'],
				'totalRows'=>$total,
				'rows'=>$res['datos']				
			);
			echo json_encode( $resp );
		}
		return $res;
	}
	
	
	function cortesJson(){
		
		
		$tienda = intval($_POST['tienda']);
		
		$fechai = explode('/', $_POST['fechai']);
		
		$sql='SELECT * FROM CorteCaja WHERE fecha = "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].'" AND tienda = '.$tienda.' and estatus=0';
		
		$mod=new Modelo();
		$pdo=$mod->getPdo();
		$sth = $pdo->query( $sql );
				
		if ( !$sth ) {
			$res=$modelo->getError(  );
			print_r( $res );
			exit;
		}
		
		$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
		if ( empty($datos) ){
			$respuesta= array(
				'success'=>false,
				'msg'=>utf8_encode('No hay cortes para esta fecha en esta tienda')
			);
		}else if ( sizeof($datos) > 1){
			$respuesta= array(
				'success'=>false,
				'msg'=>'Hay mas de un corte para esta tienda en esta fecha'
			);
		}else{
			$respuesta= array(
				'success'=>true,
				'datos'=>$datos[0]
			);
		}
		
		
		echo json_encode( $respuesta );
	}
	function cortes(){
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		
		
		$this->mostrarVista();
	}
	
	function comisiones(){
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		
		
		$this->mostrarVista();
	}
	
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
		
		//------------------
		$elMes=date('m');
		$dia=date('d');		
		$elAnio=date('Y');
		
		
		 $_REQUEST['paging']['fechai'] = $dia.'/'.$elMes.'/'.$elAnio; 
		 $_REQUEST['paging']['fechaf'] = $dia.'/'.$elMes.'/'.$elAnio; 
		 $_REQUEST['paging']['agrupar']='true';
		 $_REQUEST['paging']['tienda']='';
		 $_REQUEST['paging']['pageIndex']=1;
		 $_REQUEST['paging']['pageSize']=11;
		//------------------
		
		$datos = $this->vendidosJson(false);
		$vista->datos = $datos['datos'];
		$vista->apartados = $datos['apartados'];
		$vista->vendidos = $datos['vendidos'];
		$vista->importe = $datos['importe'];
		$vista->mostrar();
	}
	
	function vendidoshtml(){
		$tiendaMod = new TiendaModelo();
		$res  =$tiendaMod->buscar( array() );				
		$vista=$this->getVista();
		$vista->tiendas = $res['datos'];
		
		//------------------
		$elMes=date('m');
		$dia=date('d');		
		$elAnio=date('Y');
		
		
		 $_REQUEST['paging']['fechai'] = $dia.'/'.$elMes.'/'.$elAnio; 
		 $_REQUEST['paging']['fechaf'] = $dia.'/'.$elMes.'/'.$elAnio; 
		 $_REQUEST['paging']['agrupar']='true';
		 $_REQUEST['paging']['tienda']='';
		 $_REQUEST['paging']['pageIndex']=1;
		 $_REQUEST['paging']['pageSize']=13;
		//------------------
		
		$datos = $this->vendidosJson(false);
		$vista->datos = $datos['datos'];
		$vista->apartados = $datos['apartados'];
		$vista->vendidos = $datos['vendidos'];
		$vista->importe = $datos['importe'];
		$vista->mostrar('/vendidos_grid');
	}
	function vendidosJson($imprimir=true){			
		if ( empty($_SESSION) || empty($_SESSION['isLoged']) || !( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2 || $_SESSION['userInfo']['rol']==3)  ) {
			echo 'No tiene suficientes privilegios para ver este reporte'; exit;
		}
		
		// $fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		// $fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		
		$fechai = explode('/', $_REQUEST['paging']['fechai']);
		$fechaf = explode('/', $_REQUEST['paging']['fechaf']);
		
		$agrupar = ($_REQUEST['paging']['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['paging']['tienda'];		
		$articulo = empty($_REQUEST['paging']['articulo'])? '' : $_REQUEST['paging']['articulo'];		
		
		$filtroArticulo = empty($articulo) ?  ' ' : ' tkd.descripcion LIKE "%'.$articulo.'%" AND ' ;		
		$filtroTienda =  empty($tienda)? ' ' : ' tkd.tienda= '.$tienda.' AND ';		
		
		$start = ($_REQUEST['paging']['pageIndex'] ) * $_REQUEST['paging']['pageSize'];		
		$limit = $_REQUEST['paging']['pageSize'];		
		
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();						
		
		$sql='SELECT  count(tkd.primario) as total,
		SUM(tkd.cantidad * tkd.precioiva) as  importe, SUM( if (  SUBSTRING(apartado,1,1)="A", tkd.cantidad * tkd.precioiva, 0 ))  as apartado,
		SUM( if (SUBSTRING(apartado,1,1)="A", 0, tkd.cantidad * tkd.precioiva ))  as noapartado
		FROM tick_det tkd 
		LEFT JOIN tiendas t ON t.clave = tkd.tienda
		LEFT JOIN articulos a ON a.clave = tkd.primario				
		LEFT JOIN grupos g ON g.clave = a.grupo		
		WHERE '.
		$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.
		$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59"';
		
		 // echo $sql; exit;
		
		$sth = $pdo->query( $sql );
				
		if ( !$sth ) {
			$res=$modelo->getError(  );
			print_r( $res );
			exit;
		}
		
		$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
		$total=$datos[0]['total'];
		
		
		
		$importe='$'.number_format($datos[0]['importe'], 2, '.', ','); 
		$apartados='$'.number_format($datos[0]['apartado'], 2, '.', ','); 
		$vendidos='$'.number_format($datos[0]['noapartado'], 2, '.', ','); 
		
		
		
		$sql='SELECT  t.tienda as nombreTienda,
		g.nombre as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad, tkd.descripcion, 
		SUM(tkd.cantidad * tkd.precioiva) as  importe, SUM( if (  SUBSTRING(apartado,1,1)="A", tkd.cantidad * tkd.precioiva, 0 ))  as apartado,
		SUM( if (SUBSTRING(apartado,1,1)="A", 0, tkd.cantidad * tkd.precioiva ))  as noapartado
		FROM tick_det tkd 
		LEFT JOIN tiendas t ON t.clave = tkd.tienda
		LEFT JOIN articulos a ON a.clave = tkd.primario				
		LEFT JOIN grupos g ON g.clave = a.grupo		
		WHERE '.$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
		GROUP BY tkd.primario ORDER BY ';
		
		  // echo $sql; exit;
		
		
		if ( $agrupar ){
			$orden=' t.tienda ASC, a.clavesecundaria, cantidad DESC LIMIT '.$start.', '.$limit;
		}else{
			$orden=' a.clavesecundaria, cantidad DESC LIMIT '.$start.', '.$limit;
		}
		$sql.=$orden;
		
		 // echo $sql; exit;
		
		$sth = $pdo->query( $sql );
				
		if ( !$sth ) {
			$res=$modelo->getError(  );
			print_r( $res );
			exit;
		}
		
		$res=array(
			'success'	=> true,
			'datos'		=> $sth->fetchAll(PDO::FETCH_ASSOC),
			'importe'	=> $importe,
			'apartados'	=> $apartados,
			'vendidos'	=> $vendidos
		);	
		
		if ($imprimir){
			$resp = array(
				'success'=>$res['success'],
				// 'msg'=>$res['msg'],
				'totalRows'=>$total,
				'rows'=>$res['datos'],
				'importe'	=> $importe,
				'apartados'	=> $apartados,
				'vendidos'	=> $vendidos
			);
			echo json_encode( $resp );
		}
		return $res;
	}
	
	function vendidosPdf(){			
		if ( empty($_SESSION) || empty($_SESSION['isLoged']) || !( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2 || $_SESSION['userInfo']['rol']==3)  ) {
			echo 'No tiene suficientes privilegios para ver este reporte'; exit;
		}
				
		// $fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		// $fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		
		$fechai = explode('/', $_REQUEST['fechai']);
		$fechaf = explode('/', $_REQUEST['fechaf']);
		
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];		
		$articulo = empty($_REQUEST['articulo'])? '' : $_REQUEST['articulo'];		
		if ( !empty($articulo) ){
			$filtroArticulo = ' tkd.descripcion LIKE "%'.$articulo.'%" AND ';
		}else{
			$filtroArticulo = ' ';
		}
		
		if ( !empty($tienda) ){
			$filtroTienda = ' tkd.tienda= '.$tienda.' AND ';
		}else{
			$filtroTienda = ' ';
		}
		
		
		
		$sql='SELECT  t.tienda as nombreTienda,
		g.nombre as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad, tkd.descripcion, 
		SUM(tkd.cantidad * tkd.precioiva) as  importe, SUM( if (  SUBSTRING(apartado,1,1)="A", tkd.cantidad * tkd.precioiva, 0 ))  as apartado,
		SUM( if (SUBSTRING(apartado,1,1)="A", 0, tkd.cantidad * tkd.precioiva ))  as noapartado
		FROM tick_det tkd 
		LEFT JOIN tiendas t ON t.clave = tkd.tienda
		LEFT JOIN articulos a ON a.clave = tkd.primario				
		LEFT JOIN grupos g ON g.clave = a.grupo		
		WHERE '.$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
		GROUP BY tkd.primario ORDER BY ';
		
		  // echo $sql; exit;
		
		
		if ( $agrupar ){
			$orden=' t.tienda ASC, a.clavesecundaria, cantidad DESC';
		}else{
			$orden=' a.clavesecundaria, cantidad DESC';
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
		if ( empty($_SESSION) || empty($_SESSION['isLoged']) || !( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2 || $_SESSION['userInfo']['rol']==3)  ) {
			echo 'No tiene suficientes privilegios para ver este reporte'; exit;
		}
		// $fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		// $fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		
		$fechai = explode('/', $_REQUEST['fechai']);
		$fechaf = explode('/', $_REQUEST['fechaf']);
		
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];				
		if ( !empty($tienda) ){
			$filtroTienda = ' tkd.tienda= '.$tienda.' AND ';
		}else{
			$filtroTienda = ' ';
		}
		
		$articulo = empty($_REQUEST['articulo'])? '' : $_REQUEST['articulo'];		
		if ( !empty($articulo) ){
			$filtroArticulo = ' tkd.descripcion LIKE "%'.$articulo.'%" AND ';
		}else{
			$filtroArticulo = ' ';
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
				$filtroTienda=' tkd.tienda="'.$tiendaId.'" AND ';
				
				$sql='SELECT  t.tienda as nombreTienda,
				g.nombre as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
				SUM(tkd.cantidad * tkd.precioiva) as  importe
				FROM tick_det tkd 
				LEFT JOIN tiendas t ON t.clave = tkd.tienda
				LEFT JOIN articulos a ON a.clave = tkd.primario	
				LEFT JOIN grupos g ON g.clave = a.grupo								
				WHERE '.$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
				GROUP BY tkd.primario ORDER BY cantidad ASC, a.clavesecundaria ASC limit 0,20';
				
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
			g.nombre as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
			(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
			FROM tick_det tkd 
			LEFT JOIN tiendas t ON t.clave = tkd.tienda
			LEFT JOIN articulos a ON a.clave = tkd.primario				
			LEFT JOIN grupos g ON g.clave = a.grupo			
			WHERE '.$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
			GROUP BY tkd.primario ORDER BY ';
			
			if ( $agrupar ){
				$orden=' tkd.tienda ASC, cantidad ASC, a.clavesecundaria ASC';
			}else{
				$orden='  cantidad ASC, a.clavesecundaria ASC';
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
		if ( empty($_SESSION) || empty($_SESSION['isLoged']) || !( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2 || $_SESSION['userInfo']['rol']==3)  ) {
			echo 'No tiene suficientes privilegios para ver este reporte'; exit;
		}
		
		// $fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		// $fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		
		$fechai = explode('/', $_REQUEST['fechai']);
		$fechaf = explode('/', $_REQUEST['fechaf']);
		
		$agrupar = ($_REQUEST['agrupar'] =='true') ? true: false;
		$tienda = $_REQUEST['tienda'];		
		
		$articulo = empty($_REQUEST['articulo'])? '' : $_REQUEST['articulo'];		
		if ( !empty($articulo) ){
			$filtroArticulo = ' tkd.descripcion LIKE "%'.$articulo.'%" AND ';
		}else{
			$filtroArticulo = ' ';
		}
		
		$modelo=new Modelo();
		$pdo=$modelo->getPdo();						
			
		if ( !empty($tienda) ){
			$filtroTienda = ' tkd.tienda= '.$tienda.' AND ';
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
				$filtroTienda=' tkd.tienda="'.$tiendaId.'" AND ';
				
				$sql='SELECT  t.tienda as nombreTienda,
				g.nombre as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
				SUM(tkd.cantidad * tkd.precioiva ) as  importe
				FROM tick_det tkd 
				LEFT JOIN tiendas t ON t.clave = tkd.tienda
				LEFT JOIN articulos a ON a.clave = tkd.primario				
				LEFT JOIN grupos g ON g.clave = a.grupo				
				WHERE '.$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
				GROUP BY tkd.primario ORDER BY cantidad DESC limit 0,20';
				
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
			g.nombre as modelo, a.clavesecundaria, sum(tkd.cantidad) as cantidad,tkd.descripcion, 
			(tkd.cantidad * SUM(tkd.precioiva) ) as  importe
			FROM tick_det tkd 
			LEFT JOIN tiendas t ON t.clave = tkd.tienda
			LEFT JOIN articulos a ON a.clave = tkd.primario				
			LEFT JOIN grupos g ON g.clave = a.grupo			
			WHERE '.$filtroTienda.$filtroArticulo.' tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
			GROUP BY tkd.primario ORDER BY ';
			
			if ( $agrupar ){
				$orden=' tk.tienda ASC, cantidad DESC, a.clavesecundaria ASC';
			}else{
				$orden='  cantidad DESC, a.clavesecundaria ASC';
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
		if ( empty($_SESSION) || empty($_SESSION['isLoged']) || !( $_SESSION['userInfo']['rol']==1 || $_SESSION['userInfo']['rol']==2 || $_SESSION['userInfo']['rol']==3)  ) {
			echo 'No tiene suficientes privilegios para ver este reporte'; exit;
		}
		// $fechai=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechai'] );
		// $fechaf=DateTime::createFromFormat ( 'd/m/Y' , $_REQUEST['fechaf'] );
		$fechai = explode('/', $_REQUEST['fechai']);
		$fechaf = explode('/', $_REQUEST['fechaf']);
		
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
			
			$sql='SELECT t.tienda nombreTienda, a.clavesecundaria, a.precio1,a.nombre,a.talla FROM articulos a 
			LEFT JOIN tiendas t ON t.clave ="'.$tiendaId.'"
			LEFT JOIN
				(SELECT  tkd.primario primario
					FROM tick_det tkd 				
					WHERE   tkd.fechaventa >= "'.$fechai[2].'-'.$fechai[1].'-'.$fechai[0].' 00:00:00" and tkd.fechaventa <= "'.$fechaf[2].'-'.$fechaf[1].'-'.$fechaf[0].' 23:59:59" 
					AND tkd.tienda ="'.$tiendaId.'" GROUP BY  primario DESC) b ON a.clave = b.primario
			WHERE b.primario IS NULL limit 0,1000';
			
			// echo $sql; exit;
			$sth = $pdo->query( $sql );
				
			if ( !$sth ) {
				$res=$modelo->getError(  );
				print_r( $res );
				exit;
			}
			
			$datos=$sth->fetchAll(PDO::FETCH_ASSOC);
			$resultados = array_merge($datos, $resultados);
			break;
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
		
		
		$pdf=new ReporteNoVendidosPdf($agrupar);
		
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