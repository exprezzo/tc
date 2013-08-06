<script>			
	$( function(){		
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		
		
		$(tabid + ' [name="fechai"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		// $(tabid + ' [name="fechaf"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="tienda"]').wijcombobox();
		 $(tabid + ' .numeros input').wijinputnumber({
            type: 'currency',            
            decimalPlaces: 2            
        });
		// $(tabid + ' [name="agrupar"]').wijcheckbox({checked: true});
		
		
		
		$(tabid + ' .refresh').button().click(function(){
			$(tabid + ' .numeros input').val('');
			
			var datos={};
			datos['fechai']=$(tabid + ' [name="fechai"]').val();				
			datos['tienda']=$(tabid + ' [name="tienda"]').val();			
			
			console.log('datos'); console.log(datos); 
			$.ajax({
			   url: "/reportes/cortesJson",
			   type:'POST',
			   data:datos,
			}).done(function(respuesta) {
			   var resp= eval( '('+respuesta+')');
			    
			   if ( !resp.success ){
					if (resp.msg){
						alert(resp.msg);
					}
					return false;
			   }
			   
			   var elemento;
			   $.each( resp.datos, function( key, value ) {
					elemento = $(tabid + ' input[name="'+key+'"]');
					if (elemento.length== 1){
						// $(elemento).val(value);
						if ( value==null ) value=0;
						elemento.wijinputnumber('setValue',value);
					}
					// console.log("elemento"); console.log(elemento);
				  // alert( key + ": " + value );
				});

			});
		});		
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

.numeros input{ text-align:right;}
.numeros label{text-align:right; }
</style>


<?php 
	$elMes=date('m');
	$dia=date('d');
	
	$elAnio=date('Y');
	$ultimoDia=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));	
?>
<div class="ui-widget-header" style="text-align:center;">
	<div  style="display:inline-block; margin-right:20px;">
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:5px;"  >
			<label style="">Fecha:</label>
			<input type="text" name="fechai" class="txt_fechai" value="<?php echo $dia.'/'.$elMes.'/'.$elAnio; ?>" style="width:123px;" />			
		</div>
		<div class="inputBox tiendas" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Tienda:</label>
			<select name="tienda" class="txt_tienda" style="">
				<?php					
					foreach($this->tiendas as $obj){
						echo '<option  value="'.$obj['clave'].'">'.$obj['tienda'].'</option>';
					}
				?>
			</select>
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<input class="refresh" type="submit" value="Ver Corte" />
		</div>
	</div>
</div>

<div style="text-align:center; margin-top:13px;" class="numeros">
	<div style="display:inline-block; vertical-align:top;">
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="">Dep&oacute;sitos:</label>			
			<input readonly type="text" name="depositos" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 92px;display: inline-block;">Retiros:</label>			
			<input readonly type="text" name="retiros" class="" value="" style="width:110px;" />
		</div>
	</div>

	<div style="display:inline-block;">
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 82px;display: inline-block;">Efectivo:</label>			
			<input readonly type="text" name="efectivo" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="">Cheques:</label>			
			<input readonly type="text" name="cheque" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 82px;display: inline-block;">Abonos:</label>			
			<input readonly type="text" name="abonos" class="" value="" style="width:110px;" />
		</div>
	</div>

	<div style="display:inline-block;">
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="">Tarjeta:</label>			
			<input readonly type="text" name="tarjeta" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="">CxCob:</label>			
			<input  type="text" name="cxco" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="">Maribel:</label>			
			<input readonly type="text" name="maribel" class="" value="" style="width:110px;" />
		</div>
	</div>

	<div style="display:inline-block;">
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 113px;display: inline-block;">Otros:</label>			
			<input readonly type="text" name="otros" class="" value="" style="width:110px;" />
		</div>

		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 113px;display: inline-block;">Total:</label>			
			<input readonly type="text" name="total" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="">Total de caja:</label>			
			<input readonly type="text" name="totalcaja" class="" value="" style="width:110px;" />
		</div>	
	</div>

<div>



<div style="text-align:center; margin-top:13px;" class="numeros">
	<div style="display:inline-block;  margin-top:11px;">
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 158px;display: inline-block;">Num de Tickets:</label>			
			<input readonly type="text" name="ticketstotales" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 158px;display: inline-block;">Ticket Inicial:</label>			
			<input readonly type="text" name="ticketinicial" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 158px;display: inline-block;">Ticket Final:</label>			
			<input readonly type="text" name="ticketfinal" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 158px;display: inline-block;">Ticket cancelados:</label>			
			<input readonly type="text" name="ticketcancelados" class="" value="" style="width:110px;" />
		</div>
	</div>
	
	<fieldset style="display:inline-block;  vertical-align:top;">
		<legend >Venta de Tickets</legend>
		
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 77px;">Contado:</label>			
			<input readonly type="text" name="ticketcontado" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 77px; display: inline-block;">Credito:</label>			
			<input readonly type="text" name="ticketcredito" class="" value="" style="width:110px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
			<label style="width: 77px; display: inline-block;">Tarjeta:</label>			
			<input readonly type="text" name="tickettarjeta" class="" value="" style="width:110px;" />
		</div>		
	
	</fieldset>
	<div style="display:inline-block; vertical-align:top;">
		<div style="display:inline-block;  margin-top:11px; vertical-align:top;">
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="">Num de Facturas:</label>			
				<input readonly type="text" name="facturatotales" class="" value="" style="width:110px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="width: 149px;display: inline-block;">Factura Inicial:</label>			
				<input readonly type="text" name="facturainicial" class="" value="" style="width:110px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="width: 149px;display: inline-block;">Factura Final:</label>			
				<input readonly type="text" name="facturafinal" class="" value="" style="width:110px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="width: 149px;display: inline-block;">Facs canceladas:</label>			
				<input readonly type="text" name="facturacancelados" class="" value="" style="width:110px;" />
			</div>
		</div>
		
		<fieldset style="display:inline-block;  vertical-align:top;">
			<legend >Ventas de Facturas</legend>
			
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="width: 77px;">Contado:</label>			
				<input readonly type="text" name="facturacontado" class="" value="" style="width:110px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="width: 77px;display: inline-block;">Credito:</label>			
				<input readonly type="text" name="facturacredito" class="" value="" style="width:110px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block !important;margin-left:5px;"  >
				<label style="width: 77px;display: inline-block;">Tarjeta:</label>			
				<input readonly type="text" name="facturatarjeta" class="" value="" style="width:110px;" />
			</div>		
		
		</fieldset>
	</div>
</div>