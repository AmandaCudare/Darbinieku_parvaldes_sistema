@extends('layout.app')

@section('content')
<div class="container">
<h1>Prasmes</h1>

@if(count($skills)>0)



     <ul class="list-group" >
       @foreach($skills as $skill)
       <div class="row mb-3">
        <div class="col-md-7 themed-grid-col"><li class="list-group-item">
         • {{$skill->name}}
        </li></div>
        <div class="col-md-1 themed-grid-col">
          <a type="button" class="btn btn-warning" href="/skills/{{$skill->id}}/edit">Rediģēt</a> 
       </div>
        <div class="col-md-2 themed-grid-col">
          <form action="/skills/{{$skill->id}}" method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" class="btn btn-danger" value="Dzēst" />
      </form>
        </div>
      </div>
       
      
      
        
      
    @endforeach
  </ul>
            

 

@else 
<div class="row mt-2">
<h4>Patreiz nav prasmes</h4>
</div>
@endif
 @include('skills.create')

</div>

@endsection
