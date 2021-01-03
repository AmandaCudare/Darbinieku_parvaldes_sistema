@extends('layout.app')

@section('content')
{{--Dienas izdarītā izvedies lapa--}}
<h3>Izveidot dienas izdarīto</h3>

<form method="POST" action="/hour">
  @csrf

<div class="container">
{{--Dienas izdarītā datums aizpildes lauks--}}
  <div class="form-group col-md-6">
    <label for="day">{{ __('Datums') }}</label>
    <input  class="form-control @error('day') is-invalid @enderror" type="date" id="day"  name="day">
  @error('day')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>
{{--Dienas izdarītā apraksts aizpildes lauks--}}
 <div class="form-group col-md-6">
        <label for="description">{{ __('Apraksts') }}</label>
        <textarea class="form-control  @error('description') is-invalid @enderror" type="text" id="description" rows="5" name="description" ></textarea>
      @error('description')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <small id="description" class="form-text text-muted">Maksimālais rakstu zīmju skaits ir 500</small>
  </div>
{{--Dienas izdarītā nostrādātās stundas aizpildes lauks--}}
<div class="form-group col-md-6">
  <label for="hours">{{ __('Nostrādātās stundas') }}</label>
      <input id="hours" type="text" class="form-control @error('hours') is-invalid @enderror"  name="hours" >
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
      <select id="project_id" class="form-control @error('project_id') is-invalid @enderror" name="project_id" value="{{ old('project_id') }}" required autocomplete="project_id" autofocus>
          <option value=NULL >Ārpus projekta</option>
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
    <button type="submit" class="btn btn-secondary">
      {{ __('Pievienot dienas izdarīto') }}
  </button>

  </form>
  <a type="button" class="btn btn-outline-secondary mt-5" href="/hour">Atpakaļ</a> 
</div>
  

  @endsection