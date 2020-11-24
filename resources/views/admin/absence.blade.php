@extends('layout.app')

@section('content')
@if(count($absences)>0)
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="well">
        <table class="table table-bordered">
            <h4>Prombūtnes pieteikumi</h4>
            <thead>
            <tr>
              <th>Lietotāja vārds</th>
              <th>Lietotāja uzvārds</th>
              <th>Lietotāja epasts</th>
              <th>Iemesls</th>
              <th>Sākuma datums</th>
              <th>Beigu datums</th>
              <th></th>
              <th></th>
            </tr>
        </thead>
        <tbody>
        
            @foreach($absences as $absence)
                <tr>
                    <td><p>{{$absence->user->First_name}}</p></td>
                    <td><p>{{$absence->user->Last_name}}</p></td>
                    <td><p>{{$absence->user->email}}</p></td>
                    <td><p>{{$absence->reason}}</p></td>
                    <td><p>{{$absence->start_date}}</p></td>
                    <td><p>{{$absence->end_date}}</p></td>
                <td>
                    <form method="POST" action="/admin/absence/{{$absence->id}}">
                        @csrf
                        @method('PUT')
                    <input type="submit" class="btn btn-outline-secondary" value="Apstiprināts" >
                    </form>
                </td>
                <td>
                    <form method="POST" action="/admin/absence/{{$absence->id}}/decline">
                        @csrf
                        @method('PUT')
                    <input type="submit" class="btn btn-outline-secondary" value="Noraidīt" >
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
        </table>
                </div>  

     <a type="button" class="btn btn-outline-secondary" href="/admin">Atpakaļ</a>  
     
    @else 
    <h4> Nav jaunu pieteikumu</h4>
       @endif
      </div> 
@endsection