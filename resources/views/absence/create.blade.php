{{--prombūtnes pieteikuma izveide--}}
@extends('layout.app')

@section('content')

<form method="POST" action="/absence">
  @csrf
{{--prombūtnes pieteikuma iemesls--}}
<div class="container">
  <h3>Pievienot prombūtnes pieteikumu</h3>
  <div class="form-group col-md-6">
    <label for="reason" class="mt-2">Iemesls</label>
    
        <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror"  name="reason" value="{{ old('reason') }}">
        
        @error('reason')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror  
       <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
  </div>
{{--prombūtnes pieteikuma sākuma datums--}}
  <div class="form-group col-md-6">
    <label for="start_date">Sākuma datums</label>
    <input  class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"  name="start_date" value="{{ old('start_date') }}">
  
    @error('start_date')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
  @enderror
    <small  class="form-text text-muted">Nedrīkst būt pirms jau izvēlētā sākuma datuma un datums nedrīkst būt pēc beigu datuma</small>
</div>
{{--prombūtnes pieteikuma beigu datums--}}
<div class="form-group col-md-6">
    <label for="end_date">Beigu datums</label>
    <input  class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date" value="{{ old('end_date') }}">
  @error('end_date')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
</span>
  @enderror
</div>
<div class="form-group col-md-6">
<button type="submit" class="btn btn-secondary">
  {{ __('Izveidot') }}
</button>
</div>
  </form>
  <div class="form-group col-md-6">
    {{--Atpakaļ uz galveno prombūtnes lapu poga--}}
<a type="button" class="btn btn-outline-secondary mt-3" href="/absence">Atpakaļ</a> 
  </div>
</div>

  @endsection