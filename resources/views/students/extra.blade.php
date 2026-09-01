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
                    src="https://i.pinimg.com/1200x/2f/96/24/2f9624b1cf31242e8d31e9d1882615be.jpg"
                    alt="Pilihan Ekskul background"
                    class="w-full h-full object-cover object-right scale-x-[-1]"
                >
            </div>
        </div>

        {{-- Overlay Gradient: kiri (gelap) -> kanan (transparan) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/85 via-70% to-transparent"></div>

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
                                'nama' => 'Lomen',
                                'gambar' => 'https://i.pinimg.com/1200x/2f/96/24/2f9624b1cf31242e8d31e9d1882615be.jpg',
                                'deskripsi' => 'Lomen ipsum running on a jumping fox Lomen ipsum running on a simping jumping fox.',
                                'active' => true
                            ],
                            [
                                'nama' => 'Basket',
                                'gambar' => 'https://i.pinimg.com/736x/4e/04/7e/4e047e69b441044b1e80de5edb9f4064.jpg',
                                'deskripsi' => 'Ekstrakurikuler basket untuk mengembangkan kemampuan olahraga, kerja sama tim, dan sportivitas.',
                                'active' => false
                            ],
                            [
                                'nama' => 'Futsal',
                                'gambar' => 'https://i.pinimg.com/1200x/74/1d/4d/741d4dd7057c6e267b716b282e858cca.jpg',
                                'deskripsi' => 'Kegiatan futsal untuk meningkatkan keterampilan bermain, kekompakan, dan semangat kompetitif.',
                                'active' => false
                            ],
                            [
                                'nama' => 'Musik',
                                'gambar' => 'https://i.pinimg.com/736x/5d/a0/11/5da0115cbad307f2f9f6d5eb7f3ccc9d.jpg',
                                'deskripsi' => 'Wadah untuk mengembangkan kreativitas dan kemampuan bermusik bersama siswa lainnya.',
                                'active' => false
                            ],
                            [
                                'nama' => 'Fotografi',
                                'gambar' => 'https://i.pinimg.com/1200x/8e/d5/66/8ed56600cdd5d38c6d2d0e2e52920a5e.jpg',
                                'deskripsi' => 'Belajar menangkap momen melalui fotografi sekaligus mengembangkan kreativitas visual.',
                                'active' => false
                            ],
                            [
                                'nama' => 'Pramuka',
                                'gambar' => 'https://i.pinimg.com/736x/23/d8/18/23d818d44805a961566b2390fa1eb022.jpg',
                                'deskripsi' => 'Kegiatan yang melatih kedisiplinan, kepemimpinan, kemandirian, dan kerja sama.',
                                'active' => false
                            ],
                            [
                                'nama' => 'Dance',
                                'gambar' => 'https://i.pinimg.com/736x/8e/da/f4/8edaf4482bbcb9d582efc6470aa32549.jpg',
                                'deskripsi' => 'Ruang untuk mengembangkan kemampuan tari, ekspresi diri, dan kreativitas.',
                                'active' => false
                            ],
                        ];
                    @endphp

                    @foreach ($ekskuls as $ekskul)
                            <a
                                href="#"
                                data-nama="{{ $ekskul['nama'] }}"
                                data-gambar="{{ $ekskul['gambar'] }}"
                                data-deskripsi="{{ $ekskul['deskripsi'] }}"
                                class="ekskul-card group relative block shrink-0 w-48 h-24 rounded-[2px] overflow-hidden transition-all duration-300
                                {{ $ekskul['active']
                                    ? 'outline outline-3 outline-offset-2 outline-[#10A4B0]'
                                    : 'hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-[#10A4B0]/50' }}"
                            >
                            {{-- Background gambar kartu --}}
                            <img
                                src="{{ $ekskul['gambar'] }}"
                                alt="{{ $ekskul['nama'] }}"
                                class="absolute inset-0 w-full h-full object-cover"
                            >

                            <div class="ekskul-overlay absolute inset-0 transition-colors duration-300
                                {{ $ekskul['active'] ? 'bg-[#10A4B0]' : 'bg-[#003135]/70' }}">
                            </div>

                            <div class="absolute inset-0 bg-[#10A4B0] translate-y-full transition-transform duration-300 ease-out group-hover:translate-y-0">
                            </div>

                            {{-- Label nama ekskul --}}
                            <span class="relative z-10 flex items-center justify-center w-full h-full text-xl font-bold text-[#ffffff] font-['DM_Sans']">
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


