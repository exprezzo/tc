<script>			
	$( function(){		
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		
		$(tabid + ' [name="fechai"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="fechaf"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="tienda"]').wijcombobox();
		$(tabid + ' [name="articulo"]').wijtextbox();
		$(tabid + ' [name="agrupar"]').wijcheckbox({checked: true});
		
		$(tabid + ' .refresh').button().click(function(){
					
			var fechai=$(tabid + ' [name="fechai"]').val();
			var fechaf=$(tabid + ' [name="fechaf"]').val();
			var tienda=$(tabid + ' [name="tienda"]').val();			
			var articulo=$(tabid + ' [name="articulo"]').val();	
			var agrupar=$(tabid +' [name="agrupar"]').prop('checked');
			
			var url=kore.url_base+'web/blanco.pdf';
			$(tabid+' .pdfReader').attr('data',url);			
			$(tabid+' .pdfReader').load(url);
			
			url=kore.url_base+'reportes/vendidosPdf?fechai='+fechai+'&fechaf='+fechaf+'&tienda='+tienda+'&agrupar='+agrupar;			
			if (articulo!=''){
				url+='&articulo='+articulo;
			}
			$(tabid+' .pdfReader').attr('data',url);
			//http://stackoverflow.com/questions/10366867/object-tag-doesnt-refresh-when-its-data-attribute-is-changed-in-chrome
			$(tabid+' .pdfReader').load(url);
			
			var ht = $('#tabs [role="tablist"]').height();		
			var hh = $(tabid + ' .ui-widget-header').height();				
			$( tabid + ' .pdfReader').height(ht - hh);
		});
		
		setTimeout(function() { 
			var ht = $('#tabs [role="tablist"]').height();		
			var hh = $(tabid + ' .ui-widget-header').height();					
			$( tabid + ' .pdfReader').height(ht - hh);
		}, 1000);
		
		
	});
</script>
<style>
.inputBox{
	display:inline-block !important;
}
.tiendas [role="combobox"]{
	position: relative;
	top: 10px;
}
@-moz-document url-prefix()
{
  .tiendas [role="combobox"]{
		top: 29px !important; 
	}
}
</style>


<?php 
	$elMes=date('m');
	$dia=date('d');
	
	$elAnio=date('Y');
	$ultimoDia=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	
	// $elAnio=date('y');
?>
<div class="ui-widget-header" style="text-align:center;">
	<div  style="display:inline-block; margin-right:20px;">	
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:5px;"  >
			<label style="">Fecha:</label>
			<input type="text" name="fechai" class="txt_fechai" value="<?php echo $dia.$elMes.'/'.$elAnio; ?>" style="width:123px;" />
			<input type="text" name="fechaf" class="txt_fechaf" value="<?php echo $dia.'/'.$elMes.'/'.$elAnio; ?>" style="width:123px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Articulo:</label>
			<input type="text" name="articulo" class="" value="" style="width:120px;" />
		</div>
		<div class="inputBox tiendas" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Tienda:</label>
			<select name="tienda" class="txt_tienda" style="">				
				<?php
					echo '<option value="0" selected>TODAS</option>';
					// $rolId = $this->datos['rol'];						
					
					foreach($this->tiendas as $obj){					
						echo '<option  value="'.$obj['clave'].'">'.$obj['tienda'].'</option>';					
						
					}
				?>
			</select>
		</div>
		<div class="inputBox " style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label><input type="checkbox" name="agrupar" > Agrupar</label>
		</div>
		

		
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<input class="refresh" type="submit" value="Ver reporte" />
		</div>
	</div>
</div>
<div >
	<object class="pdfReader" data="<?php echo $_APP_PATH; ?>web/blanco.pdf" type="application/pdf" width="100%" height="93%" style="">
		alt : <a href="#"></a>
	</object>
</div>

<script>
	$().ready(function(){
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		
	});
	
	
	
</script>