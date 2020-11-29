@extends('layout.app')

@section('content')

<h3>Mainīt prasmi</h3>
{{--prasmes rediģesanas veidlapa --}}
<form method="POST" action="/skills/{{$skill->id}}">
    @method('PUT')
  @csrf

<div class="container">
{{--Prasmes nosaukuma aizpildes lauks, kuram jau ir noteiktas prasmes informācija--}}
<div class="form-group col-md-6">
  <label for="name">{{ __('Prasme') }}</label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value={{$skill->name}}>
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

</div>
    </div>
    {{-- Poga, lai nosutītu informaciju uz SkillsController update funckiju--}} 
    <button type="submit" class="btn btn-primary">
      {{ __('Saglabāt izmaiņas') }}
  </button>

  </form>
</div>
  

  @endsection