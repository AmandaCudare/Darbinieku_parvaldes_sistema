@extends('layout.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm"> 
<h2> Šīs nedēļas Dienas izdarīto stundu grafiks</h2>
<h4> nedēļa no {{$from}} līdz {{$till}}</h4>
@if(count($hours_with_projects)>0 || count($hours_without_projects)>0)
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 g-2 mt-3">
 @foreach($projects as $project) 
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
        @foreach ($ProjectsSum as $sum)
        @if($project->id == $sum->id)
        <tr>
          <td> </td> <td></td>
        <td><p> {{$sum->sum}}</p></td> 
        </tr>
        @endif
        @endforeach
      </tbody></table></div>
        
    </div>
  </div>
</div>
@endforeach 

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
</div>

{{--
        <div class="well">
            <table class="table table-bordered">
                <thead>
                <tr>
                  <th>Projekta nosaukums</th>
                  <th>Datums</th>
                  <th>Nostrādātās stundas</th>
                </tr>
            </thead>
            <tbody>
               @foreach($projects as $project)                
               <td><p>{{$project->title}}</p></td>
              @foreach($hours_with_projects as $projectshour) <tr>
                 @if($project->id == $projectshour->id)
                 <td></td>
              <td><p>{{$projectshour->day}}</p></td>
              <td><p>{{$projectshour->hours}}</p></td> 
               @endif
                @endforeach 
               </tr>
              @endforeach <td><p>Ārpus projekta</p></td>
              @foreach($hours_without_projects as $hour)
              <tr>
                <td></td>
              <td><p>{{$hour->day}} </p></td>
              <td><p>{{$hour->hours}}</p></td>
              </tr>
            @endforeach 
         
        <tr>
          Totals katrā projektā
          @foreach ($ProjectsSum as $sum)
             {{$sum->id}} {{$sum->sum}}
          @endforeach
          @foreach ($OutofProjectsSum as $notpsum)
          Ārpus projekta {{$notpsum->sum}}
          @endforeach
        </tr>
        </div>  
        </tbody>
          </table>
 {{--   
    @else 
     <h4>Jums nav projektu pašlaik</h4>
     <p> Dodaties uz Projektulapu lai pieteiktos projektam</p>
     @endif
--}}
 @else
 <h5>Pašreiz nav pievienoti dienas izdarītā ieraksti</h5>
 <h5>Šeit var pievienot</h5>
{{--Pievienot dienas izdarītā lapa--}}
<a type="button" class="btn btn-outline-secondary" href="hour/create">Pievienot dienas izdarīto</a>
@endif  


</div>
@endsection

