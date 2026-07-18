@props([
    'title'       => 'Hamro Koseli – Gifts & Surprises Delivered in Nepal',
    'description' => 'Hamro Koseli is Nepal\'s trusted gifting platform. Send gifts, sweets, and surprises to your loved ones across Nepal.',
    'ogImage'     => '/images/og-image.jpg',
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
    <script>
        window.isLoggedIn = @json(auth()->check());
        window.loginUrl = @json(route('userlogin'));
        window.initialCartCount = @json(auth()->check() ? (int) \App\Models\Cart::where('user_id', auth()->id())->sum('quantity') : 0);
        window.cartAddUrl = @json(route('cart.add'));
    </script>

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        window.flashMessages = [];
        @if(session('success'))
            window.flashMessages.push({ message: {!! json_encode(session('success')) !!}, type: 'success' });
        @endif
        @if(session('error'))
            window.flashMessages.push({ message: {!! json_encode(session('error')) !!}, type: 'error' });
        @endif
        @if(session('status'))
            window.flashMessages.push({ message: {!! json_encode(session('status')) !!}, type: 'success' });
        @endif
        @if(session('info'))
            window.flashMessages.push({ message: {!! json_encode(session('info')) !!}, type: 'info' });
        @endif
        @if(session('warning'))
            window.flashMessages.push({ message: {!! json_encode(session('warning')) !!}, type: 'warning' });
        @endif
        @if(session('password_success'))
            window.flashMessages.push({ message: {!! json_encode(session('password_success')) !!}, type: 'success' });
        @endif
    </script>
</head>
<body>
<x-frontend-header />
   {{ $slot }}
<x-frontend-footer />
<x-login-modal />
<x-product-details-modal />
<x-chatbot />
</body>
</html>
