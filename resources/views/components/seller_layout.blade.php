<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HamroKoseli</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-[#F5E8D6] overflow-x-hidden">
    <!-- SIDEBAR -->
    <x-seller_sidebar />

    <!-- OVERLAY -->
    <div id="overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden">
    </div>

    <!-- MAIN WRAPPER -->
    <div class="flex min-h-screen overflow-x-hidden">

        <!-- CONTENT AREA -->
        <div class="flex-1 md:ml-72 flex flex-col min-w-0">

            <!-- TOPBAR (ONLY ONE HEADER) -->
            <x-seller_topbar :searchPlaceholder="$searchPlaceholder ?? null" />

            <!-- MOBILE SAFE SPACE -->
            <main class="p-4 pt-6 md:px-8">
                {{ $slot }}
            </main>

        </div>

    </div>

</body>

</html>
