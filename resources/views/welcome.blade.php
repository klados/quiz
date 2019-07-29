@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">

		<div class='col-md-8 text-center'>
			<p>Evolve your business</p>
			<h3>Quiz solving platform</h3>
			<p>A powerful tool for the examiner, an easy exam for the candidant</p>
		</div>

	</div>

	<div class="row justify-content-center">
		<div class='col-md-12'>
			<div class='card'>
				<div class='card-header text-center bg-info text-white'>Are you an examiner?</div>
				<div class='card-body'>
					<h5 class="card-title">Join us</h5>
					<p class='card-text'>Create an account and start creating awesome quiz</p>
					<a href="{{url('register')}}" class="btn btn-primary">Join</a>
				</div>
			</div>
		</div>

		<div class='col-md-12 mt-4'>
			<div class='card'>
				<div class='card-header text-center bg-info text-white'>Are you a candidant?</div>
				<div class='card-body'>
					<h5 class="card-title">Good luck</h5>
					<p class='card-text'>Just type the quiz code that you have been provited with</p>
					<p class='card-text'> 
					<form>
						<div class='form-group row'>
							<label for='code_input' class='col-sm-2 col-form-label'>Quiz code:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='code_input'>
							</div>
						</div>
						<button type='submit' class='btn btn-primary'>Start</button>
					</form>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
