@extends('layout.app')

@section('content')
@if(count($users)>0)
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="well">
        <table class="table table-bordered">
            <h4>Prombūtnes pieteikumi</h4>
            <thead>
            <tr>
              <th>Lietotāja vārds</th>
              <th>Lietotāja uzvārds</th>
              <th></th>
              <th></th>
            </tr>
        </thead>
        <tbody>
        
            @foreach($users as $user)
                <tr>
                    <td><p>{{$user->First_name}}</p></td>
                    <td><p>{{$user->Last_name}}</p></td>
                <td>
                    <a href="/admin/users/{{$user->id}}/edit" class="btn btn-warning">Rediģēt</a>
                </td>
                <td>
                    <form method="POST" action="/admin/users/{{$user->id}}/deactivate">
                        @csrf
                        @method('PUT')
                    <input type="submit" class="btn btn-outline-secondary" value="Deaktivizēt" >
                    </form>
                </td>
                </tr>
            @endforeach
                </div>  
       </div>
    @else 
    <h4> Nav lietotāju</h4>
       @endif

@endsection