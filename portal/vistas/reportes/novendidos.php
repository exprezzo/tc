<script>
	$.ready();
</script>
<div>	
	<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
		<label style="">Fecha Inicio:</label>
		<input type="text" name="fechai" class="txt_fechai" value="<?php //echo $this->datos['name']; ?>" style="width:500px;" />
	</div>
	<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
		<label style="">Fecha Fin:</label>
		<input type="text" name="fechaf" class="txt_fechaf" value="<?php //echo $this->datos['name']; ?>" style="width:500px;" />
	</div>
	<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
		<label style="">Tienda:</label>
		<select name="empresa" class="txt_empresa">
			
			<?php
				echo '<option value="0" selected>TODAS</option>';
				// $rolId = $this->datos['rol'];						
				foreach($this->tiendas as $obj){					
					echo '<option  value="'.$obj['clave'].'">'.$obj['tienda'].'</option>';					
				}
			?>
		</select>
	</div>
	<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;"  >
		<input type="submit" />
	</div>
</div>

<div>
	<object data="/reportes/novendidosPdf" type="application/pdf" width="100%" height="100%">
		alt : <a href="/reportes/novendidosPdf">vendidos.pdf</a>
	</object>
</div>