<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0"/> -->
    
    @yield('head')

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{Asset('css/app.css')}}">
    <!-- my css style -->
    <link rel="stylesheet" href="{{Asset('myprintcss/myPrintStyle.css')}}">

    <!-- My font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    
    <title>MyPrint Advertising</title>
  </head>
  <body>
    <div class="container-fluid">
        <!-- this is slider -->
       @yield('body')
       <br>
      <div class="d-flex justify-content-center">

        <footer class="copyright">&copy; 2021 by <span> MyPrint Advertising</span></footer>
      </div>
        <br>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{Asset('js/app.js')}}"></script>
  </body>
</html>