$(document).ready(function(){
	
	$('.tab-modulo').click(function () {     
	   $(this).toggleClass("arrow-tab");  
	   $(this).next('.contenido-modulo').slideToggle();
	});
	
	MenuShow();
	
	$('span.categoria').on('click', function () {
		if ( !$(this).hasClass('active') ) {
			$(this).addClass('active');
			$('.categorias').slideDown(300);
		} else {
			$(this).removeClass('active');
			$('.categorias').slideUp(300);
		} //if ( !$(this).hasClass('navbar-toggle-active') ) {
	}); //$('#navbar-toggle').on('click', function () {
	
	$('.fancybox').fancybox({
		smallBtn : false,
		video: {
			autoStart: true
		}
	});
	
	$('.ver-pdf').fancybox({
		iframe : {
			preload : false
		}
	});
	
});

var width = $(window).width();

$(window).resize(function(){
	if ($(window).width() != width) {
		MenuShow();
	}
});

function MenuShow() {
	if($(window).width() > 870) { 
		$('.categorias').show();
	}
	else {
		$('span.categoria').removeClass('active');
		$('.categorias').hide();
	} //if($(this).outerWidth() > 650)
}

$('#verVideo').click(function (e){
    var id=$(this).data('id');
    var url = $('#url').val()+'/videos/ver/'+id;
    $.ajax({
        url: url
    })
});

$('.ver-pdf').click(function(){
	var id=$(this).data('id');
	var url = $('#url').val()+'/documentos/ver/'+id;
	$.ajax({
        url: url
    })
});

$('.ver-pdf2').click(function(){
	var id=$(this).data('id');
	var url = $('#url2').val()+'/ver/'+id;
	$.ajax({
        url: url
    })
});