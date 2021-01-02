@extends('layout.app')

@section('content')
{{--Šeit vadītājs var izveidot projektu--}}
<h1>Izveidot projektu</h1>

<form method="POST" action="/projects">
  @csrf

<div class="container">
{{--projekta nosaukuma ievades logs--}}
<div class="form-group col-md-6">
  <label for="title">{{ __('Nosaukums') }}</label>
      <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"  name="title" >
      @error('title')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <small class="form-text text-muted">Maksimālais simbolu skaits ir 100</small>
</div>
{{--projekta apraksta ievades logs--}}
  <div class="form-group col-md-6">
        <label for="Description">{{ __('Apraksts') }}</label>
        <textarea class="form-control  @error('Description') is-invalid @enderror" type="text" id="Description" rows="3" name="Description" ></textarea>
      @error('Description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
      <small class="form-text text-muted">Maksimālais simbolu skaits ir 500</small>
  </div>

{{--projekta sākuma datuma ievades logs--}}
  <div class="form-group col-md-6">
        <label for="start_date">Sākuma datums</label>
        <input  class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"  name="start_date">
      @error('start_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
      <small class="form-text text-muted">Sākuma datumam jābūt pēc Pieteikties līdz datuma un pirms Beigu datuma</small>
  </div>

{{--projekta beigu datuma ievades logs--}}
  <div class="form-group col-md-6">
        <label for="end_date">Beigu datums</label>
        <input  class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date">
      @error('end_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
      <small class="form-text text-muted">Beigu datumam jābūt pēc Sākuma datuma</small>
  </div>

{{--projekta pieteikties līdz ievades logs--}}
  <div class="form-group col-md-6">
        <label for="assign_till">Pieteikties līdz</label>
        <input  class="form-control @error('assign_till') is-invalid @enderror" type="date" id="assign_till" name="assign_till">
      @error('assign_till')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
      <small class="form-text text-muted">Pieteikties līdz datumam jābūt pirms Sākuma datuma un jābūt pēc rītdienas</small>
  </div>

    </div> 
    <button type="submit" class="btn btn-secondary">
      {{ __('Pievienot projektu') }}
  </button>

  </form>
</div>
  

  @endsection