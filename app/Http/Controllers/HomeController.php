<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
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
    //Paroles maiņas funkcija
    public function PasswordChange()
    {
        return view('password_change');
        
    }
    //Paroles maiņas saglabāšana
    public function PasswordUpdate(Request $request)
    {
        //Validacija
        $validatedData = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        //atrod lietotāju
        $id=auth()->user()->id;
        $user = User::find($id);
        $new_password=$request->input('password');
        if(Hash::check($new_password, $user->password)){
 
            return back()->with('error','Lūdzu neizmantojiet esošo paroli');
    
       }else{
        
        //atjaunina informāciju un sifrē paroles informāciju
        $user->password = Hash::make($request->input('password'));
        $user->save();
         
       return redirect('/profile')->with('success', 'Parole ir atjaunināta');
       }
    }

}
