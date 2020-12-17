@extends('layout.app')

@section('content')
<h1>Šīs nedēļas projekti</h1>
{{--Apskatīt grafiku poga--}}
<a type="button" class="btn btn-outline-secondary" href="/schedule">Apskatīt grafiku</a> 
{{--Pievienot dienas izdarītā lapa--}}
<a type="button" class="btn btn-outline-secondary" href="hour/create">Pievienot dienas izdarīto</a>
         {{--Parādīt katras dienas izdarīto noteiktajā nedēļā--}}
         
         @foreach($hours as $hour)  
         <div class="my-3 p-3 bg-white rounded shadow-sm"> 
        <h4>Datums: {{$hour->day}}</h4>
        <p>Apraksts: {{$hour->description}}</p>
        <p>Nostrādātās stundas: {{$hour->hours}}</p>
        <p>Projekts: {{$hour->project_id}}</p>
         
         <div class="col-md-2 themed-grid-col">
            <a href="/hour/{{$hour->id}}/edit" class="btn btn-warning">Rediģēt</a>
        </div>

        <div class="col-md-2 themed-grid-col">
            <form action="/hour/{{$hour->id}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Dzēst" />
        </form>
        </div>
         </div>
        @endforeach
@endsection