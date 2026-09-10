@extends('layouts.app')
@section('title', 'Pilihan Ekskul')
@section('content')

    {{--
        =========================================================
        SECTION: PILIHAN EKSKUL
        - Full-bleed background image (subjek fokus di kanan)
        - Overlay gradient kiri->kanan agar teks kiri terbaca
        - Judul + deskripsi di kiri atas
        - Carousel kartu ekskul di bawah, dengan state active & hover
        =========================================================
    --}}
    <section class="relative w-full overflow-hidden font-['DM_Sans'] px-2">

        {{-- Background Image Placeholder --}}
        <div class="absolute inset-0 overflow-hidden">
            <div
                id="ekskul-background-animation"
                class="w-full h-full"
            >
                <img
                    id="ekskul-background"
                    src="{{ Vite::asset('resources/assets/badminton.avif') }}"
                    alt="Pilihan Ekskul background"
                    class="w-full h-full object-cover object-right"
                >
            </div>
        </div>

        {{-- Overlay Gradient: kiri (gelap) -> kanan (transparan) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/75 via-65% to-transparent"></div>

        {{-- Konten --}}
        <div class="relative z-10 px-8 pt-16 pb-10">

            {{-- Judul Halaman + Garis Pemisah --}}
            <div class="mb-16">
                <h1 class="text-lg font-medium text-[#ffffff] font-['DM_Sans']">
                    Pilihan Ekskul
                </h1>
                <hr class="mt-3 border-t border-white/40 w-full">
            </div>

            {{-- Teks Judul & Deskripsi --}}
            <div class="max-w-xl mb-20">
                <h2
                    id="ekskul-title"
                    class="text-5xl text-[#ffffff] font-['DM_Sans'] mb-6"
                >
                    Lomen
                </h2>
                <p
                    id="ekskul-description"
                    class="text-lg text-[#ffffff] leading-relaxed font-['DM_Sans']"
                >
                    Lomen ipsum running on a jumping fox Lomen ipsum running on a simping
                    jumping fox Lomen ipsum running on a running on a jumping fox
                </p>
            </div>

            {{-- ============================================= --}}
            {{-- CAROUSEL KARTU EKSKUL                          --}}
            {{-- ============================================= --}}
            <div class="relative flex items-center gap-2" x-data="{}" wire:ignore.self>

                {{-- Tombol Navigasi Kiri --}}
                <button
                    type="button"
                    onclick="document.getElementById('ekskul-track').scrollBy({left: -260, behavior: 'smooth'})"
                    class="shrink-0 z-20 flex items-center justify-center w-10 h-10 rounded-full bg-[#003135] border border-[#10A4B0]/50 text-[#ffffff] hover:bg-[#10A4B0] transition-colors"
                    aria-label="Sebelumnya"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>

                {{-- Track Kartu (scrollable) --}}
                <div
                    id="ekskul-track"
                    class="flex items-stretch gap-3 overflow-x-auto scroll-smooth pb-2 [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden px-3 py-1"
                >
                    @php
                        $ekskuls = [
                            [
                                'nama' => 'Badminton',
                                'gambar' => Vite::asset('resources/assets/badminton.avif'),
                                'deskripsi' => 'Bulu tangkis atau badminton adalah cabang olahraga raket yang dimainkan oleh dua orang (tunggal) atau dua pasangan (ganda) yang saling berlawanan dengan cara memukul kok (shuttlecock) melewati atas net ke area lawan.',
                                'active' => true,
                                'flipBackground' => false,
                            ],
                            [
                                'nama' => 'Basket',
                                'gambar' => Vite::asset('resources/assets/basket.avif'),
                                'deskripsi' => 'Ekstrakurikuler basket untuk mengembangkan kemampuan olahraga, kerja sama tim, dan sportivitas.',
                                'active' => false,
                                'flipBackground' => false,
                            ],
                            [
                                'nama' => 'Voli',
                                'gambar' => Vite::asset('resources/assets/volley.jpg'),
                                'deskripsi' => 'Kegiatan olahraga beregu yang melatih kemampuan bermain voli, kerja sama tim, dan sportivitas.',
                                'active' => false,
                                'flipBackground' => false,
                            ],
                            [
                                'nama' => 'Musik',
                                'gambar' => Vite::asset('resources/assets/music.jpg'),
                                'deskripsi' => 'Wadah untuk mengembangkan kreativitas dan kemampuan bermusik bersama siswa lainnya.',
                                'active' => false,
                                'flipBackground' => false,
                            ],
                            [
                                'nama' => 'Ilmu Komputer',
                                'gambar' => Vite::asset('resources/assets/comp_science.jpg'),
                                'deskripsi' => 'Wadah untuk mempelajari dasar-dasar komputer, pemrograman, teknologi, dan pemecahan masalah secara kreatif.',
                                'active' => false,
                                'flipBackground' => false,
                            ],
                            [
                                'nama' => 'Matematika',
                                'gambar' => Vite::asset('resources/assets/math.png'),
                                'deskripsi' => 'Kegiatan untuk memperkuat kemampuan berpikir logis, analitis, dan kreatif melalui pembelajaran matematika.',
                                'active' => false,
                                'flipBackground' => false,
                            ],
                            [
                                'nama' => 'Desain',
                                'gambar' => Vite::asset('resources/assets/design.jpg'),
                                'deskripsi' => 'Ruang untuk mengembangkan kreativitas visual dan kemampuan membuat karya desain yang komunikatif.',
                                'active' => false,
                                'flipBackground' => false,
                            ],
                        ];
                    @endphp

                    @foreach ($ekskuls as $ekskul)
                        <a
                            href="#"
                            data-nama="{{ $ekskul['nama'] }}"
                            data-gambar="{{ $ekskul['gambar'] }}"
                            data-deskripsi="{{ $ekskul['deskripsi'] }}"
                            data-flip-background="{{ $ekskul['flipBackground'] ? 'true' : 'false' }}"
                            class="ekskul-card group relative block shrink-0 w-48 h-24 rounded-[2px] overflow-hidden transition-all duration-300
                            {{ $ekskul['active']
                                ? 'is-active outline outline-3 outline-offset-2 outline-[#10A4B0]'
                                : 'hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-[#10A4B0]/50' }}"
                        >

                            {{-- Background gambar kartu --}}
                            <img
                                src="{{ $ekskul['gambar'] }}"
                                alt="{{ $ekskul['nama'] }}"
                                class="absolute inset-0 w-full h-full object-cover"
                            >

                            {{-- Overlay --}}
                            <div
                                class="ekskul-overlay absolute inset-0 transition-colors duration-300
                                {{ $ekskul['active'] ? 'bg-[#10A4B0]' : 'bg-[#003135]/70' }}"
                            ></div>

                            {{-- Hover fill --}}
                            <div
                                class="absolute inset-0 bg-[#10A4B0] translate-y-full transition-transform duration-300 ease-out group-hover:translate-y-0"
                            ></div>

                            {{-- Nama --}}
                            <span
                                class="relative z-10 flex items-center justify-center w-full h-full text-xl font-bold text-[#ffffff] font-['DM_Sans']"
                            >
                                {{ $ekskul['nama'] }}
                            </span>

                        </a>
                    @endforeach
                </div>

                {{-- Tombol Navigasi Kanan --}}
                <button
                    type="button"
                    onclick="document.getElementById('ekskul-track').scrollBy({left: 260, behavior: 'smooth'})"
                    class="shrink-0 z-20 flex items-center justify-center w-10 h-10 rounded-full bg-[#003135] border border-[#10A4B0]/50 text-[#ffffff] hover:bg-[#10A4B0] transition-colors"
                    aria-label="Berikutnya"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>

            </div>

        </div>
    </section>

@endsection


