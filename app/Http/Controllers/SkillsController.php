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
    public function index()
    {
        if (Gate::allows('user-only')) {
            $user_id= auth()->user()->id;
            $skills = Skill::where('user_id',$user_id)->get();
   return view('skills.skillmain')->with('skills', $skills);
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function create()
     {
        return redirect('/skills');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:50'],
        ]);

        $skill = new Skill;
        $skill->name = $request->input('name');
        $skill->user_id = auth()->user()->id;
         $skill->save();
         

       return redirect('/skills')->with('success', 'Prasme ir pievienota');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $skill = Skill::find($id); 
        if(auth()->user()->id == $skill->user_id ){
          return view('skills.edit')->with('skill',$skill);
         }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:50'],
        ]);

        $skill = Skill::find($id);
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
    public function destroy($id)
    {
        $skill = Skill::find($id);
        if(auth()->user()->id == $skill->user_id){
           $skill->delete();
         redirect('/skills')->with('success', 'Prasme ir izdzēsta');
        }
        return redirect()->back();
    
    }
}
