{{--Projekta apskates --}}
@extends('layout.app')

@section('content')
<main >
{{--Projekta apraksts--}}
<div class='container'>
    <div class="my-3 p-3 bg-white rounded shadow-sm"> 
    <div class="row mb-3">
        <div class="col-md-6 themed-grid-col">  
        <h1>{{$project->title}}</h1>
         </div>
         {{--Pārbauda vai projektu veidoja šis lietotājs --}}
         @if(Auth::user()->id == $project->creator_id)
         {{--Projekta rediģēšanas poga--}}
        <div class="col-md-2 themed-grid-col">
            <a href="/projects/{{$project->id}}/edit" class="btn btn-warning">Rediģēt Projektu</a>
        </div>
        {{--Projekta dzēšanas poga--}}
        <div class="col-md-2 themed-grid-col">
            <form action="/projects/{{$project->id}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" onclick="return confirm('Vai jūs tiešām vēlaties dzēst projektu?')" value="Dzēst Projektu" />
        </form>
        </div>
        {{--Projekta amatu pieteikumi apskates lapa--}}
        <div class="col-md-2 themed-grid-col">
            <a href="/projects/{{$project->id}}/assign" class="btn btn-secondary">Projekta amatu pieteikumi</a>
        </div>

        @endif
      </div>
      <div class="row">
        <div class="col-md-8"> <h4>Apraksts : </h4><h5>{{$project->Description}}</h5></div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12"><h5>Sākuma datums : {{$project->start_date}}</h5></div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3"> <h5>Beigu datums : {{$project->end_date}}</h5></div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3"> <h5>Var pieteikties līdz : {{$project->assign_till}}</h5></div>
            </div>
        </div>
    </div>
      
        @if($project->assign_till<=$today)
 <h5 class="row justify-content-center mt-5"> Šim projektam vairs nevar pieteikties</h5>
   @endif

        <h4>Amati</h4>
            {{-- Amatu parādīšanas lapa--}}
        @include('project.position', [ 'positions' => $positions, 'project'=> $project, 'today'=>$today, 'upositions'=>$upositions])

    @if(Auth::user()->id == $project->creator_id)
    @if($project->assign_till>$today)
{{--Amata pievienošana--}}

        <h4 class="mt-5">Pievienot amatus</h4>

<form method="post" action="/project/{{$project->id}}/position">
            @csrf
    <div class="form-inline mb-2">
            <div class="form-group">
                        <div class="col-md-6">
                            <label class="label">Amata nosaukums</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" />
                      <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                        <div class="col-md-6">
                            <label class="label">Amatam cilvēku skaits</label>
                            <input id="people_count" type="number" class="form-control @error('people_count') is-invalid @enderror"  name="people_count" />
                           <small  class="form-text text-muted">Cilvēku skaitam ir jabūt lielākam par 0</small>  
                        @error('people_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                      
                <input type="hidden" name="project_id" value="{{ $project->id }}" />
            </div>
            <div class="form-group">
                <div class="col-md-6 ">
                <input type="submit" class="btn btn-outline-secondary" value="Pievienot amatu" />
                </div>
            </div>
</div>
</form>
@endif
@endif
{{--Visu projektu lapas poga--}}
<a type="button" class="btn btn-outline-secondary mt-5" href="/projects">Atpakaļ</a> 
</div>
</div>
</main>

@endsection