// Codigo de Validacion de Formulario

function validar(idForma)
{
	var error = false;
	var camposRequeridos = '#'+idForma + ' [data-required="true"]';
	
 	$(camposRequeridos).each(function(index, element) {
		if($(this).val() == '')
		{
			var selectorCampo = '#' + idForma + ' [name="' + $(this).attr('name') + '"]';
			console.log($(this).attr('name') + ' vacío');
			$(selectorCampo).attr('placeholder', $(this).attr('data-name') + ' requerido').addClass('campo-requerido');
			error = true;
		}
    }); // Cierra $(camposRequeridos).each
	
	var correo = '#'+idForma + ' [data-mail="true"]';
	
	$(correo).each(function(index, element) {
        var selectorCorreo = '#' + idForma + ' [name="' + $(this).attr('data-name') + '"]';
		
		var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
		
		if($(this).val() !== '')
		{
			if(!pattern.test($(this).val()))
			{
				$(selectorCorreo).attr('placeholder','Correo inválido').addClass('campo-requerido');
				$(selectorCorreo).val('');
				console.log($(this).attr('name') + ' incorrecto');
				error = true;
			} // if(!pattern.test($(this).val()))
		} // Cierra if($(this).val() !== '')
    }); // Cierra $(correo).each
	
	var camposSelect = '#'+idForma + ' [data-select="true"]';
	
 	$(camposSelect).each(function(index, element) {
		if($(this).val() == 'vacio') {
			var option = $(this).find('option:first-child').text();
			$(this).find('option:first-child').text(option + ' requerido');
			$(this).addClass('campo-requerido');
			error = true;   
		} else {
			$(this).removeClass('campo-requerido');
		}
	});
	
	return error;
}

//CONTACTO
$('#enviar').click(function(e) {
    if(validar('forma'))
	{ e.preventDefault(); }
	// else { return; }
	else {
		e.preventDefault();
		
		var nombre = $('#forma [name="nombre"]').val();
		var correo = $('#forma [name="correo"]').val();
		var servicio = $('#forma [name="servicio"]').val();
		var comentarios = $('#forma [name="comentarios"]').val();
		
		$('.loader').show();
		
		$.post("http://valeriastrempler.com/ilsb/enviar-contacto",
				{ nombre: nombre, correo: correo, servicio: servicio, comentarios: comentarios, enviarContacto: 'true' },
				function( data ) {
					$('.forma').html(data);
				},
				"html"
		).done(function() {
			$('.loader').hide();
		})
		.fail(function() {
			$('.loader').hide();
		});
	} // if(validar('forma')) ... else ...
	
}); //$('#enviar').click(function(e) {