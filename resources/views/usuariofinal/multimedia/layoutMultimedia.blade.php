@extends('usuariofinal.tema.layout')

@section('menuMultimedia')
	 current-menu-item
@endsection

@section('contenidoUsuarioFinal')
	<div class="banner" style="background-image: url({{asset('EjemploImagenes/header.jpg')}})"> <!-- style="background-image: url({{asset('logo/CTIAM FINAL.png')}})" -->

		<h1>Multimedia</h1>
		
	</div> <!-- /banner -->

    @yield('contenidoMultimedia')
	
@endsection