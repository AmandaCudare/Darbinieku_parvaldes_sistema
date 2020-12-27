@extends('layout.app')

@section('content')
 <div class="my-3 p-3 bg-white rounded shadow-sm"> 
<h1>Izveidotie dienas izdarītā ieraksti</h1>
{{--Apskatīt grafiku poga--}}
<a type="button" class="btn btn-outline-secondary" href="/schedule">Apskatīt grafiku</a> 
{{--Pievienot dienas izdarītā lapa--}}
<a type="button" class="btn btn-outline-secondary" href="hour/create">Pievienot dienas izdarīto</a>
        {{--Parādīt katras dienas izdarīto noteiktajā nedēļā--}}
        
            <div class="container">
        
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-3">
                  @foreach($hours as $hour)  
                <div class="col">
                  <div class="card shadow-sm mb-2">
                    <div class="card-body">
                       <h4 class="card-text">Datums: {{$hour->day}}</h4>
                       <p  class="card-text">Apraksts: {{$hour->description}}</p>
                       <p  class="card-text">Nostrādātās stundas: {{$hour->hours}}</p>
                       <p  class="card-text">Projekts:
                         @foreach ($projects as $project)
                         @if($hour->project_id == $project->id)
                        {{$project->title}}
                        @endif
                        @endforeach

                      @if($hour->project_id == NULL) Ārpus projekta
                      @endif
                      </p>
                      <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                          <button type="button" href="/hour/{{$hour->id}}/edit" class="btn btn-sm btn-warning">Rediģēt</button>
                          <form action="/hour/{{$hour->id}}" method="POST">
                           @csrf
                           @method('DELETE')
                           <input type="submit" class="btn btn-sm btn-danger" value="Dzēst" />
                       </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
                 @endforeach
              </div>
            </div>
        
      </div>
      {{--   @foreach($hours as $hour)  
         <div class="my-3 p-3 bg-white rounded shadow-sm"> 
        <h4>Datums: {{$hour->day}}</h4>
        <p>Apraksts: {{$hour->description}}</p>
        <p>Nostrādātās stundas: {{$hour->hours}}</p>
        <p>Projekts: {{$hour->project_id}}</p>
         
         <div class="col-md-2 themed-grid-col">
            <a href="/hour/{{$hour->id}}/edit" class="btn btn-warning">Rediģēt</a>
        </div>

        <div class="col-md-2 themed-grid-col">
            <form action="/hour/{{$hour->id}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Dzēst" />
        </form>
        </div>
         </div>
        @endforeach--}}
@endsection