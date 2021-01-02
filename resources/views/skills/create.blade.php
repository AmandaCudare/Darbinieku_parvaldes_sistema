<div class="mt-5">
  <div class="col-md-6">
<h4>Izveidot prasmi</h4>
  </div>
{{--prasmes izveidošanas veidlapa --}}
<form method="POST" action="/skills">
  @csrf
{{--Prasmes nosaukuma aizpildes lauks, kuram jau ir noteiktas prasmes informācija--}}
<div class="form-group col-md-6">
  <label for="name">Nosaukums</label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" >
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
      <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
</div>
<div class="col-md-6">
   {{-- Poga, lai nosutītu informaciju uz SkillsController store funckiju--}} 
    <button type="submit" class="btn btn-outline-secondary mb-5">
     Pievienot prasmi
  </button>
</div>
  </form>
</div>
  

 