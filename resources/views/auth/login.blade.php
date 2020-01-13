@extends("auth.layout")

@section('tituloLogin')
    Login
@endsection
@section('contenidoLogin')
<div class="login-box">
    <div class="logo-login">
      <span class="logo-lg"><img src="{{asset("logo/CTIAM FINAL.png")}}" alt="" class="center"></span>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body redondear">
      <p class="login-box-msg">Inicia sesion para ingresar</p>
  
      <form action="{{route('iniciar_sesion')}}" method="POST">
        @csrf
        <div class="form-group has-feedback {{$errors->has('email') ? 'has-error':''}}">
          <input type="email" class="form-control" name="email" placeholder="Email" value="{{old('email')}}" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if ($errors->has('email'))
            <span class="help-block" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
          @endif
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
        <div class="row">
          <div class="col-xs-7">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Recordar contraseña
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-5">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
          </div>
          <!-- /.col -->
        </div>
      </form> 
      <a href="#">Olvide mi contraseña</a><br>
      <a href="{{route('form_registrar')}}" class="text-center">Registrar una nueva cuenta</a>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
@endsection


