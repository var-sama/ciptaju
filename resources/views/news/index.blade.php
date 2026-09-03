@extends('layouts.app')
@section('title', 'News')
@section('content')

    {{--
        =========================================================
        SECTION 1: BERITA TERBARU (Hero Slider / Carousel)
        - Background image full-width (subjek fokus di kanan)
        - Gradient overlay kiri (gelap) -> kanan (transparan)
        - Konten judul, deskripsi, tanggal di kiri
        - Navigasi panah kiri/kanan + pagination dots
        =========================================================
    --}}{{-- SECTION: BERITA TERBARU (BANNER / HERO SLIDER) --}}

<section
    id="news-banner"
    class="relative w-full h-[500px] font-['DM_Sans'] overflow-hidden px-0 py-0"
    data-autoplay="true"
    data-interval="5000"
>

    {{-- Static Header Berita Terbaru --}}
    <div class="absolute inset-x-0 top-0 z-20 pointer-events-none">
        <div class="absolute top-10 left-6 md:left-10 w-auto">
            <h1
                id="news-banner-heading"
                class="text-white text-lg font-medium tracking-wide font-['DM_Sans'] hover:text-[#10A4B0] transition-colors cursor-pointer"
            >
                Berita Terbaru
            </h1>
        </div>
    </div>

    {{-- Garis pembatas mengikuti margin halaman --}}
    <div
        class="absolute top-20 left-6 right-6 md:left-10 md:right-10 z-20 border-t border-white/30 pointer-events-none"
    ></div>

    {{-- Slider Track --}}
    <div
        id="news-banner-track"
        class="flex w-full h-full"
    ></div>

    {{-- Previous --}}
    <button
        id="news-banner-prev"
        type="button"
        class="absolute left-4 md:left-8 lg:left-16 top-1/2 -translate-y-1/2 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-[#003135]/80 text-white hover:bg-[#10A4B0] transition-colors"
        aria-label="Berita sebelumnya"
    >
        <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 19l-7-7 7-7"
            ></path>
        </svg>
    </button>

    {{-- Next --}}
    <button
        id="news-banner-next"
        type="button"
        class="absolute right-4 md:right-8 lg:right-16 top-1/2 -translate-y-1/2 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-[#003135]/80 text-white hover:bg-[#10A4B0] transition-colors"
        aria-label="Berita berikutnya"
    >
        <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 5l7 7-7 7"
            ></path>
        </svg>
    </button>

    {{-- Pagination --}}
    <div
        id="news-banner-dots"
        class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3"
    ></div>

