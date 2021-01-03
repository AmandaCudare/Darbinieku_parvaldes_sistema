{{--Projekta amatu pieteikuma aptiprināšanas lapa--}}
@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
{{--Pārbauda vai ir kāds amata pieteikums --}}
<h4>Visi pieteikumi</h4> 
@if(count($positions)>0)
<div class="well">
                    
    <table class="table table-bordered">
        
        <thead>
        <tr>
        <th>Amata nosaukums</th>
        <th>Vajadzīgais cilvēku skaits</th>
        <th>Apstiprinātais cilvēku skaits</th>
        <th>Lietotāja vārds</th>
        <th>Lietotāja uzvārds</th>
        <th>Lietotāja epasts</th>
        <th>Apskatīt</th>
        <th>Apstiprināt</th>
        <th>Noraidīt</th>
        </tr>
    </thead>
    <tbody>
        @foreach($positions as $position)
    <tr>
        <td><p>{{$position->name}}</p></td>
       <td><p>{{$position->people_count}}</p></td> 
       <td> {{App\Http\Controllers\PositionController::ActualPeopleCount($position->position_id)}}</td>
       <td><p>{{$position->Last_name}}</p></td>
        <td><p>{{$position->First_name}}</p></td>
        <td><p>{{$position->email}}</p></td>
        
       {{-- <td><p>{{$actual_people_count}}</p></td>
      Lietotāja profila apskate--}}
        <td><a type="button" class="btn btn-outline-secondary" href="/user/{{$position->user_id}}">Apskatīt</a></td>
      {{--Amata pieteikuma apstiprināšanas poga--}}
        <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$position->uposition_id}}/accepted">Apstiprināt</a> </td>
    {{--Amata piteikuma noraidīšanas poga--}}
        <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$position->uposition_id}}/decline">Noraidīt</a> </td>
   </tr>
    @endforeach
</div>  
</tbody>
</table>

@else 
<h5 class="mt-3">Patreiz Jums nav pieteikumu</h5>
@endif

{{--Uz projektu lapas poga--}}
<a type="button" class="btn btn-outline-secondary mt-5" href="/projects/{{$project_id}}">Atpakaļ</a> 
</div>
@endsection