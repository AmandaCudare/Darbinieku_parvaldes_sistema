@extends('layout.app')

@section('content')


<div class="my-3 p-3 bg-white rounded shadow-sm">
    <h2 class="border-bottom border-gray pb-2 mb-2">Administratora panelis</h2>
    
    <div class="d-flex justify-content-between align-items-center w-100">
        <h5 class="text-gray-dark ">Reģistrēt lietotājus</h5>
        <a class="btn btn-secondary mb-2" href="{{ route('register') }}">Reģistrēt lietotāju</a>
    </div>
    <div class="d-flex justify-content-between align-items-center w-100">
      <h5 class="text-gray-dark ">Prombūtnes pieteikumi</h5>
      <a class="btn btn-secondary mb-2" href="admin/absence">Apskatīt</a>
  </div>
  <div class="d-flex justify-content-between align-items-center w-100">
    <h5 class="text-gray-dark">Rediģēt lietotājus</h5>
    <a class="btn btn-secondary" href="admin/users">Rediģēt</a>
</div>
  </div>
  @endsection