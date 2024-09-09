<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/mobile.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/font.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<body>
    <div class="block_abs__elements block_abs__elements__auth">
        <img src="/assets/img/elements/CyberSport.png" alt="" class="cuber1">
        <img src="/assets/img/elements/CyberSport2.png" alt="" class="cuber2">
    </div>
    <div class="header__mts">
        <svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_17_462)">
                <rect width="44" height="44" fill="#FF0032" />
                <path
                    d="M29.3131 3.35339V5.40612H33.7353V13.4371L33.7362 13.5693H36.212V5.40612H40.6341V3.35339H29.3131Z"
                    fill="white" />
                <path
                    d="M13.3871 3.38398L10.1528 10.0992L6.9185 3.38398H3.38721V13.5378H5.8629V6.27094L9.02433 12.4102H11.2814L14.4437 6.27094V13.5378H16.9194V3.38398H13.3871Z"
                    fill="white" />
                <path
                    d="M38.1522 37.2293C38.106 37.6043 37.9351 37.9529 37.6671 38.2192C37.3887 38.4725 37.0464 38.6452 36.6772 38.7186C36.1377 38.8255 35.5884 38.8753 35.0384 38.8671C34.4528 38.8776 33.8695 38.7921 33.3115 38.6142C32.8541 38.4656 32.4596 38.1681 32.191 37.7692C31.9211 37.3696 31.7879 36.7928 31.7879 36.0593V35.019C31.7879 34.2802 31.9239 33.7033 32.191 33.3038C32.459 32.9056 32.8525 32.6085 33.3088 32.4597C33.8668 32.2817 34.4502 32.1962 35.0358 32.2068C35.5857 32.1986 36.135 32.2483 36.6746 32.3553C37.0437 32.4288 37.3859 32.6015 37.6644 32.8547C37.9324 33.121 38.1032 33.4696 38.1494 33.8446H40.627C40.5822 33.0635 40.2843 32.3183 39.7783 31.7217C39.2794 31.1729 38.6335 30.7788 37.9173 30.586C36.978 30.3382 36.0088 30.2222 35.0375 30.2413C33.8505 30.2413 32.821 30.4123 31.9777 30.7488C31.1436 31.07 30.4448 31.6675 29.998 32.4416C29.5615 33.1913 29.332 34.192 29.3167 35.4186V35.5311V35.5365V35.6489C29.332 36.8755 29.5615 37.8763 29.998 38.626C30.4448 39.4001 31.1436 39.9975 31.9778 40.3186C32.8219 40.6552 33.8524 40.8262 35.0375 40.8262C36.0088 40.8458 36.9781 40.7298 37.9173 40.4816C38.6338 40.2894 39.2799 39.8951 39.7783 39.3458C40.2845 38.7492 40.5824 38.004 40.627 37.2229L38.1522 37.2293Z"
                    fill="white" />
            </g>
            <defs>
                <clipPath id="clip0_17_462">
                    <rect width="44" height="44" fill="white" />
                </clipPath>
            </defs>
        </svg>


        <button onclick="window.open('/login')">
            Войти
        </button>
    </div>

    @yield('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const modalProfile = document.getElementById('profileModal');
    
    // Function to open modal
    function openModal(modal) {
        modal.style.display = 'block';
    }

    // Check if session contains 'modal'
    const sessionModal = '{{ session('modal') }}'; // Используйте Blade для вставки данных из сессии
    if (sessionModal === 'profileModal') {
        openModal(modalProfile);
    }
});

</script>
    <script src="{{ secure_asset('assets/js/togglePassword.js') }}"></script>
    <script src="{{ secure_asset('assets/js/avatar-preview.js') }}"></script>
</body>

</html>
