@extends("theme.$theme.layout")

@section('titulo')
    Estadisticas
@endsection

@section('titulo1')
    <h1>Estadisticas Descargas</h1>
@endsection

@section('claseMenuEsta')
    active menu-open
@endsection

@section('claseEstaA')
    class="active"
@endsection

@section('contenido')
    <div  class="row" >
        <div class="col-md-6">
            <label>Año</label>
            <select class="form-control" id="anio_sel"  onchange="cambiar_fecha_grafica()">
            @foreach ($años as $item)
                @if ($item==$año)
                    <option value="{{$item}}" selected="true">{{$item}}</option>
                @else
                    <option value="{{$item}}" >{{$item}}</option>
                @endif
            @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label>Mes</label>
            <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica()" >
                <option value="0" >POR AÑO</option>
                @foreach ($meses as $item)
                    @if ($item['num']==$mes)
                        <option value="{{$item['num']}}" selected="true">{{$item['nom']}}</option>
                    @else
                        <option value="{{$item['num']}}" >{{$item['nom']}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Visitas Archivos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body" id="div_grafica_visitas_archivos"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Descargas Archivos</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body" id="div_grafica_descargas_archivos"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Top 5 Visitas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body" id="div_grafica_top_visitas"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">Top 5 Descargas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-body" id="div_grafica_top_descargas"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="{{asset("assets/highcharts/highcharts.js")}}"></script>
    <script src="{{asset("js/graficasArchivos.js")}}"></script>
    <script>          
         grafica_visitas_archivos({{$año}},{{$mes}});
         grafica_descargas_archivos({{$año}},{{$mes}});
         grafica_top_visitas({{$año}},{{$mes}});
         grafica_top_descargas({{$año}},{{$mes}});
    </script>
@endsection