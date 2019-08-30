@extends('layouts.app')

@section('content')
<div class='container'>

	<div class='mb-5'>
		<span class='row justify-content-center '>
		<h4>{{$results[0]->quizName}}</h4>
		</span>
		<h5>{{$results[0]->description}}</h5>
	</div>

	<div class="row ">
		<table class="table table-striped">
			<thead>
				<tr>      
					<th scope="col">Quiz Name</th>
					<th scope="col">Score</th>
					<th scope="col">User Email</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tbody>
			@foreach($results as $row)
			<tr>
				<td>{{$row->quizName}}</td>
				<td>{{$row->score}}</td>
				<td>{{$row->user_email}}</td>
				<td>{{$row->created_at}}</td>
			</tr>
			@endforeach
			</tbody>
		</table>

	</div>
</div>

@endsection
