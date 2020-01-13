//  USUARIOS AJAX
//  Crear
$(document).ready(function(){

    var url = $('#url').val();
    
    $('#btnAbrirModalAgregarU').click(function(){
        $('#form_results').html('');
        $('#email').prop('readonly', false);
        $('#btnModal').val("add");
        $('#modalT').text('Agregar Usuario');
        $('#formUsuarios').trigger("reset");
        $('#modalUsuarios').modal('show');
    });
    
    $('#btnModal').click(function (e){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').prop('content')
            }
        })
        e.preventDefault(); 
       
        var state = $('#btnModal').val();
        var type = "POST"; //for creating new resource
        var usuario_id = $('#usuario_id').val();
        var my_url = url;

        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/editar/' + usuario_id;
        }else{
            my_url += '/agregar';
        }
        
        $.ajax({
            type: type,
            url: my_url,
            data: {
                'nombre': $('#nombre').val(),
                'email': $('#email').val(),
                'tipousuario': $('#tipousuario').val(),
                'pass': $('#pass').val()
            },
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
                    $('#formUsuarios').trigger("reset");
                    $('#tablaUsuarios').DataTable().ajax.reload();
                    if(type=='POST'){
                        toastr.success('Registro exitoso','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }else{
                        toastr.success('Actualizacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                    }
                    cerrarModal('#modalUsuarios');
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $(document).on('click','.editU', function(){
        var id=$(this).prop('id');
        my_url = url+'/editar/'+id
        $('#formUsuarios').trigger("reset");
        $('#form_results').html('');
        $.ajax({
            url:my_url,
            dataType:"json",
            success:function(data){
                console.log(data);
                $('#nombre').val(data.name);
                $('#email').val(data.email);
                $('#email').prop('readonly', true);
                $("#tipousuario option[value="+ data.tipousuario_id +"]").prop("selected",true);
                $('#usuario_id').val(data.id);
                $('#modalT').text('Editar');
                $('#btnModal').val('update');
                $('#modalUsuarios').modal('show');
            }
        })
    });
    var id;
    $(document).on('click','.eliminarU', function(){
        id=$(this).prop('id');
        $('#modalConfir').modal('show');
    });

    $('#btnOK').click(function(){
        $.ajax({
            url: url+'/eliminar/'+id,
            success:function(data){
                cerrarModal('#modalConfir');
                toastr.success('Eliminacion exitosa','Excelente!!!', 
                        {"positionClass": "toast-top-right"});
                $('#tablaUsuarios').DataTable().ajax.reload();
            }
        })
    });
});
function cerrarModal(id) {
    $(id).modal('hide');//ocultamos el modal
    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
    $('.modal-backdrop').remove();//eliminamos el backdrop del modal
}