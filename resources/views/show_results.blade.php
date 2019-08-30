@extends('layouts.app')
@section('content')

	<div class='container'>

		<div class='row justify-content-center'>
			<h4>{{$title}}</h4>
		</div>

		<div>
			@if($total-$to_be_answer !=0)
			<h5>Your score is: <span>{{ number_format($correct * 100/($total-$to_be_answer), 2)}}%</span></h5>
			@else
			<h5>Your score is: <span>0%</span></h5>
			@endif
	
		</div>
		
		@if(Auth::check())
			You will be notified when the examiner review your {{$to_be_answer}} remaining  answers.
		@endif
		
		<div class='row justify-content-center'>
			<a type='button' href="{{ route('home') }}" class='btn btn-primary'>Home</a>
		</div>

	</div>
@endsection
