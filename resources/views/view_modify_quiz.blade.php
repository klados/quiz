@extends('layouts.app')

@section('content')

<div class='container'>

	{{ Form::open(array('action' => 'Create_quizController@update')) }}
store

		{{ Form::hidden('quiz_id', $head[0]->id) }}

		<div class='form-group'>
			{{ Form::label('quizName','Name of the quiz:') }}
			{{ Form::text('quizName',$head[0]->quizName,['class'=>'form-control']) }}
		</div>

		<div class='form-group'>
			{{ Form::label('description','Sort description:') }}
			{{ Form::textarea('description',$head[0]->description,['class'=>'form-control', 'rows'=>'5']) }}
		</div>

		@foreach($questions as $question)
		<div style='background-color:#dfe1e2!important' class='pt-2 pb-2 pl-2 pr-2 mb-5'>
			<div class='form-group'>
				{{ Form::label($question->id,'Question:') }}
				{{ Form::text("questions[$question->id][question]",$question->question,['class'=>'form-control']) }}
			</div>

			@if($question->type == 'Single Line')
				<div class='form-group'>
					{{ Form::label($question->id, 'Correct_answer:') }}
					{{ Form::text("questions[$question->id][ans]", $question->correct_answer,['class'=>'form-control']) }}
				</div>
			@elseif($question->type == 'Radio buttons')

				@for($i=0;$i<count(json_decode($question->options));$i++)
					{{ Form::text("questions[$question->id][option][$i]",json_decode($question->options)[$i],['class'=>'form-control']) }}
				@endfor

				<div class='form-group mt-2'>
					{{ Form::label($question->id, 'Correct_answer:') }}
					{{ Form::text("questions[$question->id][ans]", $question->correct_answer,['class'=>'form-control']) }}
				</div>
				
			@elseif($question->type == 'Text')
				<div class='form-group'>
					{{ Form::label('','Manual check') }}
				</div>
			@endif
		</div>
		@endforeach
		
		<div class='form-group'>
			{{ Form::label('quiz_duration','Duration of the quiz:') }}
			{{ Form::text('quiz_duration',$head[0]->quiz_duration,['class'=>'form-control', 'quiz_duration', 'placeholder'=>'Optional, in how many minutes the user must complete the quiz']) }}
		</div>

  <div class="row justify-content-center">
		{{ Form::submit('Update Quiz', ['class'=>'btn btn-success']) }} 
	</div>
	{{ Form::close() }}

</div>

@endsection
