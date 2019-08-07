@extends('layouts.app')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
@section('content')

	<div class='container'>

  <div class="row justify-content-center">
		<h3>{{$quiz->quizName}}</h3>
	</div>

	<p class='mb-5'>{{$quiz->description}}</p>


		{{ Form::open(array('action' => 'Solve_quizController@store')) }}

			{{ Form::hidden('quiz_id', $quiz->id, ['name'=>'quiz_id' ]) }}

		@foreach($questions as $row)

			<div class='pt-2 pb-2 pl-2 pr-2 mb-5' style='background-color:#dfe1e2!important'>
				<h5>{{$row->question}}</h5>

				@if($row->type == 'Single Line')
					
					{{ Form::text($row->id,'',['class'=>'form-control', 'name'=>"answers[$row->id]",  'placeholder'=> 'And the answer is ...']) }}

				@elseif($row->type == 'Text')

					<editor name="answers[{{$row->id}}]" api-key="rqb4z2v1v0xfnw6jwbtzqnrl5h0a60suba45n5ke7y7ibpgg" :init="{plugins: 'code', menubar: false}"></editor>

				@elseif($row->type == 'Radio buttons')
					
					@foreach(json_decode($row->options) as $option)
						<div class="form-check">
							<input class="form-check-input position-static" type="radio" name="answers[{{$row->id}}]" id="{{$option}}" value="{{$option}}" aria-label="{{$option}}"> {{$option}}
						</div>

						@endforeach

				@endif
			</div>
		@endforeach

  <div class="row justify-content-center">
		{{ Form::submit('Submit Quiz', ['class'=>'btn btn-success']) }} 
	</div>

		{{ Form::close() }}
	</div>
@endsection
