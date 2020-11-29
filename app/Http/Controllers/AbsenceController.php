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

    //Parāda prombutnes galveno lapu
    public function index()
    {
        //Atļauja tikai darbiniekam un vadītajam
        if (Gate::allows('user-only',Auth::user())) {
            //Izvēlās visus prombūtnes pieteikumus ko ir izveidojis sistemā esošais lietotājs
             $user_id= auth()->user()->id;
             $absence = Absence::where('user_id',$user_id)->get();
            return view('absence.show')->with('absences', $absence);
            }
            // Ja šis nav darbinieks vai vadītajs, lietotāju nosūta uz atpakaļ uz lapu kura atrodas lietotājs
            return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Nosūta uz prombutnes izveides lapu
    public function create()
    {
        //Atļauja tikai darbiniekam un vadītajam
        if (Gate::allows('user-only',Auth::user())) {
            return view('absence.create');
            }
     // Ja šis nav darbinieks vai vadītajs lietotāju nosūta uz atpakaļ uz lapu kura atrodas lietotājs
           return redirect()->back();
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
        //Iegūsts datumu 2 nedēļas pēc šodienas
       $two_weeks=Carbon::now()->addWeeks(2)->format('d-m-Y');
       //Iegūtos datu validācija
        $validatedData = $request->validate([
            'reason' => ['required', 'string','max:50'],
            'start_date' => ['required','date','before:end_date','after:'.$two_weeks, ],
            'end_date' => ['required','date', 'after:start_date'],
        ]);
        //Prombutnes pieteikuma izveide datu bāzē
        $absence = new Absence;
        $absence->reason = $request->input('reason');
        $absence->start_date = $request->input('start_date');
        $absence->end_date = $request->input('end_date');
        $absence->accepted= false;
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
        return redirect()->back();
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
        $two_week=Carbon::now()->addWeeks(2)->format('Y-m-d');
        $absence = Absence::find($id);
        //pārbauda vai lietotājs ir prombūtnes pieteikuma viedotajs
        if(auth()->user()->id == $absence->user_id ){
            //Pārbaude vai prombūtnes pieteikuma sakuma datums ir vairak kā pec 2 nedeļām
         if($absence->start_date > $two_week){
          return view('absence.edit')->with('absence',$absence);
         }
         return redirect()->back()->with('error', 'Pieteikumu var rediģēt, ja sākuma datums ir vismaz pirms 2 nedēļām');;
        }
        return redirect()->back()->with('error', 'Šis lietotājs nav veidojis so pieteikumu');
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
         //Iegūstam datumu 2 nedēļas pēc šodienas
       $two_weeks=Carbon::now()->addWeeks(2)->format('d-m-Y');
        $validatedData = $request->validate([
            'reason' => ['required', 'string','max:50'],
            'start_date' => ['required','date','before:end_date','after:'.$two_weeks, ],
            'end_date' => ['required','date', 'after:start_date'],
        ]);
        //Atjauninati Prombutnes pieteikuma dati
        $absence = Absence::find($id);
        $absence->reason = $request->input('reason');
        $absence->start_date = $request->input('start_date');
        $absence->end_date = $request->input('end_date');
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
        $absence = Absence::find($id);
        //pārbauda vai lietotājs ir prombūtnes pieteikuma viedotajs
        if(auth()->user()->id == $absence->user_id){
            //Izdzēš prombūtnes pieteikumu
           $absence->delete();
         redirect('/absence')->with('success', 'Prombūtnes pieteikums ir izdzēsts');
        }
        return redirect()->back();
    }
}
