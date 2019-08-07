<?php

// use Illuminate\Support\Facades\DB;
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
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
     * Show the application home page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

			// $ownerEmail = Auth::user()->email;
			// $quizzes = DB::table('quizzes')->select(
			// 	DB::raw('md5(id) as id, quizName, quiz_duration, access, description, date(created_at) as created_at')
			// )->where('ownerEmail', $ownerEmail)->get();

			// return view('home', ['quizzes' => $quizzes]);
			return view('home');
		}
}

