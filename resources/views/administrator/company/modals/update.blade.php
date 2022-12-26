<div class="modal fade" id="modal-update-element">
    <form action="{{ route('company.content.updateSlider') }}" method="post" id="form-update-slider" class="modal-dialog" data-info="reset" data-sync="no" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <input type="number" name="content_2" class="form-control" placeholder="Año">
            </div>  
            <div class="form-group">
                <textarea name="content_1" class="ckeditor" id="content_11" cols="30" rows="10" placeholder="Contenido"></textarea>
            </div>   
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>