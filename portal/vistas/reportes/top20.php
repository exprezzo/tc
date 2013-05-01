<script>			
	$( function(){		
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		
		$(tabid + ' [name="fechai"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy' });
		$(tabid + ' [name="fechaf"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'  });
		
		$(tabid + ' [name="tienda"]').wijcombobox();
		$(tabid + ' [name="agrupar"]').wijcheckbox();
		
		$(tabid + ' .refresh').button().click(function(){
			var fechai=$(tabid + ' [name="fechai"]').val();
			var fechaf=$(tabid + ' [name="fechaf"]').val();
			var tienda=$(tabid + ' [name="tienda"]').val();			
			var agrupar=$(tabid +' [name="agrupar"]').prop('checked');
			
			var url='/';
			$(tabid+' .pdfReader').attr('data',url);			
			$(tabid+' .pdfReader').load(url);
			
			url='/reportes/top20Pdf?fechai='+fechai+'&fechaf='+fechaf+'&tienda='+tienda+'&agrupar='+agrupar;			
			$(tabid+' .pdfReader').attr('data',url);
			//http://stackoverflow.com/questions/10366867/object-tag-doesnt-refresh-when-its-data-attribute-is-changed-in-chrome
			$(tabid+' .pdfReader').load(url);
		});
		
		
		
	});
</script>
<style>
.inputBox{
	display:inline-block !important;
}
.tiendas [role="combobox"]{
	top:10px;
}
</style>

<?php 
	$elMes=date('m');
	$elAnio=date('Y');
	$ultimoDia=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	// $elAnio=date('y');
?>
<div class="ui-widget-header" style="text-align:center;">
	<div  style="display:inline-block; margin-right:20px;">	
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Fecha Inicio:</label>
			<input type="text" name="fechai" class="txt_fechai" value="<?php echo '1/'.$elMes.'/'.$elAnio; ?>" style=";" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Fecha Fin:</label>
			<input type="text" name="fechaf" class="txt_fechaf" value="<?php echo $ultimoDia.'/'.$elMes.'/'.$elAnio; ?>" style="" />
		</div>
		<div class="inputBox tiendas" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Tienda:</label>
			<select name="tienda" class="txt_tienda" style="top:10px;">
				
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
<div>
<div>
	<object class="pdfReader" data="" type="application/pdf" width="100%" height="93%">
		alt : <a href="#"></a>
	</object>
</div>