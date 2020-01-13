@extends('usuariofinal.tema.layout')

@section('menuInicio')
	current-menu-item
@endsection

@section('contenidoUsuarioFinal')

    <!-- Slider -->
    @include('usuariofinal.inicio.slider')

    
    <div class="margen">
        <div class="row-apuesta">
            <h2>Nuestra apuesta</h2>
            @include('usuariofinal.inicio.apuestas')
        </div> <!-- /row-apuesta -->
    </div> <!-- /margen -->

    <div class="row-proyectos">
        <div class="margen">
            <h2>Nuestros proyectos</h2>
            @include('usuariofinal.inicio.proyectos')
        </div> <!-- /margen -->             
    </div> <!-- /row-proyectos -->

    <div class="row-testimonio">

        <div class="margen">
            <h2>Testimonios</h2>
            @include('usuariofinal.inicio.testimonios')
        </div> <!-- /margen -->
    </div> <!-- /row-testimonio -->

   
@endsection