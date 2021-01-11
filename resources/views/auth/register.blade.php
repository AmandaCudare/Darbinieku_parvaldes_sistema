{{--Registrēšanās lapa--}}
@extends('layout.app')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                <h4 class="text-center mb-4">Reģistrēšanās</h4>

                
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        {{--Vārda ievades lauks--}}
                        <div class="form-group row">
                            <label for="First_name" class="col-md-4 col-form-label text-md-right">{{ __('Vārds') }}</label>

                            <div class="col-md-6">
                                <input id="First_name" type="text" class="form-control @error('First_name') is-invalid @enderror" name="First_name" value="{{ old('First_name') }}" >

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
                                <input id="Last_name" type="text" class="form-control @error('Last_name') is-invalid @enderror" name="Last_name" value="{{ old('Last_name') }}" >

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small  class="form-text text-muted">Maksimālais simbolu skaits ir 100 un jābūt unikālai</small> 
                            </div>
                        </div>
                        {{--Paroles ievades lauks--}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Parole') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small  class="form-text text-muted">Parolei jābūt vismaz 8 simbolu gara </small> 
                            </div>
                        </div>
                        {{--Paroles apstiprināšanas ievades lauks--}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Paroles apstiprināšana') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            
                            <small  class="form-text text-muted">Paroles apstiprināšana jāsakrīt ar paroli</small> </div>
                        </div>
                        {{--slepens aktīvais lauks--}}
                        <input type="hidden" name="Active" value="1" >
                        {{--Lomas izvēlnes lauks--}}
                        <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('Loma') }}</label>

                            <div class="col-md-6">
                                 <select id="Role" class="form-control @error('Role') is-invalid @enderror" name="Role" value="{{ old('Role') }}" >
                                    <option value="2">Darbinieks</option>
                                    <option value="3">Vadītājs</option>
                                    <option value="1">Administrators</option>
                                  </select>
                                @error('Role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--Darba slodzes izvēlnes lauks--}}
                        <div class="form-group row">
                            <label for="Workload" class="col-md-4 col-form-label text-md-right">{{ __('Darba slodze') }}</label>

                            <div class="col-md-6">
                                <select id="Workload" class="form-control @error('Workload') is-invalid @enderror" name="Workload" value="{{ old('Workload') }}">
                                    <option value="1">Pilna slodze(40h nedēļā)</option> 
                                    <option value="0.75">Nepilna slodze(30h nedēļā)</option>
                                    <option value="0.5">Nepilna slodze(20h nedēļā)</option>
                                  </select>
                                @error('Workload')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--Reģistrēšanās viedlapas datu nosūtīšana--}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                   Reģistrēt
                                </button>
                            </div>
                        </div>
                    </form>
           
            </div>
        </div>
    </div>

@endsection
