//Funciones generales		
function iniciarLinkTabs(){
	var links=$('[tablink="true"]');
	$.each(links, function(index, element) {
		var link=$(element);
		if ( !link.attr )  return false;
		var destino=link.attr('href');
		link.attr('href','#');
		
		link.attr('tablink',false);
		link.addClass('link');
		
		var titulo=link.attr('titulo');
		link.click(function(){
			TabManager.add(destino,titulo,1);
		});
	});
}

function ajustarTab(){
	var h=$(window).height();			
	var position=$('#tabs').position();			
	var newH = (h-position.top);			
	$('#tabs').css('min-height',newH);			
}