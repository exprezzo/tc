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
	<h1>Reportes</h1>
	<a tablink="true" href="/reportes/vendidos" titulo="Vendidos">
		<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/bluestyle_09_star.png">		 
		<div>Vendidos</div>
	</a>
	<a tablink="true" href="/reportes/top20" titulo="Top 20">
		<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/greenstyle_09_star.png">		 
		<div>Top 20</div>
	</a>	
	<a tablink="true" href="/reportes/ultimos20" titulo="Ultimos 20">
		<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/redstyle_09_star.png">		 
		<div>Ultimos 20</div>
	</a>
	<a tablink="true" href="/reportes/novendidos" titulo="No Vendidos">
		<img src="http://png.findicons.com/files/icons/2389/web_icon_pack/65/blackstyle_09_star.png">		          
		<div>No vendidos</div>
	</a>
</div>


