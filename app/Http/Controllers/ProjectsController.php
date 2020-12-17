<?php

namespace App\Http\Controllers;
use App\Project;
use App\Position;
use App\UserPosition;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Parāda projektu galveno lapu
    public function index()
    {
        // Šai lapai vienīgi var piekļūt darbinieks un vadītajs
        if (Gate::allows('user-only')) {
        $today=Carbon::now()->format('Y-m-d');
        $projects = Project::orderBy('start_date', 'asc')->where('assign_till','>=',$today)->get();
        $user_id=auth()->user()->id;
        $my_projects  = Project::orderBy('start_date', 'asc')->where('creator_id',$user_id)->get();
        //$assign_projects= DB::select("SELECT projects.title, projects.start_date, projects.end_date, projects.assign_till, projects.id FROM `projects` JOIN `positions` ON projects.id=positions.project_id JOIN `user_positions` ON user_positions.position_id=positions.id JOIN `users` ON user_positions.user_id=users.id WHERE users.id=? AND user_positions.accepted='1' GROUP BY projects.title, projects.start_date ASC, projects.end_date, projects.assign_till, projects.id",[$user_id]);
        $assign_projects=Project::AssignedProjects($user_id);
        //return array('projects'=> $projects,'my_projects'=> $my_projects,'assign_projects' => $assign_projects);
        return view('project.projectmain')->with(array('projects'=> $projects,'my_projects'=> $my_projects,'assign_projects' => $assign_projects));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Nosuta uz projekt izveides lapu
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
    //Saglabā izveidotā projekta datus
    public function store(Request $request)
    {
        //Projekta datu validācija
        $validatedData = $request->validate([
            'title' => ['required', 'string','max:50'],
            'Description' => ['required', 'string','max:500'],
            'start_date' => ['required','date', 'after:assign_till'],
            'end_date' => ['required','date', 'after:start_date'],
            'assign_till' => ['required', 'date','after:tomorrow' ,'before:start_date'],
        ]);
            //Projekta saglabāšana datubāzē
        $project = new Project;
        $project->title = $request->input('title');
        $project->Description = $request->input('Description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->assign_till= $request->input('assign_till');
        $project->creator_id = auth()->user()->id;
         $project->save();
         

       return redirect('/projects')->with('success', 'Projekts ir izveidots');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Nosūta uz vienu no projektiem 
    public function show($id)
    {
        $today=Carbon::today();
        $project = Project::find($id);
        $positions = Position::where('project_id',$id)->get();
        //with('user_positions')->
            $position_id = Position::where('project_id',$id)->pluck('id')->toArray();
        $upositions_id = UserPosition::where('user_id', auth()->user()->id)->pluck('id')->toArray();
         $results = UserPosition::whereIn('position_id', $position_id)->pluck('id')->toArray();
         $result = array_intersect($results, $upositions_id);
        //$upositions = UserPosition::fi(
        $upositions = UserPosition::whereIn('id', $result)->get();
        //return array("project" => $project, "positions" => $positions , "upositions"=>$upositions, 'today'=>$today);
        return view('project.pshow')->with(array("project" => $project, "positions" => $positions , "upositions"=>$upositions, 'today'=>$today));
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Nosuta uz projekta reiģēsanas lapu
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
    //Saglabā projekta veiktas izmaiņas
    public function update(Request $request, $id)
    {
        //Projekta datu validacija
        $validatedData = $request->validate([
            'title' => ['required', 'string','max:50'],
            'Description' => ['required', 'string','max:500'],
            'start_date' => ['required','date', 'after:assign_till'],
            'end_date' => ['required','date', 'after:start_date'],
            
        ]);
            //Atrod izvelēto projektu saglabā izmaiņas
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
    //Projekta dzēšana
    public function destroy($id)
    {
        $project = Project::find($id);
        //Parbauda vai lietotajs ir projekta veidotajs
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
