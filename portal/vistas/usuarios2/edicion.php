
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
				nombre:'usuario'
			},			
			pk:"id"
			
		};				
		 var editor=new Edicionusuarios();
		 editor.init(config);		
		 
		 $('#'+config.tab.id + ' [name="rol"]').wijcombobox();
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
			<input type="hidden" name="id" class="txt_id" value="<?php echo $this->datos['id']; ?>" style="width:500px;" />
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Usuario:</label>
				<input type="text" name="nick" class="txt_nick" value="<?php echo $this->datos['nick']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Pass:</label>
				<input type="password" name="pass" class="txt_pass" value="<?php echo $this->datos['pass']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Email:</label>
				<input type="text" name="email" class="txt_email" value="<?php echo $this->datos['email']; ?>" style="width:500px;" />
			</div>
			<!--div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Fbid:</label>
				<input type="text" name="fbid" class="txt_fbid" value="<?php // echo $this->datos['fbid']; ?>" style="width:500px;" />
			</div-->
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Nombre:</label>
				<input type="text" name="name" class="txt_name" value="<?php echo $this->datos['name']; ?>" style="width:500px;" />
			</div>
			<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
				<label style="">Rol:</label>
				<select name="rol" class="txt_rol">
					<?php
						$rolId = $this->datos['rol'];						
						foreach($this->roles as $rol){
							if ( $rol['id'] == $rolId ) $selected='selected';
							echo '<option '.$selected.' value="'.$rol['id'].'">'.$rol['rol'].'</option>';
							$selected='';
						}
					?>
				</select>
			</div>
<!--div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Picture:</label>
	<input type="text" name="picture" class="txt_picture" value="<?php // echo $this->datos['picture']; ?>" style="width:500px;" />
</div>
<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
	<label style="">Originalname:</label>
	<input type="text" name="originalName" class="txt_originalName" value="<?php // echo $this->datos['originalName']; ?>" style="width:500px;" />
</div-->

		</form>
	</div>
</div>
