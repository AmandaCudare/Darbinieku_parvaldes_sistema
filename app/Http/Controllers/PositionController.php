<?php

namespace App\Http\Controllers;
use App\Position;
use App\UserPosition;
use App\Project;
use App\User;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PositionController extends Controller
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
            'name' => ['required', 'string','max:100'],
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
    //projekta amata
    public function show($id)
    {
        $creator_id=Project::where('id', $id)->value('creator_id');
        if(auth()->user()->id == $creator_id){
        //tiek iegūta amata nosaukumus, lietotaja vārds, uzvārds, epasts, identifikātors un pieteikuma identifikators, ja pieteikušais lietotajs sakrīt ar pieteikumu, pieteikums sakrīt ar amatu un amats ar projektu.
        $positions=Position::ShowPositions($id);
        return view('project.accept')->with(array('positions'=> $positions, 'project_id'=> $id));
        }
        return redirect()->back()->with('error', 'Nedrīkst piekļūt šai funckijai esošais lietotājs');
    }

        //Iegūt apstiprināto cilvēku skaits
        public static function ActualPeopleCount($position_id){
            $assigned_count = Position::AssignCount($position_id);
            $actual_count = collect($assigned_count)->count();
            return $actual_count;
            }

    //vadītājs ar so funckiju apstiprina lietotāja amata pieteikumu
    public function accept_userposition($userposition_id)
    {
        //iegūts pieteikuma amata id
        $position_id= UserPosition::where('id', $userposition_id)->value('position_id');
        //ieguts pieteikumu skaits, kas atbilst amatam un kuri ir apstiprināti
        $assigned_count = Position::AssignCount($position_id);
        //iegūta amata vajadzīgo cilveku skaitu
        $count_pos=Position::where('id', $position_id)->value('people_count');
        $project_id=Position::where('id', $position_id)->value('project_id');
        $creator_id=Project::where('id', $project_id)->value('creator_id');
        if(auth()->user()->id == $creator_id){
        //tiek saskaitīt cik ir jau apstiprinati amatam
        $number = collect($assigned_count)->count();
        //pārbauda vai apstiprināto skaits ir mazāks par vajadzīgais cilveku skaitu
        if($count_pos>$number){
           //notiekto pieteikumu aptiprina
        $uposition = UserPosition::find($userposition_id);
        $uposition->accepted = true;
        $uposition->save();
        return back()->with('success', 'Apstiprināts');
        //ja nav tad tiek nosūtīt paziņojums ka nevar apstiprināt
        }else{
            return back()->with('error', 'Pieņemto skaits ir pietiekams');
        }
        }
    return redirect()->back();
     }
    //vadītājs ar so funckiju noraida lietotāja amata pieteikumu
     public function decline_userposition($id)
     {
          //iegūts pieteikuma amata id
        $position_id= UserPosition::where('id', $id)->value('position_id');
         $project_id=Position::where('id', $position_id)->value('project_id');
        $creator_id=Project::where('id', $project_id)->value('creator_id');
        if(auth()->user()->id == $creator_id){
         //pieteikums noraida
         $uposition = UserPosition::find($id);
         $uposition->accepted = false;
         $uposition->save();
         return back()->with('error', 'Lietotāja pieteikums ir noraidīts');
        }
        return redirect()->back();
      }

      //vadītājs ar šo var piekļūt pieteikušās lietotāja informācijai
      public function user($id)
      {
          //tikai vadītāji drīkst piekļūt šajai lapai
        if (Gate::allows('manager-only')) {
          //atrod lietotāju kas pieteicies amatam
          $user= User::find($id);
          $skills=Skill::where('user_id', $id)->get();
          return view('project.user')->with(array('user'=> $user, 'skills'=>$skills));
        }
        return redirect()->back();

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
        $creator_id=Project::where('id',$project_id)->value('creator_id');
        $position=Position::find($id);
    //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id ==$creator_id){
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
        $project_id=Position::where('id', $id)->value('project_id');
       $creator_id=Project::where('id', $project_id)->value('creator_id');
       if(auth()->user()->id == $creator_id){
        //Validācija
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:100'],
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
        return redirect()->back()->with('error', 'Lietotājs nedrīkst rediģet amatu');
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
        $creator_id=Project::where('id',$project_id)->pluck('creator_id')->sum();
    //Pārbaudīt vai pareizā vadītāja projekts
        if(auth()->user()->id ==$creator_id){
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
