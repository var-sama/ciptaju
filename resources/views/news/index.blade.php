```blade
@extends('layouts.app')
@section('title', 'News')
@section('content')

    @php
        /*
        |--------------------------------------------------------------------------
        | Simulasi Role Admin dan User
        |--------------------------------------------------------------------------
        | Ubah menjadi 'user' untuk menguji tampilan pengguna biasa.
        | Ini hanya simulasi frontend, belum memakai sistem login.
        */
        $currentRole = 'admin';
        $isAdmin = $currentRole === 'admin';
    @endphp

    {{--
        =========================================================
        SECTION 1: BERITA TERBARU (Hero Slider / Carousel)
        =========================================================
    --}}

    <section
        id="news-banner"
        data-news-url="{{ route('news.view') }}"
        class="relative w-full h-[500px] font-['DM_Sans'] overflow-hidden px-0 py-0"
        data-autoplay="true"
        data-interval="5000"
    >
        {{-- Header Berita Terbaru --}}
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

        {{-- Garis pembatas --}}
        <div class="absolute top-20 left-6 right-6 md:left-10 md:right-10 z-20 border-t border-white/30 pointer-events-none"></div>

        {{-- Slider Track --}}
        <div id="news-banner-track" class="flex w-full h-full"></div>

        {{-- Previous --}}
        <button
            id="news-banner-prev"
            type="button"
            class="absolute left-4 md:left-8 lg:left-16 top-1/2 -translate-y-1/2 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-[#003135]/80 text-white hover:bg-[#10A4B0] transition-colors"
            aria-label="Berita sebelumnya"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>

        {{-- Next --}}
        <button
            id="news-banner-next"
            type="button"
            class="absolute right-4 md:right-8 lg:right-16 top-1/2 -translate-y-1/2 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-[#003135]/80 text-white hover:bg-[#10A4B0] transition-colors"
            aria-label="Berita berikutnya"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        {{-- Pagination --}}
        <div
            id="news-banner-dots"
            class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-3"
        ></div>
    </section>

    {{-- Hero Slider --}}
    <section
        class="relative w-full overflow-hidden font-['DM_Sans']"
        x-data="{
            active: 0,
            slides: {{ Illuminate\Support\Js::from([
                [
                    'judul' => 'Amond Aye Winning Programming Competition',
                    'tanggal' => '20/12/2099',
                    'gambar' => Vite::asset('resources/assets/banner_1.png'),
                ],
                [
                    'judul' => 'Lomen',
                    'tanggal' => '20/12/2099',
                    'gambar' => 'https://i.pinimg.com/736x/78/8b/d7/788bd73f3e433bca90029d91376cdbc8.jpg',
                ],
                [
                    'judul' => 'Lomen',
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
                <img
                    :src="slide.gambar"
                    alt="Berita Terbaru"
                    class="absolute inset-0 w-full h-full object-cover object-right"
                >

                {{-- Overlay Gradient --}}
                <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>

                {{-- Konten Slide --}}
                <div class="relative z-10 h-full flex flex-col justify-center px-8 md:px-16 max-w-3xl">
                    <p class="text-lg text-white font-['DM_Sans'] mb-3">
                        Berita Terbaru
                    </p>

                    <hr class="border-t border-white/30 mb-10 w-full">

                    <h2
                        class="text-5xl md:text-6xl font-medium text-white font-['DM_Sans'] mb-6"
                        x-text="slide.judul"
                    ></h2>

                    <p
                        class="text-sm text-white font-['DM_Sans']"
                        x-text="slide.tanggal"
                    ></p>
                </div>
            </div>
        </template>

        {{-- Navigasi Panah Kiri --}}
        <button
            type="button"
            @click="active = (active - 1 + slides.length) % slides.length"
            class="absolute left-6 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135]/70 text-white hover:bg-[#10A4B0] transition-colors"
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
            class="absolute right-6 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135]/70 text-white hover:bg-[#10A4B0] transition-colors"
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
        =========================================================
    --}}

    <section class="news-section w-full bg-white font-['DM_Sans'] px-6 md:px-10 py-16">

        <div class="max-w-7xl mx-auto">

            {{-- Judul News --}}
            <h1 class="news-section-title text-5xl md:text-6xl font-bold text-[#003135] font-['DM_Sans'] mb-10">
                News
            </h1>

            @php
                /*
                |--------------------------------------------------------------------------
                | Data Dummy Berita
                |--------------------------------------------------------------------------
                | Data ini hanya untuk tampilan frontend.
                */
                $newsItems = [
                    [
                        'id' => 1,
                        'gambar' => 'resources/assets/news1.png',
                        'judul' => 'Informasi Beasiswa Universitas Two Win Tahun 2077',
                        'tanggal' => '20/12/2099',
                    ],
                    [
                        'id' => 2,
                        'gambar' => 'resources/assets/news2.png',
                        'judul' => 'Kelulusan Angkatan Tahun 2050 Pada Tahun 2060',
                        'tanggal' => '20/12/2099',
                    ],
                    [
                        'id' => 3,
                        'gambar' => 'resources/assets/news3.png',
                        'judul' => 'Mayreel Athuath Menang Kompetisi MTK Antar Daerah',
                        'tanggal' => '20/12/2099',
                    ],
                    [
                        'id' => 4,
                        'gambar' => 'resources/assets/news1.png',
                        'judul' => 'Informasi Beasiswa Universitas Two Win Tahun 2077',
                        'tanggal' => '20/12/2099',
                    ],
                ];

                // Mengulangi data dummy agar jumlah kartu tetap seperti sebelumnya.
                $newsList = collect(range(1, 16))->map(function ($i) use ($newsItems) {
                    return $newsItems[($i - 1) % count($newsItems)];
                });
            @endphp

            {{-- GRID BERITA --}}
            <div id="news-grid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-10">

                {{-- KARTU ADD NEWS KHUSUS ADMIN --}}
                @if ($isAdmin)
                    <button
                        id="add-news-button"
                        type="button"
                        onclick="openNewsModal()"
                        class="group flex min-h-[360px] flex-col items-center justify-center rounded-md border-2 border-dashed border-[#10A4B0] bg-white p-6 text-center transition-all duration-300 hover:-translate-y-2 hover:bg-[#003135] hover:shadow-xl"
                    >
                        <span class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-[#10A4B0] text-white transition-colors duration-300 group-hover:bg-white group-hover:text-[#003135]">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-9 w-9"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 4v16m8-8H4"
                                />
                            </svg>
                        </span>

                        <span class="text-xl font-bold text-[#003135] transition-colors duration-300 group-hover:text-white">
                            Add News
                        </span>

                        <span class="mt-2 text-sm text-gray-500 transition-colors duration-300 group-hover:text-white/70">
                            Tambahkan berita baru
                        </span>
                    </button>
                @endif

                {{-- DAFTAR BERITA --}}
                @foreach ($newsList as $news)

                    <div class="news-card group relative flex h-full min-w-0 flex-col overflow-hidden rounded-md border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl">

                        {{-- Link berita --}}
                        <a href="{{ route('news.view') }}" class="block">

                            {{-- FOTO --}}
                            <div class="relative h-48 overflow-hidden">
                                <img
                                    src="{{ str_starts_with($news['gambar'], 'resources/') ? Vite::asset($news['gambar']) : $news['gambar'] }}"
                                    alt="{{ $news['judul'] }}"
                                    class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                >

                                {{-- Gradient Hover --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0"></div>
                            </div>

                            {{-- TEKS BERITA --}}
                            <div class="relative flex flex-col bg-[#003135] px-5 py-4">
                                <p
                                    class="min-h-[2.75rem] overflow-hidden text-lg text-white font-['DM_Sans'] leading-snug whitespace-normal break-words line-clamp-2 [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:2]"
                                    title="{{ $news['judul'] }}"
                                >
                                    {{ $news['judul'] }}
                                </p>

                                <p class="mt-3 text-sm text-white/60 font-['DM_Sans']">
                                    {{ $news['tanggal'] }}
                                </p>
                            </div>
                        </a>

                        {{-- TOMBOL EDIT DAN DELETE KHUSUS ADMIN --}}
                        @if ($isAdmin)
                            <div class="flex flex-1 items-end gap-3 bg-[#003135] px-5 pb-5">

                                {{-- EDIT --}}
                                <button
                                    type="button"
                                    onclick="alert('Form edit berita belum tersedia. Tombol ini masih berupa simulasi frontend.')"
                                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-md bg-[#10A4B0] px-3 py-2 text-sm font-medium text-white transition duration-300 hover:bg-white hover:text-[#003135]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                        />
                                    </svg>
                                    Edit
                                </button>

                                {{-- DELETE --}}
                                <button
                                    type="button"
                                    onclick="if (confirm('Apakah kamu yakin ingin menghapus berita ini?')) { alert('Fitur hapus belum tersedia. Data dummy tidak dihapus.') }"
                                    class="inline-flex flex-1 items-center justify-center gap-2 rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition duration-300 hover:border-red-500 hover:bg-red-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 7h12m-10 0V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0l-1 13H9L8 7m2 3v6m4-6v6"
                                        />
                                    </svg>
                                    Delete
                                </button>

                            </div>
                        @endif

                    </div>

                @endforeach

            </div>

        </div>
    </section>

    {{-- =========================================================
         TAMBAHAN: POPUP FORM ADD NEWS
         Bagian asli di atas tetap dipertahankan.
         ========================================================= --}}
    @if ($isAdmin)
        <div
            id="news-modal"
            class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 px-4 py-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="news-modal-title"
        >
            <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 md:p-8 shadow-2xl">

                {{-- Header Popup --}}
                <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h2 id="news-modal-title" class="text-2xl font-bold text-[#003135]">
                            Add News
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Masukkan informasi berita yang ingin ditambahkan.
                        </p>
                    </div>

                    <button
                        type="button"
                        onclick="closeNewsModal()"
                        class="flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-red-500"
                        aria-label="Tutup popup"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Form Tambah Berita --}}
                <form id="news-form" class="space-y-5">

                    {{-- Judul --}}
                    <div>
                        <label for="news-title" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="news-title"
                            name="judul"
                            type="text"
                            maxlength="150"
                            required
                            placeholder="Masukkan judul berita"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="news-date" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Tanggal Berita <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="news-date"
                            name="tanggal"
                            type="date"
                            required
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >
                    </div>

                   {{-- Gambar Berita --}}
                <div>
                    <label for="news-image" class="mb-2 block text-sm font-semibold text-[#003135]">
                        Gambar Berita
                    </label>

                    <input
                        id="news-image"
                        name="gambar"
                        type="file"
                        accept="image/*"
                        class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm
                            file:mr-4 file:rounded-md file:border-0 file:bg-[#10A4B0]
                            file:px-4 file:py-2 file:text-white"
                    >

                    <img
                        id="news-image-preview"
                        class="hidden mt-4 h-40 w-full rounded-md object-cover"
                        alt="Preview gambar berita"
                    >
                </div>
                    {{-- Pesan Validasi --}}
                    <p id="news-form-error" class="hidden text-sm text-red-600"></p>

                    {{-- Tombol Popup --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            onclick="closeNewsModal()"
                            class="rounded-md border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="rounded-md bg-[#10A4B0] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#003135]"
                        >
                            Save News
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

    {{-- =========================================================
         TAMBAHAN: JAVASCRIPT POPUP DAN SIMULASI ADD NEWS
         ========================================================= --}}
    <script>
        function openNewsModal() {
            const modal = document.getElementById('news-modal');

            if (!modal) return;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.classList.add('overflow-hidden');

            setTimeout(() => {
                document.getElementById('news-title')?.focus();
            }, 100);
        }

        function closeNewsModal() {
            const modal = document.getElementById('news-modal');

            if (!modal) return;

            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('news-modal');
            const form = document.getElementById('news-form');
            const grid = document.getElementById('news-grid');
            const addButton = document.getElementById('add-news-button');
            const errorMessage = document.getElementById('news-form-error');

            // Berhenti jika popup tidak tersedia, misalnya saat role adalah user.
            if (!modal || !form || !grid || !addButton) return;

            // Mengisi tanggal dengan tanggal hari ini.
            const today = new Date();
            const localToday = new Date(
                today.getTime() - today.getTimezoneOffset() * 60000
            ).toISOString().slice(0, 10);

            document.getElementById('news-date').value = localToday;

            // Menutup popup saat area di luar form diklik.
            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeNewsModal();
                }
            });

            // Menutup popup dengan tombol Escape.
            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeNewsModal();
                }
            });

            // Proses penambahan berita secara frontend.
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const title = document.getElementById('news-title').value.trim();
                const dateValue = document.getElementById('news-date').value;
                const imageUrl = document.getElementById('news-image').value.trim();
                const content = document.getElementById('news-content').value.trim();

                errorMessage.textContent = '';
                errorMessage.classList.add('hidden');

                if (!title || !dateValue || !content) {
                    errorMessage.textContent = 'Judul, tanggal, dan isi berita wajib diisi.';
                    errorMessage.classList.remove('hidden');
                    return;
                }

                // Format tanggal menjadi DD/MM/YYYY.
                const [year, month, day] = dateValue.split('-');
                const formattedDate = `${day}/${month}/${year}`;

                // Membuat kartu berita baru tanpa mengubah kartu yang sudah ada.
                const card = document.createElement('div');

                card.className = 'news-card group relative flex h-full min-w-0 flex-col overflow-hidden rounded-md border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl';

                // Link berita.
                const link = document.createElement('a');
                link.href = @json(route('news.view'));
                link.className = 'block';

                // Bagian gambar.
                const imageContainer = document.createElement('div');
                imageContainer.className = 'relative h-48 overflow-hidden';

                if (imageUrl) {
                    const image = document.createElement('img');

                    image.src = imageUrl;
                    image.alt = title;
                    image.className = 'h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105';

                    image.addEventListener('error', function () {
                        image.remove();

                        const fallback = document.createElement('div');
                        fallback.className = 'flex h-full w-full items-center justify-center bg-gray-100 text-sm text-gray-500';
                        fallback.textContent = 'Gambar tidak tersedia';

                        imageContainer.appendChild(fallback);
                    }, { once: true });

                    imageContainer.appendChild(image);
                } else {
                    imageContainer.classList.add('bg-gray-100', 'flex', 'items-center', 'justify-center');

                    const placeholder = document.createElement('span');
                    placeholder.className = 'text-sm text-gray-500';
                    placeholder.textContent = 'No Image';

                    imageContainer.appendChild(placeholder);
                }

                // Gradient hover gambar.
                const gradient = document.createElement('div');
                gradient.className = 'absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0';

                imageContainer.appendChild(gradient);
                link.appendChild(imageContainer);

                // Bagian teks berita.
                const textContainer = document.createElement('div');
                textContainer.className = 'relative flex flex-col bg-[#003135] px-5 py-4';

                const titleElement = document.createElement('p');
                titleElement.className = 'min-h-[2.75rem] overflow-hidden text-lg text-white font-[\'DM_Sans\'] leading-snug whitespace-normal break-words line-clamp-2';
                titleElement.textContent = title;
                titleElement.title = title;

                const dateElement = document.createElement('p');
                dateElement.className = 'mt-3 text-sm text-white/60 font-[\'DM_Sans\']';
                dateElement.textContent = formattedDate;

                const contentElement = document.createElement('p');
                contentElement.className = 'mt-3 text-sm leading-relaxed text-white/80 whitespace-pre-line break-words';
                contentElement.textContent = content;

                textContainer.appendChild(titleElement);
                textContainer.appendChild(dateElement);
                textContainer.appendChild(contentElement);

                link.appendChild(textContainer);
                card.appendChild(link);

                // Tombol Edit dan Delete mengikuti desain tombol yang sudah ada.
                const actions = document.createElement('div');
                actions.className = 'flex flex-1 items-end gap-3 bg-[#003135] px-5 pb-5';

                const editButton = document.createElement('button');
                editButton.type = 'button';
                editButton.className = 'inline-flex flex-1 items-center justify-center gap-2 rounded-md bg-[#10A4B0] px-3 py-2 text-sm font-medium text-white transition duration-300 hover:bg-white hover:text-[#003135]';
                editButton.textContent = 'Edit';

                editButton.addEventListener('click', function () {
                    alert('Form edit berita belum tersedia. Tombol ini masih berupa simulasi frontend.');
                });

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'inline-flex flex-1 items-center justify-center gap-2 rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition duration-300 hover:border-red-500 hover:bg-red-500';
                deleteButton.textContent = 'Delete';

                deleteButton.addEventListener('click', function () {
                    if (confirm('Apakah kamu yakin ingin menghapus berita ini?')) {
                        card.remove();
                    }
                });

                actions.appendChild(editButton);
                actions.appendChild(deleteButton);
                card.appendChild(actions);

                // Berita baru muncul tepat setelah kartu Add News.
                addButton.insertAdjacentElement('afterend', card);

                // Mengosongkan form dan menutup popup.
                form.reset();
                document.getElementById('news-date').value = localToday;

                closeNewsModal();

                alert('Berita berhasil ditambahkan ke tampilan halaman!');
            });
        });
    </script>

@endsection
```