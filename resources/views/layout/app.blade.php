<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
    <title> DPS</title>
   
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
    </head>
       <body>
           <header>
@include('inc.navbar')
</header>
<main role="main" class="container">
            @include('inc.messages')
@yield('content')  
</main>

<footer class="footer row justify-content-md-center">
  
  <p>Ja ir vajadzība sazināties ar Administratoru
  E-pasts: Admin@info.lv</p>
</footer>

         
    </body>
</html>
