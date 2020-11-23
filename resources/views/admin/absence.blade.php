@extends('layout.app')

@section('content')

<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="well">
        <table class="table table-bordered">
            <h4>Prombūtnes pieteikumi</h4>
            <thead>
            <tr>
              <th>Lietotāja vārds</th>
              <th>Lietotāja uzvārds</th>
              <th>Lietotāja epasts</th>
              <th>Iemesls</th>
              <th>Sākuma datums</th>
              <th>Beigu datums</th>
              <th></th>
              <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $user)
                @foreach($user->absence as $absence)
                <tr>
                    <td><p>{{$user->first_name}}</p></td>
                    <td><p>{{$user->last_name}}</p></td>
                    <td><p>{{$user->email}}</p></td>
                    <td><p>{{$absence->reason}}</p></td>
                    <td><p>{{$absence->start_date}}</p></td>
                    <td><p>{{$absence->end_date}}</p></td>
                <td><a type="button" class="btn btn-outline-secondary" href="#">Apskatīt projektu</a> </td>
                </tr>
            @endforeach
                </div>  
        @endif
    @endif
</div>
@endsection