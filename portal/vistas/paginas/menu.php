<script type="text/javascript">
    $(document).ready(function () {
        $("#accordion").wijaccordion();
		// iniciarLinkTabs();
    });
</script>

<style>
	#accordion  .submenu a{
		display:inline-block;
		text-decoration:none;
		margin:15px;
		
	}
	
	#accordion div{
		text-align:center;
	}
	
	
</style>

<div id="menuPrincipal" style="position: absolute; width: 700px;margin-left: 20px;z-index: 6;background-color: white;display: block;right: 13px;top: 40px; display:none; ">
	<div id="accordion">
			<h3>Reportes</h3>
			<div class="submenu">
				<a tablink="true" href="/reportes/vendidos" titulo="Vendidos" class="link">
					<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/bluestyle_09_star.png">		 
					<div>Vendidos</div>
				</a>
				<a tablink="true" href="/reportes/top20" titulo="Top 20" class="link">
					<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/greenstyle_09_star.png">		 
					<div>Top 20</div>
				</a>
				<a tablink="true" href="/reportes/ultimos20" titulo="Ultimos 20" class="link">
					<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/redstyle_09_star.png">		 
					<div>Ultimos 20</div>
				</a>
				<a tablink="true" href="/reportes/novendidos" titulo="No Vendidos" class="link">
					<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/blackstyle_09_star.png">		          
					<div>No vendidos</div>
				</a>				
			</div>
			<h3>Catalogos</h3>
			<div>
				
			</div>
			<h3>Sistema</h3>
			<div class="submenu">
				<a tablink="true" href="/backend/usuarios/busqueda" titulo="Usuarios" class="link">
					<img src="http://png.findicons.com/files/icons/2332/super_mono/64/user_card.png">		 
					<div>Usuarios</div>
				</a>				
			</div>
	</div>
</div>