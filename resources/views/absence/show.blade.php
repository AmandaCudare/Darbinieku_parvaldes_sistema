{{--Prombūtnes pieteikuma apskates lapa--}}
@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
<div class="container">
    <div class="row ">
        <div class="col-md-9">
           <h1> Prombūtne</h1> 
        </div>
    <div class="col-md-3"> 
        {{--Prombūtnes izveides poga--}}
    <a href="/absence/create" type="submit" class="btn btn-secondary row mb-3">Prombūtne izveidošana</a>
   
        </div>
      </div>
{{--Pārbauda vai ir vismaz viens prombūtnes pieteikums--}}
@if(count($absences)>0)
<small  class="form-text text-muted">Nevar rediģēt vai dzēst prombūtnes pieteikumu, ja ir esošā diena ir pēc beigu datuma</small>
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
                   @if($absence->accepted == '0' )
                   <p>Noraidīts</p>
                    @elseif($absence->accepted == '1')
                   <p> Akceptēts</p> 
                   @else
                        <p>Nav vēl izskatīts</p>
                   @endif
                </td>
                {{--Parāda rediģēšanas un dzešanas pogu jo ir sodiena datums  ir pirms vai ir beigu datuma--}}
               <td> @if($absence->end_date >= $today)
                <a type="button" class="btn btn-warning" href="/absence/{{$absence->id}}/edit">Rediģēt</a> 
                     @endif
                 </td>
                <td>
                    @if($absence->end_date >= $today)
                <form action="/absence/{{$absence->id}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Dzēst" />
            </form>
             @endif </td>
            </tr>
        @endforeach
    </tbody>
    </table>
       </div>        
        @else
        <h5 class="mt-4">Patreiz nav izveidoti prombūtnes pieteikumu</h5>
        @endif
</div>
</div>
@endsection