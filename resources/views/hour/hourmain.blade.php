@extends('layout.app')

@section('content')
<h1>Šīs nedēļas projekti</h1>
{{--Apskatīt grafiku poga--}}
<a type="button" class="btn btn-outline-secondary" href="/schedule">Apskatīt grafiku</a> 
{{--Pievienot dienas izdarītā lapa--}}
<a type="button" class="btn btn-outline-secondary" href="hour/create">Pievienot dienas izdarīto</a>
         {{--Parādīt katras dienas izdarīto noteiktajā nedēļā--}}
        @foreach($hours as $hour)   
        <p>Datums: {{$hour->day}}</p>
        <p>Apraksts: {{$hour->description}}</p>
        <p>Nostrādātās stundas: {{$hour->hours}}</p>
        <p>Projekts: {{$hour->project_id}}</p>
         @endforeach

@endsection