function mostrarPassword(){
    var cambio = document.getElementById("pass");
    var cambio2 = document.getElementById("pass2");
    if(cambio.type == "password"){
        cambio.type = "text";
        cambio2.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    }else{
        cambio.type = "password";
        cambio2.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
} 
