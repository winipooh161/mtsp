<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/modal.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/mobile.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/font.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('header')
            @yield('content')
            @yield('home')
            @yield('slider')
            @yield('games')
            @yield('register-group')
            @yield('register-solo')
            @yield('register-groupPage')
            @yield('register-soloPage')
            @yield('thanky')
            @yield('thankyPage')
            @yield('profileModal')
            @yield('offlineModal')
            @yield('offlineModalYES')
            @yield('profileDelete')
        </main>
    </div>
    <script src="{{ secure_asset('assets/js/burger-toggle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ secure_asset('assets/js/modal.js') }}"></script>
    <script src="{{ secure_asset('assets/js/togglePassword.js') }}"></script>
    <script src="{{ secure_asset('assets/js/profileModal.js') }}"></script>
    <script src="{{ secure_asset('assets/js/maskTg.js') }}"></script>
    <script src="{{ secure_asset('assets/js/maskSaves.js') }}"></script>
 
    <script>
        const swiper = new Swiper('.swiper', {
            direction: 'horizontal',

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 1.25,
            spaceBetween: 30,
            breakpoints: {
                768: {
                    slidesPerView: 1.2,
                    spaceBetween: 50,
                },
                480: {
                    slidesPerView: 0.5,
                    spaceBetween: 50,
                },
            }
        });
    </script>
</body>

</html>
