<header class="main-header">

    <!-- Logo -->
    <div class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{asset("logo/CTIAM FINAL.png")}}" alt=""></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{asset("logo/CTIAM FINAL.png")}}" alt=""></span>
    </div>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}}
                  <small>Administrador</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('cerrar_sesion') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      Cerrar Sesion
                  </a>

                  <form id="logout-form" action="{{ route('cerrar_sesion') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>