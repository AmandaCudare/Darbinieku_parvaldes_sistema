<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Startcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Atļauj tikai nereģistrētam lietotajam piekļut šajai lapai
    public function __construct()
    {
         $this->middleware('guest');
        
    }
    //pārāda sākuma lapu nereģistrētam lietotājam
    public function index()
    {
        return view('start');
    }

}