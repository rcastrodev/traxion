<div class="bg-blue">
    <form action="{{ route('productos') }}" method="get" class="container mx-auto py-sm-3 py-md-5 row">
        <div class="col-sm-12 col-md-5 mb-sm-3 mb-md-0">
            <div class="form-group">
                <select name="category_id" class="form-control" id="category_id" data-url="{{ route('productos-por-categoria') }}">
                    <option value="0">Seleccione categoría</option>
                    @foreach ($appCategories as $appCategory)
                        <option value="{{ $appCategory->id }}">{{ $appCategory->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-5 mb-sm-3 mb-md-0">
            <div class="form-group">
                <select name="product_id" class="form-control" id="product_id">
                    <option value="0">Seleccione producto</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 col-md-2">
            <button type="submit" class="btn bg-red text-white w-100 fw-bold text-uppercase">Buscar</button>
        </div>
    </form>
</div>