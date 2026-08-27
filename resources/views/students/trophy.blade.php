    @extends('layouts.app')
    @section('title', 'Prestasi')
    @section('content')

        {{--
            =========================================================
            SECTION: PRESTASI
            - Header: judul "Prestasi" + tombol Filter
            - Garis pemisah tipis
            - Blok per tahun, masing-masing dengan carousel 3 kartu
            + tombol navigasi panah kiri/kanan
            =========================================================
        --}}
        <section class="w-full bg-[#ffffff] font-['DM_Sans'] px-6 md:px-10 py-12">
        <div class="max-w-7xl mx-auto">

            {{-- ============================================= --}}
            {{-- HEADER KONTEN: Judul + Tombol Filter           --}}
            {{-- ============================================= --}}
            <div class="prestasi-header flex items-center justify-between">
                <h1 class="text-xl font-bold text-[#003135] font-['DM_Sans']">
                    Prestasi
                </h1>

                <button
                    type="button"
                    class="flex items-center gap-2 text-[#10A4B0] font-bold font-['DM_Sans'] text-lg hover:text-[#0d8a95] transition-colors"
                >
                    Filter
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                </button>
            </div>

            <hr class="mt-3 mb-10 border-t border-gray-200 pb-10">

            {{-- ============================================= --}}
            {{-- DATA DUMMY: Prestasi dikelompokkan per tahun    --}}
            {{-- Ganti dengan data asli dari controller           --}}
            {{-- ============================================= --}}
            @php
                $prestasiPerTahun = [
                    2026 => [
                        ['gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxeAGNn2RWxfl53GpuuYgo0bqBQbWliumipCc-jUgD_Ka06SWMychdEfkN&s=10', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/89/e4/23/89e423d7f1560fd5d9e039633fd7a01c.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/4b/32/39/4b323962246e9e60e6d3b1d845b82d1b.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/4b/32/39/4b323962246e9e60e6d3b1d845b82d1b.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                    ],
                    2025 => [
                        ['gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxeAGNn2RWxfl53GpuuYgo0bqBQbWliumipCc-jUgD_Ka06SWMychdEfkN&s=10', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxeAGNn2RWxfl53GpuuYgo0bqBQbWliumipCc-jUgD_Ka06SWMychdEfkN&s=10', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/89/e4/23/89e423d7f1560fd5d9e039633fd7a01c.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/4b/32/39/4b323962246e9e60e6d3b1d845b82d1b.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                    ],
                    2024 => [
                        ['gambar' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxeAGNn2RWxfl53GpuuYgo0bqBQbWliumipCc-jUgD_Ka06SWMychdEfkN&s=10', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/89/e4/23/89e423d7f1560fd5d9e039633fd7a01c.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/89/e4/23/89e423d7f1560fd5d9e039633fd7a01c.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                        ['gambar' => 'https://i.pinimg.com/736x/4b/32/39/4b323962246e9e60e6d3b1d845b82d1b.jpg', 'judul' => "Lomen ipsum dot sit\na jumping fox running on a", 'tanggal' => '20/12/2099'],
                    ],
                ];
            @endphp

            {{-- ============================================= --}}
            {{-- BLOK PER TAHUN                                 --}}
            {{-- ============================================= --}}
            @foreach ($prestasiPerTahun as $tahun => $daftarPrestasi)
                <div class="prestasi-year mb-24">

                    {{-- Judul Tahun --}}
                    <h2 class="text-2xl font-bold text-[#003135] font-['DM_Sans'] mb-6">
                        {{ $tahun }}
                    </h2>

                    {{-- Wrapper Carousel + Tombol Navigasi --}}
                    <div class="relative">

                        {{-- Tombol Navigasi Kiri --}}
                        <button
                            type="button"
                            onclick="document.getElementById('prestasi-track-{{ $tahun }}').scrollBy({left: -400, behavior: 'smooth'})"
                            class="absolute -left-5 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135] text-[#ffffff] hover:bg-[#10A4B0] transition-colors shadow-md"
                            aria-label="Sebelumnya"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="15 18 9 12 15 6"></polyline>
                            </svg>
                        </button>

                        {{-- Track Kartu (scrollable) --}}
                        <div
                            id="prestasi-track-{{ $tahun }}"
                            class="flex items-stretch gap-10 overflow-x-auto scroll-smooth [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-4"
                        >
                            @foreach ($daftarPrestasi as $prestasi)

                                <a
                                    href="#"
                                    class="prestasi-card group relative shrink-0 w-[30%] min-w-[260px] max-w-[340px] rounded-md overflow-hidden border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl"
                                >

                                    {{-- FOTO --}}
                                    <div class="relative h-48 overflow-hidden">

                                        <img
                                            src="{{ $prestasi['gambar'] }}"
                                            alt="Prestasi {{ $tahun }}"
                                            class="w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                        >

                                        {{-- GRADIENT HOVER DI FOTO --}}
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-[#003135]/70  to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0"
                                        ></div>

                                    </div>

                                    {{-- TEKS --}}
                                    <div class="relative bg-[#003135] px-5 py-4">

                                        <p class="text-lg text-[#ffffff] font-['DM_Sans'] leading-snug whitespace-pre-line">
                                            {{ $prestasi['judul'] }}
                                        </p>

                                        <p class="mt-3 text-sm text-[#ffffff]/60 font-['DM_Sans']">
                                            {{ $prestasi['tanggal'] }}
                                        </p>

                                    </div>

                                </a>

                            @endforeach
                        </div>

                        {{-- Tombol Navigasi Kanan --}}
                        <button
                            type="button"
                            onclick="document.getElementById('prestasi-track-{{ $tahun }}').scrollBy({left: 400, behavior: 'smooth'})"
                            class="absolute -right-5 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135] text-[#ffffff] hover:bg-[#10A4B0] transition-colors shadow-md"
                            aria-label="Berikutnya"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </button>

                    </div>
                </div>
            @endforeach

            </div>
        </section>

    @endsection