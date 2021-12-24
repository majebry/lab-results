<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    {!! NoCaptcha::renderJs() !!}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>
        .container {
            max-width: 960px;
        }

        header img {
            height: 60px;
        }
    </style>
</head>
<body>
    <div id="app">
        <div class="container py-5">
            <header class="{{ config('app.env') == 'staging' ? 'bg-warning' : '' }}">
                <nav class="border-bottom pb-3 mb-5 d-flex flex-column flex-md-row">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" style="height: 60px">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <nav class="d-inline-flex ms-md-auto d-none d-lg-block">
                        <a target="_blank" class="me-3 py-2 text-dark text-decoration-none" href="https://premiermedicine.com">Go to the main website</a>
                    </nav>
                </nav>
            </header>
            
            <main class="py-4">
                @yield('content')
            </main>

            <footer class="border-top mt-5">
                <div class="p-5 d-flex justify-content-between flex-sm-row flex-xs-row flex-column">
                    <div>
                        <h5>Livonia</h5>
    
                        <ul class="list-unstyled text-small">
                            <li class="mb-2">
                                <i class="bi bi-telephone"></i> +1(248) 987 1250
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-file-text"></i> +1(248) 987 1251
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-pin-map"></i> 20290 Middlebelt Rd,<br>
                                Livonia, MI 48152
                            </li>
                        </ul>
                    </div>
    
                    <div>
                        <h5>Dearborn</h5>
    
                        <ul class="list-unstyled text-small">
                            <li class="mb-2">
                                <i class="bi bi-telephone"></i> +1(313) 348 6375
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-file-text"></i> +1(313) 348 4590
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-pin-map"></i> 9550 Dix Ave,<br>
                                Dearborn, MI 48120
                            </li>
                        </ul>
                    </div>
    
                    <div>
                        <h5>Hamtramck</h5>
    
                        <ul class="list-unstyled text-small">
                            <li class="mb-2">
                                <i class="bi bi-telephone"></i> +1(313) 285 9766
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-file-text"></i> +1(313) 818 3135
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-pin-map"></i> 9824 Conant St,<br>
                                Hamtramck, MI 48212
                            </li>
                        </ul>
                    </div>
                </div>
    
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">© 2021</small>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>
