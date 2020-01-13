@extends("theme.$theme.layout")

@section('titulo')
    Sliders
@endsection

@section('titulo1')
    <h1> Gestionar Sliders</h1>
@endsection

@section('claseSlid')
    class="active"
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Libros</h3>
                    <button class="btn btn-primary pull-right" id="btnAbrirModalAgregarS" >Agregar Nuevo Slider</button>
                </div>
                <div class="box-body">
                    <table id="tablaSliders" class="table table-bordered table-striped nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Link</th>
                                <th>Imagen</th>
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
    @include('theme.sliders.modalAyE')
    @include('theme.sliders.modalConfirmacion')
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#tablaSliders').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                "ajax": "{{url('api/sliders')}}",
                "columns": [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'estado'},
                    {data: 'link'},
                    {data: 'img'},
                    {data: 'btns'},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            // "lengthMenu":    [2,4,6,8,10]
            });
        });
    </script>
    <script src="{{asset("js/slidersAjax.js")}}"></script>
@endsection