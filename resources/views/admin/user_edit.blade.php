{{--Lietotāja rediģēšanas lapa--}}
@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <h4 class="text-center mb-4">Rediģēšana</h4>

                
                    <form method="POST" action="/admin/users/{{$user->id}}">
                        @csrf
                        @method('PUT')
                        {{--Vārda ievades lauks--}}
                        <div class="form-group row">
                            <label for="First_name" class="col-md-4 col-form-label text-md-right">{{ __('Vārds') }}</label>
                                 <div class="col-md-6">
                                <input id="First_name" type="text" class="form-control @error('First_name') is-invalid @enderror" name="First_name" value="{{$user->First_name}}" autofocus>

                                @error('First_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
                            </div>
                        </div>
                        {{--Uzvārda ievades lauks--}}
                        <div class="form-group row">
                            <label for="Last_name" class="col-md-4 col-form-label text-md-right">{{ __('Uzvārds') }}</label>

                            <div class="col-md-6">
                                <input id="Last_name" type="text" class="form-control @error('Last_name') is-invalid @enderror" name="Last_name" value="{{$user->Last_name}}"  autofocus>

                                @error('Last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100</small> 
                            </div>
                        </div>
                        {{--Epasta ievades lauks--}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-pasta Adrese') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100 un jābūt unikālai</small> 
                            </div>
                        </div>
                        {{--Darba slodzes ievades lauks--}}
                        <div class="form-group row">
                            <label for="Workload" class="col-md-4 col-form-label text-md-right">{{ __('Darba slodze') }}</label>

                            <div class="col-md-6">
                                <select id="Workload" class="form-control @error('Workload') is-invalid @enderror" name="Workload" required autocomplete="Workload" autofocus>
                                    @if($user->Workload == 1.0)
                                    <option value="1">Pilna slodze(40h nedēļā)</option> 
                                    <option value="0.75">Nepilna slodze(30h nedēļā)</option>
                                    <option value="0.5">Nepilna slodze(20h nedēļā)</option>
                                    @elseif($user->Workload == 0.75)
                                   <option value="0.75">Nepilna slodze(30h nedēļā)</option> 
                                   <option value="1">Pilna slodze(40h nedēļā)</option> 
                                    <option value="0.5">Nepilna slodze(20h nedēļā)</option>
                                    @else
                                   <option value="0.5">Nepilna slodze(20h nedēļā)</option>
                                   <option value="0.75">Nepilna slodze(30h nedēļā)</option> 
                                   <option value="1">Pilna slodze(40h nedēļā)</option> 
                                    @endif
                                  </select>
                                @error('Workload')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Saglabāt izmaiņas') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <a type="button" class="btn btn-outline-secondary mt-3" href="/admin/users">Atpakaļ</a>  
            </div>
        </div>
  </div>

@endsection
