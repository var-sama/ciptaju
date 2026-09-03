@extends('layouts.app')
@section('title', 'Visi & Misi')
@section('content')

    {{-- 
        =========================================================
        SECTION: VISI & MISI
        - Full-bleed background image (subjek fokus di kanan)
        - Overlay gradient: kiri->kanan (hitam) agar teks kiri terbaca
        - Judul halaman + garis pemisah tipis
        - Blok Visi & Blok Misi
        =========================================================
    --}}
    <section class="relative w-full overflow-hidden font-['DM_Sans'] px-2">

        {{-- Background Image Placeholder --}}
        {{-- Ganti src di bawah ini dengan gambar asli (potret, subjek fokus di kanan) --}}
        <img
            id="vision-background"
            src="https://i.pinimg.com/1200x/d5/30/ec/d530ecad39427d843295224a597957fa.jpg"
            alt="Visi & Misi background"
            class="absolute inset-0 w-full h-full object-cover object-right"
        >

        {{-- Overlay Gradient: kiri (gelap) -> kanan (transparan) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/85 via-65% to-transparent"></div>

        <!-- {{-- Overlay Gradient tambahan: bawah (gelap) -> atas (transparan) untuk kedalaman --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div> -->

        {{-- Konten --}}
        <div class="relative z-10 px-8 pt-16 pb-24">

            {{-- Judul Halaman + Garis Pemisah --}}
            <div class="mb-35">
                <h1
                    id="vision-page-title"
                    class="text-lg font-medium text-[#ffffff] font-['DM_Sans']"
                >
                    Visi &amp; Misi
                </h1>
                <hr class="mt-3 border-t border-white/40 w-full">
            </div>

        <div>
            {{-- Blok Visi --}}
            <div id="vision-block" class="max-w-3xl mb-25">
                <h2
                    id="vision-title"
                    class="text-6xl text-[#ffffff] font-['DM_Sans'] mb-6"
                >
                    Visi
                </h2>
                <p
                    id="vision-description"
                    class="text-xl text-[#ffffff] leading-relaxed font-['DM_Sans']"
                >
                    Lomen ipsum running on a jumping fox Lomen ipsum running
                    on a simping jumping fox Lomen ipsum running on a running
                    on a jumping fox
                </p>
            </div>

            {{-- Blok Misi --}}
            <div id="mission-block" class="max-w-3xl mb-20">
                <h2
                    id="mission-title"
                    class="text-6xl text-[#ffffff] font-['DM_Sans'] mb-6"
                >
                    Misi
                </h2>
                <p
                    id="mission-description"
                    class="text-xl text-[#ffffff] leading-relaxed font-['DM_Sans']"
                >
                    Lomen ipsum running on a jumping fox Lomen ipsum running
                    on a simping jumping fox Lomen ipsum running on a running
                    on a jumping fox
                </p>
            </div>
        </div>

        </div>
    </section>

@endsection