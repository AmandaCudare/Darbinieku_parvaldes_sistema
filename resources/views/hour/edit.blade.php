@extends('layout.app')

@section('content')
{{--Dienas izdarītā izvedies lapa--}}
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
<h1>Rediģēt dienas izdarīto</h1>

<form method="POST" action="/hour/{{$hour->id}}">
    @method('PUT')
  @csrf

<div class="container">
{{--Dienas izdarītā datums aizpildes lauks--}}
  <div class="form-group col-md-6">
    <label for="day">{{ __('Datums') }}</label>
    <input  class="form-control @error('day') is-invalid @enderror" type="date" id="day"  name="day" value={{$hour->day}}>
  @error('day')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>
{{--Dienas izdarītā apraksts aizpildes lauks--}}
 <div class="form-group col-md-6">
        <label for="description">{{ __('Apraksts') }}</label>
        <textarea class="form-control  @error('description') is-invalid @enderror" type="text" id="description" rows="5" name="description" >{{$hour->description}}</textarea>
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <small id="description" class="form-text text-muted">Maksimālais rakstu zīmju skaits ir 500</small>
  </div>
{{--Dienas izdarītā nostrādātās stundas aizpildes lauks--}}
<div class="form-group col-md-6">
  <label for="hours">{{ __('Nostrādātās stundas') }}</label>
      <input id="hours" type="text" class="form-control @error('hours') is-invalid @enderror"  name="hours" value={{$hour->hours}}>
      @error('hours')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <small id="hours" class="form-text text-muted">Drīkst būt skaitlis no 1 līdz 12(ieskaitot)</small>
</div>
{{--Dienas izdarītā projekts kurā tika veidots aizpildes lauks--}}
<div class="form-group col-md-6">
  <label for="project_id">{{ __('Projekts') }}</label>
      <select id="project_id" class="form-control @error('project_id') is-invalid @enderror" name="project_id" required autocomplete="project_id" autofocus>
        @if($hour->project_id!=NULL)
        <option value={{$hour->project_id}}>{{$project_title}}</option>
        <option value=NULL >Ārpus projekta</option>
        @else <option value=NULL >Ārpus projekta</option>
        @endif
         {{--paradīs katru projektu kurma ir amats aptiprināts--}}
          @foreach($projects as $project)
          <option value="{{$project->id}}">{{$project->title}}</option>
          @endforeach
        
        </select>
      @error('project_id')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
</div>
 {{-- Poga, lai nosutītu informaciju uz HoursController store funckiju--}} 
    </div> 
    <button type="submit" class="btn btn-primary">
      {{ __('Saglabāt izmaiņas') }}
  </button>

  </form>
</div>
  

  @endsection