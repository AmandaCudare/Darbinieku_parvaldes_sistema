<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Absence;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
         $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Parāda administratora paneļa lapu
    public function index()
    {
        return view ('admin.admin');
     
    }
    // parāda aktivu lietotāju lapu
    public function showUsers()
    {
            //Atrod aktīvus lietotājus
            $users = User::where('Active', true)->get();
        return view ('admin.users')->with(array('users' => $users));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Parāda prombutnes pieteikumu lapu
    public function showAbsence()
    {
           $absences = Absence::where('accepted', null)->with('user')->get();
           return view ('admin.absence')->with(array('absences' => $absences));
        
    }
    //Prombutnes aptiprināšanas funkcija
    public function updateAbsence($id)
    {
           $absences = Absence::find($id);
           $absences->accepted = true;
           $absences->save();
           return redirect('admin/absence')->with('success', 'Prombūtnes pieteikums ir apstiprināta');
           
    }
    //Prombutnes noraidīšanas funkcija
    public function declineAbsence($id)
    {
           $absences = Absence::find($id);
           $absences->accepted = false;
           $absences->save();
           return redirect('admin/absence')->with('error', 'Prombūtnes pieteikums noraidīts');
           
    }

    //lietotaja datu rediģēšanas lapa
    public function editUser($id)
    {
            //Atrod aktīvus lietotājus
            $user = User::find($id);
        return view ('admin.user_edit')->with('user', $user);

    }
    //Darbinieka loma maiņa uz vadītaju
    public function editRole($id)
    {
        //Atrod lietotāju
         $user = User::find($id);
         //Pārbauda vai lietotājs ir darbinieks
        if($user->Role == '2'){
        //Nomaina lomu uz vadītāja lomu - 3
        $user->Role= '3';
        $user->save();
        return redirect()->back()->with('success', 'Loma ir nomainīta');
        }
        return redirect()->back()->with('error', 'šim lietotājam nedrīkst nomainīt lomu');
        
    }
    //lietotaja informācijas izmaiņu saglabāšana
    public function updateUser(Request $request, $id)
    {
          
             //Lietotāja datu validacija
        $validatedData = $request->validate([
            'First_name' => ['required', 'string', 'max:50'],
            'Last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'Workload' => ['required'],
            
        ]);
            //Atrod izvelēto projektu saglabā izmaiņas
        $user = User::find($id);
        $user->First_name = $request->input('First_name');
        $user->Last_name = $request->input('Last_name');
        $user->email = $request->input('email');
        $user->Workload = $request->input('Workload');
         $user->save();
         
       return redirect('/admin/users')->with('success', 'Lietotāja izmaiņas ir saglabātas');
    
    }
    //Deaktivizēt lietotāju
    public function deactivateUser($id)
    {
            //Atrod aktīvus lietotājus
            if($id != auth()->user()->id){
            $user = User::find($id);
            $user->Active = false;
            $user->save();
            return redirect('/admin/users')->with('error', 'Lietotājs ir deaktivizēts');
    }
    return redirect()->back()->with('error', 'Šo lietotāju nedrīkst deaktivizēt');
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
