@extends('layout.app')

@section('content')
{{--Sākuma lapa--}}
 <main role="main" class="inner cover">
    <h1 class="cover-heading">Mājas lapas sākuma lapa</h1>
    {{--Autentifikācijas poga--}}
    <p class="lead">
      <a href="{{ route('login') }}" class="btn btn-lg btn-secondary">Autentifikācija</a>
    </p>
  </main>

  @endsection