<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Pinjam Ruang') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Pinjam Ruang') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                        </li> 
                    </ul>
                </div>
            </div>
        </nav>

        {{-- <main class="py-4"> --}}
            <div class="container">
                <div class="row mt-5 justify-content-md-center">
                    <div class="col col-md-6 align-self-center">
                        <div class="card border-secondary mb-3 text-center">
                        <img class="card-img-top align-self-center m-5" src="{{ asset('storage/site/logo.jpg') }}" style="width: 10rem;" alt="Card image cap">
                            <div class="card-header">Selamat Datang</div>
                            <div class="card-body text-secondary">
                              <h5 class="card-title">Web Admin Pinjam Ruang</h5>
                              <p class="card-text">Login dengan tombol login di atas untuk melanjutkan</p>
                            </div>
                          </div>
                    </div>
                </div>
            </div>

        {{-- </main> --}}
    </div>
</body>
</html>
