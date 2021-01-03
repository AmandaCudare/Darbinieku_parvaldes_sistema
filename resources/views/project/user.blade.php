{{--Lietotāja pamatinformācijas lapa--}}
@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
        <h3>Lietotājs</h4> 
            {{--Lietotāja pamatinformācija--}}
            <div class="form-inline">
        <h5><b>Lietotāja vārds:</b></h5><h5>   {{$user->Last_name}}</h5>
            </div>
        <div class="form-inline">
        <h5><b>Lietotāja uzvārds: </b></h5><h5> {{$user->First_name}}</h5>
        </div>
        <div class="form-inline">
        <h5><b>Lietotāja epasts: </b></h5><h5> {{$user->email}}</h5>
        </div>
        <div class="form-inline">
            <h5><b>Darba slodze:</b> 
                @if($user->Workload == 1.0)
                Pilna slodze(40h nedēļā)
                @elseif($user->Workload == 0.75)
                Nepilna slodze(30h nedēļā)
                @else
                Nepilna slodze(20h nedēļā)
                @endif
            </h5>
            </div>
            {{--Pārbauda vai ir kāda prasme šim lietotājam--}}
   @if(count($skills)>0)
  <h4> Lietotāja prasmes</h4>
   <ul class="list-group mt-3">
   @foreach ($skills as $skill)
    <li class="list-group-item col-md-6">{{$skill->name}}</li>
   @endforeach
   </ul>
   @else 
    <p>Lietotājam nav prasmju</p>
   @endif

{{--Visu projektu lapas poga--}}
<a type="button" class="btn btn-outline-secondary mt-5" href="/projects">Atpakaļ</a> 

</div>

@endsection