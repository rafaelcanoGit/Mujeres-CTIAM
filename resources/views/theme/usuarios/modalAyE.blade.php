<div class="modal fade in" id="modalUsuarios" role="dialog">
    <div class="modal-dialog">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="modal-header with-border">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                            <h3 id="modalT" class="modal-title">Agregar Usuario</h3>
                        </div>
                        <!-- /.box-header -->   
                        <!-- form start -->
                        <div class="modal-body">
                            <span id="form_results"></span>
                            <form  id="formUsuarios" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputFile">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" 
                                    name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" 
                                    name="email" placeholder="Enter email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <label>Tipo Usuario</label>
                                    <select class="form-control" name="tipousuario" id="tipousuario">
                                        @foreach ($tiposusuarios as $tipousuario)
                                                <option value="{{$tipousuario->id}}">{{strtoupper($tipousuario->nombre)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="passInput">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="pass" 
                                        name="pass" placeholder="Contraseña" value="{{ old('pass') }}">
                                        <span class="input-group-addon" id="show_password" onclick="mostrarPassword()"><i class="icon fa  fa-eye-slash"></i></span>
                                    </div>
                                </div>  
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary pull-right" id="btnModal">Agregar</button>
                            <input type="hidden" id="usuario_id" name="usuario_id" value="0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>