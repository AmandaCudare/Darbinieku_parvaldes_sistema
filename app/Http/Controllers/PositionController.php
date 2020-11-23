<?php

namespace App\Http\Controllers;
use App\Position;
use App\UserPosition;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string','max:50'],
            'people_count' => ['required', 'numeric'],
            ]);

        $position = new Position;
        $position->name = $request->input('name');
        $position->people_count = $request->input('people_count');
        $position->project_id = $request->input('project_id');
        $position->save();
        return back();
     }


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
