<div class="container">
  
<h4>Izveidot prasmi</h4>

<form method="POST" action="/skills">
  @csrf



<div class="form-group col-md-6">
  <label for="name">{{ __('Nosaukums') }}</label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" >
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror

</div>
   
    <button type="submit" class="btn btn-primary">
      {{ __('Pievienot prasmi') }}
  </button>

  </form>
</div>
  

 