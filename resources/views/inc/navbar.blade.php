{{--navigācijas josla--}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">

  <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" >DPS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        @guest

             <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
             </li>
     
       

           @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
             @endif
 
       @else 
       @if (Auth::user()->Role == '1')
       <li class="nav-item ">
        <a class="nav-link" href="/admin">Adminstratora panelis</a>
     </li> 
      @endif
@if (Auth::user()->Role == '2' || Auth::user()->Role == '3')
            <li class="nav-item ">
               <a class="nav-link" href="/hour">Stundas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/absence">Prombūtne</a>
          </li>
            <li class="nav-item">
                <a class="nav-link" href="/skills">Prasmes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="/projects">Projekts</a>
            </li>
       @endif
            
        <!-- Authentication Links -->
      
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->First_name }}
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/profile">
              Profile
          </a>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>
          </div>
      </li>
           
        @endguest
    </ul>
    </div>
  </nav>
 
</div>
</body>
</html>