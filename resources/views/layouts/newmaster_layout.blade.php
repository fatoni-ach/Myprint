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
    <link rel="stylesheet" href="{{Asset('css/flickity.css')}}">
    <link rel="stylesheet" href="{{Asset('css/Mystyle.css')}}">
    <link rel="stylesheet" href="{{Asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{Asset('css/fullscreen.css')}}">

    <!-- My font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    
    <title>MyPrint Advertising</title>
  </head>
  <body style="background-color: #ecf0f1;">
    @yield('body')
    <br>
    <section class="d-flex justify-content-center my-2" style="background-color: none">
        <div class="width-mobile d-flex justify-content-center">
            <footer class="copyright">2021 &copy; <span class="text-primary">Fatoni </span>to MyPrint Advertising</footer>
        </div>
    </section>

    <!-- My javascripts -->
    <script>
    @yield('script')
    </script>
    <script src="{{Asset('js/app.js')}}"></script>
    <script src="{{Asset('js/flickity.pkgd.js')}}"></script>
    <script src="{{Asset('js/fullscreen.js')}}"></script>

    

    @yield('script')
  </body>
</html>