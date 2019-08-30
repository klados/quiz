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
			// return view('home', ['quizzes' => $quizzes]);
			return view('home');
		}
}

