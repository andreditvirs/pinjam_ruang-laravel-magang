<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{config('app.name')}}</title>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/css/main.css') }}">
<!--===============================================================================================-->
<link rel="stylesheet" href="{{ asset('air-datepicker\dist\css\datepicker.css') }}">
<style>
	/* Style untuk menyembunyikan spin button input type number */
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		/* display: none; <- Crashes Chrome on hover */
		-webkit-appearance: none;
		margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
	}

	input[type=number] {
		-moz-appearance:textfield; /* Firefox */
	}
</style>
    </head>
    <body>

        <div class="limiter">
            <div class="container-login100">
                @yield('content')
            </div>
        </div>
            
        <div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{ asset('akun/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('akun/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('akun/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/js/main.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('air-datepicker\dist\js\datepicker.js') }}"></script>
	<script src="{{ asset('air-datepicker\dist\js\i18n\datepicker.en.js') }}"></script>
    </body>
</html>
