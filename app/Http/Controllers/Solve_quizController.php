<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;
use App\Quiz_answer;
use Auth;

use DB;

class Solve_quizController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}


	/*
	 * return list with all the availables quizzes
   * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{

		try
		{
			$quizzes = DB::table('quizzes')->select(
				DB::raw('md5(id) as id, quizName, quiz_duration, access, description, date(created_at) as created_at')
			)->where('access', 'public')->orderBy('created_at', 'desc')->get();
		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return redirect('/home')->with('error', $ex->getMessage());
		}

		return view('browse_quizzes', ['available_quizzes'=> $quizzes]);
	}


	/*
	 * display a specific quiz, to be solved
   * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function show($id)
	{
		try
		{
			$quiz = DB::table('quizzes')->select(
				DB::raw('md5(id) as id, quizName, quiz_duration, access, description')
			)->where(DB::raw('md5(id)'), $id)->first();

			// ToDo -> check access variable. If acces not public redirect with error message
			$questions = DB::table('questions')->select(
				DB::raw('md5(id) as id, question, type, options')
			)->where(DB::raw('md5(target_quiz)'), $id)->get();
		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return redirect('/home')->with('error', $ex->getMessage());
		}

		return view('solve_quiz', ['quiz'=> $quiz, 'questions'=> $questions]);
	}


	/*
	 *	calculate the score for a submited quiz
	 */
	public function store(Request $request)
	{
		// dd($gcrequest->request->parameters);
		$quiz_id = $request->input('quiz_id');

		try
		{

			// check if user has writes to submit the quiz
			$quiz = DB::table('quizzes')->select('id', 'access', 'quizName')
																	->where(DB::raw('md5(id)'), $quiz_id)->first();
			if($quiz->access == 'invitation')
			{
				return redirect('/home')->withErrors(['error'=> 'You do not hae access to this quiz']);
			}

			// check if the answers belong to the question

			// calculate the correct answers
			$correct_answer_counter = 0;
			$total_questions = 0;
			$to_be_answer_question = 0;

			$toStoreData = array();

			foreach($request->input('answers') as $key=> $ans)
			{
				$question = DB::table('questions')->select('type', 'correct_answer', 'question')
																	->where(DB::raw('md5(id)'), $key)->first();

				if($question->type == 'Single Line' || $question->type == 'Radio buttons')
				{
					if( strtoupper($ans) == strtoupper($question->correct_answer) )
					{
						$correct_answer_counter++;
					}
				}
				else
				{
					$to_be_answer_question++;
				}
				$total_questions++;

				if(Auth::check())
				{
					array_push($toStoreData, [$question->question, $ans, $question->correct_answer]);
				}

			}

			// store the results
			if(Auth::check())
			{
				$userEmail = Auth::user()->email;

				$answer = new Result();
				$answer->user_email = $userEmail; 
				$answer->target_quiz = $quiz->id; 
				$answer->score = "$correct_answer_counter /".($total_questions - $to_be_answer_question); 
				$answer->save();

				// dd($toStoreData[1][0]);
				for($i=0; $i <count($toStoreData); $i++)
				{
					$quiz_answer = new Quiz_answer();
					$quiz_answer->quiz_id = $quiz->id;
					$quiz_answer->result_id = $answer->id;
					$quiz_answer->question = $toStoreData[$i][0];
					$quiz_answer->answer = $toStoreData[$i][1];
					$quiz_answer->correct_answer = isset($toStoreData[$i][2])? $toStoreData[$i][2]: '';
					$quiz_answer->save();
				}

			}

	
			// $score = $correct_answer_counter/count($request->input('answers'));
			// dd($score);
			// return redirect()->route('show_results', [])
			return view('show_results', [
				'correct'=> $correct_answer_counter,
				'total'=> $total_questions,
				'to_be_answer'=> $to_be_answer_question,
				'title'=> $quiz->quizName]
			);
		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return back()->withInput()->withErrors(['err'=> $ex->getMessage()]);
		}

	}

	/*
	 * list of all the quizzes for a specific user
	 */
	public function result()
	{


		if(Auth::check() == FALSE)
		{
			return redirect('/')->with('error', 'You need to login to access this page');
		}	

		$owner_email = Auth::user()->email;

		try
		{
			$results= DB::table('results')
				->join('quizzes', 'quizzes.id', '=', 'results.target_quiz')
				->select('quizzes.quizName', 'quizzes.description', 'results.created_at', 'results.score')
				->where('results.user_email', $owner_email)
				->orderBy('results.created_at', 'desc')->get();

		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return redirect('/home')->with('error', $ex->getMessage());
		}

		return view('show_results_of_a_user', ['results'=> $results]);
	}


	/*
	 * return the stats for a specific quiz. Only the owner of the quiz has access to this info
	 */
	public function quiz_result($id)
	{
		// check if user is  logedin
		if(Auth::check() == FALSE)
		{
			return redirect('/')->with('error', 'You need to login to access this page');
		}	

		// check if user owns the quiz
		$owner_email = Auth::user()->email;
		try{

			$results = DB::table('results')
				->join('quizzes', 'quizzes.id', '=', 'results.target_quiz')
				->select(DB::raw('md5(results.id) as id, quizzes.quizName, quizzes.description, results.created_at, results.score, results.user_email'))
				->where('quizzes.ownerEmail', $owner_email)
				->where(DB::raw('md5(results.target_quiz)'), $id)
				->orderBy('results.created_at', 'desc')->get();

			$answers = DB::table('quiz_answers')
			 	->select(DB::raw('md5(result_id) as res_id, question, answer, correct_answer'))
				->where(DB::raw('md5(quiz_id)'), $id)->get();	
		}
		catch(\Illuminate\Database\QueryException $ex){ 
			return redirect('/home')->with('error', $ex->getMessage());
		}

		// dd($answers);
		// return the statistics
		return view('show_results_of_a_quiz', ['results'=> $results, 'answers'=> $answers]);

	}


}
