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
          <th></th>
          <th></th>
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
                   <p>Nav vēl izskatīts</p>
                    @elseif($absence->accepted == true)
                   <p> Akceptēts</p> 
                   @else
                        <p>Noraidīts</p>
                   @endif
                </td>
                @if($absence->accepted != true)
                <td>
                    <a type="button" class="btn btn-warning" href="/absence/{{$absence->id}}/edit">Rediģēt</a> 
                 </td>
            <td>
                <form action="/absence/{{$absence->id}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Dzēst" />
            </form>
        </td>
             @endif
            </tr>
        @endforeach
            </div> 
        @else
        <h4>Patreiz nav izveidoti prombūtnes pieteikumu.</h4>
        @endif
@endsection