

@if(count($positions)>0)
@foreach($positions as $position)
<div class="display-comment">
    <p>{{ $position->name}}</p>
</div>
@endforeach 
@else 
<p>no positions </p>
@endif

{{--
<h1>Izveidot amatu</h1>
<body class="text-center">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="/projects/{{$project_id}}">
  @csrf


<div class="form-group row">
  <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Amats') }}</label>

  <div class="col-md-6">
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" >

      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
  </div>
</div>

</div> 
<button type="submit" class="btn btn-primary">
  {{ __('Pievienot amatu') }}
</button>

</form>--}}
{{--</body>--}}
