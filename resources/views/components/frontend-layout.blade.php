@props(['title' => 'Hamro Koseli'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<x-frontend-header />
   {{ $slot }}
<x-frontend-footer />
<x-login-modal />
<x-product-details-modal />
</body>
</html>