</section>

    <section class="relative w-full overflow-hidden font-['DM_Sans']" x-data="{
            active: 0,
            slides: {{ Illuminate\Support\Js::from([
                [
                    'judul' => 'Lomen',
                    'deskripsi' => 'Lomen ipsum running on a jumping fox Lomen ipsum running on a simping jumping fox Lomen ipsum running on a running on a jumping fox',
                    'tanggal' => '20/12/2099',
                    'gambar' => 'https://i.pinimg.com/1200x/01/0d/2f/010d2f4b9ea272721690c0d962f96071.jpg',
                ],
                [
                    'judul' => 'Lomen',
                    'deskripsi' => 'Lomen ipsum running on a jumping fox Lomen ipsum running on a simping jumping fox Lomen ipsum running on a running on a jumping fox',
                    'tanggal' => '20/12/2099',
                    'gambar' => 'https://i.pinimg.com/736x/78/8b/d7/788bd73f3e433bca90029d91376cdbc8.jpg',
                ],
                [
                    'judul' => 'Lomen',
                    'deskripsi' => 'Lomen ipsum running on a jumping fox Lomen ipsum running on a simping jumping fox Lomen ipsum running on a running on a jumping fox',
                    'tanggal' => '20/12/2099',
                    'gambar' => 'https://i.pinimg.com/1200x/01/0d/2f/010d2f4b9ea272721690c0d962f96071.jpg',
                ],
            ]) }}
        }"
        x-init="setInterval(() => { active = (active + 1) % slides.length }, 6000)"
    >
        {{-- Track Slide --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="active === index"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="relative w-full h-[620px]"
            >
                {{-- Background Image Placeholder --}}
                <img
                    :src="slide.gambar"
                    alt="Berita Terbaru"
                    class="absolute inset-0 w-full h-full object-cover object-right"
                >

                {{-- Overlay Gradient: kiri (gelap) -> kanan (transparan) --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>

                {{-- Konten Slide --}}
                <div class="relative z-10 h-full flex flex-col justify-center px-8 md:px-16 max-w-3xl">
                    <p class="text-lg text-[#ffffff] font-['DM_Sans'] mb-3">
                        Berita Terbaru
                    </p>
                    <hr class="border-t border-white/30 mb-10 w-full">

                    <h2 class="text-5xl md:text-6xl font-bold text-[#ffffff] font-['DM_Sans'] mb-6" x-text="slide.judul"></h2>

                    <p class="text-lg text-[#ffffff] leading-relaxed font-['DM_Sans'] max-w-2xl mb-4" x-text="slide.deskripsi"></p>

                    <p class="text-sm text-[#ffffff] font-['DM_Sans']" x-text="slide.tanggal"></p>
                </div>
            </div>
        </template>

        {{-- Navigasi Panah Kiri --}}
        <button
            type="button"
            @click="active = (active - 1 + slides.length) % slides.length"
            class="absolute left-6 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135]/70 text-[#ffffff] hover:bg-[#10A4B0] transition-colors"
            aria-label="Sebelumnya"
        >
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        {{-- Navigasi Panah Kanan --}}
        <button
            type="button"
            @click="active = (active + 1) % slides.length"
            class="absolute right-6 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135]/70 text-[#ffffff] hover:bg-[#10A4B0] transition-colors"
            aria-label="Berikutnya"
        >
            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>

        {{-- Pagination Dots --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    type="button"
                    @click="active = index"
                    class="w-2.5 h-2.5 rounded-full transition-colors"
                    :class="active === index ? 'bg-[#10A4B0]' : 'bg-white/40'"
                    :aria-label="'Slide ' + (index + 1)"
                ></button>
            </template>
        </div>
    </section>

    {{--
        =========================================================
        SECTION 2: DAFTAR BERITA (News Grid)
        - Judul "News" besar rata kiri
        - 1 section tunggal, grid mengalir ke bawah (bukan carousel per baris)
        - Maksimal 4 kartu per baris (grid-cols-1 md:3 lg:4)
        - Kartu: style & efek hover sama seperti kartu Prestasi
          (naik saat hover, radius, gradient overlay di gambar, scale gambar)
        =========================================================
    --}}
    <section class="news-section w-full bg-[#ffffff] font-['DM_Sans'] px-6 md:px-10 py-16">
        
        <div class="max-w-7xl mx-auto">

            <h1 class="news-section-title text-5xl md:text-6xl font-bold text-[#003135] font-['DM_Sans'] mb-10">
                News
            </h1>

            @php
                // Data dummy berita — ganti dengan data asli dari controller
                // Untuk "beralih ke bawah terus", gunakan pagination (bukan carousel per baris)
                $newsList = collect(range(1, 16))->map(function ($i) {
                    return [
                        'gambar'  => "https://i.pinimg.com/1200x/01/0d/2f/010d2f4b9ea272721690c0d962f96071.jpg",
                        'judul'   => "Lomen ipsum dot sit\na jumping fox running on a",
                        'tanggal' => '20/12/2099',
                    ];
                });
            @endphp


            {{-- Grid Berita: 1 kolom (mobile) / 3 kolom (md) / 4 kolom (lg), mengalir terus ke bawah --}}
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-10">
                @foreach ($newsList as $news)
                    <a
                        href="#"
                        class="news-card group relative shrink-0 rounded-md overflow-hidden border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl"
                    >
                        {{-- FOTO --}}
                        <div class="relative h-48 overflow-hidden">

                            <img
                                src="{{ $news['gambar'] }}"
                                alt="Berita"
                                class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                            >

                            {{-- GRADIENT HOVER DI FOTO --}}
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0"
                            ></div>

                        </div>

                        {{-- TEKS --}}
                        <div class="relative bg-[#003135] px-5 py-4">

                            <p class="text-lg text-[#ffffff] font-['DM_Sans'] leading-snug whitespace-pre-line">
                                {{ $news['judul'] }}
                            </p>

                            <p class="mt-3 text-sm text-[#ffffff]/60 font-['DM_Sans']">
                                {{ $news['tanggal'] }}
                            </p>

                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Pagination (opsional) — hapus/ganti jika pakai infinite scroll asli --}}
            @if (method_exists($newsList, 'links'))
                <div class="mt-12">
                    {{ $newsList->links() }}
                </div>
            @endif

        </div>
    </section>

@endsection