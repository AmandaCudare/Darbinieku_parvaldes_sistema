@extends('layout.app')

@section('content')
{{--Profil lapa--}}

<div class="my-3 p-3 bg-white rounded shadow-sm"> 
                <h1>Profils</h1>
                   
                        {{--Esošā lietotāja dati--}}
                <h5><b>Vārds:</b> {{$user->First_name}}</h5>
                <h5><b>Uzvārds:</b> {{$user->Last_name}}</h5>
                <h5><b>E-pasts:</b> {{$user->email}}</h5>
                <h5><b>Loma: </b>
                    @if ($user->Role == 1)
                   Administrators
                   @elseif($user->Role == 2)
                  Darbinieks
                   @else
                   Vadītājs
                    @endif</h5>
                <h5><b>Darba slodze:</b> {{$user->Workload}}</h5>

           <a type="button" class="btn btn-outline-secondary" href="/password">Mainīt paroli</a> 
                  
</div>

@endsection
