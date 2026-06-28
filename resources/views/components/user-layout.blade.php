<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HamroKoseli</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-brand-cream overflow-hidden h-screen">
    <!-- SIDEBAR -->
    <x-user-sidebar />

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden">
    </div>

    <!-- MAIN WRAPPER -->
    <div class="flex min-h-screen overflow-x-hidden">

        <!-- CONTENT AREA -->
        <div class="flex-1 md:ml-72 flex flex-col min-w-0 h-screen">

            <!-- TOPBAR (ONLY ONE HEADER) -->
            <x-user-topbar :title="$title ?? 'Dashboard'" />
            <!-- MOBILE SAFE SPACE -->
            <main class="p-4 pt-6 md:px-8 overflow-y-auto flex-1">
                {{ $slot }}
            </main>

        </div>

    </div>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
