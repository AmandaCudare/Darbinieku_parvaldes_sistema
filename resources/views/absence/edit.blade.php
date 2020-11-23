@extends('layout.app')

@section('content')

<h3>Mainīt prombutnes pieteikuma datus</h3>



<form method="POST" action="/absence/{{$absence->id}}">
    @method('PUT')
  @csrf

<div class="container">

<div class="form-group col-md-6">
  <label for="reason">{{ __('Iemesls') }}</label>
      <input id="reason" type="text" class="form-control @error('reason') is-invalid @enderror"  name="reason" value={{$absence->reason}}>
      @error('reason')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

</div>

  <div class="form-group col-md-6">
        <label for="start_date">Sākuma datums</label>
        <input  class="form-control @error('start_date') is-invalid @enderror" type="date" id="start_date"  name="start_date" value={{$absence->start_date}}>
      @error('start_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
      @enderror
  </div>

  <div class="form-group col-md-6">
        <label for="end_date">Beigu datums</label>
        <input  class="form-control @error('end_date') is-invalid @enderror" type="date" id="end_date" name="end_date" value={{$absence->end_date}}>
      @error('end_date')
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