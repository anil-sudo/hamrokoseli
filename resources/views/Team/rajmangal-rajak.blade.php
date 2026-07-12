<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rajmangal Rajak - Hamro Koseli</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <section class="bg-[#FFF7EF] min-h-screen">

        <div class="max-w-7xl mx-auto px-6 py-10 md:py-20">

            <!-- Main Section -->

            <div class="mt-10 grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left Image -->

                <div>

                    <div class="rounded-[40px] overflow-hidden bg-[#d6f5e0]">

                        <img src="{{ asset('images/Rajmangal Rajak.png') }}" alt="rajmangal rajak"
                            class="w-full h-[500px] md:h-[700px] object-cover">

                    </div>

                </div>

                <!-- Right Content -->

                <div>


                    <h1 class="mt-4 text-4xl md:text-6xl font-serif text-[#3A2A1F]">
                        Rajmangal Rajak</h1>

                    <p class="mt-4 text-xl text-[#807870]">
                        Testing & Backend Support
                    </p>

                    <!-- Contribution -->

                    <div class="mt-10">

                        <h2 class="text-xl font-semibold text-[#3A2A1F]">
                            Contribution
                        </h2>

                        <p class="mt-3 text-[#8E8376] leading-8">
                            Backend support,
                            Testing and quality assurance
                            throughout Hamro Koseli.
                        </p>

                    </div>

                    <!-- Achievement -->

                    <div class="mt-10">

                        <h2 class="text-xl font-semibold text-[#3A2A1F]">
                            Greatest Achievement
                        </h2>

                        <p class="mt-1 text-[#8E8376] leading-8">
                            Helped improve system reliability through testing and debugging.
                        </p>

                    </div>

                    <!-- Goal -->

                    <div class="mt-3">

                        <h2 class="text-xl font-semibold text-[#3A2A1F]">
                            Future Goal
                        </h2>

                        <p class="mt-1 text-[#8E8376] leading-8">
                            Become a software quality engineer and backend specialist.
                        </p>

                    </div>

                    <!-- Past Time -->

                    <div class="mt-3">

                        <h2 class="text-xl font-semibold text-[#3A2A1F]">
                            Favorite Past Time
                        </h2>

                        <p class="mt-1 text-[#8E8376] leading-8">
                            Learning new tools and solving technical challenges.
                        </p>

                    </div>

                    <!-- Social Links -->

                    <div class="mt-10 flex flex-wrap gap-1">

                        <!--LinkedIn-->
                        <a href="" class="px-5 py-3 text-2xl">

                            <i class="fa-brands fa-square-linkedin"></i>
                        </a>

                        <!--Instagram-->
                        <a href="" class="px-5 py-3 text-2xl">
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <!--Portfolio-->
                        <a href="" class="px-5 py-3 rounded-xl text-2xl">
                            <i class="fa-solid fa-briefcase"></i>
                        </a>

                    </div>

                </div>

                <!-- Back Button -->

                <a href="{{ route('meet-the-team') }}"
                    class="inline-flex items-center text-[#C65A3A] font-medium hover:underline">

                    ← Back to Team

                </a>
            </div>

        </div>

    </section>
</body>

</html>
