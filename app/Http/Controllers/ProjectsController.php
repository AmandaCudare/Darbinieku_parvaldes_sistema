<?php

namespace App\Http\Controllers;
use App\Project;
use App\Position;
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
        if (Gate::allows('user-only')) {
        $projects = Project::all();
        return view('project.projectmain')->with('projects', $projects);
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
        return view('project.pcreate');
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
            'Description' => ['required', 'string','max:250'],
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
         
        /*$position = new Position;
        $position->name = $request->input('name');
        $position->project_id = $project->id;
        $position->assigned = false;
        $position->accepted = false;
        $position->save;*/

       return redirect('/projects');
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
        return view('project.pshow')->with('project',$project)->with('positions',$positions);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
