<script>			
	$( function(){		
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		
		
		$(tabid + ' [name="fechai"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="fechaf"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="tienda"]').wijcombobox();		
		
		var campos=[
			 { name: "nombreTienda"  },
			 { name: "vendedor_nombre"  },
			 { name: "importe"  },
			 { name: "apartado"  },
			 { name: "noapartado"  },
			 
		];
			
		var dataReader = new wijarrayreader(campos);
		
		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: kore.url_base+'reportes/comisionesJson',
				dataType: "json",
				success: function (data) {
					if (data.success){
					}
				}
			}),
			dynamic:true,
			reader:new wijarrayreader(campos),
			loading:function(e, data){
				var params={};
				data.data.paging.fechai=$(tabid + ' [name="fechai"]').val();
				data.data.paging.fechaf=$(tabid + ' [name="fechaf"]').val();
				data.data.paging.tienda=$(tabid + ' [name="tienda"]').val();
				var articulo=$(tabid + ' [name="articulo"]').val();	
				
				if (articulo!=''){
					data.data.paging.articulo=articulo;
				}
				
			}
		});
				
		dataSource.reader.read= function (datasource) {
			console.log("datasource"); console.log(datasource);
			
			var totalRows=datasource.data.totalRows;
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			dataReader.read(datasource);
		};
		
		var columnasAgrupadas=[
			{ headerText: "Tienda", dataIndex:'nombreTienda', visible:false, groupInfo: { groupSingleRow: true, position:'header' }  },
			{ headerText: "Vendedor", dataIndex:'vendedor_nombre',visible:true },
			{ headerText: "Importe",dataIndex:'importe' },
			{ headerText: "Apartado",dataIndex:'apartado' },
			{ headerText: "Ventas",dataIndex:'ventas' }
		];
		
		$(tabid + ' .tabla_reporte').wijgrid({
			data:dataSource,			
			allowPaging: true,
			rendered : function (e) {
				var h = $(tabid).height();
				 $('#tabs').height(h);
			},
            pageSize: 11,
		    columns: columnasAgrupadas
		});
		
		$(tabid + ' .refresh').button().click(function(){
			$(tabid + ' .tabla_reporte').wijgrid({ensureControl :true});
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

.totales label{font-weight:bold;}
.totales label.valor{font-weight:normal;}
.totales div{display:inline-block;}
.totales {text-align:right;}
.totales td{width:100px;}
</style>


<?php 
	$elMes=date('m');
	$dia=date('d');
	
	$elAnio=date('Y');
	$ultimoDia=date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	
	// $elAnio=date('y');
?>
<div class="ui-widget-header" style="text-align:center;">
	<div  style="display:inline-block; margin-right:20px;">	
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:5px;"  >
			<label style="">Fecha:</label>
			<input type="text" name="fechai" class="txt_fechai" value="<?php echo '01/'.$elMes.'/'.$elAnio; ?>" style="width:123px;" />
			<input type="text" name="fechaf" class="txt_fechaf" value="<?php echo $ultimoDia.'/'.$elMes.'/'.$elAnio; ?>" style="width:123px;" />
		</div>
		
		<div class="inputBox tiendas" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Tienda:</label>
			<select name="tienda" class="txt_tienda" style="">				
				<?php
					echo '<option value="0" selected>TODAS</option>';
					
					foreach($this->tiendas as $obj){					
						echo '<option  value="'.$obj['clave'].'">'.$obj['tienda'].'</option>';					
						
					}
				?>
			</select>
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<input class="refresh" type="submit" value="Ver reporte" />
		</div>
	</div>
</div>


<div >
	<table class="tabla_reporte">
		<thead>
			<th>column0</th> <th>columnN</th>
		</thead>
		<tbody>			
		</tbody>
	</table>
</div>