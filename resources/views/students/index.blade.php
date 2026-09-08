@extends('layouts.app')
@section('title', 'Lomen Ipsum Landing Page')
@section('content')

    {{-- 
        =========================================================
        SECTION: HERO
        - Background image placeholder (subjek utama di kanan)
        - Overlay gradient ganda: kiri->kanan (hitam) & bawah->atas (hitam)
        - Teks & tombol di kiri
        =========================================================
    --}}
    <section class="relative w-full overflow-hidden font-['DM_Sans'] px-2">

        {{-- Background Image Placeholder --}}
        {{-- Ganti src di bawah ini dengan gambar asli (portrait close-up, subjek fokus di kanan) --}}
        <img
            id="hero-background"
            src="{{ Vite::asset('resources/assets/landing.jpg') }}"
            alt="Hero background"
            class="absolute inset-0 w-full h-full origin-left scale-[1.2] object-cover object-[65%_center]"
        >

        {{-- Overlay Gradient 1: kiri (gelap) -> kanan (transparan) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/80 via-55% to-transparent"></div>

        {{-- Overlay Gradient 2: bawah (gelap) -> atas (transparan) --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent"></div>

        {{-- Konten Hero --}}
        <div class="relative z-10 px-8 pt-24 pb-32 max-w-4xl">
            <h1
                id="hero-title"
                class="text-5xl md:text-6xl text-[#ffffff] leading-tight font-['DM_Sans']">
                Wujudkan Masa Depan Cerah Bersama Sekolah Kami
            </h1>

            <p
                id="hero-description"
                class="mt-6 text-lg text-[#ffffff] leading-relaxed font-['DM_Sans'] max-w-3xl"
            >
                Menghadirkan pendidikan berkualitas, fasilitas modern, serta lingkungan belajar yang inovatif untuk mendukung bakat dan potensi terbaik setiap siswa.
            </p>

            <a
                id="hero-button"
                href="{{ url('/register') }}"
                class="register-button relative inline-block mt-8 overflow-hidden rounded-full bg-[#10A4B0] text-[#ffffff] font-bold font-['DM_Sans'] text-lg px-8 py-3"
            >
                <span class="register-button-text relative z-10">
                    Register Now
                </span>

                <span class="register-button-fill"></span>
            </a>
        </div>
        <section
            id="school-info"
            class="relative w-full px-8 py-16 font-['DM_Sans']"
        >
        <h2 class="text-3xl font-bold text-[#ffffff] font-['DM_Sans'] mb-8">
            Informasi Umum Sekolah
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            {{-- Kartu 1: Pilihan Exkul Sekolah --}}
            <a href="{{ route('extracurricular.index') }}" class="group relative block rounded-lg overflow-hidden border border-white/10 transition-transform duration-300 ease-out hover:-translate-y-2.5">
                <img
                    src="{{ Vite::asset('resources/assets/landing_sub1.png') }}"
                    alt="Pilihan Ekskul Sekolah"
                    class="w-full h-72 scale-[1.03] object-cover"
                >
                {{-- Overlay teal gradient di bawah kartu, menebal saat hover --}}
                <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#003135] via-[#003135]/90 to-transparent transition-all duration-300 ease-out group-hover:h-32 group-hover:from-[#0d5c63] group-hover:via-[#003135]/95"></div>

                <span class="absolute bottom-4 left-4 text-2xl font-bold text-[#ffffff] font-['DM_Sans']">
                    Pilihan Ekskul Sekolah
                </span>
            </a>

            {{-- Kartu 2: Visi & Misi --}}
            <a href="{{ route('vision-mission.index') }}" class="group relative block rounded-lg overflow-hidden border border-white/10 transition-transform duration-300 ease-out hover:-translate-y-2.5">
                <img
                    src="{{ Vite::asset('resources/assets/landing_sub2.png') }}"
                    alt="Visi & Misi"
                    class="w-full h-72 scale-[1.03] object-cover"
                >
                <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#003135] via-[#003135]/90 to-transparent transition-all duration-300 ease-out group-hover:h-32 group-hover:from-[#0d5c63] group-hover:via-[#003135]/95"></div>

                <span class="absolute bottom-4 left-4 text-2xl font-bold text-[#ffffff] font-['DM_Sans']">
                    Visi &amp; Misi
                </span>
            </a>

            {{-- Kartu 3: Prestasi --}}
            <a href="{{ route('achievement.index') }}" class="group relative block rounded-lg overflow-hidden border border-white/10 transition-transform duration-300 ease-out hover:-translate-y-2.5">
                <img
                    src="{{ Vite::asset('resources/assets/landing_sub3.png') }}"
                    alt="Prestasi"
                    class="w-full h-72 scale-[1.03] object-cover"
                >
                <div class="absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-[#003135] via-[#003135]/90 to-transparent transition-all duration-300 ease-out group-hover:h-32 group-hover:from-[#0d5c63] group-hover:via-[#003135]/95"></div>

                <span class="absolute bottom-4 left-4 text-2xl font-bold text-[#ffffff] font-['DM_Sans']">
                    Prestasi
                </span>
            </a>

        </div>
    </section>
    </section>

    {{-- 
        =========================================================
        SECTION: INFORMASI UMUM SEKOLAH
        - Judul + 3 kartu dengan gambar & overlay teal
        - Hover: kartu naik + overlay teks menebal
        =========================================================
    --}}
    

@endsection