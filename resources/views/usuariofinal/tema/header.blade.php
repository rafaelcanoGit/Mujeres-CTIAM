<header>              
    <div class="margen">
        <div class="row-header">
            <div class="divLogo">
                <img class="imgLogo" src="{{asset("logo/CTIAM FINAL.png")}}">
            </div>
            <ul id="menu-menu-ilsb" class="menu-ilsb">
                <li id="menu-item-11" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-11 @yield('menuInicio')" ><a href="{{ route('inicio') }}">Inicio</a></li>
                <li id="menu-item-46" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-46 @yield('menuInformacion')"><a href="#">Informacion</a></li>
                <li id="menu-item-65" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-65 @yield('menuRed')"><a href="#">Red</a></li>
                <li id="menu-item-210" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-210 @yield('menuActividades')"><a href="#">Actividades</a></li>
                <li id="menu-item-102" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-102 @yield('menuServicios')"><a href="#">Servicios</a></li>
                <li id="menu-item-131" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-131 @yield('menuMultimedia')"><a href="{{ route('multimedia') }}">Multimedia</a></li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="{{ route('cerrar_sesion') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesion</a></li>
            </ul>			
            <a class="menu-movil" href="#menu"><i class="fa fa-bars fa-2x"></i></a>
            <a class="menu-movil" href="#page"><i class="fa fa-close fa-2x"></i></a>
            <form id="logout-form" action="{{ route('cerrar_sesion') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div> <!-- /row-header -->
        
    </div> <!-- /margen -->
</header>