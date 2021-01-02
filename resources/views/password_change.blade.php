{{--Paroles maiņas lapa--}}
@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Paroles maiņa</div>

                <div class="card-body">
<form method="POST" action="/password/store">
    @csrf
    {{--Paroles ievades lauks--}}
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
</div>
</div>
</div>
</div>
</div>
@endsection