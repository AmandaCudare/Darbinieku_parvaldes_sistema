@extends('layout.app')

@section('content')

<h1> Nostrādatās darba stunda</h1>

    {{--@if(count($projects)>0)
--}}
        <div class="well">
            <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Projekta nosaukums</th>
                  <th>Pirmdiena</th>
                  <th>Otrdiena</th>
                  <th>Trešdiena</th>
                  <th>Ceturdiena</th>
                  <th>Piektdiena</th>
                  <th>Sestdiena</th>
                  <th>Svētdiena</th>
                </tr>
            </thead>
            <tbody>
               @foreach($hours_with_projects as $projectshour)
            <tr><td><p>{{$projectshour->title}}</p></td>
                <td><p>{{$projectshour->hours}} {{$projectshour->day}} </p></td>
            </tr>
            @endforeach 
        </div>  
        </tbody>
          </table>
 {{--   
    @else 
     <h4>Jums nav projektu pašlaik</h4>
     <p> Dodaties uz Projektulapu lai pieteiktos projektam</p>
     @endif
--}}


  <p><a type="submit" class="btn btn-outline-secondary" href="#"><</a>
Nedēļa
  <a type="button" class="btn btn-outline-secondary" href="#">></a>
</p>

@endsection

