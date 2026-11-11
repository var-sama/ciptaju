@extends('layouts.app')
@section('title', 'News')
@section('content')

    @php
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
    @endphp

    @if ($bannerSlides->isNotEmpty())
    {{--
        =========================================================
        SECTION 1: BERITA TERBARU (Hero Slider / Carousel)
        =========================================================
    --}}

    <section
        id="news-banner"
        data-news-slides="{{ json_encode($bannerSlides) }}"
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
    @endif

    {{-- Hero Slider --}}
    @if ($latestNews->isNotEmpty())
    <section
        class="relative w-full overflow-hidden font-['DM_Sans']"
        x-data="{
            active: 0,
            slides: {{ Illuminate\Support\Js::from($latestNews) }}
        }"
        x-init="setInterval(() => { active = (active + 1) % slides.length }, 6000)"
    >
        {{-- Track Slide --}}
        <template x-for="(slide, index) in slides" :key="index">
            <a
                :href="slide.url"
                x-show="active === index"
                x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="relative block w-full h-[620px]"
            >
                <img
                    :src="slide.image"
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
                        x-text="slide.title"
                    ></h2>

                    <p
                        class="text-sm text-white font-['DM_Sans']"
                        x-text="slide.date"
                    ></p>
                </div>
            </a>
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
    @endif

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

            {{-- GRID BERITA --}}
            <div id="news-grid" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-10">

                {{-- KARTU ADD NEWS KHUSUS ADMIN --}}
                @if ($isAdmin)
                    <button
                        id="add-news-button"
                        type="button"
                        data-news-modal-open
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

                    <button
                        id="manage-banners-button"
                        type="button"
                        data-banner-modal-open
                        class="group flex min-h-[360px] flex-col items-center justify-center rounded-md border-2 border-dashed border-[#10A4B0] bg-white p-6 text-center transition-all duration-300 hover:-translate-y-2 hover:bg-[#003135] hover:shadow-xl"
                    >
                        <span class="mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-[#10A4B0] text-white transition-colors duration-300 group-hover:bg-white group-hover:text-[#003135]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                            </svg>
                        </span>
                        <span class="text-xl font-bold text-[#003135] transition-colors duration-300 group-hover:text-white">
                            Kelola Banner
                        </span>
                        <span class="mt-2 text-sm text-gray-500 transition-colors duration-300 group-hover:text-white/70">
                            Tambah dan atur banner
                        </span>
                    </button>
                @endif

                {{-- DAFTAR BERITA --}}
                @forelse ($news as $item)

                    <div class="news-card group relative flex h-full min-w-0 flex-col overflow-hidden rounded-md border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl">

                        {{-- Link berita --}}
                        <a href="{{ route('news.view', $item->id) }}" class="block">

                            {{-- FOTO --}}
                            <div class="relative h-48 overflow-hidden">
                                <img
                                    src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}"
                                    alt="{{ $item->title }}"
                                    class="h-full w-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                >

                                {{-- Gradient Hover --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0"></div>
                            </div>

                            {{-- TEKS BERITA --}}
                            <div class="relative flex flex-col bg-[#003135] px-5 py-4">
                                <p
                                    class="min-h-[2.75rem] overflow-hidden text-lg text-white font-['DM_Sans'] leading-snug whitespace-normal break-words line-clamp-2 [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:2]"
                                    title="{{ $item->title }}"
                                >
                                    {{ $item->title }}
                                </p>

                                <p class="mt-3 text-sm text-white/60 font-['DM_Sans']">
                                    {{ $item->published_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </a>

                        {{-- TOMBOL EDIT DAN DELETE KHUSUS ADMIN --}}
                        @if ($isAdmin)
                            <div class="flex flex-1 items-end gap-3 bg-[#003135] px-5 pb-5">

                                {{-- EDIT --}}
                                <button
                                    type="button"
                                    data-news-edit
                                    data-news-id="{{ $item->id }}"
                                    data-update-url="{{ route('news.update', $item) }}"
                                    data-title="{{ $item->title }}"
                                    data-published-at="{{ $item->published_at->format('Y-m-d') }}"
                                    data-content="{{ $item->content }}"
                                    data-image-url="{{ Illuminate\Support\Facades\Storage::disk('public')->url($item->image_path) }}"
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
                                <form
                                    action="{{ route('news.destroy', $item) }}"
                                    method="POST"
                                    class="flex flex-1"
                                    onsubmit="return confirm('Hapus berita ini?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition duration-300 hover:border-red-500 hover:bg-red-500"
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
                                </form>

                            </div>
                        @endif

                    </div>

                @empty
                    <p class="col-span-full text-center text-slate-500">
                        Belum ada berita yang tersedia.
                    </p>
                @endforelse

            </div>

        </div>
    </section>

    {{-- =========================================================
         TAMBAHAN: POPUP FORM ADD NEWS
         Bagian asli di atas tetap dipertahankan.
         ========================================================= --}}
    @if ($isAdmin)
        @php
            $editingNews = $errors->any() && old('editing_news_id')
                ? $news->firstWhere('id', (int) old('editing_news_id'))
                : null;
        @endphp

        <div
            id="news-modal"
            class="fixed inset-0 z-[100] {{ $errors->any() && old('news_form') ? 'flex' : 'hidden' }} items-center justify-center bg-black/60 px-4 py-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="news-modal-title"
        >
            <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 md:p-8 shadow-2xl">

                {{-- Header Popup --}}
                <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h2 id="news-modal-title" class="text-2xl font-bold text-[#003135]">
                            {{ $editingNews ? 'Edit News' : 'Add News' }}
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $editingNews ? 'Perbarui informasi berita.' : 'Masukkan informasi berita yang ingin ditambahkan.' }}
                        </p>
                    </div>

                    <button
                        type="button"
                        data-news-modal-close
                        class="flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-red-500"
                        aria-label="Tutup popup"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Form Tambah dan Edit Berita --}}
                <form
                    id="news-form"
                    action="{{ $editingNews ? route('news.update', $editingNews) : route('news.store') }}"
                    data-create-action="{{ route('news.store') }}"
                    data-default-date="{{ now()->toDateString() }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-5"
                >
                    @csrf
                    <input type="hidden" name="news_form" value="1">
                    @if ($editingNews)
                        @method('PUT')
                    @endif
                    <input
                        id="editing-news-id"
                        type="hidden"
                        name="editing_news_id"
                        value="{{ $editingNews?->id ?? '' }}"
                    >

                    {{-- Judul --}}
                    <div>
                        <label for="news-title" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="news-title"
                            name="title"
                            type="text"
                            maxlength="150"
                            required
                            placeholder="Masukkan judul berita"
                            value="{{ old('title', $editingNews?->title) }}"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="news-date" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Tanggal Berita <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="news-date"
                            name="published_at"
                            type="date"
                            required
                            value="{{ old('published_at', $editingNews?->published_at->toDateString() ?? now()->toDateString()) }}"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                   {{-- Gambar Berita --}}
                <div>
                    <label for="news-image" class="mb-2 block text-sm font-semibold text-[#003135]">
                    Gambar Berita <span id="news-image-required" class="text-red-500 {{ $editingNews ? 'hidden' : '' }}">*</span>
                    </label>

                    <input
                        id="news-image"
                        name="image"
                        type="file"
                        accept="image/*"
                        {{ $editingNews ? '' : 'required' }}
                        class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm
                            file:mr-4 file:rounded-md file:border-0 file:bg-[#10A4B0]
                            file:px-4 file:py-2 file:text-white"
                    >
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <img
                        id="news-image-preview"
                        src="{{ $editingNews ? Illuminate\Support\Facades\Storage::disk('public')->url($editingNews->image_path) : '' }}"
                        data-original-url="{{ $editingNews ? Illuminate\Support\Facades\Storage::disk('public')->url($editingNews->image_path) : '' }}"
                        class="{{ $editingNews ? '' : 'hidden' }} mt-4 h-40 w-full rounded-md object-cover"
                        alt="{{ $editingNews ? $editingNews->title : 'Preview gambar berita' }}"
                    >
                </div>

                    {{-- Isi Berita --}}
                    <div>
                        <label for="news-content" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Isi Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="news-content"
                            name="content"
                            rows="6"
                            required
                            placeholder="Masukkan isi berita"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >{{ old('content', $editingNews?->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pesan Validasi --}}
                    @if ($errors->any())
                        <p id="news-form-error" class="text-sm text-red-600">
                            Periksa kembali data berita yang dimasukkan.
                        </p>
                    @endif

                    {{-- Tombol Popup --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            data-news-modal-close
                            class="rounded-md border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100"
                        >
                            Cancel
                        </button>

                        <button
                            type="submit"
                            class="rounded-md bg-[#10A4B0] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#003135]"
                        >
                            {{ $editingNews ? 'Simpan Perubahan' : 'Save News' }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

    @if ($isAdmin)
        @php
            $editingBanner = $errors->any() && old('banner_form') && old('editing_banner_id')
                ? $banners->firstWhere('id', (int) old('editing_banner_id'))
                : null;
        @endphp

        <div
            id="banner-modal"
            class="fixed inset-0 z-[100] {{ $errors->any() && old('banner_form') ? 'flex' : 'hidden' }} items-center justify-center bg-black/60 px-4 py-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="banner-modal-title"
        >
            <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl bg-white p-6 md:p-8 shadow-2xl">
                <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-4">
                    <div>
                        <h2 id="banner-modal-title" class="text-2xl font-bold text-[#003135]">
                            {{ $editingBanner ? 'Edit Banner' : 'Tambah Banner' }}
                        </h2>
                        <p id="banner-modal-description" class="mt-1 text-sm text-gray-500">
                            {{ $editingBanner ? 'Ganti gambar banner jika diperlukan.' : 'Unggah gambar untuk banner halaman News.' }}
                        </p>
                    </div>

                    <button
                        type="button"
                        data-banner-modal-close
                        class="flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-red-500"
                        aria-label="Tutup popup banner"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form
                    id="banner-form"
                    action="{{ $editingBanner ? route('banners.update', $editingBanner) : route('banners.store') }}"
                    data-create-action="{{ route('banners.store') }}"
                    data-default-date="{{ now()->toDateString() }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-5"
                >
                    @csrf
                    @if ($editingBanner)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="banner_form" value="1">
                    <input
                        id="editing-banner-id"
                        type="hidden"
                        name="editing_banner_id"
                        value="{{ $editingBanner?->id ?? '' }}"
                    >

                    <div>
                        <label for="banner-title" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="banner-title"
                            name="title"
                            type="text"
                            maxlength="150"
                            required
                            placeholder="Masukkan judul berita"
                            value="{{ old('title', $editingBanner?->title) }}"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="banner-date" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Tanggal Berita <span class="text-red-500">*</span>
                        </label>
                        <input
                            id="banner-date"
                            name="published_at"
                            type="date"
                            required
                            value="{{ old('published_at', $editingBanner?->published_at?->toDateString() ?? now()->toDateString()) }}"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >
                        @error('published_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="banner-image" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Gambar Banner <span id="banner-image-required" class="text-red-500 {{ $editingBanner ? 'hidden' : '' }}">*</span>
                        </label>
                        <input
                            id="banner-image"
                            name="image"
                            type="file"
                            accept="image/*"
                            {{ $editingBanner ? '' : 'required' }}
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-[#10A4B0] file:px-4 file:py-2 file:text-white"
                        >
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <img
                            id="banner-image-preview"
                            src="{{ $editingBanner ? Illuminate\Support\Facades\Storage::disk('public')->url($editingBanner->image_path) : '' }}"
                            data-original-url="{{ $editingBanner ? Illuminate\Support\Facades\Storage::disk('public')->url($editingBanner->image_path) : '' }}"
                            alt="{{ $editingBanner ? 'Preview banner '.$editingBanner->id : 'Preview gambar banner' }}"
                            class="{{ $editingBanner ? '' : 'hidden' }} mt-4 h-40 w-full rounded-md object-cover"
                        >
                    </div>

                    <div>
                        <label for="banner-content" class="mb-2 block text-sm font-semibold text-[#003135]">
                            Isi Berita <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="banner-content"
                            name="content"
                            rows="6"
                            required
                            placeholder="Masukkan isi berita"
                            class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                        >{{ old('content', $editingBanner?->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($errors->any() && old('banner_form'))
                        <p class="text-sm text-red-600">Periksa kembali informasi banner yang dimasukkan.</p>
                    @endif

                    <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                        <button
                            type="button"
                            data-banner-modal-close
                            class="rounded-md border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100"
                        >
                            Batal
                        </button>
                        <button
                            id="banner-submit"
                            type="submit"
                            class="rounded-md bg-[#10A4B0] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#003135]"
                        >
                            {{ $editingBanner ? 'Simpan Perubahan' : 'Simpan Banner' }}
                        </button>
                    </div>
                </form>

                @if ($banners->isNotEmpty())
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="mb-4 text-lg font-bold text-[#003135]">Banner Tersimpan</h3>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach ($banners as $banner)
                                <div class="overflow-hidden rounded-md border border-gray-200">
                                    <img
                                        src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($banner->image_path) }}"
                                        alt="Banner {{ $banner->id }}"
                                        class="h-32 w-full object-cover"
                                    >
                                    <div class="flex gap-3 bg-[#003135] p-3">
                                        <button
                                            type="button"
                                            data-banner-edit
                                            data-banner-id="{{ $banner->id }}"
                                            data-update-url="{{ route('banners.update', $banner) }}"
                                            data-image-url="{{ Illuminate\Support\Facades\Storage::disk('public')->url($banner->image_path) }}"
                                            data-title="{{ $banner->title ?? 'Informasi Sekolah' }}"
                                            data-published-at="{{ $banner->published_at?->toDateString() ?? now()->toDateString() }}"
                                            data-content="{{ $banner->content ?? '' }}"
                                            class="inline-flex flex-1 items-center justify-center rounded-md bg-[#10A4B0] px-3 py-2 text-sm font-medium text-white transition hover:bg-white hover:text-[#003135]"
                                        >
                                            Edit
                                        </button>
                                        <form
                                            action="{{ route('banners.destroy', $banner) }}"
                                            method="POST"
                                            class="flex flex-1"
                                            onsubmit="return confirm('Hapus banner ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="inline-flex w-full items-center justify-center rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition hover:border-red-500 hover:bg-red-500"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

@endsection