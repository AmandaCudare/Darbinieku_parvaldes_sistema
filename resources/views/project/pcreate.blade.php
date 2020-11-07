@extends('layout.app')

@section('content')

<h1>Izveidot projektu</h1>
{{--<body class="text-center">--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/projects">
  @csrf
{{--Amats--}}

<div class="form-group row">
  <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Nosaukums') }}</label>

  <div class="col-md-6">
      <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"  name="title" >

      @error('title')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
</div>

  <div class="form-group col-md-6">
        <label for="Description">{{ __('Apraksts') }}</label>
        <textarea class="form-control  @error('Description') is-invalid @enderror" type="text" id="Description" rows="3" name="Description" ></textarea>
      @error('Description')
      <div class="alert alert-danger">{{ $message }}</div>
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

  <div class="form-group col-md-6">
        <label for="assign_till">Pieteikties līdz</label>
        <input  class="form-control @error('assign_till') is-invalid @enderror" type="date" id="assign_till" name="assign_till">
      @error('assign_till')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
  </div>

    </div> 
    <button type="submit" class="btn btn-primary">
      {{ __('Pievienot projektu') }}
  </button>

  </form>
{{--</body>--}}
  @endsection