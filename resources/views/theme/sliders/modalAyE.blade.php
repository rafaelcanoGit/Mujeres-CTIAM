<div class="modal fade in" id="modalSliders" role="dialog">
        <div class="modal-dialog">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="modal-header with-border">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                <h3 id="modalT" class="modal-title">Agregar Slider</h3>
                            </div>
                            <!-- /.box-header -->   
                            <!-- form start -->
                            <div class="modal-body">
                                <span id="form_results"></span>
                                <form  id="formSliders" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputFile">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" 
                                        name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Link</label>
                                        <input type="text" class="form-control" id="link" 
                                        name="link" placeholder="link" value="{{ old('link') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="visible">VISIBLE</option>
                                            <option value="oculto">OCULTO</option>
                                        </select>
                                    </div> 
                                    <div class="form-group archivo">
                                        <label id="nomRev" for="examplse">Imagen</label>
                                        <input type="file" id="imagen" name="imagen">
                                    </div>                            
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right" id="btnModal">Agregar</button>
                                <input type="hidden" id="slider_id" name="slider_id" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>