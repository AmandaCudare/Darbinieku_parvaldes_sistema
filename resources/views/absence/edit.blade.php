{{--Prombūtnes rediģēšanas poga--}}
@extends('layout.app')

@section('content')

<h3>Mainīt prombūtnes pieteikuma datus</h3>
<small  class="form-text text-muted">Ja tiks rediģēts apstiprināts vai noraidīts  prombūtnes pieteikums, tad pieteikums atkal nonāks uz izskati.</small> 
     
<form method="POST" action="/absence/{{$absence->id}}">
    @method('PUT')
  @csrf

<div class="container">
{{--prombūtnes pieteikuma iemesls--}}
<div class="form-group col-md-6">
  <label for="start_date">Iemesls</label>
      <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror"  name="reason" value="{{$absence->reason}}">
      <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
      @error('reason')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
</div>
{{--prombūtnes pieteikuma sākuma datums--}}
  <div class="form-group col-md-6">
        <label for="start_date">Sākuma datums</label>
        <input  class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"  name="start_date" value={{$absence->start_date}}>
        <small  class="form-text text-muted">Nedrīkst būt pirms jau izvēlētā sākuma datuma un datums nedrīkst būt pēc beigu datuma</small>
        @error('start_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>
{{--prombūtnes pieteikuma beigu datums--}}
  <div class="form-group col-md-6">
        <label for="end_date">Beigu datums</label>
        <input  class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date" value={{$absence->end_date}}>
      @error('end_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>

  <div class="form-group col-md-6">
    <button type="submit" class="btn btn-secondary">
      {{ __('Saglabāt izmaiņas') }}
  </button>
  </div>
  </form>
  <div class="form-group col-md-6">
      {{--Atpakaļ uz galveno prombūtnes lapu poga--}}
<a type="button" class="btn btn-outline-secondary mt-3" href="/absence">Atpakaļ</a> 
  </div>
</div> 
  
  @endsection