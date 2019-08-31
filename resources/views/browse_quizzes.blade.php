@extends('layouts.app')

@section('content')

<div class='container'>

		@if( count($available_quizzes) == 0)
		<div class='row '>
			<div class='alert alert-danger '>Nothing here, create a new Quiz <a href="{{url('create_quiz')}}" class='btn btn-info ml-5'>Create Quiz</a></div>
		</div>
		@else
			<search_quiz :quizzes="{{$available_quizzes}}"></search_quiz>
		@endif


</div>
@endsection
