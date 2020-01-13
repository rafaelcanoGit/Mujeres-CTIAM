@extends('usuariofinal.multimedia.layoutMultimedia')

@section('contenidoMultimedia')



	<div class="back-gris">

		<div class="margen">
			
			<ul class="breadcrumbs">
				<li><a href="{{route('multimedia')}}">Multimedia</a> - </li>
				@foreach ($tiposdocumentos as $tipo)
					@if ($tipoActivo==$tipo->id)
						<li>{{$tipo->nombre}}</li>	
					@endif	
				@endforeach
			</ul> <!-- /breadcrumbs -->

			<span class="categoria">Categorías</span>
			
			<ul class="categorias">
				@foreach ($tiposdocumentos as $tipo)
					@if ($tipoActivo==$tipo->id)
						<li class="active"><a href="{{route('multimedia_documentos',$tipo->id)}}">{{$tipo->nombre}}</a></li>
					@else
						<li><a href="{{route('multimedia_documentos',$tipo->id)}}">{{$tipo->nombre}}</a></li>
					@endif
				@endforeach
			</ul>

			@foreach ($tiposdocumentos as $tipo)
				@if ($tipoActivo==$tipo->id)
				<div class="dumar">
					<form action="{{route('multimedia_documentos',$tipo->id)}}" class="sidebar-form">
						<div class="input-group">
							<input type="text" name="nombre" class="form-control" placeholder="Search..." required>
							<span class="input-group-btn">
								<button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
								</button>
							</span>
						</div>
					</form>
				</div>
				@endif
			@endforeach
			<ul class="slide-multimedia">
				
				@foreach ($results as $result)
					<li>
						<div class="img-multimedia" style="background-image: url({{asset("EjemploImagenes/libros.png")}})"></div> <!-- /img-multimedia -->
						<div class="txt-temas">
							<p>{{$result['nombre']}}</p>
							<a class="ver-pdf ver-pdf2" data-type="iframe" data-src="{{asset($result['rutaPublica'])}}" 
							data-id="{{$result['id']}}">
								<p>+ver</p>
							</a>
							<a class="descargar"
								href="{{route('descargar_documento_usuariofinal',$result['id'])}}"
							>
								<p>Descargar</p>
							</a>
						</div> <!-- /txt-temas -->
					</li>
				@endforeach
			</ul>
		</div>
		
		<div class="blog-pagination">
			{{$results->links()}}
		</div>
	</div> 
	<input id="url2" type="hidden" value="{{ \Request::url() }}">
@endsection
