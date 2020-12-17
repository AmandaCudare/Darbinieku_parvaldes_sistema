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
                  <th>Mainīt laiku projektā</th>
                </tr>
            </thead>
            <tbody>
              {{--  @foreach($projects as $project)--}}
            <tr>
                <td>
                 {{--  @if(count($projectsid)>0)
                   <p>{{$project->title}}</p>
                    @else
                    <a type="button" class="btn btn-outline-secondary" href="#">Pievienot projekta stundas</a>
                    @endif
               --}}</td>
                <td>{{-- <p>{{$day->phour}}</p>--}}</td>
                <td>{{-- <p>{{$day->ohour}}</p>--}}</td>
                <td>{{-- <p>{{$day->thour}}</p>--}}</td>
                <td>{{-- <p>{{$day->chour}}</p>--}}</td>
                <td>{{-- <p>{{$day->phour}}</p>--}}</td>
                <td>{{-- <p>{{$day->shour}}</p>--}}</td>
                <td>{{-- <p>{{$day->shour}}</p>--}}</td>
                <td><a type="button" class="btn btn-outline-secondary" href="#">Rediģēt</a></td>
            </tr>
            <tr>
              <td>
                <a type="button" class="btn btn-outline-secondary" href="hour/create">Pievienot projekta stundas</a>
              </td>
            </tr>
           {{-- @endforeach --}}
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

