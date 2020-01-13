$(document).ready(function(){

    var url = $('#url').val();
    
    $('#btnAbrirModalAgregarD').click(function(){
        $('#form_results').html('');
        $('#btnModal').val("add");
        $('#modalT').text('Agregar Documento');
        $('#nomRev').text("Nuevo Documento");
        $('#documento').prop('type','file');
        $('#nombre').prop('type','hidden');
        $('#formDocumentos').trigger("reset");
        $('#modalDocumentos').modal('show');
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
        var documento_id = $('#documento_id').val();
        var my_url = url;
        var parametros=new FormData($('#formDocumentos')[0]);
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
                'tipodocumento': $('#tipodocumento').val(),
                'estado': $('#estado').val()
            };
            my_url += '/editar/' + documento_id;
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
                    $('#formDocumentos').trigger("reset");
                    $('#tablaDocumentos').DataTable().ajax.reload();
                    if(type=='POST'){
                        toastr.success('Registro exitoso','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }else{
                        toastr.success('Actualizacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }
                    cerrarModal('#modalDocumentos');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click','.editD', function(){
        var id=$(this).prop('id');
        my_url = url+'/editar/'+id
        $('#formDocumentos').trigger("reset");
        $('#form_results').html('');
        $.ajax({
            url:my_url,
            dataType:"json",
            success:function(data){
                console.log(data);
                $('#nomRev').text("Nombre Documento");
                $('#documento').prop('type','hidden');
                $('#nombre').prop('type','text');
                $('#modalT').text('Editar Documento');
                $('#btnModal').val('update');
                $('#nombre').val(data.nomsinext);
                $('#descripcion').val(data.descripcion);
                $("#tipodocumento option[value="+ data.tipodocumento_id +"]").prop("selected",true);
                $("#estado option[value="+ data.estado +"]").prop("selected",true);
                $('#documento_id').val(data.id);
                $('#modalDocumentos').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });

    var id;
    $(document).on('click','.eliminarD', function(){
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
                $('#tablaDocumentos').DataTable().ajax.reload();
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