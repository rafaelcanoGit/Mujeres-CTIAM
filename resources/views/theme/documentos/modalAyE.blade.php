<div class="modal fade in" id="modalDocumentos" role="dialog">
        <div class="modal-dialog">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="modal-header with-border">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span></button>
                                <h3 id="modalT" class="modal-title">Agregar Documento</h3>
                            </div>
                            <!-- /.box-header -->   
                            <!-- form start -->
                            <div class="modal-body">
                                <span id="form_results"></span>
                                <form  id="formDocumentos" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group archivo">
                                        <label id="nomRev" for="examplse">Nuevo Documento</label>
                                        <input type="file" id="documento" name="documento" >
                                        <input type="hidden" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="{{ old('nombre') }}">
                                    </div> 
                                    <div class="form-group">
                                        <label>Tipo Documento</label>
                                        <select class="form-control" name="tipodocumento" id="tipodocumento">
                                            @foreach ($tiposdocumentos as $tipodocumento)
                                                    <option value="{{$tipodocumento->id}}">{{strtoupper($tipodocumento->nombre)}}</option>
                                            @endforeach
                                        </select>
                                    </div>                         
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select class="form-control" name="estado" id="estado">
                                            <option value="visible">VISIBLE</option>
                                            <option value="oculto">OCULTO</option>
                                        </select>
                                    </div>                                  
                                    <label>Descripcion</label>
                                    <textarea class="form-control" rows="3" placeholder="..." id="descripcion" name="descripcion">
                                        {{old('descripcion')}}</textarea>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary pull-right" id="btnModal">Agregar</button>
                                <input type="hidden" id="documento_id" name="documento_id" value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>