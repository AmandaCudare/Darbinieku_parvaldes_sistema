<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Absence;
use Carbon\Carbon;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    //Šīm funkcijām var piekļūt tikai  lietotāji ar lomu darbinieks vai vadītājs
    public function __construct()
    {
         $this->middleware('users_only');
    }

    //Parāda prombutnes galveno lapu
    public function index()
    {
            //Izvēlās visus prombūtnes pieteikumus ko ir izveidojis sistemā esošais lietotājs
             $user_id= auth()->user()->id;
             $absence = Absence::orderBy('start_date', 'asc')->where('user_id',$user_id)->get();
             //šodienas datums
             $today=Carbon::now()->format('Y-m-d');
            return view('absence.show')->with(array('absences'=> $absence, 'today'=>$today));
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Nosūta uz prombutnes izveides lapu
    public function create()
    {
            return view('absence.create');
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //Saglabā prombūtnes pieteikumu
    public function store(Request $request)
    {
        
       //Iegūtos datu validācija
        $validatedData = $request->validate([
            'reason' => ['required', 'string','max:100'],
            'start_date' => ['required','date','before:end_date','after:yesterday', ],
            'end_date' => ['required','date', 'after:start_date'],
        ]);
        //Prombutnes pieteikuma izveide datu bāzē
        $absence = new Absence;
        $absence->reason = $request->input('reason');
        $absence->start_date = $request->input('start_date');
        $absence->end_date = $request->input('end_date');
        $absence->user_id = auth()->user()->id;
        $absence->save();
         

       return redirect('/absence')->with('success', 'Prombūtnes pieteikums ir izveidots');
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

    //Nosūta uz prombūtnes pieteikuma rediģesanas lapu
    public function edit($id)
    {  
        $today=Carbon::now()->format('Y-m-d');
        $absence = Absence::findOrFail($id);
        //pārbauda vai lietotājs ir prombūtnes pieteikuma viedotajs
        if(auth()->user()->id == $absence->user_id ){
            //Pārbaude vai prombūtnes pieteikuma beigu datums ir pirms sodienas
         if($absence->end_date >= $today){
          return view('absence.edit')->with('absence',$absence);
         }
         return redirect()->back()->with('error', 'Pieteikumu nedrīkst rediģēt pēc beigu datuma');
        }
        return redirect()->back()->with('error', 'Šis lietotājs nav veidojis šo pieteikumu');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Saglabā prombutnes pieteikuma izmaiņas
    public function update(Request $request, $id)
    {
         //Iegūstam datumu pirms izmaiņam sakuma datuma
       $date= Absence::where('id', $id)->value('start_date');
       $day_before=Carbon::parse($date);
       $day_before->subDay();
       //Validācija
        $validatedData = $request->validate([
            'reason' => ['required', 'string','max:100'],
            'start_date' => ['required','date','before:end_date','after:'.$day_before, ],
            'end_date' => ['required','date', 'after:start_date'],
        ]);
        //Atjauninati Prombutnes pieteikuma dati
         $absence = Absence::findOrFail($id);
        $absence->reason = $request->input('reason');
        $absence->start_date = $request->input('start_date');
        $absence->end_date = $request->input('end_date');
        $absence->accepted = NULL;
        $absence->save();
         
       return redirect('/absence')->with('success', 'Prombūtnes pieteikums ir atjaunināts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Izdzēš izvēlēto prombūtnes pieteikumu
    public function destroy($id)
    {
        //Atrod izvēleto prombutnes pieteikumu
        $absence = Absence::findOrFail($id);
        
        $today=Carbon::now()->format('Y-m-d');
       //pārbauda vai lietotājs ir prombūtnes pieteikuma viedotajs 
       if(auth()->user()->id == $absence->user_id){
          if($absence->accepted != true || $absence->start_date>$today){   
              //Izdzēš prombūtnes pieteikumu
           $absence->delete();
         return redirect('/absence')->with('error', 'Prombūtnes pieteikums ir izdzēsts');
        }
        return redirect('/absence')->with('error', 'Prombūtnes pieteikums nedrīkst dzēst');
        }
        return redirect()->back();
    }
}
