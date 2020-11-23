@extends('layout.app')

@section('content')
<div class="container">
<h1>Prasmes</h1>

@if(count($skills)>0)
<div class="row mt-3">
<div class="col col-lg-2">

     <ul class="list-group" >
       @foreach($skills as $skill)
       <li class="list-group-item">
         • {{$skill->name}}
        
      <a type="button" class="btn btn-warning" href="/skills/{{$skill->id}}/edit">Rediģēt</a> 
       
      <form action="/absence/{{$skill->id}}" method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" class="btn btn-danger" value="Dzēst" />
      </form>
        
      </li>
    @endforeach
  </ul>
            

  </div></div>

@else 
<div class="row mt-2">
<h4>Patreiz nav prasmes</h4>
</div>
@endif
 @include('skills.create')

</div>

@endsection
