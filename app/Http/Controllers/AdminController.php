<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Absence;
use App\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('admin-only')) {
           
        return view ('admin.admin');
        }
     
        return redirect()->back();
    }

    public function showUsers()
    {
        if (Gate::allows('admin-only')) {
            $users = User::where('Active', true)->get();
        return view ('admin.users')->with(array('users' => $users));
        }
     
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showAbsence()
    {
        if (Gate::allows('admin-only')) {
           $absences = Absence::where('accepted', false)->with('user')->get();
            //return array('absences' => $absences);
           return view ('admin.absence')->with(array('absences' => $absences));
            }
         
            return redirect()->back();
    }

    public function updateAbsence($id)
    {
        if (Gate::allows('admin-only')) {
           $absences = Absence::find($id);
           $absences->accepted = true;
           $absences->save();
           return redirect('admin/absence')->with('success', 'Prombūtnes pieteikums ir apstiprināta');
            }
         
            return redirect()->back();
    }

    public function declineAbsence($id)
    {
        if (Gate::allows('admin-only')) {
           $absences = Absence::find($id);
           $absences->accepted = false;
           $absences->save();
           return redirect('admin/absence')->with('danger', 'Prombūtnes pieteikums noraidīts');
            }
         
            return redirect()->back();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
