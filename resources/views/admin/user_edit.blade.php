@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Rediģēšana</div>

                <div class="card-body">
                    <form method="POST" action="/admin/users/{{$user->id}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="First_name" class="col-md-4 col-form-label text-md-right">{{ __('Vārds') }}</label>

                            <div class="col-md-6">
                                <input id="First_name" type="text" class="form-control @error('First_name') is-invalid @enderror" name="First_name" value="{{$user->First_name}}" autofocus>

                                @error('First_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Last_name" class="col-md-4 col-form-label text-md-right">{{ __('Uzvārds') }}</label>

                            <div class="col-md-6">
                                <input id="Last_name" type="text" class="form-control @error('Last_name') is-invalid @enderror" name="Last_name" value="{{$user->Last_name}}"  autofocus>

                                @error('Last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                {{--<input id="Role" type="text" class="form-control @error('Role') is-invalid @enderror" name="Role" value="{{ old('Role') }}" required autocomplete="Role" autofocus>--}}
                                <select id="Role" class="form-control @error('Role') is-invalid @enderror" name="Role" value="{{$user->Role }}" autofocus>
                                    <option value="2">Darbinieks</option>
                                    <option value="3">Vadītājs</option>
                                    <option value="1">Administrators</option>
                                  </select>
                                @error('Role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Workload" class="col-md-4 col-form-label text-md-right">{{ __('Workload') }}</label>

                            <div class="col-md-6">
                                <input id="Workload" type="text" class="form-control @error('Workload') is-invalid @enderror" name="Workload" value="{{ $user->Workload }}"  autofocus>

                                @error('Workload')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Saglabāt izmaiņas') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
