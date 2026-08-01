@props([
    'title'       => 'Hamro Koseli – Gifts & Surprises Delivered in Nepal',
    'description' => 'Hamro Koseli is Nepal\'s trusted gifting platform. Send gifts, sweets, and surprises to your loved ones across Nepal.',
    'ogImage' => '/images/og-images.jpg',
])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- SEO Meta -->
    <meta name="description" content="{{ $description }}">

    <!-- Open Graph -->
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:title"       content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image"       content="{{ asset($ogImage) }}">

    <!-- Twitter Card -->
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $title }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image"       content="{{ asset($ogImage) }}">
    <link rel="icon" type="image/png" href="{{ asset('images/Simplified logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- NProgress -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>

    {{--
        FIX 1: window globals are set once on first load here in <head>.
        FIX 2: On every wire:navigate, Livewire re-renders the page body but NOT the <head>.
                So we ALSO update these globals inside the livewire:navigated event below
                using a hidden <template> in the <body> that carries the fresh server values.
    --}}
    <script>
        window.isLoggedIn       = @json(auth()->check());
        window.loginUrl         = @json(route('userlogin'));
        window.initialCartCount = @json(auth()->check() ? (int) \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') : 0);
        window.cartAddUrl       = @json(route('cart.add'));
    </script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        [wire\:navigating] {
            opacity: 0.5;
            transition: opacity 0.3s;
        }
    </style>

    <script>
        // FIX 3: Flash messages — reset the guard flag on every navigation
        // so messages from the NEW page are shown, not silently skipped.
        document.addEventListener('livewire:navigating', function () {
            window._flashMessagesShown = false;
        });

        function initFlashMessages() {
            if (window._flashMessagesShown) return;
            window._flashMessagesShown = true;
            window.flashMessages = [];
            @if(session('success'))        window.flashMessages.push({ message: {!! json_encode(session('success')) !!},        type: 'success' }); @endif
            @if(session('error'))          window.flashMessages.push({ message: {!! json_encode(session('error')) !!},          type: 'error'   }); @endif
            @if(session('status'))         window.flashMessages.push({ message: {!! json_encode(session('status')) !!},         type: 'success' }); @endif
            @if(session('info'))           window.flashMessages.push({ message: {!! json_encode(session('info')) !!},           type: 'info'    }); @endif
            @if(session('warning'))        window.flashMessages.push({ message: {!! json_encode(session('warning')) !!},        type: 'warning' }); @endif
            @if(session('password_success')) window.flashMessages.push({ message: {!! json_encode(session('password_success')) !!}, type: 'success' }); @endif

            window.flashMessages.forEach(flash => {
                Swal.fire({ icon: flash.type, title: flash.message, toast: true, position: 'top-end', showConfirmButton: false, timer: 3000 });
            });
            window.flashMessages = [];
        }

        document.addEventListener('livewire:navigated', function () {
            // FIX 2 (continued): After Livewire swaps the page body, read the
            // fresh server values from the hidden <template> tag rendered in <body>
            // and update window globals so JS always has the correct auth state.
            const tpl = document.getElementById('__page_globals');
            if (tpl) {
                try {
                    const data = JSON.parse(tpl.dataset.globals);
                    window.isLoggedIn       = data.isLoggedIn;
                    window.initialCartCount = data.initialCartCount;
                    window.cartAddUrl       = data.cartAddUrl;
                    window.loginUrl         = data.loginUrl;
                } catch(e) {}
            }

            // FIX 4: Refresh the CSRF token meta tag so POST requests (add to cart,
            // wishlist toggle, reviews) don't get 419 errors after navigation.
            const tplCsrf = document.getElementById('__csrf_token');
            if (tplCsrf) {
                const freshToken = tplCsrf.dataset.token;
                const metaCsrf   = document.querySelector('meta[name="csrf-token"]');
                if (metaCsrf && freshToken) metaCsrf.setAttribute('content', freshToken);
            }

            initFlashMessages();
        });

        window.addEventListener('load', initFlashMessages);
    </script>
</head>
<body>
{{--
    FIX 2 (body part): This hidden template is re-rendered on every wire:navigate
    because it lives in <body>. The JS above reads it after each navigation to
    update window globals with fresh server-side auth/cart data.
--}}
<template id="__page_globals" data-globals='@json([
    "isLoggedIn"       => auth()->check(),
    "initialCartCount" => auth()->check() ? (int) \App\Models\Cart::where("user_id", auth()->id())->sum("quantity") : 0,
    "cartAddUrl"       => route("cart.add"),
    "loginUrl"         => route("userlogin"),
])'></template>

{{--
    FIX 4 (body part): Fresh CSRF token on every page swap so AJAX calls never 419.
--}}
<template id="__csrf_token" data-token="{{ csrf_token() }}"></template>

<x-frontend-header />
   {{ $slot }}
<x-frontend-footer />
<x-login-modal />
<x-product-details-modal />
<x-chatbot />
@livewireScripts
</body>
</html>