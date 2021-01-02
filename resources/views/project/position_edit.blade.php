{{--Amata rediģēšanas lapa--}}
@extends('layout.app')

@section('content')

<h4 class="mb-3">Rediģēt Amatu</h4>

<form method="post" action="/projects/positions/{{$position->id}}">
    @method('PUT')
            @csrf
            
                {{--Amata nosaukuma ievades logs--}}
                        <div class="form-group col-md-6">
                            <label class="label">Amata nosaukums</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" value={{$position->name}}>
                      
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
                        </div>
                        
                {{--Amatam cilvēku skaits ievades logs--}}
                <div class="form-group col-md-6">
                            <label class="label">Amatam cilvēku skaits</label>
                            <input id="people_count" type="text" class="form-control @error('people_count') is-invalid @enderror"  name="people_count" value={{$position->people_count}}>
                      
                            @error('people_count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small  class="form-text text-muted">Amata cilvēku skaitam ir jabūt lielākam par 0</small> 
                        </div>
           
                        <div class="form-group col-md-6">
                <input type="submit" class="btn btn-outline-secondary" value="Saglabāt izmaiņas" />
                        </div>

</form>

@endsection