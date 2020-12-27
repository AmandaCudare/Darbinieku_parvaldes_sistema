@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
@if(count($positions)>0)
<div class="well">
                    
    <table class="table table-bordered">
        <h4>Visi pieteikumi</h4> 
        <thead>
        <tr>
        <th>Amata nosaukums</th>
        <th>Lietotāja vārds</th>
        <th>Lietotāja uzvārds</th>
        <th>Lietotāja epasts</th>
        <th>Apskatīt</th>
        <th>Apstiprināt</th>
        <th>noraidīt</th>
        </tr>
    </thead>
    <tbody>
        @foreach($positions as $position)
    <tr>
        <td><p>{{$position->name}}</p></td>
        <td><p>{{$position->Last_name}}</p></td>
        <td><p>{{$position->First_name}}</p></td>
        <td><p>{{$position->email}}</p></td>
        <td><a type="button" class="btn btn-outline-secondary" href="/user/{{$position->user_id}}">Apskatīt</a></td>
    <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$position->uposition_id}}/accepted">Apstiprināt</a> </td>
    <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$position->uposition_id}}/decline">Noraidīt</a> </td>
   </tr>
    @endforeach
</div>  
</tbody>
</table>

@else 
<h4>Patreiz Jums nav pieteikumu</h4>
@endif
</div>
@endsection