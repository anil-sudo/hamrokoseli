<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meet The Team - Hamro Koseli</title>

    <link rel="icon" type="image/png" href="{{ asset('images/Simplified logo.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <!-- HEADER -->
    <header>

    </header>

    <!-- HERO -->

    <section class="bg-[#FFF7EF] min-h-screen">

    <!-- HERO -->
    <div class="py-16 md:py-24">

        <div class="max-w-5xl mx-auto px-6 text-center">

            <span class="text-[#D4A017] uppercase tracking-[0.3em] text-sm font-semibold">
                Meet The Team
            </span>

            <h1 class="mt-4 text-4xl md:text-6xl font-serif text-[#3A2A1F]">
                The People Behind Hamro Koseli
            </h1>

            <p class="mt-6 text-[#8E8376] text-lg max-w-3xl mx-auto leading-relaxed">
                A team of six aspiring developers, designers, and problem-solvers
                working together under the CodeIT Internship Program to build a
                marketplace that celebrates local artisans, handmade products,
                and authentic local foods.
            </p>

        </div>

    </div>

    <!-- OUR STORY -->

    <div class="max-w-5xl mx-auto px-6 pb-20">

        <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm">

            <span class="text-[#C65A3A] font-semibold uppercase tracking-widest text-sm">
                Our Story
            </span>

            <h2 class="mt-4 text-3xl md:text-4xl font-serif text-[#3A2A1F]">
                From Internship Project to Marketplace Vision
            </h2>

            <div class="mt-6 space-y-6 text-[#8E8376] leading-8">

                <p>
                    Hamro Koseli was developed as part of the CodeIT Internship Program
                    by a team of six interns who shared a common goal: creating a digital
                    platform that empowers local artisans, food producers, and small
                    businesses.
                </p>

                <p>
                    Throughout the internship, our team collaborated on research,
                    design, development, testing, and deployment while learning
                    modern web development practices using Laravel, Tailwind CSS,
                    and MySQL.
                </p>

                <p>
                    What started as an internship project gradually evolved into a
                    complete multi-vendor marketplace designed to preserve local
                    craftsmanship and connect creators directly with customers.
                </p>

            </div>

        </div>

    </div>

    <!-- TEAM MEMBERS -->

    <div class="max-w-7xl mx-auto px-6 pb-24">

        <div class="text-center">

            <h2 class="text-3xl md:text-5xl font-serif text-[#3A2A1F]">
                Meet Our Team
            </h2>

            <p class="mt-4 text-[#8E8376]">
                The talented individuals who brought Hamro Koseli to life.
            </p>

        </div>

        <div class="mt-16 mb-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- CARD -->

            <a href="{{ url('suraj-tamang') }}"
                class="group">

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition duration-300">

                    <div class="h-100 bg-[#F5E8D6] flex items-center justify-center ">

                        <img
                            src="{{ asset('images/suraj tamang.png') }}"
                            alt="Suraj Tamang"
                            class="h-full w-full object-top object-cover">

                    </div>

                    <div class="p-6 text-center">

                        <h3 class="text-xl font-semibold text-[#3A2A1F]">
                            Suraj Tamang
                        </h3>

                    </div>

                </div>

            </a>

            <!-- CARD 2 -->

            <a href="{{ url('anil-shrestha') }}" class="group">

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    <div class="h-100 bg-[#F5E8D6] flex items-center justify-center">

                        <img src="{{ asset('images/anil shrestha.png') }}"
                            alt="Anil Shrestha"
                            class="h-full w-full object-cover">

                    </div>

                    <div class="p-6 text-center">

                        <h3 class="text-xl font-semibold text-[#3A2A1F]">
                            Anil Shrestha
                        </h3>

                    </div>

                </div>

            </a>

            <!-- CARD 3 -->

            <a href="{{ url('nishan-rai') }}" class="group">

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    <div class="h-100 bg-[#F5E8D6] flex items-center justify-center">

                        <img src="{{ asset('images/Nishan Rai.png') }}"
                            class="h-full w-full object-top object-cover">

                    </div>

                    <div class="p-6 text-center">

                        <h3 class="text-xl font-semibold text-[#3A2A1F]">
                            Nishan Rai
                        </h3>

                    </div>

                </div>

            </a>

            <!-- CARD 4 -->

            <a href="{{ url('babisha-katwal') }}" class="group">

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    <div class="h-100 bg-[#F5E8D6]">

                        <img src="{{asset('images/babisha katwal.png')}}"
                            class="h-full w-full object-cover">

                    </div>

                    <div class="p-6 text-center">

                        <h3 class="text-xl font-semibold text-[#3A2A1F]">
                            Babisha Katwal
                        </h3>

                    </div>

                </div>

            </a>

            <!-- CARD 5 -->

            <a href="{{ url('aashutosh-baral') }}" class="group">

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    <div class="h-100 bg-[#F5E8D6]">

                        <img src="{{asset('images/aashutosh baral.png')}}"
                            class="h-full w-full object-top object-cover">

                    </div>

                    <div class="p-6 text-center">

                        <h3 class="text-xl font-semibold text-[#3A2A1F]">
                            Aashutosh Baral
                        </h3>

                    </div>

                </div>

            </a>

            <!-- CARD 6 -->

            <a href="{{ url('rajmangal-rajak') }}" class="group">

                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition">

                    <div class="h-100 bg-[#F5E8D6]">

                        <img src="{{asset('images/rajmangal rajak.png')}}"
                            class="h-full w-full object-cover">

                    </div>

                    <div class="p-6 text-center">

                        <h3 class="text-xl font-semibold text-[#3A2A1F]">
                            Rajmangal Rajak
                        </h3>

                    </div>

                </div>

            </a>

        </div>

    </div>

</section>
</body>

</html>
