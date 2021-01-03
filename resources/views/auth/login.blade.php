{{--Autentificēšanās lapa--}}
@extends('layout.app')

@section('content')
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
    <div class="row justify-content-center">
        <div class="col-md-8">
                <h4 class="text-center mb-4">Autentificēšanās</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        {{--Epasta adreses ievades lauks--}}
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-pasta adrese') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--Paroles ievades lauks--}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Parole') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{--Ievades datu atcerēšanās poga--}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Atcerēties mani') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        {{--Autentificēšanās poga--}}
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('Autentificēties') }}
                                </button>
                                {{--Ja reģistrēts lietotājs aizmirst paroli--}}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Aizmirsāt paroli?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
