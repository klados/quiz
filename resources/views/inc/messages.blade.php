<div class='container'>
<div class="row justify-content-center">
@if(Count($errors) > 0)
<ul class="list-group">
	@foreach($errors->all() as $error)
<li>
	<div class='alert alert-danger col-md-12'>
		{{$error}}
	</div>
</li>
	@endforeach
	</ul>
@endif


@if(session('success'))
	<div class='alert alert-success'>
		{{ session('success') }}
	</div>
@endif

@if(session('error'))
	<div class='alert alert-danger'>
	{{ session('error') }}
	</div>
@endif
</div>
</div>
