<div class="container">
  
<h4>Izveidot prasmi</h4>
{{--prasmes izveidošanas veidlapa --}}
<form method="POST" action="/skills">
  @csrf
{{--Prasmes nosaukuma aizpildes lauks, kuram jau ir noteiktas prasmes informācija--}}
<div class="form-group col-md-6">
  <label for="name">{{ __('Nosaukums') }}</label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" >
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

</div>
   {{-- Poga, lai nosutītu informaciju uz SkillsController store funckiju--}} 
    <button type="submit" class="btn btn-outline-secondary">
      {{ __('Pievienot prasmi') }}
  </button>

  </form>
</div>
  

 