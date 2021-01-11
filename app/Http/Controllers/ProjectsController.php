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
//Šīm funkcijām var piekļūt tikai  lietotāji ar lomu darbinieks vai vadītājs
    public function __construct()
    {
         $this->middleware('users_only');
    }

    //Parāda projektu galveno lapu
    public function index()
    {
        $today=Carbon::now()->format('Y-m-d');
        //Visi projekti kuriem pieteikties līdz datums ir pirms esošās dienas
        $projects = Project::orderBy('start_date', 'asc')->where('assign_till','>=',$today)->get();
        $user_id=auth()->user()->id;
        //vadītāju izvediotie projekti
        $my_projects  = Project::orderBy('start_date', 'asc')->where('creator_id',$user_id)->get();
        //projekti kuriem lietotājam ir apstiprināts pieteikums
        $assign_projects=Project::AssignedProjects($user_id);
        return view('project.projectmain')->with(array('projects'=> $projects,'my_projects'=> $my_projects,'assign_projects' => $assign_projects));
       
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
        //* Šai lapai vienīgi var piekļūt vadītājs */
        if (Gate::allows('manager-only')) {
        //Projekta datu validācija
        $validatedData = $request->validate([
            'title' => ['required', 'string','max:50'],
            'Description' => ['required', 'string','max:500'],
            'start_date' => ['required','date', 'after:assign_till','before:end_date'],
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
       return redirect()->back();
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Nosūta uz vienu no projektiem 
    public function show($project_id)
    {
        $today=Carbon::today();
        //atrod noteikto projektu
        $project = Project::findOrFail($project_id);
        //amatus noteiktajam projektam
        $positions = Position::where('project_id',$project_id)->get();
        $user_id=auth()->user()->id;
        //Visu amatu pieteikumus notiektā projektā noteiktajam lietotājam
        $upositions = UserPosition::ProjectsPositions($user_id, $project_id);
         return view('project.pshow')->with(array("project" => $project, "positions" => $positions , "upositions"=>$upositions, 'today'=>$today));
    
    }

    //Pārbauda vai amatam ir izveidots pieteikums
    public static function IfPositionEntry($position_id, $project_id){
        $user_id=auth()->user()->id;
        $upositions = UserPosition::ProjectsPositions($user_id, $project_id);
        foreach($upositions as $uposition){
            if($uposition->position_id == $position_id){
                return false;
            }
        }
        return true;
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Nosuta uz projekta reiģēsanas lapu
    public function edit($project_id)
    {
        $project = Project::findOrFail($project_id);
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
    public function update(Request $request, $project_id)
    {   
        //Atrod izvelēto projektu saglabā izmaiņas
        $project = Project::findOrFail($project_id);
        //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id == $project->creator_id){
        //Projekta datu validacija
        $validatedData = $request->validate([
            'title' => ['required', 'string','max:50'],
            'Description' => ['required', 'string','max:500'],
            'start_date' => ['required','date', 'after:assign_till'],
            'end_date' => ['required','date', 'after:start_date'],
            
        ]);
         
        $project->title = $request->input('title');
        $project->Description = $request->input('Description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->assign_till= $request->input('assign_till');
         $project->save();
         

       return redirect('/projects')->with('success', 'Projekta izmaiņas ir saglabātas');
    }
    return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Projekta dzēšana
    public function destroy($project_id)
    {
        $project = Project::findOrFail($project_id);
        //Parbauda vai lietotajs ir projekta veidotajs
        if(auth()->user()->id == $project->creator_id){
        //iegūst katra amata id
        $position_id = Position::where('project_id',$project_id)->pluck('id')->toArray();
        //atrod katra amata pieteikumu noteiktajam amatam un izdzēš katru
        $upositions= UserPosition::whereIn('position_id', $position_id)->get()->each->delete();
        //atrod katra amatu noteiktajam projektam un izdzēš katru
        $position = Position::where('project_id',$project_id)->get()->each->delete();
        //izdzēš projektu
        $project->delete();
        return redirect('/projects')->with('success', 'Projekts ir izdzēsts');
        }
        return redirect()->back()->with('error', 'Šis nav šī lietotāja veidots projekts');
     }
}
