<script>
	$().ready(function(){
		iniciarLinkTabs();
	});
</script>
<style>
.menuReportes a{
	text-decoration:none;
	display:inline-block;
	text-align:center;
	padding:42px;
}

.menuReportes a div{
	display:block;
}
.menuReportes{
	text-align:center;
}

</style>
<div style="padding:10px;" class="menuReportes">	
	<div>
	<h1>Reportes</h1>		
		<a tablink="true" href="<?php echo $_APP_PATH.'portal'; ?>/reportes/vendidoshtml" titulo="Vendidos">
			<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/bluestyle_09_star.png">		 
			<div>Vendidos</div>
		</a>
		
		<a tablink="true" href="<?php echo $_APP_PATH.'portal'; ?>/reportes/top20" titulo="Top 20">
			<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/greenstyle_09_star.png">		 
			<div>Top 20</div>
		</a>	
		<a tablink="true" href="<?php echo $_APP_PATH.'portal'; ?>/reportes/ultimos20" titulo="Ultimos 20">
			<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/redstyle_09_star.png">		 
			<div>Ultimos 20</div>
		</a>
		<a tablink="true" href="<?php echo $_APP_PATH.'portal'; ?>/reportes/novendidos" titulo="No Vendidos">
			<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/blackstyle_09_star.png">		          
			<div>No vendidos</div>
		</a>
	</div>
	
	<div>
		<a tablink="true" href="<?php echo $_APP_PATH.'portal'; ?>/reportes/comisiones" titulo="Comisiones">
			<img src="http://png.findicons.com/files/icons/190/business_toolbar/48/payment.png">
			<div>Comisiones</div>
		</a>
		<a tablink="true" href="<?php echo $_APP_PATH.'portal'; ?>/reportes/cortes" titulo="Cortes de caja">
			<img src="http://png.findicons.com/files/icons/192/finance/64/cash_register.png">
			<div>Cortes de caja</div>
		</a>
		
	</div>
</div>


