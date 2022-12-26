@extends('paginas.partials.app')
@section('content')
@if(count($sliders))
	<div id="sliderHero" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
			@foreach ($sliders as $k => $item)
				<button type="button" data-bs-target="#sliderHero" data-bs-slide-to="{{$k}}" class="@if(!$k) active @endif"  aria-current="true" aria-label="Slide {{$k}}"></button>			
			@endforeach
		</div>
		<div class="carousel-inner" style="box-shadow: -1px -1px 14px #00000014;">
			@foreach ($sliders as $key => $slider)
				<div class="carousel-item @if(!$key) active @endif" style="background-image: url({{$slider->image}}); background-repeat: no-repeat; background-size: 100% 100%; background-position: center;">
					<div class="container mx-auto contentHero">
						<div class="mt-sm-2 text-start" style="max-width: 600px !important;">
							<h1 class="text-white font-size-58 text-dark hero-content-slider">{{ $slider->content_1 }}</h1>
							@if ($slider->content_2)
								<div class="d-sm-none d-md-block">
									<a href="{{ $slider->content_2 }}" class="bg-red-2 text-white py-2 px-4 text-decoration-none mt-5 d-inline-block text-uppercase font-size-16 fw-light">Más información</a>
								</div> 		
							@else
								<div class="d-sm-none d-md-block">
									<a href="{{ route('contacto') }}" class="bg-red-2 text-white py-2 px-4 text-decoration-none mt-5 d-inline-block text-uppercase font-size-16 fw-light">Más información</a>
								</div> 				
							@endif

						</div>
					</div>
				</div>			
			@endforeach
		</div>	
	</div>	
@endif
@includeIf('paginas.partials.filtro')
<div class="categorias py-5">
	<div class="row container mx-auto">
		<div class="col-sm-12 mb-4">
			<h3 class="text-center">Productos</h3>
		</div>
		@foreach ($categories as $category)
			<div class="col-sm-12 col-md-3 mb-2">
				@includeIf('paginas.partials.categoria', ['category' => $category])
			</div>
		@endforeach
	</div>
</div>
@isset($section2)
	<section id="section2">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				@if (Storage::disk('public')->exists($section2->image))
					<img src="{{Storage::disk('public')->url($section2->image)}}" class="img-fluid">
				@endif
			</div>
			<div class="col-sm-12 col-md-6">
				<h3 class="font-size-30 text-black fw-bold mt-4 mb-3">{{ $section2->content_1 }}</h3>
				<div class="font-size-18">{!! $section2->content_2 !!}</div>
				<a href="{{ route('contacto') }}" class="bg-red-2 text-white py-2 px-4 text-decoration-none mt-5 d-inline-block text-uppercase font-size-16 fw-light">Más información</a>
			</div>
		</div>
	</section>
@endisset
@endsection
@push('head')
	<style>
		@media(max-width: 992px)
		{
			h1.hero-content-slider{
				margin-top: 100px;
				font-size: 24px !important;
			}
		}

		@media(max-width: 768px)
		{
			#section2{
				max-width: 95%;
				margin:auto;
				margin-bottom: 20px;
			}
		}
		
	</style>
@endpush
