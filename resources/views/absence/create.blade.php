@extends('layout.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/absence">
  @csrf

<div class="container">
  <div class="form-group col-md-6">
    <label for="reason">{{ __('Iemesls') }}</label>
        <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror"  name="reason" >
        @error('reason')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
  
  </div>
  <div class="form-group col-md-6">
    <label for="start_date">Sākuma datums</label>
    <input  class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"  name="start_date">
  @error('start_date')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<div class="form-group col-md-6">
    <label for="end_date">Beigu datums</label>
    <input  class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date">
  @error('end_date')
  <div class="alert alert-danger">{{ $message }}</div>
  @enderror
</div>

<button type="submit" class="btn btn-primary">
  {{ __('Izveidot') }}
</button>
</div>
  </form>

  @endsection