@extends('layouts.app')

@section('content')

<div class='container'>

	<div class='row '>
		@if( count($available_quizzes) == 0)
			<div class='alert alert-danger '>Nothing here, create a new Quiz <a href="{{url('create_quiz')}}" class='btn btn-info ml-5'>Create Quiz</a></div>
		@else
			<input class="form-control mb-5" type="text" placeholder="Search" aria-label="Search">
		@endif
	</div>

	@foreach($available_quizzes as $row)
	<div class='col-lg-4 mb-3'>
		<div class='card'>
			<div class="card-body">
				<h5 class="card-title">{{ $row->quizName }}</h5>
				<div class="card-text">
					<p>{{ $row->description }}</p>
					<ul class="list-group">
						<li class="list-group-item">
							Max duration of quiz:
							@if($row->quiz_duration == NULL)
								<strong>Unlimited time</strong>
							@else
								<strong>{{ $row->quiz_duration }} min</strong>
							@endif
						</li>
						<li class="list-group-item">
							Access mode: {{$row->access}}
						</li>
						<li class="list-group-item">
							Created on: {{$row->created_at}}
						</li>
					</ul>
				</div>

				<div class="col flex text-center mt-4">
					<a href="{{ route('solve_quiz', $row->id) }}" class='flex-item card-link mr-3'>Solve</a>
				</div>

			</div>
		</div>
	</div>
	@endforeach

</div>
@endsection
