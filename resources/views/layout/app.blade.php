<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
    <title> DPS</title>
   
    </head>
       <body>
           <header>
@include('inc.navbar')
</header>
<main role="main" class="container">
            @include('inc.messages')
@yield('content')  
</main>
<div class="container-fluid">
<footer class="footer row justify-content-md-center">
  
  <p>Ja ir vajadzība sazināties ar Administratoru
  E-pasts: Admin@info.lv</p>
</footer>
</div>
         
    </body>
</html>
