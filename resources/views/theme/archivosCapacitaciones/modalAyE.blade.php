<div class="modal fade in" id="modalArchivosCapacitacion" role="dialog">
        <div class="modal-dialog">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="modal-header with-border">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                <h3 id="modalT" class="modal-title">Agregar Archivos</h3>
                            </div>
                            <!-- /.box-header -->   
                            <!-- form start -->
                            <div class="modal-body">
                                <span id="form_results"></span>
                            <form  id="formArchivosCapacitacionAgregar" method="post" enctype="multipart/form-data" style="display:block">
                                    @csrf
                                    <div class="form-group archivo">
                                        <label id="nomRev" for="examplse">Archivos</label>
                                        <input type="file" id="archivos" name="archivos[]" multiple>
                                    </div> 
                                </form>
                                <form  id="formArchivosCapacitacionEditar" method="post" style="display:block">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputFile">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" 
                                        name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right" id="btnModal">Agregar</button>
                                <input type="hidden" id="archivo_id" name="archivo_id" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>