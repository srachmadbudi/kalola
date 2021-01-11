<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="KALOLA ERP">
	<meta name="author" content="">
    
    @yield('title')

	<link type="text/css" href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
	<link type="text/css" rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/select2.js') }}"></script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('layouts.module.header')
    <div class="app-body" id="dw">
        <div class="sidebar">
            @include('layouts.module.sidebar')
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
        @yield('content')
    </div>

    <footer class="app-footer">
        <div>
            Copyright &copy;<script>document.write(new Date().getFullYear());</script>
        </div>
        <div class="ml-auto">
            <span>Powered by</span>
            <a href="https://coreui.io">CoreUI</a>
        </div>
    </footer>
    
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/pace.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/coreui.min.js') }}"></script>
    <script src="{{ asset('js/custom-tooltips.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    @yield('js')
</body>
</html>