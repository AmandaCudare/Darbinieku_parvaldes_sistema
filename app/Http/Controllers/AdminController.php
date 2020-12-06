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
    //Parāda administratora paneļa lapu
    public function index()
    {
        //atļauj tikai administratoriem
        if (Gate::allows('admin-only')) {
           
        return view ('admin.admin');
        }
     // Ja šis nav administrators, lietotāju nosūta uz atpakaļ uz lapu kura atrodas lietotājs
         return redirect()->back();
    }
    // parāda aktivu lietotāju lapu
    public function showUsers()
    {
        //atļauj tikai administratoriem
        if (Gate::allows('admin-only')) {
            //Atrod aktīvus lietotājus
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
    //Parāda prombutnes pieteikumu lapu
    public function showAbsence()
    {
        //atļauj tikai administratoriem
        if (Gate::allows('admin-only')) {
           $absences = Absence::where('accepted', null)->with('user')->get();
           return view ('admin.absence')->with(array('absences' => $absences));
            }
         
            return redirect()->back();
    }
    //Prombutnes aptiprināšanas funkcija
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
    //Prombutnes noraidīšanas funkcija
    public function declineAbsence($id)
    {
        if (Gate::allows('admin-only')) {
           $absences = Absence::find($id);
           $absences->accepted = false;
           $absences->save();
           return redirect('admin/absence')->with('error', 'Prombūtnes pieteikums noraidīts');
            }
         
            return redirect()->back();
    }

    //lietotaja datu rediģēšanas lapa
    public function editUser($id)
    {
          //atļauj tikai administratoriem
          if (Gate::allows('admin-only')) {
            //Atrod aktīvus lietotājus
            $user = User::find($id);
        return view ('admin.user_edit')->with('user', $user);
        }
    }
    //lietotaja informācijas izmaiņu saglabāšana
    public function updateUser(Request $request, $id)
    {
          //atļauj tikai administratoriem
          if (Gate::allows('admin-only')) {
             //Lietotāja datu validacija
        $validatedData = $request->validate([
            'First_name' => ['required', 'string', 'max:50'],
            'Last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'Role' => ['required', 'max:2'],
            'Workload' => ['required'],
            
        ]);
            //Atrod izvelēto projektu saglabā izmaiņas
        $user = User::find($id);
        $user->First_name = $request->input('First_name');
        $user->Last_name = $request->input('Last_name');
        $user->email = $request->input('email');
        $user->Role = $request->input('Role');
        $user->Workload = $request->input('Workload');
         $user->save();
         
       return redirect('/admin/users')->with('success', 'Lietotāja izmaiņas ir saglabātas');
        }
    }
    //Deaktivizēt lietotāju
    public function deactivateUser($id)
    {
          //atļauj tikai administratoriem
          if (Gate::allows('admin-only')) {
            //Atrod aktīvus lietotājus
            $user = User::find($id);
            $user->Active = false;
            $user->save();
            return redirect('/admin/users')->with('error', 'Lietotājs ir deaktivizēts');
        }
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
