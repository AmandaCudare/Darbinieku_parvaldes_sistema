<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> DPS</title>
    </head>
       <body>
@include('inc.navbar')
           <div class="container">
            @include('inc.messages')
@yield('content')     
           </div>
    </body>
</html>
