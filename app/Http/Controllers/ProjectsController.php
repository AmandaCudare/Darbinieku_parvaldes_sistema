<?php

namespace App\Http\Controllers;
use App\Project;
use App\Position;
use App\UserPosition;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //* Šai lapai vienīgi var piekļūt darbinieks un vadītajs */
        if (Gate::allows('user-only')) {
        $projects = Project::all();
       // $my_projects =  Project::orderByDesc(
           //   User::select('id')
             //   ->where('Role', 3)
             //   )->get();
       $creator_id= auth()->user()->id;
      $my_projects  = Project::where('creator_id',$creator_id)->get();
        
        return view('project.projectmain')->with('projects', $projects)->with('my_projects', $my_projects);
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
       //* Šai lapai vienīgi var piekļūt vadītājs */
        if (Gate::allows('manager-only')) {
        return view('project.pcreate');
    }
    return redirect()->back();
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
            'title' => ['required', 'string','max:50'],
            'Description' => ['required', 'string','max:400'],
            'start_date' => ['required','date', 'after:assign_till'],
            'end_date' => ['required','date', 'after:start_date'],
            'assign_till' => ['required', 'date','after:tomorrow' ,'before:start_date'],
        ]);

        $project = new Project;
        $project->title = $request->input('title');
        $project->Description = $request->input('Description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->assign_till= $request->input('assign_till');
        $project->creator_id = auth()->user()->id;
         $project->save();
         

       return redirect('/projects')->with('success', 'Projekts ir izveidots');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        $positions = Position::where('project_id',$id)->get();
        //with('user_positions')->
            $position_id = Position::where('project_id',$id)->pluck('id')->toArray();
        $upositions_id = UserPosition::where('user_id', auth()->user()->id)->pluck('id')->toArray();
         $results = UserPosition::whereIn('position_id', $position_id)->pluck('id')->toArray();
         $result = array_intersect($results, $upositions_id);
        //$upositions = UserPosition::fi(
        $upositions = UserPosition::whereIn('id', $result)->get();
        //
        return view('project.pshow')->with(array("project" => $project, "positions" => $positions , "upositions"=>$upositions));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id == $project->creator_id){
            return view('project.pedit')->with('project',$project);
        }
        return redirect()->back();
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
            'title' => ['required', 'string','max:50'],
            'Description' => ['required', 'string','max:400'],
            'start_date' => ['required','date', 'after:assign_till'],
            'end_date' => ['required','date', 'after:start_date'],
            
        ]);

        $project = Project::find($id);
        $project->title = $request->input('title');
        $project->Description = $request->input('Description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->assign_till= $request->input('assign_till');
         $project->save();
         

       return redirect('/projects')->with('success', 'Projekta izmaiņas ir saglabātas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if(auth()->user()->id == $project->creator_id){
        $position_id = Position::where('project_id',$id)->pluck('id')->toArray();
        $upositions= UserPosition::whereIn('position_id', $position_id)->get()->each->delete();
        $position = Position::where('project_id',$id)->get()->each->delete();
        $project->delete();
        return redirect('/projects')->with('success', 'Projekts ir izdzēsts');
        }
        return redirect()->back();
     }
}
