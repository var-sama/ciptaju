@extends('layouts.app')
@section('title', $title)
@section('content')

    <div class="relative w-full h-[350px] md:h-[450px] overflow-hidden mb-12 shadow-md">
        <img
            src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop"
            alt="About Us Banner"
            class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-black/40"></div>

        <div class="absolute inset-0 z-10 flex items-center justify-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white tracking-wider">
                About Us
            </h1>
        </div>
    </div>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">

            <div>

                <h2 class="text-3xl font-bold text-slate-900 mb-4">
                    About Our School
                </h2>

                <p class="text-slate-700 leading-relaxed mb-6">
                    Sekolah kami merupakan tempat untuk belajar, berkembang,
                    dan mempersiapkan siswa menghadapi masa depan. Kami
                    berkomitmen memberikan lingkungan belajar yang nyaman
                    dengan pendidikan yang berkualitas serta mendukung
                    setiap siswa untuk mengembangkan kemampuan dan potensi mereka.
                </p>

                <div class="text-center">
                    <a
                        href="{{ route('auth.registration') }}"
                        class="inline-block px-6 py-2.5 bg-cyan-600 text-white font-medium rounded-md hover:bg-cyan-700 transition duration-300 shadow-md">
                        Register Now
                    </a>
                </div>

            </div>


            <div class="overflow-hidden rounded-lg shadow-md">

                <img
                    src="https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=1000&auto=format&fit=crop"
                    alt="School Building"
                    class="w-full h-[350px] object-cover
                           hover:scale-105 transition duration-500">

            </div>

        </div>

    </div>


    <div id="registerMessage"
         class="fixed top-6 right-6 z-50 hidden">

        <div class="bg-white border border-slate-200
                    shadow-xl rounded-lg px-6 py-4">

            <h3 class="font-bold text-slate-900 mb-1">
                Registration
            </h3>

            <p class="text-sm text-slate-600">
                Informasi pendaftaran akan segera tersedia.
            </p>

        </div>

    </div>


    <script>

        function showRegisterMessage() {

            const message = document.getElementById('registerMessage');

            message.classList.remove('hidden');

            setTimeout(function () {
                message.classList.add('hidden');
            }, 3000);

        }

    </script>

@endsection