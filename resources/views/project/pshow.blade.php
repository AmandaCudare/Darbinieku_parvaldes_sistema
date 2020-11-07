@extends('layout.app')

@section('content')

<h1>{{$project->title}}</h1>
<div class='container'>
        <p>{{$project->Description}}</p>
        <p>{{$project->start_date}}</p></td>
        <p>{{$project->end_date}}</p>
        <p>{{$project->assign_till}}</p>
</div>

<div class="card-body">
        <h5>Amati</h5>
    
        @include('project.position', [ 'positions' => $positions])

        
       </div>

@if (Auth::user()->Role == '3')
<div class="card-body">
        <h5>Pievienot amatus</h5>
        <form method="post" action="{{ route('position.add') }}">
            @csrf
            <div class="form-group">
                
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Amats') }}</label>
                      
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"  name="name" />
                      
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      
                <input type="hidden" name="project_id" value="{{ $project->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Pievienot amatu" />
            </div>
        
       </div>
@endif
<a type="button" class="btn btn-outline-secondary" href="/projects">Atpakaļ</a> 
@endsection