<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', "Title")</title>

     <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{config('notika.icon')}}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- owl.carousel CSS
		============================================ -->
    <link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">

    <link href="{{ asset('css/owl.theme.css') }}" rel="stylesheet">

    <link href="{{ asset('css/owl.transitions.css') }}" rel="stylesheet">
    <!-- meanmenu CSS
		============================================ -->
    <link href="{{ asset('css/meanmenu/meanmenu.min.css') }}" rel="stylesheet">
    
    <!-- animate CSS
		============================================ -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <!-- normalize CSS
		============================================ -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link href="{{ asset('css/scrollbar/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet">
    <!-- jvectormap CSS
		============================================ -->
    <link href="{{ asset('css/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet">
    <!-- notika icon CSS
		============================================ -->
    <link href="{{ asset('css/notika-custom-icon.css') }}" rel="stylesheet">
    <!-- wave CSS
		============================================ -->
    <link href="{{ asset('css/wave/waves.min.css') }}" rel="stylesheet">
    <!-- main CSS
		============================================ -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- style CSS
		============================================ -->
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <!-- responsive CSS
		============================================ -->
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

     <link href="{{ asset('css/style.css') }}" rel="stylesheet">

     @yield('css')

    <!-- modernizr JS
		============================================ -->
    <script src="{{asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>

</head>

<body>

 <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                       <h3 class="title">{{config('notika.title')}}</h3>
                    </div>
                </div>
                @if (config('notika.default-header-widgets'))
                         @include('template.header-widgets')
                @endif
       
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    
    <!-- Main Menu area start-->
   
   @include('template.menu')

    {{-- Status Area/Header Area Of Content --}}

     {{-- <div class="notika-status-area">
        <div class="container">
            <div class="row">
                @yield('content-header')
                </div>
        </div>
    </div> --}}

    {{-- End Status Area/Header Area Of Content --}}




    {{-- content --}}


    @yield('content')

    {{-- End Content --}}


   {{--  Footer --}}

   <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                    @yield('footer')
                    </div>
                </div>
            </div>
        </div>
    </div>

     {{--End Footer --}}


     {{-- Javascript --}}

    <script src="{{asset('js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{asset('js/jquery-price-slider.js')}}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <script src="{{asset('js/jquery-price-slider.js')}}"></script>
<!-- scrollUp JS
    ============================================ -->
    <script src="{{asset('js/jquery.scrollUp.min.js')}}"></script>
<!-- meanmenu JS
    ============================================ -->
    <script src="{{asset('js/meanmenu/jquery.meanmenu.js')}}"></script>
<!-- counterup JS
    ============================================ -->

    <script src="{{asset('js/counterup/jquery.counterup.min.js')}}"></script>

    <script src="{{asset('js/counterup/waypoints.min.js')}}"></script>

    <script src="{{asset('js/counterup/counterup-active.js')}}"></script>
<!-- mCustomScrollbar JS
    ============================================ -->
    <script src="{{asset('js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- jvectormap JS
    ============================================ -->
    <script src="{{asset('js/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>

    <script src="{{asset('js/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <script src="{{asset('js/jvectormap/jvectormap-active.js')}}"></script>
<!-- sparkline JS
    ============================================ -->
    <script src="{{asset('js/sparkline/jquery.sparkline.min.js')}}"></script>

    <script src="{{asset('js/sparkline/sparkline-active.js')}}"></script>
<!-- sparkline JS
    ============================================ -->

    <script src="{{asset('js/flot/jquery.flot.js')}}"></script>

    <script src="{{asset('js/flot/jquery.flot.resize.js')}}"></script>

    <script src="{{asset('js/flot/curvedLines.js')}}"></script>

    <script src="{{asset('js/flot/flot-active.js')}}"></script>
<!-- knob JS
    ============================================ -->
    <script src="{{asset('js/knob/jquery.knob.js')}}"></script>

    <script src="{{asset('js/knob/jquery.appear.js')}}"></script>

    <script src="{{asset('js/knob/knob-active.js')}}"></script>
<!--  wave JS
    ============================================ -->
    <script src="{{asset('js/wave/waves.min.js')}}"></script>

    <script src="{{asset('js/wave/wave-active.js')}}"></script>
<!--  todo JS
    ============================================ -->
    <script src="{{asset('js/todo/jquery.todo.js')}}"></script>
<!-- plugins JS
    ============================================ -->
    <script src="{{asset('js/plugins.js')}}"></script>
<!--  Chat JS
    ============================================ -->
    <script src="{{asset('js/chat/moment.min.js')}}"></script>

    <script src="{{asset('js/chat/jquery.chat.js')}}"></script>
<!-- main JS
    ============================================ -->
    <script src="{{asset('js/main.js')}}"></script>
<!-- tawk chat JS
    ============================================ -->
    {{-- <script src="{{asset('js/tawk-chat.js')}}"></script> --}}


    @yield('javascript')

     {{-- End Of Javascript --}}

</body>
</html>