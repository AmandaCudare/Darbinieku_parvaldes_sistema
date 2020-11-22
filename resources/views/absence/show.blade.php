@extends('layout.app')

@section('content')
<h1> Prombūtne</h1>
<div class="container">
<a href="/absence/create" type="submit" class="btn btn-outline-secondary row mb-3">Prombūtne izveidošana</a>
</div>
@if(count($absences)>0)
    
   <div class="well">
    <table class="table table-bordered">
        <thead>
        <tr>
          <th>Iemesls</th>
          <th>Sākuma datums</th>
          <th>Beigu datums</th>
          <th>Status</th>
          <th>Rediģēt</th>
          <th>Dzēst</th>
        </tr>
    </thead>
    <tbody>
        @foreach($absences as $absence)
            <tr>
                <td><p>{{$absence->reason}}</p></td>
                <td><p>{{$absence->start_date}}</p></td>
                <td><p>{{$absence->end_date}}</p></td>
                <td>
                   @if($absence->accepted != false && $absence->accepted != true)
                   <p>Nav vel izskatīts</p>
                    @elseif($absence->accepted == true)
                   <p> Akceptēts</p> 
                   @else
                        <p>Noraidīts</p>
                   @endif
                </td>
                <td><a type="button" class="btn btn-warning" href="/absence/edit">Edit</a> </td>
            <td><a type="button" class="btn btn-outline-danger" href="/absence/delete">Dzēst</a> </td>
            </tr>
        @endforeach
            </div>  
            @endif
@endsection