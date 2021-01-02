@extends('layout.app')

@section('content')
{{--Profila lapa--}}

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
                <h5><b>Darba slodze:</b> 
                    @if($user->Workload == 1.0)
                    Pilna slodze(40h nedēļā)
                    @elseif($user->Workload == 0.75)
                    Nepilna slodze(30h nedēļā)
                    @else
                    Nepilna slodze(20h nedēļā)
                    @endif
                </h5>
                    {{--Paroles maiņas poga--}}
           <a type="button" class="btn btn-outline-secondary mt-3" href="/password">Mainīt paroli</a> 
                  
</div>

@endsection
