
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
				nombre:'articulos'
			},			
			pk:"clave"
			
		};				
		 var editor=new Edicionarticulos();
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
	<label style="">Clave:</label>
	<input type="text" name="clave" class="txt_clave" value="<?php echo $this->datos['clave']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Clavesecundaria:</label>
	<input type="text" name="clavesecundaria" class="txt_clavesecundaria" value="<?php echo $this->datos['clavesecundaria']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Nombre:</label>
	<input type="text" name="nombre" class="txt_nombre" value="<?php echo $this->datos['nombre']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Grupo:</label>
	<input type="text" name="grupo" class="txt_grupo" value="<?php echo $this->datos['grupo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Presentacion:</label>
	<input type="text" name="presentacion" class="txt_presentacion" value="<?php echo $this->datos['presentacion']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Depto:</label>
	<input type="text" name="depto" class="txt_depto" value="<?php echo $this->datos['depto']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Dcategoria:</label>
	<input type="text" name="dcategoria" class="txt_dcategoria" value="<?php echo $this->datos['dcategoria']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Tipo:</label>
	<input type="text" name="tipo" class="txt_tipo" value="<?php echo $this->datos['tipo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Ultimoproveedor:</label>
	<input type="text" name="ultimoproveedor" class="txt_ultimoproveedor" value="<?php echo $this->datos['ultimoproveedor']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Costo:</label>
	<input type="text" name="costo" class="txt_costo" value="<?php echo $this->datos['costo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio1:</label>
	<input type="text" name="precio1" class="txt_precio1" value="<?php echo $this->datos['precio1']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio2:</label>
	<input type="text" name="precio2" class="txt_precio2" value="<?php echo $this->datos['precio2']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio3:</label>
	<input type="text" name="precio3" class="txt_precio3" value="<?php echo $this->datos['precio3']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio4:</label>
	<input type="text" name="precio4" class="txt_precio4" value="<?php echo $this->datos['precio4']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Precio5:</label>
	<input type="text" name="precio5" class="txt_precio5" value="<?php echo $this->datos['precio5']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Talla:</label>
	<input type="text" name="talla" class="txt_talla" value="<?php echo $this->datos['talla']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Descuentomax:</label>
	<input type="text" name="descuentomax" class="txt_descuentomax" value="<?php echo $this->datos['descuentomax']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Ultimaconsulta:</label>
	<input type="text" name="ultimaconsulta" class="txt_ultimaconsulta" value="<?php echo $this->datos['ultimaconsulta']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Reorden:</label>
	<input type="text" name="reorden" class="txt_reorden" value="<?php echo $this->datos['reorden']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Reordendes:</label>
	<input type="text" name="reordendes" class="txt_reordendes" value="<?php echo $this->datos['reordendes']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa:</label>
	<input type="text" name="utilidadventa" class="txt_utilidadventa" value="<?php echo $this->datos['utilidadventa']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa2:</label>
	<input type="text" name="utilidadventa2" class="txt_utilidadventa2" value="<?php echo $this->datos['utilidadventa2']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa3:</label>
	<input type="text" name="utilidadventa3" class="txt_utilidadventa3" value="<?php echo $this->datos['utilidadventa3']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa4:</label>
	<input type="text" name="utilidadventa4" class="txt_utilidadventa4" value="<?php echo $this->datos['utilidadventa4']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa5:</label>
	<input type="text" name="utilidadventa5" class="txt_utilidadventa5" value="<?php echo $this->datos['utilidadventa5']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa1sis:</label>
	<input type="text" name="utilidadventa1sis" class="txt_utilidadventa1sis" value="<?php echo $this->datos['utilidadventa1sis']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa2sis:</label>
	<input type="text" name="utilidadventa2sis" class="txt_utilidadventa2sis" value="<?php echo $this->datos['utilidadventa2sis']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa3sis:</label>
	<input type="text" name="utilidadventa3sis" class="txt_utilidadventa3sis" value="<?php echo $this->datos['utilidadventa3sis']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa4sis:</label>
	<input type="text" name="utilidadventa4sis" class="txt_utilidadventa4sis" value="<?php echo $this->datos['utilidadventa4sis']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadventa5sis:</label>
	<input type="text" name="utilidadventa5sis" class="txt_utilidadventa5sis" value="<?php echo $this->datos['utilidadventa5sis']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadfactor:</label>
	<input type="text" name="utilidadFactor" class="txt_utilidadFactor" value="<?php echo $this->datos['utilidadFactor']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Utilidadfactorsis:</label>
	<input type="text" name="utilidadFactorsis" class="txt_utilidadFactorsis" value="<?php echo $this->datos['utilidadFactorsis']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Iva:</label>
	<input type="text" name="IVA" class="txt_IVA" value="<?php echo $this->datos['IVA']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Factorconv:</label>
	<input type="text" name="FactorConv" class="txt_FactorConv" value="<?php echo $this->datos['FactorConv']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Unidadconv:</label>
	<input type="text" name="UnidadConv" class="txt_UnidadConv" value="<?php echo $this->datos['UnidadConv']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Costopromedio:</label>
	<input type="text" name="CostoPromedio" class="txt_CostoPromedio" value="<?php echo $this->datos['CostoPromedio']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Preciofactor:</label>
	<input type="text" name="PrecioFactor" class="txt_PrecioFactor" value="<?php echo $this->datos['PrecioFactor']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Existenciaf:</label>
	<input type="text" name="ExistenciaF" class="txt_ExistenciaF" value="<?php echo $this->datos['ExistenciaF']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Subgrupo:</label>
	<input type="text" name="subgrupo" class="txt_subgrupo" value="<?php echo $this->datos['subgrupo']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Submarcas:</label>
	<input type="text" name="subMarcas" class="txt_subMarcas" value="<?php echo $this->datos['subMarcas']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Emaxima:</label>
	<input type="text" name="Emaxima" class="txt_Emaxima" value="<?php echo $this->datos['Emaxima']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
