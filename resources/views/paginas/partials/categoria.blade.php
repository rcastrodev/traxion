<div class="card card-producto">
    <div class="position-relative" style="background-color: #F7F9FC; min-height: 290px;">
        <a href="{{ route('categoria', ['id' => $category->id]) }}" class="position-absolute mas">+</a>
        @if (Storage::disk('public')->exists($category->image))
            <img src="{{ asset($category->image) }}" class="card-img-top img-fluid" alt="{{$category->name}}">
        @else
            <img src="{{ asset('images/default.jpg') }}" class="card-img-top img-fluid" alt="{{$category->name}}">	
        @endif
        @if ($category->brand_image)
            <img src="{{ asset($category->brand_image) }}" class="position-absolute img-fluid" style="    bottom: 0px;
            right: 10px; max-width: 70px; max-height: 60px; min-height: 50px; object-fit: contain;" alt="{{$category->name}}">
        @endif
    </div>
    <div class="card-body bg-white">
        <a href="{{ route('categoria', ['id' => $category->id]) }}" class="card-title text-center font-size-18 text-decoration-none text-dark d-block text-center">{{$category->name}}</a>
    </div>
</div>

