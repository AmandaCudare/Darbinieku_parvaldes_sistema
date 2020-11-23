@extends('layout.app')

@section('content')

<h1>Mainīt projekta saturu</h1>


<form method="POST" action="/projects/{{$project->id}}">
    @method('PUT')
  @csrf

<div class="container">

<div class="form-group col-md-6">
  <label for="title">{{ __('Nosaukums') }}</label>
      <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"  name="title" value={{$project->title}}>
      @error('title')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

</div>

  <div class="form-group col-md-6">
        <label for="Description">{{ __('Apraksts') }}</label>
        <textarea class="form-control  @error('Description') is-invalid @enderror" type="text" id="Description" rows="3" name="Description" >{{$project->Description}}</textarea>
      @error('Description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>

  <div class="form-group col-md-6">
        <label for="start_date">Sākuma datums</label>
        <input  class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"  name="start_date" value={{$project->start_date}}>
      @error('start_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>

  <div class="form-group col-md-6">
        <label for="end_date">Beigu datums</label>
        <input  class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date" value={{$project->end_date}}>
      @error('end_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>

  <div class="form-group col-md-6">
        <label for="assign_till">Pieteikties līdz</label>
        <input  class="form-control @error('assign_till') is-invalid @enderror" type="date" id="assign_till" name="assign_till" value={{$project->assign_till}}>
      @error('assign_till')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>

    </div> 
    <button type="submit" class="btn btn-primary">
      {{ __('Saglabāt izmaiņas') }}
  </button>

  </form>
</div>
  

  @endsection