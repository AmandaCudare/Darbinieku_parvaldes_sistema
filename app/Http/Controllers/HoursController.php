<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Hour;
use App\Project;
use Carbon\Carbon;

class HoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Parāda dienas izdarītā galveno lapu
    public function index()
    {
        //Atļauja tikai darbiniekam un vadītajam
        if (Gate::allows('user-only',Auth::user())) {
            //Izvēlās visus dienas izdarītos ierakstus, ko ir izveidojis sistemā esošais lietotājs
            $user_id= auth()->user()->id;
            $now = Carbon::now();
            $hours= Hour::where('user_id',$user_id)->get();
        return view('hour.hourmain')->with(array('hours'=>$hours));
        }
         // Ja šis nav darbinieks vai vadītajs, lietotāju nosūta uz atpakaļ uz lapu, kura atrodas lietotājs
       return redirect()->back();
    }

    //Parāda nostrādātās nedeļas grafiku
    public function showSchedule()
    {
        if (Gate::allows('user-only',Auth::user())) {
        $week=Carbon::now()->weekOfYear;
        //$week =52;
        $user_id= auth()->user()->id;
        $weeks_hours_with_projects = Hour::WeeksHoursWithProjects($user_id, $week);
        $weeks_hours_without_projects= Hour::WeeksHoursWithoutProjects($user_id, $week);
        //return array('hours_with_projects'=>$weeks_hours_with_projects ,'hours_without_projects'=> $weeks_hours_without_projects);
        return view('hour.schedule')->with(array('hours_with_projects'=>$weeks_hours_with_projects ,'hours_without_projects'=> $weeks_hours_without_projects));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Nosūta lietotāju uz dienas izdarītā ieraksta izveides lapu
    public function create()
    {
        if (Gate::allows('user-only',Auth::user())) {
        $user_id= auth()->user()->id;
        $projects=Project::HourProjects($user_id);
        //$projects = DB::select("SELECT projects.id, projects.title FROM `projects` JOIN `positions` ON projects.id=positions.project_id JOIN `user_positions` ON user_positions.position_id=positions.id JOIN `users` ON user_positions.user_id=users.id WHERE users.id=? AND user_positions.accepted=true GROUP BY projects.id, projects.title, projects.start_date, projects.end_date",[$user_id]);
        return view('hour.create')->with(array('projects' => $projects));
        }
    // Ja šis nav darbinieks vai vadītajs, lietotāju nosūta uz atpakaļ uz lapu kura atrodas lietotājs
  return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Saglabā dienas izdarītā datus
    public function store(Request $request)
    {
        //Validē dienas izdarītā ieraksta datus
        $validatedData = $request->validate([
            'day' => ['required','date'], 
            'description' => ['required', 'string','max:500'],
            'hours' => ['required','numeric','between:1,12'],
        ]);
        
        //Pārveido "Day" string data tipu uz laika datu tipu
        $day=Carbon::parse($day=$request->input('day')) ;
        //Saglabā dienas izdarītā ierakstu datubāzē
        $hours = new Hour;
        $hours->day = $request->input('day');
        $hours->week = $day->week();
        $hours->description = $request->input('description');
        $hours->hours = $request->input('hours');
        $project_id=$request->input('project_id');  
        if($project_id!= 'NULL'){
        $hours->project_id = $project_id;
        }
        $hours->user_id= auth()->user()->id;
         $hours->save();
         

       return redirect('/hour')->with('success', 'Dienas izdarītā ieraksts ir izveidots');
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
    //Nosūtīt uz dienas izdarīta rediģešanas lapu
    public function edit($id)
    {
        //Atrast dienas izdarītā ieraksta dtus
        $hour = Hour::find($id);
        //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id == $hour->user_id){
        $user_id= auth()->user()->id;
        //Esošā dienas izdarītā projekta identifikātors
        $project_id=$hour->project_id;
        //Esošā dienas izdarītā projekta nosaukums
        $project_title=Project::where('id', $project_id)->value('title');
        //Iegūt projektus, kuri nav jau dienas izdarīta ieraksta projekts
        $projects=Project::HourEditProjects($user_id, $project_id);
        //$projects = DB::select("SELECT projects.id, projects.title FROM `projects` JOIN `positions` ON projects.id=positions.project_id JOIN `user_positions` ON user_positions.position_id=positions.id JOIN `users` ON user_positions.user_id=users.id WHERE users.id=? AND user_positions.accepted=true AND projects.id NOT IN(SELECT projects.id FROM `projects` WHERE projects.id=?) GROUP BY projects.id, projects.title, projects.start_date, projects.end_date",[$user_id, $project_id]);
       
        return view('hour.edit')->with(array('projects' => $projects, 'hour'=>$hour, 'project_title' =>$project_title));
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
    //Saglabāt dienas izdarīta ieraksta izmaiņas
    public function update(Request $request, $id)
    {
       //Validē dienas izdarītā ieraksta datus
       $validatedData = $request->validate([
        'day' => ['required','date'], 
        'description' => ['required', 'string','max:500'],
        'hours' => ['required','numeric','between:1,12'],
    ]);
    
    //Pārveido "Day" string data tipu uz laika datu tipu
    $day=Carbon::parse($day=$request->input('day')) ;
    //Saglabā dienas izdarītā ierakstu datubāzē
    $hours = Hour::find($id);
    $hours->day = $request->input('day');
    $hours->week = $day->week();
    $hours->description = $request->input('description');
    $hours->hours = $request->input('hours');
    $project_id=$request->input('project_id');  
    //Ja pieprasījuma datos projekta id nav NULL tad saglabāt projekta id
    if($project_id!= 'NULL'){
    $hours->project_id = $project_id;
    }
    //Ja pieprasījuma datos projekta id ir NULL tad saglabāt pie projekta id NULL
    if($project_id== 'NULL'){
        $hours->project_id = NULL;
        }
    $hours->user_id= auth()->user()->id;
     $hours->save();
     
   return redirect('/hour')->with('success', 'Dienas izdarītā ierakstam izmaiņas ir saglabātas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Atrod dienas izdarīto
        $hour = Hour::find($id);
          //Pārbauda vai lietotājs ir dienas izdarīta ieraksta veidotājs
        if(auth()->user()->id == $hour->user_id){
            //Izdzēš dienas izdarītā ierakstu
           $hour->delete();
         redirect('/hour')->with('error', 'Dienas izdarīta ieraksts ir izdzēsts');
        }
        return redirect()->back();
    }
}
