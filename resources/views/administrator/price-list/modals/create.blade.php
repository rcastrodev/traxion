<div class="modal fade" id="modal-create-element">
    <form action="{{ route('price-list.content.store') }}" method="post" class="modal-dialog" data-info="reset">
        <input type="hidden" name="section_id" value="6">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Título">
                </div>
                <div class="form-group">
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>  
                <div class="form-group">
                    <input type="text" name="type" class="form-control" placeholder="Tipo de archivo">
                </div>
                <div class="form-group">
                    <input type="file" name="archive" class="form-control-file">
                    <small>archivo de descarga</small>
                </div>   
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>