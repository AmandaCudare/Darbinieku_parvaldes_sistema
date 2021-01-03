{{--Prasmju galvenā lapa--}}
@extends('layout.app')

@section('content')

  <div class="my-3 p-3 bg-white rounded shadow-sm"> 
<h1>Prasmes</h1>
{{--Parbauda vai ir vismaz viena prasme--}}
@if(count($skills)>0)

     <ul class="list-group" >
      {{--No masīva izņem individuali katru prasmi--}}
       @foreach($skills as $skill)
       <div class="row mb-3">
        <div class="col-md-7 themed-grid-col"><li class="list-group-item">
          {{--Prasmes nosaukums--}}
        <h5> {{$skill->name}}</h5>
        
        </li></div>
        <div class="col-sm-1 themed-grid-col">
          {{--Prasmes rediģēšanas poga--}}
          <a type="button" class="btn btn-warning" href="/skills/{{$skill->id}}/edit">Rediģēt</a> 
       </div>
        <div class="col-sm-3 themed-grid-col">
          {{--Prasmes dzēšanas poga--}}
          <form action="/skills/{{$skill->id}}" method="POST">
      @csrf
      @method('DELETE')
      <input type="submit" class="btn btn-danger" value="Dzēst" />
      </form>
        </div>
      </div>
       
    @endforeach
  </ul>
   {{--Ja nav lietotājam nevienas prasmes, tad parādīs šo tekstu--}}         
@else 
<div class="mt-4 col-12" >
<h5>Patreiz nav prasmes</h5>
</div>
@endif
{{--Šeit ir create.blade.php daļa ievieto šajā lapā--}}
 @include('skills.create')
  </div>

@endsection
