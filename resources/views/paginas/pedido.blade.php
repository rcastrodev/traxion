@extends('paginas.partials.app')
@section('content')
<header class="d-sm-none d-md-block" style="background-image: linear-gradient(rgba(0, 0, 0, 0.9),rgba(0, 0, 0, 0.1)), url({{ Storage::disk('public')->url('images/blog/Enmascarar_grupo_525.png') }}); background-repeat: no-repeat; background-size: 100% 100%; background-position: center;">
    <div class="container mx-auto d-flex align-items-center" style="height:145px;">
        <h4 class="text-yellow font-size-18 pt-3 text-uppercase fw-bold" style="border-top: 2px solid #ffdd00;">Carrito</h4>
    </div>
</header>
@includeIf('paginas.partials.filtro', ['categories' => $categories])
<form class="carrito my-5">
    <div class="container">
        <div class="table-responsive py-5">
            <table class="table font-size-14 table-striped">
                <thead class="bg-black">
                    <tr>
                        <th></th>
                        <th class="text-white fw-light">LINEA</th>
                        <th class="text-white fw-light">PRODUCTO</th>
                        <th class="text-white fw-light">DESCRIPCIÓN</th>
                        <th class="text-white fw-light">PRECIO</th>
                        <th class="text-white fw-light">CANTIDAD</th>
                        <th class="text-white fw-light"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr style="border: none;">
                            <td style="border: none;">
                                @if (count($product->images))
                                    @if (Storage::disk('public')->exists($product->images()->first()->image))
                                        <img src="{{ Storage::disk('public')->url($product->images()->first()->image) }}" class="img-fluid d-block mx-auto" alt="{{ $product->name }}" style="max-width: 80px;">
                                    @endif
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" class="img-fluid d-block mx-auto" alt="{{ $product->name }}" style="max-width: 80px;">    
                                @endif
                            </td style="border: none;">
                            <td style="border: none;">{{ $product->category->name }}</td>
                            <td style="border: none;">{{ $product->name }}</td>
                            <td style="border: none;">{{ $product->short_description }}</td>
                            <td style="border: none;">{{ $product->price }}</td>
                            <td style="border: none;">
                                <input type="number" name="cantidad" class="px-2 py-1" style="max-width: 90px; border-radius: 30px;">
                            </td>
                            <td style="border: none;">
                                <button class="text-uppercase px-4 py-2 btn text-white bg-black rounded-pill fw-bold font-size-14">agregar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links()  }}
        </div>
        <div class="text-end">
            <button type="submit" class="btn bg-yellow fw-bold text-uppercase text-black rounded-pill px-4 py-2">comprar</button>
        </div>
    </div>
</form>
@endsection
@push('scripts')
<script>
    let category_id = document.getElementById('category_id')
    if (category_id) {
        category_id.addEventListener('change', function(e){
            axios.get(`${e.target.dataset.url}/${category_id.options[category_id.selectedIndex].value}`).then(r => {

                let productsSelect, productsTable

                productsSelect = r.data.products.map( element => {
                    return `<option value="${element.id}">${element.name}</option>`
                })

                document.getElementById('product_id').innerHTML = productsSelect.join('')

            }).catch(error =>{
                console.error(new Error(error))
            })
        })
    }
</script>
@endpush
