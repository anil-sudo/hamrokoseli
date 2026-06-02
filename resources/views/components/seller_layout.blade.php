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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap');

        :root {
            /* Brand Colors */
            --primary-color: #1F3D2E; /* sidebar, navbar, h1 */
            --secondary-color: #C65A3A; /* buttons, links */

            /* Text Colors */
            --text-color: #3A2A1F;/* main text */
            --text-light: #FFF7EF; /* dashboard text / light text */
            --text-dark: #1F2A24; /* Background Colors */
            --bg-color: #F5E8D6; /* page background */
            --card-bg: #FFF7EF; /* normal card background */

            /* Special */
            --card-dark: rgba(31, 61, 46, 0.15); /* big card background */
            --hover-color: #D4A017;/* button hover */
        }

        /* Fonts */
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: "Inter", sans-serif;
        }

        /* Headings + Sidebar text */
        h1,
        .sidebar,
        .navbar {
            font-family: "Cormorant Garamond", serif;
        }

        /* Utility Classes */
        .bg-primary {
            background-color: var(--primary-color);
        }

        .bg-secondary {
            background-color: var(--secondary-color);
        }

        .bg-card {
            background-color: var(--card-bg);
        }

        .bg-card-dark {
            background-color: var(--card-dark);
        }

        .text-primary {
            color: var(--primary-color);
        }

        .text-secondary {
            color: var(--secondary-color);
        }

        .text-light {
            color: var(--text-light);
        }

        .text-main {
            color: var(--text-color);
        }

        /* Border */
        .border-primary {
            border-color: var(--primary-color);
        }

        /* Buttons */
        .btn {
            background-color: var(--secondary-color);
            color: var(--text-light);
            padding: 10px 16px;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: var(--hover-color);
            color: var(--text-color);
        }

        /* Links */
        a {
            text-decoration: none;
        }



        .navbar a {
            color: var(--text-light);
            text-decoration: none;
        }

        .navbar a:hover {
            color: var(--text-color);
        }

        /* Hover utilities */
        .hover\:bg-primary:hover {
            background-color: var(--primary-color);
        }

        .hover\:text-primary:hover {
            color: var(--primary-color);
        }

        /* Focus */
        .focus\:ring-primary:focus {
            box-shadow: 0 0 0 3px rgba(31, 61, 46, 0.25);
            outline: none;
        }

        /* Cards */
        .card {
            background-color: var(--card-bg);
            border-radius: 12px;
            padding: 16px;
        }

        .card-dark {
            background-color: var(--card-dark);
            border-radius: 12px;
            padding: 16px;
        }

        /* Smooth animations */
        .product-card {
            transition: all 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }

        /* Optional subtle gradient */
        .hero-gradient {
            background: linear-gradient(135deg,
                    rgba(31, 61, 46, 0.05) 0%,
                    rgba(198, 90, 58, 0.08) 100%);
        }
    </style>
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menu-btn');
        const overlay = document.getElementById('overlay');

        menuBtn?.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        });

        overlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });
    });
</script>

</html>
