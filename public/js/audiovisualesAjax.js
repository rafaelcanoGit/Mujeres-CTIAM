$(document).ready(function(){

    var url = $('#url').val();
    
    $('#btnAbrirModalAgregarAV').click(function(){
        $('#form_results').html('');
        $('#btnModal').val("add");
        $("#select").css('display', 'block');
        $("#audiov").css('display', 'block');
        $("#tipo").css('display', 'block');
        $("#audiovisual").prop('type','file');
        $("#linklabel").css('display', 'block');
        $("#link").prop('type','text');
        $('#modalT').text('Agregar AudioVisual');
        $('#formAudioVisuales').trigger("reset");
        cambiarTipo();
        $('#modalAudioVisuales').modal('show');
    });
    
    $('#btnModal').click(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').prop('content')
            }
        })
        e.preventDefault(); 
       
        var state = $('#btnModal').val();
        var type = "POST"; 
        var audiovisual_id = $('#audiovisual_id').val();
        var my_url = url;
        var parametros=new FormData($('#formAudioVisuales')[0]);
        var cache=false;
        var contentType=false;
        var processData=false;

        if (state == "update"){
            type = "PUT"; 
            cache=true;
            contentType='application/x-www-form-urlencoded; charset=UTF-8';
            processData=true;
            parametros={
                'nombre': $('#nombre').val(),
                'descripcion': $('#descripcion').val(),
                'estado': $('#estado').val(),
                'link': $('#link').val()
            };
            my_url += '/editar/' + audiovisual_id;
        }else{
            my_url += '/agregar';       
        }
        
        $.ajax({
            type: type,
            url: my_url,
            data: parametros,
            cache: cache,
            contentType: contentType,
            processData: processData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if(data.errors){
                    var html='<div class="alert alert-danger">';
                    for(var i=0;i<data.errors.length;i++){
                        html+='<p>'+data.errors[i]+'</p>';
                    }
                    html+='</div>';
                    $('#form_results').html(html);
                }else{
                    $('#formAudioVisuales').trigger("reset");
                    $('#tablaAudioVisuales').DataTable().ajax.reload();
                    if(type=='POST'){
                        toastr.success('Registro exitoso','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }else{
                        toastr.success('Actualizacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }
                    cerrarModal('#modalAudioVisuales');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click','.editAV', function(){
        var id=$(this).prop('id');
        my_url = url+'/editar/'+id
        $('#formAudioVisuales').trigger("reset");
        $('#form_results').html('');
        $.ajax({
            url:my_url,
            dataType:"json",
            success:function(data){
                console.log(data);
                $("#nombre").prop('type', 'text');
                $("#nomb").css('display', 'block');
                $("#select").css('display', 'none');
                $("#audiov").css('display', 'none');
                $("#tipo").css('display', 'none');
                $("#audiovisual").prop('type','hidden');
                
                if(data.tipo=='archivo'){
                    $("#linklabel").css('display', 'none');
                    $("#link").prop('type','hidden');
                    $('#nombre').val(data.nomsinext);
                }else{
                    $("#linklabel").css('display', 'block');
                    $("#link").prop('type','text');
                    $("#link").prop('disabled', false);
                    $("#link").val(data.link);
                    $('#nombre').val(data.nombre);
                }                
                $('#modalT').text('Editar AudioVisual');
                $('#btnModal').val('update');
                $('#descripcion').val(data.descripcion);
                $("#estado option[value="+ data.estado +"]").prop("selected",true);
                $('#audiovisual_id').val(data.id);
                $('#modalAudioVisuales').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });

    var id;
    $(document).on('click','.eliminarAV', function(){
        id=$(this).prop('id');
        $('#modalConfir').modal('show');
    });

    $('#btnOK').click(function(){
        $.ajax({
            url: url+'/eliminar/'+id,
            success:function(data){
                console.log('ok:', data);
                cerrarModal('#modalConfir');
                toastr.success('Eliminacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                $('#tablaAudioVisuales').DataTable().ajax.reload();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });
});
function cerrarModal(modal) {
    $(modal).modal('hide');//ocultamos el modal
    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
    $('.modal-backdrop').remove();//eliminamos el backdrop del modal
}

function cambiarTipo(){
    tipo= document.getElementById("tipo");
	if(tipo.value=='link'){
        $("#link").prop('disabled', false);
        $("#audiovisual").prop('disabled', true);
        $("#nombre").prop('type', 'text');
        $("#nomb").css('display', 'block');
    }else if(tipo.value=='archivo'){
        $("#link").prop('disabled', true);
        $("#audiovisual").prop('disabled', false);
        $("#nombre").prop('type', 'hidden');
        $("#nomb").css('display', 'none');
    }
}