<div class="modal fade" id="modal-create-element">
    <form action="{{ route('client.content.store') }}" method="post" class="modal-dialog" data-info="reset">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Nombre cliente">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                </div>  
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Ingrese la clave">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="repita la clave">
                </div>  
                <div class="form-group">
                    <label for="">Estado del cliente Activo/Desactivado</label>
                    <input type="checkbox" name="status" value="1">
                </div>  
                <div class="form-group col-sm-12 mt-4">
                    <label for="">Lista de precios</label><br>
                    <select name="priceLists[]" class="select2 form-control" multiple="multiple">
                        @foreach ($priceLists as $pl)
                            <option value="{{$pl->id}}">{{$pl->name}}</option>
                        @endforeach
                    </select>
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