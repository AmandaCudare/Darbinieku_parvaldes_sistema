@extends('layout.app')

@section('content')

<h1> Projekts</h1>
    @if(count($projects)>0)

        <div class="well">
            <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Projekta nosaukums</th>
                  <th>Amats</th>
                  <th>Sākuma datums</th>
                  <th>Beigu datums</th>
                  <th>Pieteities līdz</th>
                  <th>Apskatīt projektu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
            <tr>
                <td><p>{{$project->title}}</p></td>
                <td>{{--<p>{{amats}}</p>--}}</td>
                <td><p>{{$project->start_date}}</p></td>
                <td><p>{{$project->end_date}}</p></td>
                <td><p>{{$project->assign_till}}</p></td>
                <td><a type="button" class="btn btn-outline-secondary" href="#">Apskatīt projektu</a> </td>
            </tr>
            @endforeach
        </div>  
        </tbody>
          </table>
    
    @else 
     <h4>Patreiz Jums nav projektu</h4>
     @endif

@endsection
