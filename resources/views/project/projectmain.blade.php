@extends('layout.app')

@section('content')

<h1> Projekts</h1> 
{{--Šo lapas daļu var redzēt vadītājs tikai--}} 
@if (Auth::user()->Role == '3')

    <a href="/projects/create" class="btn btn-outline-secondary row mb-3">Izveidot projektu</a>
    @if(count($my_projects)>0)
    
   <div class="well">
    <table class="table table-bordered">
        <h4>Projekti, kuros izveidoju</h4>
        <thead>
        <tr>
          <th>Projekta nosaukums</th>
          <th>Sākuma datums</th>
          <th>Beigu datums</th>
          <th>Pieteities līdz</th>
          <th>Apskatīt projektu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($my_projects as $my_project)
            <tr>
                <td><p>{{$my_project->title}}</p></td>
                <td><p>{{$my_project->start_date}}</p></td>
                <td><p>{{$my_project->end_date}}</p></td>
                <td><p>{{$my_project->assign_till}}</p></td>
            <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$my_project->id}}">Apskatīt projektu</a> </td>
            </tr>
        @endforeach
            </div>  
    @endif
@endif

    @if(count($projects)>0)
                <div class="well">
                    
                    <table class="table table-bordered">
                        <h4>Visi pieejamie projekti</h4> 
                        <thead>
                        <tr>
                        <th>Projekta nosaukums</th>
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
                        <td><p>{{$project->start_date}}</p></td>
                        <td><p>{{$project->end_date}}</p></td>
                        <td><p>{{$project->assign_till}}</p></td>
                    <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$project->id}}">Apskatīt projektu</a> </td>
                    </tr>
                    @endforeach
                </div>  
                </tbody>
                </table>
            
                {{--{{$projects->links()}}--}}

            @else 
            <h4>Patreiz Jums nav projektu</h4>
            @endif

     {{--{{$projects->links()}}--}}
   

@endsection
