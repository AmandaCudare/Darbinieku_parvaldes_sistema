@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="First_name" class="col-md-4 col-form-label text-md-right">{{ __('Vārds') }}</label>

                            <div class="col-md-6">
                                <input id="First_name" type="text" class="form-control @error('First_name') is-invalid @enderror" name="First_name" value="{{ old('First_name') }}" required autocomplete="First_name" autofocus>

                                @error('First_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Last_name" class="col-md-4 col-form-label text-md-right">{{ __('Uzvārds') }}</label>

                            <div class="col-md-6">
                                <input id="Last_name" type="text" class="form-control @error('Last_name') is-invalid @enderror" name="Last_name" value="{{ old('Last_name') }}" required autocomplete="Last_name" autofocus>

                                @error('Last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-pasta Adrese') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Parole') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Paroles apstiprināšana') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <input type="hidden" name="Active" value="1" >

                        <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('Loma') }}</label>

                            <div class="col-md-6">
                                {{--<input id="Role" type="text" class="form-control @error('Role') is-invalid @enderror" name="Role" value="{{ old('Role') }}" required autocomplete="Role" autofocus>--}}
                                <select id="Role" class="form-control @error('Role') is-invalid @enderror" name="Role" value="{{ old('Role') }}" required autocomplete="Role" autofocus>
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

                        <div class="form-group row">
                            <label for="Workload" class="col-md-4 col-form-label text-md-right">{{ __('Darba slodze') }}</label>

                            <div class="col-md-6">
                                <select id="Workload" class="form-control @error('Workload') is-invalid @enderror" name="Workload" value="{{ old('Workload') }}" required autocomplete="Workload" autofocus>
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
                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
