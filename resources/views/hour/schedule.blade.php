{{--Nostrādāto stundu grafika lapa --}}
@extends('layout.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm"> 

<h2> Šīs nedēļas nostrādāto stundu grafiks</h2>
{{--Esošā nedēļas sākuma un beigu datums--}}
<h4 class="text-right"> nedēļa no {{$from}} līdz {{$till}}</h4>
{{--pārbaudīt vai ir kāds dienas izdarītā ieraksts šajā nedēļā--}}
@if(count($hours_with_projects)>0 || count($hours_without_projects)>0)
{{--Slodze, nostrādātās stundas un virsstundas--}}
<h5 class="text-right"> Slodze - {{$workload}}h
  @if($total>0)
  , nostrādātās stundas - {{$total}}h 
  @endif
    @if($overtime>0)
  , virsstundas - {{$overtime}}h  
    @endif
  </h5> 

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 g-2 mt-3">
 @foreach($projects as $project) 
 {{--Pārbaudīt vai kādā projektā ir kāds dienas izdarītā ieraksts šajā nedēļā--}}
  @if(count($hours_with_projects)>0) 
  {{--Pārbauda vai šim projektam ir vismaz viens dienas izdarītā ieraksts--}}
  @if(App\Http\Controllers\HoursController::ifhours($project->id) == true)
 <div class="col">
  <div class="card shadow-sm mb-2">
    <div class="card-body">
     
       <h4 class="card-text">Projekts: {{$project->title}}</h4>
      
       <div class="well table-sm">
        <table class="table table-bordered">
            <thead>
            <tr>
              <th>Datums</th>
              <th>Nostrādātās stundas</th>
              <th>Kopā:</th>
            </tr>
        </thead>
        <tbody>
          @foreach($hours_with_projects as $projectshour) <tr>
            @if($project->id == $projectshour->id)
            
         <td><p>{{$projectshour->day}}</p></td>
         <td><p>{{$projectshour->hours}}</p></td> <td></td>
          @endif
        </tr>   
        @endforeach
        {{--Projekta nostrādāto stundu summa--}} 
        @foreach ($ProjectsSum as $sum)
        @if($project->id == $sum->id)
        <tr>
          <td> </td> <td></td>
        <td><p> {{$sum->sum}}</p></td> 
        </tr>
        </tbody></table></div>
      
        @endif
        @endforeach
      
        
    </div>
  </div>
</div>
@endif
@endif
@endforeach 
{{--Pārbaudīt vai ārpus projekta ir kāds dienas izdarītā ieraksts--}}
@if(count($hours_without_projects)>0)
<div class="col">
  <div class="card shadow-sm mb-2">
    <div class="card-body">
     
       <h4 class="card-text">Ārpus projekta</h4>
       <div class="well">
        <table class="table table-bordered">
            <thead>
            <tr>
              <th>Datums</th>
              <th>Nostrādātās stundas</th>
              <th>Kopā:</th>
            </tr>
        </thead>
        <tbody>
          @foreach($hours_without_projects as $hour)<tr>
         <td><p>{{$hour->day}}</p></td>
         <td><p>{{$hour->hours}}</p></td> 
         <td> </td>
        </tr>   
        @endforeach 
        {{--Ārpus projekta nostrādāto stundu summa--}}
        @foreach ($OutofProjectsSum as $sum)
           <tr>
          <td> </td> <td></td>
        <td><p> {{$sum->sum}}</p></td> 
        </tr> 
        @endforeach
        
      </tbody></table></div>
        
    </div>
  </div>
</div>
@endif
</div>
 @else
 <h5>Pašreiz nav pievienoti dienas izdarītā ieraksti</h5>
 <h5>Šeit var pievienot - 
{{--Pievienot dienas izdarītā lapa--}}
<a type="button" class="btn btn-outline-secondary" href="hour/create">Pievienot dienas izdarīto</a>
</h5>
@endif  
<br>
{{--Poga uz dienas izdarītā galveno lapu--}}
<a type="button" class="btn btn-outline-secondary mt-3" href="/hour">Atpakaļ</a> 
</div>
@endsection

