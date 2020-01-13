@extends('usuariofinal.multimedia.layoutMultimedia')

@section('contenidoMultimedia')
	<div class="row-title">

		<div class="margen">

			<h2>Publicaciones</h2>

		</div> <!-- /margen -->

	</div> <!-- /row-title -->

	<div class="back-gris" id="multimedia">

		<div class="margen">

			<span class="categoria">Categorías</span>
			
			<ul class="categorias">
				@foreach ($tiposdocumentos as $tipo)
					<li><a href="{{route('multimedia_documentos',$tipo->id)}}">{{$tipo->nombre}}</a></li>
				@endforeach
			</ul>

		
			<div class="dumar">
				<form action="{{route('multimedia')}}" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="nombre" class="form-control" placeholder="Search..." required>
						<span class="input-group-btn">
							<button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
			</div>


			<ul class="slide-multimedia">
				
				@foreach ($results as $result)
					<li>
						<div class="img-multimedia" style="background-image: url({{asset("EjemploImagenes/libros.png")}})"></div> <!-- /img-multimedia -->
						<div class="txt-temas">
							<p>{{$result['nombre']}}</p>
							<a class="ver-pdf" data-type="iframe" data-src="{{asset($result['rutaPublica'])}}" 
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

	<div id="videos">

		<div class="row-title">

			<div class="margen">

				<h2>Audiovisual</h2>

			</div> <!-- /margen -->

		</div> <!-- /row-title -->
		<div class="margen">
			<form action="{{route('multimedia')}}" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="nombre" class="form-control" placeholder="Search..." required>
					<input type="hidden" name="tipo" value="video">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</form>
		</div>
		<hr>
		<div class="row-videos">

			
			@foreach ($videos as $video)
				
					<a id="verVideo" class="fancybox"   @if ($video['tipo']=='archivo')
														href="{{asset($video['rutaPublica'])}}" 
														@else
														href="{{asset($video['link'])}}" 
														@endif     	data-id="{{$video['id']}}">	
						<svg version="1.1" id="play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="70px" width="70px" viewbox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
							<path class="stroke-solid" fill="none" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
								C97.3,23.7,75.7,2.3,49.9,2.5"></path>
							<path class="stroke-dotted" fill="none" d="M49.9,2.5C23.6,2.8,2.1,24.4,2.5,50.4C2.9,76.5,24.7,98,50.3,97.5c26.4-0.6,47.4-21.8,47.2-47.7
								C97.3,23.7,75.7,2.3,49.9,2.5"></path>
							<path class="icon" fill="gray" d="M38,69c-1,0.5-1.8,0-1.8-1.1V32.1c0-1.1,0.8-1.6,1.8-1.1l34,18c1,0.5,1,1.4,0,1.9L38,69z"></path>
						</svg>
						<img src="{{asset('EjemploImagenes/videos.jpg')}}">
					</a>
			@endforeach

			<div class="margen">

				<div class="blog-pagination">
					{{$videos->links()}}
				</div>

			</div> <!-- /margen -->

		</div> <!-- /row-videos -->
		
	</div> <!-- /videos -->
	<input id="url" type="hidden" value="{{ \Request::url() }}">
@endsection
