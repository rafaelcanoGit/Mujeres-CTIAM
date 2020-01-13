$(document).ready(function(){

    var url = $('#url').val();
    
    $('#btnAbrirModalAgregarS').click(function(){
        $('#form_results').html('');
        $('#btnModal').val("add");
        $('#modalT').text('Agregar Slider');
        $('#formSliders').trigger("reset");
        $('#modalSliders').modal('show');
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
        var slider_id = $('#slider_id').val();
        var my_url = url;
        var parametros=new FormData($('#formSliders')[0]);

        if (state == "update"){
            my_url += '/editar/' + slider_id;
        }else{
            my_url += '/agregar';       
        }
        
        $.ajax({
            type: type,
            url: my_url,
            data: parametros,
            cache: false,
            contentType: false,
            processData: false,
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
                    $('#formSliders').trigger("reset");
                    $('#tablaSliders').DataTable().ajax.reload();
                    if(state == "update"){
                        toastr.success('Actualizacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }else{
                        toastr.success('Registro exitoso','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }
                    cerrarModal('#modalSliders');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click','.editS', function(){
        var id=$(this).prop('id');
        my_url = url+'/editar/'+id
        $('#formSliders').trigger("reset");
        $('#form_results').html('');
        $.ajax({
            url:my_url,
            dataType:"json",
            success:function(data){
                console.log(data);
                $('#modalT').text('Editar Slider');
                $('#btnModal').val('update');
                $('#nombre').val(data.nombre);
                $('#link').val(data.link);
                $("#estado option[value="+ data.estado +"]").prop("selected",true);
                $('#slider_id').val(data.id);
                $('#modalSliders').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        })
    });

    var id;
    $(document).on('click','.eliminarS', function(){
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
                $('#tablaSliders').DataTable().ajax.reload();
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
