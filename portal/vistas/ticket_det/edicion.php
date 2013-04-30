
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
				nombre:'ticket_det'
			},			
			pk:"clave"
			
		};				
		 var editor=new Edicionticket_det();
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
	<label style="">Numero:</label>
	<input type="text" name="numero" class="txt_numero" value="<?php echo $this->datos['numero']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Primario:</label>
	<input type="text" name="primario" class="txt_primario" value="<?php echo $this->datos['primario']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cantidad:</label>
	<input type="text" name="cantidad" class="txt_cantidad" value="<?php echo $this->datos['cantidad']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Costo:</label>
	<input type="text" name="costo" class="txt_costo" value="<?php echo $this->datos['costo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio:</label>
	<input type="text" name="precio" class="txt_precio" value="<?php echo $this->datos['precio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Descripcion:</label>
	<input type="text" name="descripcion" class="txt_descripcion" value="<?php echo $this->datos['descripcion']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Folio:</label>
	<input type="text" name="folio" class="txt_folio" value="<?php echo $this->datos['folio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Modo:</label>
	<input type="text" name="modo" class="txt_modo" value="<?php echo $this->datos['modo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Mecanico:</label>
	<input type="text" name="mecanico" class="txt_mecanico" value="<?php echo $this->datos['mecanico']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Nivel:</label>
	<input type="text" name="nivel" class="txt_nivel" value="<?php echo $this->datos['nivel']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Factor:</label>
	<input type="text" name="factor" class="txt_factor" value="<?php echo $this->datos['factor']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cantidad1:</label>
	<input type="text" name="cantidad1" class="txt_cantidad1" value="<?php echo $this->datos['cantidad1']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Cantidad2:</label>
	<input type="text" name="cantidad2" class="txt_cantidad2" value="<?php echo $this->datos['cantidad2']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Iva:</label>
	<input type="text" name="iva" class="txt_iva" value="<?php echo $this->datos['iva']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Unidadfactor:</label>
	<input type="text" name="unidadfactor" class="txt_unidadfactor" value="<?php echo $this->datos['unidadfactor']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Costopromedio:</label>
	<input type="text" name="costopromedio" class="txt_costopromedio" value="<?php echo $this->datos['costopromedio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Descuento:</label>
	<input type="text" name="descuento" class="txt_descuento" value="<?php echo $this->datos['descuento']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Nivelprecio:</label>
	<input type="text" name="nivelprecio" class="txt_nivelprecio" value="<?php echo $this->datos['nivelprecio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Espera:</label>
	<input type="text" name="espera" class="txt_espera" value="<?php echo $this->datos['espera']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precioiva:</label>
	<input type="text" name="precioiva" class="txt_precioiva" value="<?php echo $this->datos['precioiva']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Resurtido:</label>
	<input type="text" name="resurtido" class="txt_resurtido" value="<?php echo $this->datos['resurtido']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Sinc:</label>
	<input type="text" name="sinc" class="txt_sinc" value="<?php echo $this->datos['sinc']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
