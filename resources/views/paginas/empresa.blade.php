@extends('paginas.partials.app')
@section('content')
<div class="contenedor-breadcrumb bg-celeste">
    <div class="container">
        <div aria-label="breadcrumb">
            <ol class="breadcrumb py-2 font-size-13 m-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="color-azul-oscuro text-decoration-none text-dark">inicio</a>
                </li>
                <li class="breadcrumb-item active text-dark" aria-current="page">Empresa</li>
            </ol>
        </div>
    </div>
</div>
<div class="jumbotron bg-celeste py-5">
	<div class="container mx-auto"><h1 class="text-blue font-size-30">Empresa</h1></div>
</div>
@isset($section2)
	<section id="section_2" class="py-sm-2 pt-md-5">
		<div class="container py-sm-0 py-md-3">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="font-size-18 mb-5">{!! $section2->content_1 !!}</div>
					<div class="d-flex flex-wrap justify-content-sm-center justify-content-md-between img-empresa">
						@if (Storage::disk('public')->exists($section2->content_2))
							<div class="">
								<img src="{{Storage::disk('public')->url($section2->content_2)}}" class="img-fluid d-block mb-3">
							</div>
						@endif
						@if (Storage::disk('public')->exists($section2->content_3))
							<div class="">
								<img src="{{Storage::disk('public')->url($section2->content_3)}}" class="img-fluid d-block mb-3">
							</div>
						@endif
						@if (Storage::disk('public')->exists($section2->content_4))
							<div class="">
								<img src="{{Storage::disk('public')->url($section2->content_4)}}" class="img-fluid d-block mb-3">
							</div>
						@endif
					</div>
				</div>
				<div class="col-sm-12 col-md-6 mb-sm-4 mb-md-0">{!! $section2->content_5 !!}</div>
			</div>
		</div>
	</section>	
@endisset
@isset($histories)
	@if(count($histories))
		<div class="py-5 bg-celeste d-sm-none d-md-block" style="border-bottom: 1px solid #f5f5dc82;">
			<div class="container mx-auto my-5 ">
				<div class="timeline-container timeline-theme-1">
					<div class="timeline js-timeline">
						@foreach ($histories as $h)
							<div data-time="{{ $h->content_2 }}" class="text-blue">{!! $h->content_1 !!}</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	@endif
@endisset
@endsection
@push('head')
	<link rel="stylesheet" href="{{ asset('vendor/timeline/timeline.css') }}" />
	<style>
		.timeline-dots li.slide-active button, 
		.timeline-dots button{
			color: #24348C !important
		}

		.img-empresa > div{
			width: 30%;
		}
		@media(max-width:768px){
			.img-empresa > div{
				width: 48%;
			}	
		}
		@media(max-width:500px){
			.img-empresa > div{
				width: 95%;
			}	
		}
	</style>
@endpush
@push('scripts')
	<script src="{{ asset('vendor/timeline/timeline.js') }}"></script>
	<script>
		$('.js-timeline').Timeline({
			dotsPosition: 'top',
		});
	</script>	
@endpush
       
