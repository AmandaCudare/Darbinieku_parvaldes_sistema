@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
    <div class="row ">
        <div class="col-md-9">
           <h1> Projekts</h1>  
        </div>
       
{{--Šo lapas daļu var redzēt vadītājs tikai--}} 
@if (Auth::user()->Role == '3')
 <div class="col-6 col-md-3">
          <a href="/projects/create" class="btn btn-secondary">Izveidot projektu</a>  
        </div>
      </div>
    @if(count($my_projects)>0)
    
   <div class="well">
    <table class="table table-bordered">
        <h4>Projekti, kurus izveidoju</h4>
        <thead>
        <tr>
          <th>Projekta nosaukums</th>
          <th>Sākuma datums</th>
          <th>Beigu datums</th>
          <th>Pieteikties līdz</th>
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
    </tbody>
    </table>
            </div>  
    @endif
@endif
{{--Projekti kuriem lietotājs ir aptiprināts amatā--}}
@if(count($assign_projects)>0)
<div class="well">
    
    <table class="table table-bordered">
        <h4>Apstiprinātie projekti</h4> 
        <thead>
        <tr>
        <th>Projekta nosaukums</th>
        <th>Sākuma datums</th>
        <th>Beigu datums</th>
        <th>Pieteikties līdz</th>
        <th>Apskatīt projektu</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assign_projects as $assign_project)
    <tr>
        <td><p>{{$assign_project->title}}</p></td>
        <td><p>{{$assign_project->start_date}}</p></td>
        <td><p>{{$assign_project->end_date}}</p></td>
        <td><p>{{$assign_project->assign_till}}</p></td>
    <td><a type="button" class="btn btn-outline-secondary" href="/projects/{{$assign_project->id}}">Apskatīt projektu</a> </td>
    </tr>
    @endforeach
</tbody>
</table>
</div> 

@else 
<h4>Jūs patreiz neesat apstiprināts nevienam projektam</h4>
@endif

{{--Vispār pieejamie projekti kurime var pieteikties vēl--}}
    @if(count($projects)>0)
                <div class="well">
                    
                    <table class="table table-bordered">
                        <h4>Visi pieejamie projekti</h4> 
                        <thead>
                        <tr>
                        <th>Projekta nosaukums</th>
                        <th>Sākuma datums</th>
                        <th>Beigu datums</th>
                        <th>Pieteikties līdz</th>
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
                
                </tbody>
                </table>
            </div>  
             

            @else 
            <h4>Patreiz nav pieejami jauni projekti</h4>
            @endif

     
</div>

@endsection
