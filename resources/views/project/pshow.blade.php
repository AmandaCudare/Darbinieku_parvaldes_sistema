@extends('layout.app')

@section('content')
<main >
{{--Projekta apraksts--}}
<div class='container'>
    <div class="row mb-1">
        <div class="col-md-3 themed-grid-col">  
        <h1>{{$project->title}}</h1>
         </div>

         @if(Auth::user()->id == $project->creator_id)

        <div class="col-md-2 themed-grid-col">
            <a href="/projects/{{$project->id}}/edit" class="btn btn-warning">Rediģēt Projektu</a>
        </div>

        <div class="col-md-2 themed-grid-col">
            <form action="/projects/{{$project->id}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" onclick="return confirm('Vai jūs tiešām vēlaties dzēst projektu?')" value="Dzēst Projektu" />
        </form>
        </div>

        <div class="col-md-2 themed-grid-col">
            <a href="/projects/{{$project->id}}/assign" class="btn btn-warning">Projekta amatu pieteikumi</a>
        </div>

        @endif
      </div>
     
       <h5>Apraksts : {{$project->Description}}</h5>
        <p>Sākuma datums : {{$project->start_date}}</p></td>
        <p>Beigu datums : {{$project->end_date}}</p>
        <p>Var pieteikties līdz : {{$project->assign_till}}</p>
        @if($project->assign_till<=$today)
 <p> Nevar vairs pieteikties</p>
   @endif

        <h4>Amati</h4>
            {{-- Amatu parādīšanas lapa--}}
        @include('project.position', [ 'positions' => $positions, 'project'=> $project, 'today'=>$today])

    @if(Auth::user()->id == $project->creator_id)

{{--Amata pievienošana--}}

        <h4>Pievienot amatus</h4>

<form method="post" action="/project/{{$project->id}}/position">
            @csrf
    <div class="form-inline mb-2">
            <div class="form-group">
                        <div class="col-md-6">
                            <label class="label">Amata nosaukums</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" />
                      
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="label">Amatam cilvēku skaits</label>
                            <input id="people_count" type="number" class="form-control @error('people_count') is-invalid @enderror"  name="people_count" />
                      
                            @error('people_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      
                <input type="hidden" name="project_id" value="{{ $project->id }}" />
            </div>
            <div class="form-group">
                <div class="col-md-6 mt-4">
                <input type="submit" class="btn btn-outline-secondary" value="Pievienot amatu" />
                </div>
            </div>
</div>
</form>
@endif
{{--Visu projektu lapas poga--}}
<a type="button" class="btn btn-outline-secondary" href="/projects">Atpakaļ</a> 
</div>
</main>
@endsection