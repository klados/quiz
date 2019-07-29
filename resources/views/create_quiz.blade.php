@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
			<h4>Create a new Quiz</h4>
    </div>

			<div>
				{{ Form::open(array('action' => 'Create_quizController@store')) }}

					<div class='form-group'>
						{{ Form::label('quizName','Name of the quiz') }}
						{{ Form::text('quizName','',['class'=>'form-control']) }}
					</div>

					<div class='form-group'>
						{{ Form::label('description','Sort Description') }}
						{{ Form::textarea('description','',['class'=>'form-control', 'rows'=>"5"]) }}
					</div>
					
					<add_question></add_question>

					<div class='form-group'>
						{{ Form::label('quiz_duration','Quiz Duration') }}
						{{ Form::text('quiz_duration','',['class'=>'form-control', 'type'=>'number', 'placeholder'=>'Optional, in how many minutes the user must complete the quiz' ]) }}
					</div>

					{{ Form::submit('Submit', ['class'=>'btn btn-success']) }} 
					{{ Form::close() }}
			</div>	
		
			<!-- <question></question> -->
</div>
@endsection
