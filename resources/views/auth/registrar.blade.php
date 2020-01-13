@extends("auth.layout")

@section('tituloLogin')
    Registrar
@endsection

@section('contenidoLogin')
<div class="register-box">
  <div class="logo-login">
    <span class="logo-lg"><img src="{{asset("logo/CTIAM FINAL.png")}}" alt="" class="center"></span>
  </div>
  
    <div class="register-box-body redondear">
      <p class="login-box-msg">Registrar una nueva cuenta</p>
  
      <form action="{{route('registrar')}}" method="post">
          @csrf
        <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
          <input type="text" class="form-control" placeholder="Nombre Completo" name="name"
          value="{{ old('name') }}" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
          @if ($errors->has('name'))
            <span class="help-block" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
          <input type="email" class="form-control" placeholder="Email" name="email"
          value="{{ old('email') }}" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
            <span class="help-block" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
        </div>
        <div class="form-group has-feedback">
          <select class="form-control" name="tipousuario" id="tipousuario">
              @foreach ($tiposusuarios as $tipousuario)
                      <option value="{{$tipousuario->id}}">{{strtoupper($tipousuario->nombre)}}</option>
              @endforeach
          </select>
        </div> 
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
          <div class="input-group">
            <input type="password" class="form-control" id="pass" placeholder="Contraseña" name="password" required>
            <span class="input-group-addon" onclick="mostrarPassword()"><i class="icon fa  fa-eye-slash"></i></span>
          </div>
          @if ($errors->has('password'))
            <span class="help-block" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
          @endif
        </div>  
        <div class="form-group has-feedback">
          <input type="password" id="pass2" class="form-control" placeholder="Repite la contraseña" name="password_confirmation" required>
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Acepto los <a href="#">terminos</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="{{route('login')}}" class="text-center">Ya tengo una cuenta</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.register-box -->
@endsection

