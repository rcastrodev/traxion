@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show col-sm-12" role="alert">
    @foreach ($errors->all() as $error)
        <span class="d-block">{{$error}}</span>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>                
@endif