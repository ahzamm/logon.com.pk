<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
@yield('metainfo')
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title','Logon BroadBand')</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
<!-- Stylesheets -->
<link href="{{asset('site/css/font-awesome-all.css')}}" rel="stylesheet">
<link href="{{asset('site/css/flaticon.css')}}" rel="stylesheet">
<link href="{{asset('site/css/owl.css')}}" rel="stylesheet">
<link href="{{asset('site/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('site/css/jquery.fancybox.min.css')}}" rel="stylesheet">
<link href="{{asset('site/css/animate.css')}}" rel="stylesheet">
<link href="{{asset('site/css/style.css')}}" rel="stylesheet">
<link href="{{asset('site/css/responsive.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="all" href="{{asset('webslidemenu/dropdown-effects/fade-down.css')}}" />
<link rel="stylesheet" type="text/css" media="all" href="{{asset('webslidemenu/webslidemenu.css')}}" />
<link rel="stylesheet" type="text/css" media="all" href="{{asset('webslidemenu/color-skins/white-red.css')}}" />
<link rel="stylesheet" href="{{asset('site/css/custom-style.css')}}">
@stack('styles')
{{-- @livewireStyles --}}
</head>

<!-- page wrapper -->
<body class="boxed_wrapper">

    <!-- preloader -->
    {{-- <div class="preloader"></div> --}}
    <!-- preloader -->

    @livewire('front.menu')

    @yield('content')

    @include('site.partial.footer')


<!--Scroll to top-->
<button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-arrow-up"></span>
</button>

<!-- jequery plugins -->
<script src="{{asset('site/js/jquery.js')}}"></script>
<script src="{{asset('site/js/popper.min.js')}}"></script>
<script src="{{asset('site/js/bootstrap.min.js')}}"></script>
<script src="{{asset('site/js/owl.js')}}"></script>
<script src="{{asset('site/js/wow.js')}}"></script>
<script src="{{asset('site/js/validation.js')}}"></script>
<script src="{{asset('site/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('site/js/appear.js')}}"></script>
<script src="{{asset('site/js/circle-progress.js')}}"></script>
<script src="{{asset('site/js/jquery.countTo.js')}}"></script>
<script src="{{asset('site/js/scrollbar.js')}}"></script>
<script src="{{asset('site/js/jquery.paroller.min.js')}}"></script>
<script src="{{asset('site/js/tilt.jquery.js')}}"></script>

<!-- main-js -->
<script src="{{asset('site/js/script.js')}}"></script>
<script type="text/javascript" src="{{asset('webslidemenu/webslidemenu.js')}}"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


</script>
@stack('scripts')
</body><!-- End of .page_wrapper -->
{{-- @livewireScripts --}}
</html>
