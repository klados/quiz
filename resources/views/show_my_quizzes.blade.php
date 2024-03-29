@extends('layouts.app')

@section('content')
<div class='container'>

	<div class='row '>
		@if( count($quizzes) == 0)
			<div class='alert alert-danger '>Nothing here, create a new Quiz <a href="{{url('create_quiz')}}" class='btn btn-info ml-5'>Create Quiz</a></div>
		@endif
	</div>


	<div class="row ">

		@foreach($quizzes as $row)

		<div class="col-lg-4 mb-3">
			<div class="card">
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
							<li class='list-group-item'>
								<span class='mr-2'>Delete this quiz</span> <delete_confirm  quiz_id="{{$row->id}}"></delete_confirm>
							</li>
						</ul>
					</div>

					<div class="col flex text-center mt-4">
						<a href="{{ url('/show_edit_quiz/'.$row->id) }}" class='card-link'>View/Modify</a>
						<a href="{{ url('/show_quiz_results/'.$row->id) }}" class='card-link'>View Statistics</a>
					</div>

				</div>
			</div>
		</div>
		@endforeach

	</div>
</div>

@endsection
