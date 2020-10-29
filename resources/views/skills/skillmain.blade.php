@extends('layout.app')

@section('content')
<h1>Prasmes</h1>
<button type="button" class="btn btn-dark row mt-2">Pievienot prasmi</button>
@if(count($skills)>0)

<div class="row mt-3">
 @foreach($skills as $skill)
     <ul class="list-group" >
      <li class="list-group-item">{{$skill->name}}</li>
    </ul>
            @endforeach

  </div>
@else 
<div class="row mt-2">
<h4>Patreiz nav prasmes</h4>
</div>
@endif




@endsection
