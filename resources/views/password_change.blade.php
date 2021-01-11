{{--Paroles maiņas lapa--}}
@extends('layout.app')
@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm"> 
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="text-center mb-4">Paroles maiņa</h4>

        <form method="POST" action="/password/store">
            @csrf
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
                <small class="form-text text-muted">Parolei jābūt vismaz 8 simbolu garai un jāsakrīt ar Paroles apstiprināšanu</small>
            </div>
        </div>
        {{--Paroles apstiprināšanas ievades lauks--}}
        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Paroles apstiprināšana') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-secondary">
                    {{ __('Mainīt paroli') }}
                </button>
            </div>
        </div>
        </form>
    

{{--Profila poga--}}
<div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
<a type="button" class="btn btn-outline-secondary mt-4" href="/profile">Atpakaļ</a> 
</div>
</div>
</div>
    </div>
</div>

@endsection