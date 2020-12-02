@extends('layout.app')

@section('content')

<h4>Rediģēt Amatu</h4>

<form method="post" action="/projects/positions/{{$position->id}}">
    @method('PUT')
            @csrf
    <div class="form-inline mb-2">
            <div class="form-group">
                        <div class="col-md-6">
                            <label class="label">Amata nosaukums</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value={{$position->name}}>
                      
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="label">Amatam cilvēku skaits</label>
                            <input id="people_count" type="text" class="form-control @error('people_count') is-invalid @enderror"  name="people_count" value={{$position->people_count}}>
                      
                            @error('people_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-outline-secondary" value="Saglabāt izmaiņas" />
            </div>
</div>
</form>

@endsection