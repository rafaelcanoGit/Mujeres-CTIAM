@extends("theme.$theme.layout")

@section('titulo')
    Usuarios
@endsection

@section('titulo1')
    <h1> Gestionar Usuarios</h1>
@endsection

@section('claseUsua')
    class="active"
@endsection

@section('contenido')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Usuarios</h3>
                    <button class="btn btn-primary pull-right" id="btnAbrirModalAgregarU" >Agregar Nuevo Usuario</button>
                </div>
                <div class="box-body">
                    <table id="tablaUsuarios" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Tipo</th>
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
    @include('theme.usuarios.modalAyE')
    @include('theme.usuarios.modalConfirmacion')
@endsection
@section('script')
    <script>
        $(document).ready( function () {
            $('#tablaUsuarios').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "autoWidth": false,
                "ajax": "{{url('api/users')}}",
                "columns": [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'tipousuario'},
                    {data: 'btns'},
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                }
            // "lengthMenu":    [2,4,6,8,10]
            });
        });
    </script>
    <script src="{{asset("js/usuariosAjax.js")}}"></script>
@endsection