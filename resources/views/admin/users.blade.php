{{--Lietotājus rediģēšana, dzēšana un lomas maiņa lapa--}}
@extends('layout.app')

@section('content')
@if(count($users)>0)
<div class="my-3 p-3 bg-white rounded shadow-sm">
    <div class="well">
        <table class="table table-bordered">
            <h4>Lietotājus rediģēšana, dzēšana un lomas maiņa</h4>
            <thead>
            <tr>
              <th>Lietotāja vārds</th>
              <th>Lietotāja uzvārds</th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
        </thead>
        <tbody>
        
            @foreach($users as $user)
                <tr>
                    <td><p>{{$user->First_name}}</p></td>
                    <td><p>{{$user->Last_name}}</p></td>
                    {{--Lietotāja rediģēšanas poga--}}
                <td>
                    <a href="/admin/users/{{$user->id}}/edit" class="btn btn-warning">Rediģēt</a>
                </td>
                {{--Lietotāja deaktivizācijas poga--}}
                <td>
                    @if($user->id!= Auth::id())
                    <form method="POST" action="/admin/users/{{$user->id}}/deactivate">
                        @csrf
                        @method('PUT')
                    <input type="submit" class="btn btn-outline-secondary"  onclick="return confirm('Vai tiešām vēlaties deaktivizēt lietotāju?')" value="Deaktivizēt" >
                    </form>
                    @endif
                </td>
                {{--Lomas maiņas poga--}}
                <td>
                @if($user->Role== '2')
                    <a href="/admin/users/{{$user->id}}/role" onclick="return confirm('Vai vēlaties nomainīt lomu?')" class="btn btn-warning">Lomas maiņa uz vadītaju</a>
                @endif
            </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div> 
    @else 
    <h4> Nav lietotāju</h4>
       @endif

       <a type="button" class="btn btn-outline-secondary" href="/admin">Atpakaļ</a>  

 </div>
@endsection