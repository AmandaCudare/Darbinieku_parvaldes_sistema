@extends('layout.app')

@section('content')


<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h6 class="border-bottom border-gray pb-2 mb-2">Administratora panelis</h6>
    
    <div class="d-flex justify-content-between align-items-center w-100">
        <h4 class="text-gray-dark">Reģistrēt lietotājus</h4>
        {{--<a class="btn btn-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    </div>
    <div class="d-flex justify-content-between align-items-center w-100">
      <h4 class="text-gray-dark">Prombūtnes pieteikumi</h4>
      <a class="btn btn-secondary" href="admin/absence">Apskatīt</a>
  </div>
  <div class="d-flex justify-content-between align-items-center w-100">
    <h4 class="text-gray-dark">Rediģēt lietotājus</h4>
    <a class="btn btn-secondary" href="admin/users">Rediģēt</a>
</div>
  </div>
  @endsection