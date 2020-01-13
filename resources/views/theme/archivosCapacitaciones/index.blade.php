@extends("theme.$theme.layout")

@section('titulo')
    Capacitaciones
@endsection

@section('titulo1')
    <h1> Gestionar Informacion</h1>
@endsection

@section('claseMenuInfo')
    active menu-open
@endsection

@section('claseCapa')
    class="active"
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Archivos de la Capacitacion: {{$capacitacion->nombre}}</h3>
                    <button class="btn btn-primary pull-right" id="btnAbrirModalAgregarAC" >Agregar Nuevo Archivo</button>
                </div>
                <div class="box-body">
                    <table id="tablaArchivosCapacitacion" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descargar</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary pull-right" onclick="location.href='{{route('listar_capacitaciones')}}'">
                            <i class="fa fa-arrow-circle-o-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input id="url" type="hidden" value="{{ \Request::url() }}">
    <input id="idCapacitacion" type="hidden" value="{{$capacitacion->id}}">
    @include('theme.archivosCapacitaciones.modalAyE')
    @include('theme.archivosCapacitaciones.modalConfirmacion')
@endsection
@section('script')
    <script src="{{asset("assets/dropzone/js/dropzone.js")}}"></script>
    <script>
        $(document).ready( function () {
            var id = $('#idCapacitacion').val();
            $('#tablaArchivosCapacitacion').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                "ajax":
                {
                    url : "{{url('api/archivosCapacitacion/{id}')}}",
                    type: "GET",
                    data: {"id": id} 
                },
                "columns": [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'descargar'},
                    {data: 'btns'},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            // "lengthMenu":    [2,4,6,8,10]
            });
            /*Dropzone.options.formArchivosCapacitacionAgregar = {
                uploadMultiple: true,
                paramName: "archivos", // Las imágenes se van a usar bajo este nombre de parámetro
                maxFilesize: 80, // Tamaño máximo en MB
                acceptedFiles: 'application/pdf,application/pptx,application/pub,image/jpg',
                maxFiles: 8,

                init: function init(){
                    this.on('error',function(){
                        alert('error');
                    });
                }

            };*/
        });
    </script>
    <script src="{{asset("js/archivosCapacitacionAjax.js")}}"></script>
@endsection