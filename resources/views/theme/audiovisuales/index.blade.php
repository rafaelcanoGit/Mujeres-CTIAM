@extends("theme.$theme.layout")

@section('titulo')
    AudioVisuales
@endsection

@section('titulo1')
    <h1> Gestionar Informacion</h1>
@endsection

@section('claseMenuInfo')
    active menu-open
@endsection

@section('claseAudi')
    class="active"
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">AudioVisuales</h3>
                    <button class="btn btn-primary pull-right" id="btnAbrirModalAgregarAV" >Agregar Nuevo AudioVisual</button>
                </div>
                <div class="box-body">
                    <table id="tablaAudioVisuales" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th>Tipo</th>
                                <th>Descargar</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="box-footer">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="url" type="hidden" value="{{ \Request::url() }}">
    @include('theme.audiovisuales.modalAyE')
    @include('theme.audiovisuales.modalConfirmacion')
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#tablaAudioVisuales').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                "ajax": "{{url('api/audiovisuales')}}",
                "columns": [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'descripcion'},
                    {data: 'estado'},
                    {data: 'tipo'},
                    {data: 'descargar'},
                    {data: 'btns'},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            // "lengthMenu":    [2,4,6,8,10]
            });
        });
    </script>
    <script src="{{asset("js/audiovisualesAjax.js")}}"></script>
@endsection