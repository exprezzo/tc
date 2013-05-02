
<script src="<?php echo $MOD_WEB_PATH; ?>js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

<script>			
	$( function(){		
		var config={
			tab:{
				id:'<?php echo $_REQUEST['tabId']; ?>'
			},
			controlador:{
				nombre:'<?php echo $_PETICION->controlador; ?>'
			},
			modulo:{
				nombre:'<?php echo $_PETICION->modulo; ?>'
			},
			catalogo:{
				nombre:'ticket'
			},			
			pk:"id"
			
		};				
		 var editor=new Ediciontickets();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar('/backend/componentes/toolbar');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">				
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fechasinc:</label>
	<input type="text" name="fechasinc" class="txt_fechasinc" value="<?php echo $this->datos['fechasinc']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Tienda:</label>
	<input type="text" name="tienda" class="txt_tienda" value="<?php echo $this->datos['tienda']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Clave:</label>
	<input type="text" name="clave" class="txt_clave" value="<?php echo $this->datos['clave']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Fecha:</label>
	<input type="text" name="fecha" class="txt_fecha" value="<?php echo $this->datos['fecha']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Hora:</label>
	<input type="text" name="hora" class="txt_hora" value="<?php echo $this->datos['hora']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Subtotal:</label>
	<input type="text" name="subtotal" class="txt_subtotal" value="<?php echo $this->datos['subtotal']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Iva:</label>
	<input type="text" name="iva" class="txt_iva" value="<?php echo $this->datos['iva']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Total:</label>
	<input type="text" name="total" class="txt_total" value="<?php echo $this->datos['total']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cliente:</label>
	<input type="text" name="cliente" class="txt_cliente" value="<?php echo $this->datos['cliente']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Estatus:</label>
	<input type="text" name="estatus" class="txt_estatus" value="<?php echo $this->datos['estatus']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Factura:</label>
	<input type="text" name="factura" class="txt_factura" value="<?php echo $this->datos['factura']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Efectivo:</label>
	<input type="text" name="efectivo" class="txt_efectivo" value="<?php echo $this->datos['efectivo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Vales:</label>
	<input type="text" name="vales" class="txt_vales" value="<?php echo $this->datos['vales']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cheques:</label>
	<input type="text" name="cheques" class="txt_cheques" value="<?php echo $this->datos['cheques']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Otros:</label>
	<input type="text" name="otros" class="txt_otros" value="<?php echo $this->datos['otros']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Descuento:</label>
	<input type="text" name="descuento" class="txt_descuento" value="<?php echo $this->datos['descuento']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cortecaja:</label>
	<input type="text" name="cortecaja" class="txt_cortecaja" value="<?php echo $this->datos['cortecaja']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Clientenombre:</label>
	<input type="text" name="clientenombre" class="txt_clientenombre" value="<?php echo $this->datos['clientenombre']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cxcob:</label>
	<input type="text" name="cxcob" class="txt_cxcob" value="<?php echo $this->datos['cxcob']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Usuario:</label>
	<input type="text" name="usuario" class="txt_usuario" value="<?php echo $this->datos['usuario']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Vendedor:</label>
	<input type="text" name="vendedor" class="txt_vendedor" value="<?php echo $this->datos['vendedor']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Colonia:</label>
	<input type="text" name="colonia" class="txt_colonia" value="<?php echo $this->datos['colonia']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Dolares:</label>
	<input type="text" name="dolares" class="txt_dolares" value="<?php echo $this->datos['dolares']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Tipocambio:</label>
	<input type="text" name="tipocambio" class="txt_tipocambio" value="<?php echo $this->datos['tipocambio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Clavevale:</label>
	<input type="text" name="clavevale" class="txt_clavevale" value="<?php echo $this->datos['clavevale']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Sinc:</label>
	<input type="text" name="sinc" class="txt_sinc" value="<?php echo $this->datos['sinc']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Id:</label>
	<input type="text" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
