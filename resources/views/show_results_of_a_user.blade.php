@extends('layouts.app')
@section('content')

	<div class='container'>

		<div class='row justify-content-center mb-5'>
			<h4>Your Results</h4>
		</div>

		<!-- <div class='row justify&#45;content&#45;center'> -->
		<!-- </div> -->

		<table class="table table-striped">
			<thead>
				<tr>      
					<th scope="col">Quiz Name</th>
					<th scope="col">Score</th>
					<th scope="col">Description</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tbody>
			@foreach($results as $row)
			<tr>
				<td>{{$row->quizName}}</td>
				<td>{{$row->score}}</td>
				<td>{{$row->description}}</td>
				<td>{{$row->created_at}}</td>
			</tr>
			@endforeach
			</tbody>
		</table>

	</div>
@endsection
