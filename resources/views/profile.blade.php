@extends('layout.app')

@section('content')
{{--Profil lapa--}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                    <div class="container">
                        {{--Esošā lietotāja dati--}}
                <p><b>Vārds:</b> {{$user->First_name}}</p>
                <p><b>Uzvārds:</b> {{$user->Last_name}}</p>
                <p><b>E-pasts:</b> {{$user->email}}</p>
                <p><b>Loma: </b>
                    @if ($user->Role == 1)
                   Administrators
                   @elseif($user->Role == 2)
                  Darbinieks
                   @else
                   Vadītājs
                    @endif</p>
                <p><b>Darba slodze:</b> {{$user->Workload}}</p>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
