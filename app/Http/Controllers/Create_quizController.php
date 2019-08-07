<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quiz;
use App\Question;
use DB;

use Illuminate\Support\Facades\Auth;


class Create_quizController extends Controller
{
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
			$this->middleware('auth');
	}


	/**
	 *
	 */
	public function index()
	{

		try
		{
			$ownerEmail = Auth::user()->email;
			$quizzes = DB::table('quizzes')->select(
				DB::raw('md5(id) as id, quizName, quiz_duration, access, description, date(created_at) as created_at')
			)->where('ownerEmail', $ownerEmail)->get();
		}
		catch(\Illuminate\Database\QueryException $ex){ 
			// return back()->withInput()->withErrors(['err'=> $ex->getMessage()]);
			return redirect('/home')->with('error', $ex->getMessage());
		}

		return view('show_my_quizzes', ['quizzes'=> $quizzes]);
	}


	/**
	*	show the create quiz form
	*/
	public function create(){
		return view('create_quiz');
	}


	/**
	 *	delete specific quiz
	 *	@param id of quiz
	 *	@return \Illuminate\Http\Response
	 */
	public function delete(Request $request, $id){

		$userEmail = Auth::user()->email;

		try{
			// check if user owns the quiz
			$quiz = DB::table('quizzes')->select('ownerEmail')
															 		->where(DB::raw("md5(id)"), $id)->get();
			if(count($quiz) != 1){
				return redirect('/home')->with('error','Unexpected Error');
			}

			if($quiz[0]->ownerEmail != $userEmail){
				return redirect('/home')->with('error','You are not the owner of the quiz');
			}

			// delete quiz 
			$affected = DB::table('quizzes')->where(DB::raw('md5(id)'), '=', $id)->delete();
			
			if($affected == 0){
				return redirect('/home')->with('error','Problem, nothing deleted');
			}

		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return back()->withInput()->withErrors(['err'=> $ex->getMessage()]);
		}

		return redirect('/home')->with('success','Quiz Deleted');
	}


	/**
	 *	store data from submited form
	 *	@param \Illuminate\Http\Request $request
	 *	@return \Illuminate\Http\Response
	 */
	public function store(Request $request){

		$this->validate($request,[
			'quizName' => 'required',
			'description' => 'required'
		]);

		$userEmail = Auth::user()->email;

		try{
			// store quiz to the database
			$quiz = new Quiz();
			$quiz->quizName = $request->input('quizName');
			$quiz->description= $request->input('description');
			$quiz->ownerEmail = $userEmail;  //$request->session()->get('email');
			$quiz->quiz_duration = $request->input('quiz_duration');
			$quiz->save();

			$target_quiz = $quiz->id;

			// store questions to the database
			foreach($request->input('questions') as $q) {
				$question = new Question();
				$question->timestamps = false;
				$question->question = $q['question'];
				$question->type = $q['type_of_question'];
				$question->target_quiz = $target_quiz;
			
				if($q['type_of_question'] == 'Radio buttons' || $q['type_of_question'] == 'Single Line' ){
					$question->correct_answer = $q['correct_answer'];
					
					if($q['type_of_question'] == 'Radio buttons'){
						$question->options = json_encode($q['options']);
					}
				}
				$question->save();
			}
		} 
		catch(\Illuminate\Database\QueryException $ex){ 
			return back()->withInput()->withErrors(['err'=> $ex->getMessage()]);
		}
		// dd($request);
		return redirect('/home')->with('success','Quiz created');
	}


	/**
	 *	@param id of quiz
	 *	@return \Illuminate\Http\Response
	 */
	public function edit($id){

		try{

			$ownerEmail = Auth::user()->email;
			$quiz = DB::table('quizzes')->select(
				DB::raw('md5(id) as id, quizName, quiz_duration, access, description, date(created_at) as created_at')
			)->where(DB::raw('md5(id)'), $id)->where('ownerEmail', $ownerEmail)->get();

			$quiz_id = $quiz[0]->id;
			$questions = DB::table('questions')->select(DB::raw('md5(id) as id, question, type, correct_answer, options'))
																				 ->where(DB::raw('md5(target_quiz)'), $quiz_id)->get();
			// dd($questions);
		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return back()->withInput()->withErrors(['err'=> $ex->getMessage()]);
		}

		return view('view_modify_quiz', ['head'=>$quiz,'questions'=>$questions]);
	}


	/**
	 * modify an existed quiz
	 *	@return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{

		try
		{
			// check if user own this quiz
			$userEmail = Auth::user()->email;
			$quiz = DB::table('quizzes')->select('ownerEmail')
															 		->where(DB::raw("md5(id)"), $request->input('quiz_id'))->get();
			if(count($quiz) != 1){
				return redirect('/home')->with('error','Unexpected Error');
			}

			if($quiz[0]->ownerEmail != $userEmail)
			{
				return redirect('/home')->with('error','You are not the owner of the quiz');
			}

			
			// update description of quiz
			DB::table('quizzes')->where(DB::raw('md5(id)'), $request->input('quiz_id'))
											 ->update([
												 'quizName' => $request->input('quizName'),
												 'description' => $request->input('description'),
												 'quiz_duration'=> $request->input('quiz_duration')
											 ]);


			// update questions of quiz
			foreach($request->input('questions') as $id=> $question)
			{
				// dd($question['question']);
				$ans = $option = NULL;
				if(!array_key_exists('question', $question))
				{
					// error
				}
				if(array_key_exists('ans', $question))
				{
					$ans = $question['ans'];
				}
				if(array_key_exists('option', $question))
				{
					$option = json_encode($question['option']);
				}

				DB::table('questions')->where(DB::raw('md5(id)'),$id)
											 ->update([
												 'question' => $question['question'],
												 'correct_answer' => $ans,
												 'options'=> $option
											 ]);
			}

		}
		catch(\Illuminate\Database\QueryException $ex)
		{ 
			return back()->withInput()->withErrors(['err'=> $ex->getMessage()]);
		}

		return redirect('/home')->with('success','Quiz Updated');
	}


}
