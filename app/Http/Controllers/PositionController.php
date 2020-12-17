<?php

namespace App\Http\Controllers;
use App\Position;
use App\UserPosition;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        /*if (Gate::allows('user-only')) {
            
            return view('project.position_create')->with('project_id', $id);
            }
            return redirect()->back();*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
       /* if (Gate::allows('manager-only')) {
            
            return view('project.position_create')->with('project_id', $id);
            }
            return redirect()->back();*/
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Saglabā izveidotā amata datus
    public function store(Request $request)
    {
        //Validācija
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:50'],
            'people_count' => ['required', 'numeric', 'gt:0'],
            ]);
        //Saglabā amata datus datubazē
        $position = new Position;
        $position->name = $request->input('name');
        $position->people_count = $request->input('people_count');
        $position->project_id = $request->input('project_id');
        $position->save();
        return redirect()->back();
     }

     //Saglabā amata pieteikumu
     public function store_userposition(Request $request)
     {
         $position = new UserPosition;
         $position->assigned = true;
         $position->user_id = auth()->user()->id;
         $position->position_id = $request->input('position_id');
         $position->save();
         return back();
      }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //tiek iegūta amata nosaukumus, lietotaja vārds, uzvārds, epasts, identifikātors un pieteikuma identifikators, ja pieteikušais lietotajs sakrīt ar pieteikumu, pieteikums sakrīt ar amatu un amats ar projektu.
        $positions=Position::ShowPositions($id);
       // $positions = DB::select("SELECT positions.name,users.First_name, users.Last_name, users.email, users.id as user_id, user_positions.id as uposition_id FROM `user_positions`JOIN `positions` ON user_positions.position_id=positions.id JOIN `projects` ON projects.id=positions.project_id JOIN `users` ON user_positions.user_id=users.id WHERE projects.id=? AND user_positions.accepted IS NULL GROUP BY user_positions.id, positions.name, users.id, users.First_name, users.Last_name, users.email",[$id]);       
        return view('project.accept')->with(array('positions'=> $positions));
    }

    public function accept_userposition($id)
    {
        //iegūts pieteikuma amata id
        $position= UserPosition::where('id', $id)->value('position_id');
        //ieguts pieteikumu skaits, kas atbilst amatam un kuri ir apstiprināti
        $assigned_count = Position::AssignCount($position);
        //$assigned_count = DB::select("SELECT user_positions.id FROM `positions` JOIN `user_positions` ON user_positions.position_id=positions.id WHERE user_positions.accepted=true AND positions.id=?",[$position]);
       //iegūta amata vajadzīgo cilveku skaitu
        $count_pos=Position::where('id', $position)->value('people_count');
        //tiek saskaitīt cik ir jau apstiprinati amatam
        $number = collect($assigned_count)->count();
        //pārbauda vai apstiprināto skaits ir mazāks par vajadzīgais cilveku skaitu
        if($count_pos>$number){
           //notiekto pieteikumu aptiprina
        $uposition = UserPosition::find($id);
        $uposition->accepted = true;
        $uposition->save();
        return back()->with('success', 'Apstiprināts');
        //ja nav tad tiek nosūtīt paziņojums ka nevar apstiprināt
        }else{
            return back()->with('error', 'Pieņemto skaits ir pietiekams');
        }
     }

     public function decline_userposition($id)
     {
         //pieteikums noraida
         $uposition = UserPosition::find($id);
         $uposition->accepted = false;
         $uposition->save();
         return back()->with('error', 'Lietotāja pieteikums ir noraidīts');;
      }

      public function user($id)
      {
          //atrod lietotāju kas pieteicie amatam
          $user= User::find($id);
          return view('project.user')->with(array('user'=> $user));
       }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project_id = Position::where('id',$id)->pluck('project_id');
        $project=Project::where('id',$project_id)->pluck('creator_id')->sum();
        $position=Position::find($id);
    //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id ==$project){
            return view('project.position_edit')->with('position', $position);
        }
        return redirect()->back()->with('error', 'Lietotājs nedrīkst rediģet amatu');
       
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
        //Validācija
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:50'],
            'people_count' => ['required', 'numeric', 'gt:0'],
            ]);
        //Saglabā izmaiņas amata datus datubazē
        $position = Position::find($id);
        $position->name = $request->input('name');
        $position->people_count = $request->input('people_count');
        $position->save();
        $project_id=Project::where('id', $position->project_id)->pluck('id')->sum();
         return redirect('/projects/'.$project_id)->with('success', 'Amats atjaunināts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Izdzēst amatu
    public function destroyPosition($id)
    {
        //atrast amata projektu
        $project_id = Position::where('id',$id)->pluck('project_id');
        $project=Project::where('id',$project_id)->pluck('creator_id')->sum();
    //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id ==$project){
        $position=Position::find($id);
        $user_id= auth()->user()->id;
        //izdzēst amata pieteikumus
        $uposition= UserPosition::where('position_id', $id)->get()->each->delete();
        //izdzēst amatu
        $position->delete();
        return redirect()->back()->with('success', 'Amats izdzēsts');
    }
    return redirect()->back()->with('error', 'Lietotājs nedrīkst dzēst so amatu');
    }
    //Amata pieteikuma noņemšana
    public function destroy_UserPosition($id)
    {
        $user_id= auth()->user()->id;
        $uposition= UserPosition::where('position_id', $id)->where('user_id', $user_id)->get()->each->delete();
        return redirect()->back()->with('success', 'Pieteikums noņemts');
        
    }
}
