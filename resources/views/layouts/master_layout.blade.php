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
    <!--<link rel="stylesheet" href="{{Asset('myprintcss/flick.min.css')}}">-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity-fullscreen@1/fullscreen.css">
    <link rel="stylesheet" href="{{Asset('myprintcss/myPrintStyle.css')}}">
    
    
    <!-- Add the slick-theme.css if you want default styling -->
    <!--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>-->
    <!-- Add the slick-theme.css if you want default styling -->
    <!--<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>-->

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

        <footer class="copyright">2021 &copy; <span>Fatoni to MyPrint Advertising</span></footer>
      </div>
        <br>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{Asset('js/app.js')}}"></script>
    <!--<script src="{{Asset('myprintcss/flick.pkgd.min.js')}}"></script>-->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <script src="https://unpkg.com/flickity-fullscreen@1/fullscreen.js"></script>
    

    <!--<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>-->
    <!-- <script> -->
    @yield('script')
    <!-- </script> -->
  </body>
</html>