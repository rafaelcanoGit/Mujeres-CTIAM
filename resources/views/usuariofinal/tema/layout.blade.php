<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1  user-scalable=no">
        
        <title>CTIAM</title>
        
        <link href="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/style.css")}}" rel="stylesheet">
        <link href="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/queries.css")}}" rel="stylesheet">
        
        <link href="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/slick/slick.css")}}" rel="stylesheet">	
        <link href="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/slick/slick-theme.css")}}" rel="stylesheet">
            
        <link href="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/mmenu/jquery.mmenu.all.css")}}" rel="stylesheet">
            
        <link href="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/fancybox/jquery.fancybox.css")}}" rel="stylesheet">
            
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
            
        <script language="javascript" src="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/jquery-1.12.1.min.js")}}"></script>
        <script language="javascript" src="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/fancybox/jquery.fancybox.js")}}"></script>
            
        <script language="javascript" src="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/slick/slick.js")}}"></script>
            
        <script language="javascript" src="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/mmenu/jquery.mmenu.all.js")}}"></script>
            
            
        
       
        <link rel="stylesheet" id="wp-block-library-css" href="{{asset("assets/usuarioFinal/wp-includes/css/dist/block-library/style.min.css?ver=5.2.4")}}" type="text/css" media="all">
        <link rel="https://api.w.org/" href="{{asset("assets/usuarioFinal/wp-json/index.json")}}">
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="{{asset("assets/usuarioFinal/xmlrpc.xml?rsd")}}">
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="{{asset("assets/usuarioFinal/wp-includes/wlwmanifest.xml")}}"> 
         <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset("assets/$theme/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
        <!-- css Dumar -->
        <link rel="stylesheet" href="{{asset("css/usuariofinal.css")}}">
    </head>
    <body class="home">
        <div>
            @include('usuariofinal.tema.header')

            @yield('contenidoUsuarioFinal')
            
            @include('usuariofinal.tema.footer')
        </div>
        @include('usuariofinal.tema.navResponsivo')
        
        <script language="javascript" src="{{asset("assets/usuarioFinal/js/global.js")}}"></script>
        <script language="javascript" src="{{asset("assets/usuarioFinal/wp-content/themes/ilsb/assets/js/validacion.js")}}"></script>
        
        <script type='text/javascript' src='{{asset("assets/usuarioFinal/wp-includes/js/wp-embed.min.js?ver=5.2.4")}}'></script>
            
    </body>
</html>