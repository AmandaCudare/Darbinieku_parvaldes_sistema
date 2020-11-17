

@if(count($positions)>0)

        <table class="table">
            <thead>
              <tr>
                <th>Amats</th>
                <th>Amatu skaits</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>@foreach($positions as $position)
             
              <tr>
                <td>{{ $position->name}}</td>
                <td>{{ $position->people_count}}</td>
                <td> 
                  <div class="container">
                    <div class="row">
                      <div class="col-12 col-md-3">
                        {{--Ja nav neviens pieteicis kādam amatam projektā--}}
                        @if(count($position->user_positions) == 0)
                        <form method="post" action="{{ route('user_position.add') }}">
                          @csrf
                      <input type="hidden" name="position_id" value="{{ $position->id }}" >
                      <input type="submit" class="btn btn-outline-secondary" value="Pieteikties" >
                      </form>
                      @endif
                      {{-- Pieteikšanās amatam pogas vai status--}}
        @foreach($position->user_positions as $uposition)                
    @if($uposition->assigned == false &&  $uposition->accepted== false)
    <form method="post" action="{{ route('user_position.add') }}">
        @csrf
    <input type="hidden" name="position_id" value="{{ $position->id }}" >
    <input type="submit" class="btn btn-outline-secondary" value="Pieteikties" >
    </form>
    @elseif($uposition->assigned == true &&  $uposition->accepted == false)
    <p> Status: Pieteicies</p>
    @else
    <p> Status: Pieņemts</p>
    @endif
                      </div>
                      <div class="col-12 col-md-9">
<input  type="submit" class="btn btn-outline-danger" value="X">
                      </div>
                    </div></div>
                </td>
              </tr>@endforeach
              @endforeach 
            </tbody>
          </table>
    
</div>

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
