<script>			
	$( function(){		
		var tabid='#<?php echo $_REQUEST['tabId']; ?>';
		var datos = <?php echo json_encode($this->datos); ?>;
		
		$(tabid + ' [name="fechai"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="fechaf"]').wijinputdate({showTrigger:true,dateFormat:'dd/MM/yyyy'});
		$(tabid + ' [name="tienda"]').wijcombobox();
		$(tabid + ' [name="articulo"]').wijtextbox();
		$(tabid + ' [name="agrupar"]').wijcheckbox({checked: true});
		
		var campos=[
			// { name: "id"  }
		];
		var dataReader = new wijarrayreader(campos);
			
		var dataSource = new wijdatasource({
			proxy: new wijhttpproxy({
				url: kore.url_base+'reportes/vendidosJson',
				dataType: "json",
				success: function (data) {
					if (data.success){
						$(tabid + ' .totales .val_importe').html(data.importe);
						$(tabid + ' .totales .val_vendidos').html(data.vendidos);
						$(tabid + ' .totales .val_apartados').html(data.apartados);
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
				data.data.paging.agrupar=$(tabid +' [name="agrupar"]').prop('checked');					
				if (articulo!=''){				
					data.data.paging.articulo=articulo;
				}
				// console.log("data.data"); console.log(data.data);
				// data.data.paging.push(params);
				// data.data.filtering.push({
					// field: 'fecha',
					// dataKey:'fecha_i',
					// filterOperator:'greaterorequal',
					// filterValue:$(me.tabId + ' [name="fecha_i"]').val()
				// });
				
				// data.data.filtering.push({
					// field: 'fecha',
					// dataKey:'fecha_f',
					// filterOperator:'lessorequal',
					// filterValue:$(me.tabId + ' [name="fecha_f"]').val()
				// });
			}
		});
				
		dataSource.reader.read= function (datasource) {						
			var totalRows=datasource.data.totalRows;						
			datasource.data = datasource.data.rows;
			datasource.data.totalRows = totalRows;
			
			
			
			dataReader.read(datasource);
		};	
		var columnasAgrupadas=[
                    { headerText: "Tienda",dataIndex:'nombreTienda', visible:false, groupInfo: { groupSingleRow: true, position:'header' }  },
					{ headerText: "Mod.",dataIndex:'modelo',visible:true,width:90 },
					{ headerText: "Clave",dataIndex:'clavesecundaria',visible:true },					
					{ headerText: "Cant.",dataIndex:'cantidad',width:80,dataType: "number" },
					{ headerText: "Descripcion",dataIndex:'descripcion',visible:true },										
					{ headerText: "Importe",dataIndex:'importe', dataType: "currency" },
					{ headerText: "apartado",dataIndex:'apartado', dataType: "currency" },
					{ headerText: "ventas",dataIndex:'ventas', dataType: "currency" }					
                ];
				
		var columnasNoAgrupadas=[
                    { headerText: "Tienda",dataIndex:'nombreTienda'  },
					{ headerText: "Mod.",dataIndex:'modelo',visible:true,width:90 },
					{ headerText: "Clave",dataIndex:'clavesecundaria',visible:true },					
					{ headerText: "Cant.",dataIndex:'cantidad',width:80,dataType: "number" },
					{ headerText: "Descripcion",dataIndex:'descripcion',visible:true },										
					{ headerText: "Importe",dataIndex:'importe', dataType: "currency" },
					{ headerText: "apartado",dataIndex:'apartado', dataType: "currency" },
					{ headerText: "ventas",dataIndex:'ventas', dataType: "currency" }					
                ];
		$(tabid + ' .tabla_reporte').wijgrid({
			data:dataSource,
			ensureColumnsPxWidth :true,
			allowPaging: true,
			rendered : function (e) { 
				var h = $(tabid).height();
				 $('#tabs').height(h);
			},
            pageSize: 11
		    ,columns: columnasAgrupadas
		});
		
		$(tabid + ' .refresh').button().click(function(){
				$(tabid+" .tabla_reporte").wijgrid('destroy');
				if ( $(tabid +' [name="agrupar"]').prop('checked') ){
					$(tabid + ' .tabla_reporte').wijgrid({
						ensureColumnsPxWidth :true,
						data:dataSource,
						allowPaging: true,
						pageSize: 11,
						rendered : function (e) { 
							var h = $(tabid).height();
							 $('#tabs').height(h);
						}
						,columns: columnasAgrupadas
					});
				}else{
					$(tabid + ' .tabla_reporte').wijgrid({
						ensureColumnsPxWidth :true,
						data:dataSource,
						 allowPaging: true,
						 rendered : function (e) { 
							var h = $(tabid).height();
							 $('#tabs').height(h);
						 },
						pageSize: 11
							,columns: columnasNoAgrupadas
					});
				}
				
				// var grid=$(tabid+" .tabla_reporte");
				// grid.wijgrid('ensureControl', true);	
			// var fechai=$(tabid + ' [name="fechai"]').val();
			// var fechaf=$(tabid + ' [name="fechaf"]').val();
			// var tienda=$(tabid + ' [name="tienda"]').val();			
			// var articulo=$(tabid + ' [name="articulo"]').val();	
			// var agrupar=$(tabid +' [name="agrupar"]').prop('checked');
			
			// var url=kore.url_base+'web/blanco.pdf';
			// $(tabid+' .pdfReader').attr('data',url);			
			// $(tabid+' .pdfReader').load(url);
			
			// url=kore.url_base+'reportes/vendidosPdf?fechai='+fechai+'&fechaf='+fechaf+'&tienda='+tienda+'&agrupar='+agrupar;			
			// if (articulo!=''){
				// url+='&articulo='+articulo;
			// }
			
			
			
			// var ht = $('#tabs [role="tablist"]').height();		
			// var hh = $(tabid + ' .ui-widget-header').height();				
			// $( tabid + ' .pdfReader').height(ht - hh);
		});
		
		// setTimeout(function() { 
			// var ht = $('#tabs [role="tablist"]').height();		
			// var hh = $(tabid + ' .ui-widget-header').height();					
			// $( tabid + ' .pdfReader').height(ht - hh);
		// }, 1000);
		
		
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
			<input type="text" name="fechai" class="txt_fechai" value="<?php echo $dia.$elMes.'/'.$elAnio; ?>" style="width:123px;" />
			<input type="text" name="fechaf" class="txt_fechaf" value="<?php echo $dia.'/'.$elMes.'/'.$elAnio; ?>" style="width:123px;" />
		</div>
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Articulo:</label>
			<input type="text" name="articulo" class="" value="" style="width:120px;" />
		</div>
		<div class="inputBox tiendas" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label style="">Tienda:</label>
			<select name="tienda" class="txt_tienda" style="">				
				<?php
					echo '<option value="0" selected>TODAS</option>';
					// $rolId = $this->datos['rol'];						
					
					foreach($this->tiendas as $obj){					
						echo '<option  value="'.$obj['clave'].'">'.$obj['tienda'].'</option>';					
						
					}
				?>
			</select>
		</div>
		
	</div>
</div>
<div class="totales">
	<div style="vertical-align: top;margin-top: 9px;">
		<div class="inputBox " style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<label><input type="checkbox" name="agrupar" > Agrupar</label>
		</div>
		

		
		<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;"  >
			<input class="refresh" type="submit" value="Ver reporte" />
		</div>
	</div>
	<table style="display:inline-block;">
		<tr>
			<td>Total:</td>
			<td>Apartado</td>
			<td>Vendidos</td>
		</tr>
		<tr>
			<td class="valor val_importe"<?php echo $this->importe; ?></td>
			<td class="valor val_apartados" style="width:121px;"><?php echo $this->apartados; ?></td>
			<td class="valor val_vendidos"><?php echo $this->vendidos; ?></td>
		</tr>
	</table>
		
	
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


