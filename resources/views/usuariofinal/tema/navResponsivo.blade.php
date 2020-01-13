<nav id="menu" class="navbar">
    <ul id="menu-menu-ilsb-1" class="menu-mobile">
      <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-11"><a href="{{ route('inicio') }}" aria-current="page">Inicio</a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-46"><a href="#">Informacion</a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-65"><a href="#">Red</a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-210"><a href="#">Actividades</a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-102"><a href="#">Servicios</a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-131"><a href="{{ route('multimedia') }}">Multimedia</a></li>
      <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-164"><a href="{{ route('cerrar_sesion') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesion</a></li>
    </ul>
</nav> <!-- /navbar -->

<script>

  $("#menu").mmenu({
    "slidingSubmenus": false,
    "extensions": [
      "position-right",
      "theme-dark"
    ],
    navbar: {
      title: "Menú"
    }
  });

</script>