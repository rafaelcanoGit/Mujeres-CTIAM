@extends("theme.$theme.layout")

@section('titulo')
    Perfil
@endsection

@section('titulo1')
    <h1>Perfil del Administrador</h1>
@endsection

@section('clasePerf')
    class="active"
@endsection

@section('contenido')
<div class="row">
    <div class="col-md-3">
    </div>
    <!-- /.col -->
    <div class="col-md-6">
      <!-- Widget: user widget style 1 -->
      <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-aqua-active">
          <h3 class="widget-user-username">{{Auth::user()->name}}</h3>
          <h5 class="widget-user-desc">Administrador</h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle" src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" alt="User Avatar">
        </div>
        <div class="box-footer ">
          <div class="row">
            <div class="col-sm-2 border-right">
            </div>
            <div class="col-sm-8 ">
                <form method="POST" action="{{route('admin_actualizar',Auth::user()->id)}}">
                    {{ method_field('PUT') }}
                    @csrf
                   <div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
                        <label for="exampleInputFile">Nombre</label>
                        <input type="text" class="form-control" id="nombre" 
                        name="nombre" placeholder="nombre" value="{{Auth::user()->name}}">
                        @if ($errors->has('nombre'))
                          <span class="help-block" role="alert">
                              <strong>{{ $errors->first('nombre') }}</strong>
                          </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" 
                        name="email" placeholder="Enter email" value="{{Auth::user()->email}}" disabled>
                    </div>
                    <div class="form-group  {{ $errors->has('pass') ? 'has-error' : '' }}">
                        <label for="passInput">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="pass" 
                            name="pass" placeholder="Contraseña" value="{{ old('pass') }}">
                            <span class="input-group-addon" id="show_password" onclick="mostrarPassword()"><i class="icon fa  fa-eye-slash"></i></span>
                        </div>
                        @if ($errors->has('pass'))
                          <span class="help-block" role="alert">
                              <strong>{{ $errors->first('pass') }}</strong>
                          </span>
                        @endif
                    </div> 
                    <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                </form>
              </div>
              <div class="col-sm-3 border-right">
              </div>
          </div>
          <hr>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.widget-user -->
    </div>
    <!-- /.col -->
    <div class="col-md-2">
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection