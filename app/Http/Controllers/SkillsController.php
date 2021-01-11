<?php

namespace App\Http\Controllers;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//Šīm funkcijām var piekļūt tikai  lietotāji ar lomu darbinieks vai vadītājs
    public function __construct()
    {
         $this->middleware('users_only');
    }

    //Nosūta uz galveno prasmju lapu
    public function index()
    {
         //Izvēlās visus prasmes ko ir izveidojis sistemā esošais lietotājs
            $user_id= auth()->user()->id;
            $skills = Skill::where('user_id',$user_id)->get();
   return view('skills.skillmain')->with('skills', $skills);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Saglabā izveidoto prasmi
    public function store(Request $request)
    {
        //Valide prasmes datus
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:100'],
        ]);
            //Saglabā prasmju datu datubāzē
        $skill = new Skill;
        $skill->name = $request->input('name');
        $skill->user_id = auth()->user()->id;
         $skill->save();
         
       return redirect('/skills')->with('success', 'Prasme ir pievienota');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Nosūta uz rediģēšanas lapu
    public function edit($id)
    {
        $skill = Skill::findOrFail($id); 
        //Pārbauda vai lietotājs ir prasmes veidotajs
        if(auth()->user()->id == $skill->user_id ){
          return view('skills.edit')->with('skill',$skill);
         }
         return redirect()->back()->with('error', 'Lietotājs šo prasmi nedrīkst rediģēt');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Saglaba prasmes izmaiņas
    public function update(Request $request, $id)
    {
        //Validacija
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:100'],
        ]);
        //atrod prasmi 
        $skill = Skill::findOrFail($id);
        //atjaunina informāciju
        $skill->name = $request->input('name');
        $skill->save();
         
       return redirect('/skills')->with('success', 'Prasme ir atjaunināta');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Izdzēš prasmi
    public function destroy($id)
    {
        //atrod prasmi
        $skill = Skill::findOrFail($id);
          //Pārbauda vai lietotājs ir prasmes veidotajs
        if(auth()->user()->id == $skill->user_id){
            //Izdzēš prasmi
           $skill->delete();
        return redirect('/skills')->with('success', 'Prasme ir izdzēsta');
        }
        return redirect()->back()->with('error', 'Lietotājs šo prasmi nedrīkst dzēst');
    
    }
}
