$(document).ready(function(){

    var url = $('#url').val();
    
    $('#btnAbrirModalAgregarR').click(function(){
        $('#form_results').html('');
        $('#btnModal').val("add");
        $('#modalT').text('Agregar Revista');
        $('#nomRev').text("Nueva Revista");
        $('#revista').prop('type','file');
        $('#nombre').prop('type','hidden');
        $('#formRevistas').trigger("reset");
        $('#modalRevistas').modal('show');
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
        var revista_id = $('#revista_id').val();
        var my_url = url;
        var parametros=new FormData($('#formRevistas')[0]);
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
                'estado': $('#estado').val()
            };
            my_url += '/editar/' + revista_id;
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
                    $('#formRevistas').trigger("reset");
                    $('#tablaRevistas').DataTable().ajax.reload();
                    if(type=='POST'){
                        toastr.success('Registro exitoso','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }else{
                        toastr.success('Actualizacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }
                    cerrarModal('#modalRevistas');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click','.editR', function(){
        var id=$(this).prop('id');
        my_url = url+'/editar/'+id
        $('#formRevistas').trigger("reset");
        $('#form_results').html('');
        $.ajax({
            url:my_url,
            dataType:"json",
            success:function(data){
                console.log(data);
                $('#nomRev').text("Nombre Revista");
                $('#revista').prop('type','hidden');
                $('#nombre').prop('type','text');
                $('#modalT').text('Editar Revista');
                $('#btnModal').val('update');
                $('#nombre').val(data.nomsinext);
                $('#descripcion').val(data.descripcion);
                $("#estado option[value="+ data.estado +"]").prop("selected",true);
                $('#revista_id').val(data.id);
                $('#modalRevistas').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });

    var id;
    $(document).on('click','.eliminarR', function(){
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
                $('#tablaRevistas').DataTable().ajax.reload();
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