<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">

<head>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="{{$settings['site_author']}}" />
    @stack('seo')
    <title>{{ $title }} | {{ $settings['site_name'] ?? config('app.name') }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['site_logo']) }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ URL::to('front/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ URL::to('front/css/custom.css') }}" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    @stack('css')
</head>

<body>
    @include('layouts.navbar')

    @yield('content')
    <!-- Footer-->
    <footer class="py-5 bg-dark mt-auto">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; ApanyaClay 2024</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ URL::to('front/js/scripts.js') }}"></script>
    <script src="{{ URL::to('front/js/custom.js') }}"></script>

    @stack('js')
</body>

</html>
