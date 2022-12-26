@if (Session::has('mensaje'))
    <div class="alert alert-success alert-dismissible fade show col-sm-12" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>   
@endif

 