@extends('layouts.app')

@section('content')
<div class="container">

	<div class='row justify-content-center mb-2'>
		<h3>Manage your Life</h3>
	</div>

	<div class='row mb-5'>

		<div class='col-lg-6'>
		<div class="card">
		  <div class="card-body">
				<h5 class="card-title text-center">Create a Quiz</h5>
				<p class="card-text">Create a quiz and share it with the world.</p>
				<a href="{{route('create_quiz')}}" class="btn btn-primary">Create</a>
		  </div>
		</div>
		</div>

		<div class='col-lg-6'>
		<div class="card">
		  <div class="card-body">
				<h5 class="card-title text-center">Show your quizzes</h5>
				<p class="card-text">View or Edit your quizes.</p>
				<a href="{{route('my_quizzes')}}" class="btn btn-primary">Show</a>
		  </div>
		</div>
		</div>

	</div>


	<div class='row'>

		<div class='col-lg-6'>
		<div class="card">
		  <div class="card-body">
				<h5 class="card-title text-center">Solve a Quiz</h5>
				<p class="card-text">Search a quiz from the list.</p>
				<a href="{{route('browse_quizzes')}}" class="btn btn-primary">Browse</a>
		  </div>
		</div>
		</div>

		<div class='col-lg-6'>
		<div class="card">
		  <div class="card-body">
				<h5 class="card-title text-center">Show statistics</h5>
				<p class="card-text">List of your reuslts.</p>
				<a href="{{route('show_results_of_a_user')}}" class="btn btn-primary">Show</a>
		  </div>
		</div>
		</div>

	</div>


</div>
@endsection
