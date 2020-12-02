@extends('layout.app')

@section('content')

<div class="well">
                    
    <table class="table table-bordered">
        <h4>Lietotājs</h4> 
        <thead>
        <tr>
        <th>Lietotāja vārds</th>
        <th>Lietotāja uzvārds</th>
        <th>Lietotāja epasts</th>
        </tr>
    </thead>
    <tbody>
    <tr>
        <td><p>{{$user->Last_name}}</p></td>
        <td><p>{{$user->First_name}}</p></td>
        <td><p>{{$user->email}}</p></td>
     </tr>
   
 
</tbody>
</table>
</div> 

@endsection