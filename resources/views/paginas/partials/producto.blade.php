<div class="card card-producto position-relative">
    <div class="position-relative bg-celeste" style="min-height: 290px;">
        <a href="{{ route('producto', ['id' => $product->id]) }}" class="position-absolute mas">+</a>
        @if (count($product->images))
            <img src="{{ asset($product->images()->first()->image) }}" class="card-img-top img-fluid" alt="{{$product->name}}">
        @else
            <img src="{{ asset('images/default.jpg') }}" class="card-img-top img-fluid" alt="{{$product->name}}">	
        @endif
    </div>
    <div class="card-body bg-white ps-0">
        <a href="{{ route('producto', ['id' => $product->id]) }}" class="card-title font-size-18 text-decoration-none text-dark d-block">{{$product->name}}</a>
    </div>  
</div>

