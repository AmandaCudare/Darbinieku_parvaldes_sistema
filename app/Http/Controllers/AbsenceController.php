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
     */
    public function index()
    {
        if (Gate::allows('user-only',Auth::user())) {
             $user_id= auth()->user()->id;
             $absence = Absence::where('user_id',$user_id)->get();
            return view('absence.show')->with('absences', $absence);
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
        if (Gate::allows('user-only',Auth::user())) {
            return view('absence.create');
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
       $two_weeks=Carbon::now()->addWeeks(2)->format('d-m-Y');
        $validatedData = $request->validate([
            'reason' => ['required', 'string','max:50'],
            'start_date' => ['required','date','before:end_date','after:'.$two_weeks, ],
            'end_date' => ['required','date', 'after:start_date'],
        ]);

        $absence = new Absence;
        $absence->reason = $request->input('reason');
        $absence->start_date = $request->input('start_date');
        $absence->end_date = $request->input('end_date');
        $absence->accepted= false;
        $absence->user_id = auth()->user()->id;
        $absence->save();
         

       return redirect('/absence');
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
