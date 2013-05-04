
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
				nombre:'grupo'
			},			
			pk:"clave"
			
		};				
		 var editor=new Ediciongrupos();
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
	<input type="text" name="Clave" class="txt_Clave" value="<?php echo $this->datos['Clave']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Nombre:</label>
	<input type="text" name="Nombre" class="txt_Nombre" value="<?php echo $this->datos['Nombre']; ?>" style="width:500px;" />
</div>

		</form>
	</div>
</div>
