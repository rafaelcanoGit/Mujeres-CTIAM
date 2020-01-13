<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVEGACION</li>
        <li @yield('clasePerf')>
          <a href="{{route('admin_perfil')}}">
            <i class="fa fa-user"></i> 
            <span>Perfil</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview @yield('claseMenuInfo')">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Gestionar Informacion</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @yield('claseDocu')><a href="{{route('listar_documentos')}}"><i class="fa fa-circle-o"></i> Documentos</a></li>
            <li @yield('claseAudi')><a href="{{route('listar_audiovisuales')}}"><i class="fa fa-circle-o"></i> Piezas Audiovisuales</a></li>
            <li @yield('claseCapa')><a href="{{route('listar_capacitaciones')}}"><i class="fa fa-circle-o"></i> Material de Capacitacion</a></li>
          </ul>
        </li>
        <li @yield('claseUsua')>
          <a href="{{route('listar_usuarios')}}">
            <i class="fa fa-users"></i>
            <span>Gestionar Usuarios</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        <li class="treeview @yield('claseMenuEsta')">
          <a href="#">
            <i class="fa fa-pie-chart"></i> <span>Estadisticas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li @yield('claseEstaU')><a href="{{route('ver_estadisticas_usuarios')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            <li @yield('claseEstaA')><a href="{{route('ver_estadisticas_archivos')}}"><i class="fa fa-circle-o"></i> Archivos</a></li>
          </ul>
        </li>   
        <li @yield('claseSlid')>
          <a href="{{route('listar_sliders')}}">
            <i class="fa fa-file-image-o"></i> 
            <span>Gestionar Sliders</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>