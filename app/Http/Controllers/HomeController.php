<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //Šīm lapam var piekļut tikai autenficējusies lietotāji
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    //Parāda profila lapu
    public function index()
    {
        $user_id= auth()->user()->id;
        $user= User::find($user_id);
       return view('profile')->with('user', $user);
    }
}
