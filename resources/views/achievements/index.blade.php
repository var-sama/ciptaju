
@extends('layouts.app')
@section('title', 'Prestasi')
@section('content')

@php
    $isAdmin = auth()->check() && auth()->user()->role === 'admin';
@endphp

<section class="w-full bg-[#ffffff] font-['DM_Sans'] px-6 md:px-10 py-12">
    <div class="max-w-7xl mx-auto">

        {{-- HEADER DAN FILTER --}}
        <div class="prestasi-header flex items-center justify-between">
            <h1 class="text-lg font-bold text-[#003135] font-['DM_Sans']">
                Prestasi
            </h1>

            <div class="relative">
                <button
                    id="filter-prestasi-button"
                    type="button"
                    aria-expanded="false"
                    class="flex items-center gap-2 text-[#10A4B0] font-bold font-['DM_Sans'] text-lg hover:text-[#0d8a95] transition-colors"
                >
                    Filter
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                </button>

                <div id="filter-prestasi-panel" class="hidden absolute right-0 top-full mt-3 z-40 w-64 rounded-lg border border-gray-200 bg-white p-5 shadow-xl">
                    <label for="filter-tahun-prestasi" class="mb-2 block text-sm font-semibold text-[#003135]">
                        Filter Tahun
                    </label>

                    <select id="filter-tahun-prestasi" class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm outline-none focus:border-[#10A4B0]">
                        <option value="semua">Semua Tahun</option>
                        @foreach ($achievements->keys() as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>

                    <button id="reset-filter-prestasi" type="button" class="mt-3 w-full rounded-md border border-gray-300 px-3 py-2 text-sm font-medium text-gray-600 transition hover:bg-gray-100">
                        Reset Filter
                    </button>
                </div>
            </div>
        </div>

        <hr class="mt-3 mb-10 border-t border-gray-200 pb-10">

        @if ($isAdmin)
            <div class="mb-10">
                <button type="button" onclick="bukaFormPrestasi()" class="inline-flex items-center gap-2 rounded-md bg-[#10A4B0] px-5 py-3 text-sm font-semibold text-white transition duration-300 hover:bg-[#003135]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Prestasi
                </button>
            </div>
        @endif

        {{-- KARTU PRESTASI --}}
        @foreach ($achievements as $tahun => $daftarPrestasi)
            <div class="prestasi-year mb-24" data-year-section="{{ $tahun }}">
                <h2 class="text-2xl font-bold text-[#003135] font-['DM_Sans'] mb-6">
                    {{ $tahun }}
                </h2>

                <div class="relative">
                    <button
                        type="button"
                        onclick="document.getElementById('prestasi-track-{{ $tahun }}').scrollBy({left:-400,behavior:'smooth'})"
                        class="absolute -left-5 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135] text-white hover:bg-[#10A4B0] transition-colors shadow-md"
                        aria-label="Sebelumnya"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </button>

                    <div id="prestasi-track-{{ $tahun }}" class="prestasi-track flex items-stretch gap-10 overflow-x-auto scroll-smooth [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-4">
                        @foreach ($daftarPrestasi as $prestasi)
                            <div class="prestasi-item shrink-0 w-[30%] min-w-[260px] max-w-[340px]" data-id="{{ $prestasi->id }}" data-year="{{ $tahun }}">
                                <div class="prestasi-card group relative flex h-full min-w-0 flex-col overflow-hidden rounded-md border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl">

                                    <a href="{{ route('achievements.view', $prestasi) }}" class="block">
                                        <div class="relative h-48 overflow-hidden">
                                            <img
                                                src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($prestasi->image_path) }}"
                                                alt="{{ $prestasi->title }}"
                                                class="prestasi-image w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                            >
                                            <div class="absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0"></div>
                                        </div>

                                        <div class="relative flex flex-col bg-[#003135] px-5 py-4">
                                            <p class="prestasi-title min-h-[2.75rem] overflow-hidden text-lg text-white font-['DM_Sans'] leading-snug whitespace-normal break-words line-clamp-2 [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:2]" title="{{ $prestasi->title }}">
                                                {{ $prestasi->title }}
                                            </p>
                                            <p class="prestasi-date mt-3 text-sm text-white/60 font-['DM_Sans']">
                                                {{ $prestasi->published_at->format('d/m/Y') }}
                                            </p>
                                        </div>
                                    </a>

                                    {{-- EDIT DAN DELETE: SAMA DENGAN TOMBOL NEWS --}}
                                    @if ($isAdmin)
                                        <div class="mt-auto flex flex-1 items-end gap-3 bg-[#003135] px-5 pb-5">

                                            <button
                                                type="button"
                                                onclick="editPrestasi(this)"
                                                data-achievement-id="{{ $prestasi->id }}"
                                                data-update-url="{{ route('achievements.update', $prestasi) }}"
                                                data-title="{{ $prestasi->title }}"
                                                data-published-at="{{ $prestasi->published_at->toDateString() }}"
                                                data-year="{{ $prestasi->year }}"
                                                data-content="{{ $prestasi->content }}"
                                                data-image-url="{{ Illuminate\Support\Facades\Storage::disk('public')->url($prestasi->image_path) }}"
                                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-md bg-[#10A4B0] px-3 py-2 text-sm font-medium text-white transition duration-300 hover:bg-white hover:text-[#003135]"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <form action="{{ route('achievements.destroy', $prestasi) }}" method="POST" class="flex flex-1" onsubmit="return confirm('Apakah kamu yakin ingin menghapus prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex w-full items-center justify-center gap-2 rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition duration-300 hover:border-red-500 hover:bg-red-500"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12m-10 0V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0l-1 13H9L8 7m2 3v6m4-6v6"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button
                        type="button"
                        onclick="document.getElementById('prestasi-track-{{ $tahun }}').scrollBy({left:400,behavior:'smooth'})"
                        class="absolute -right-5 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135] text-white hover:bg-[#10A4B0] transition-colors shadow-md"
                        aria-label="Berikutnya"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach

        <p id="prestasi-empty-message" class="{{ $achievements->isEmpty() ? '' : 'hidden' }} py-12 text-center text-gray-500">
            Tidak ada prestasi pada tahun yang dipilih.
        </p>
    </div>
</section>

{{-- POPUP TAMBAH DAN EDIT --}}
@if ($isAdmin)
@php
    $editingAchievement = $errors->any() && old('achievement_form') && old('editing_achievement_id')
        ? $achievements->flatten(1)->firstWhere('id', (int) old('editing_achievement_id'))
        : null;
@endphp
<div id="prestasi-modal" class="fixed inset-0 z-[100] {{ $errors->any() && old('achievement_form') ? 'flex' : 'hidden' }} items-center justify-center bg-black/60 px-4 py-6" role="dialog" aria-modal="true">
    <div class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-xl bg-white p-6 shadow-2xl md:p-8">

        <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 id="prestasi-modal-title" class="text-2xl font-bold text-[#003135]">{{ $editingAchievement ? 'Edit Prestasi' : 'Tambah Prestasi' }}</h2>
                <p class="mt-1 text-sm text-gray-500">Masukkan informasi prestasi sekolah.</p>
            </div>
            <button type="button" onclick="tutupFormPrestasi()" class="flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-red-500" aria-label="Tutup popup">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form
            id="prestasi-form"
            action="{{ $editingAchievement ? route('achievements.update', $editingAchievement) : route('achievements.store') }}"
            data-create-action="{{ route('achievements.store') }}"
            data-default-date="{{ now()->toDateString() }}"
            data-default-year="{{ now()->year }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-5"
        >
            @csrf
            @if ($editingAchievement)
                @method('PUT')
            @endif
            <input type="hidden" name="achievement_form" value="1">
            <input id="editing-achievement-id" type="hidden" name="editing_achievement_id" value="{{ $editingAchievement?->id ?? '' }}">

            <div>
                <label for="prestasi-judul-input" class="mb-2 block text-sm font-semibold text-[#003135]">Judul Prestasi <span class="text-red-500">*</span></label>
                <input id="prestasi-judul-input" name="title" type="text" maxlength="200" required placeholder="Masukkan judul prestasi" value="{{ old('title', $editingAchievement?->title) }}" class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="prestasi-tanggal-input" class="mb-2 block text-sm font-semibold text-[#003135]">Tanggal Prestasi <span class="text-red-500">*</span></label>
                <input id="prestasi-tanggal-input" name="published_at" type="date" required value="{{ old('published_at', $editingAchievement?->published_at->toDateString() ?? now()->toDateString()) }}" class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
                @error('published_at')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="prestasi-tahun-input" class="mb-2 block text-sm font-semibold text-[#003135]">Tahun Prestasi <span class="text-red-500">*</span></label>
                <input id="prestasi-tahun-input" name="year" type="number" min="1900" max="9999" required placeholder="Contoh: 2099" value="{{ old('year', $editingAchievement?->year ?? now()->year) }}" class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
                @error('year')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-[#003135]">Gambar Prestasi <span id="prestasi-gambar-required" class="text-red-500">*</span></label>
                <input id="prestasi-gambar-input" name="image" type="file" accept="image/*" aria-describedby="prestasi-gambar-error" class="hidden">
                @error('image')<p class="mb-2 text-sm text-red-600">{{ $message }}</p>@enderror

                <div class="flex flex-wrap items-center gap-3">
                    <button id="pilih-gambar-prestasi" type="button" class="inline-flex items-center gap-2 rounded-md bg-[#10A4B0] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#003135]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21"/>
                        </svg>
                        Pilih Gambar
                    </button>
                    <span id="nama-gambar-prestasi" class="text-sm text-gray-500">{{ $editingAchievement ? 'Gunakan gambar saat ini atau pilih gambar baru' : 'Belum ada gambar dipilih' }}</span>
                </div>
                <p id="prestasi-gambar-error" class="mt-2 hidden text-sm text-red-600">Gambar wajib dipilih untuk menambahkan prestasi.</p>

                <img id="preview-gambar-prestasi" src="{{ $editingAchievement ? Illuminate\Support\Facades\Storage::disk('public')->url($editingAchievement->image_path) : '' }}" data-original-url="{{ $editingAchievement ? Illuminate\Support\Facades\Storage::disk('public')->url($editingAchievement->image_path) : '' }}" alt="Preview gambar prestasi" class="mt-4 {{ $editingAchievement ? '' : 'hidden' }} h-48 w-full rounded-md border border-gray-200 object-cover">
            </div>

            <div>
                <label for="prestasi-content-input" class="mb-2 block text-sm font-semibold text-[#003135]">Deskripsi Prestasi <span class="text-red-500">*</span></label>
                <textarea id="prestasi-content-input" name="content" rows="6" required placeholder="Masukkan deskripsi prestasi" class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">{{ old('content', $editingAchievement?->content) }}</textarea>
                @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            @if ($errors->any() && old('achievement_form'))
                <p id="prestasi-form-error" class="text-sm text-red-600">Periksa kembali data prestasi yang dimasukkan.</p>
            @endif

            <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                <button type="button" onclick="tutupFormPrestasi()" class="rounded-md border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">Cancel</button>
                <button id="prestasi-submit-button" type="submit" class="rounded-md bg-[#10A4B0] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#003135]">Simpan Prestasi</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
let gambarObjectURLPrestasi = null;

function bukaFormPrestasi() {
    const modal = document.getElementById('prestasi-modal');
    const form = document.getElementById('prestasi-form');
    if (!modal || !form) return;

    form.action = form.dataset.createAction;
    form.reset();
    hapusPreviewSementaraPrestasi();
    document.getElementById('editing-achievement-id').value = '';
    document.getElementById('prestasi-tanggal-input').value = form.dataset.defaultDate;
    document.getElementById('prestasi-tahun-input').value = form.dataset.defaultYear;
    document.getElementById('prestasi-gambar-input').required = true;
    form.querySelector('input[name="_method"]')?.remove();

    document.getElementById('prestasi-modal-title').textContent = 'Tambah Prestasi';
    document.getElementById('prestasi-submit-button').textContent = 'Simpan Prestasi';
    document.getElementById('nama-gambar-prestasi').textContent = 'Belum ada gambar dipilih';
    document.getElementById('prestasi-gambar-required').classList.remove('hidden');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function editPrestasi(button) {
    const modal = document.getElementById('prestasi-modal');
    const form = document.getElementById('prestasi-form');
    if (!modal || !form) return;

    form.reset();
    hapusPreviewSementaraPrestasi();
    form.action = button.dataset.updateUrl;
    document.getElementById('editing-achievement-id').value = button.dataset.achievementId;
    document.getElementById('prestasi-judul-input').value = button.dataset.title;
    document.getElementById('prestasi-tanggal-input').value = button.dataset.publishedAt;
    document.getElementById('prestasi-tahun-input').value = button.dataset.year;
    document.getElementById('prestasi-content-input').value = button.dataset.content;
    document.getElementById('prestasi-gambar-input').required = false;

    document.getElementById('prestasi-modal-title').textContent = 'Edit Prestasi';
    document.getElementById('prestasi-submit-button').textContent = 'Simpan Perubahan';
    document.getElementById('prestasi-gambar-required').classList.add('hidden');
    document.getElementById('nama-gambar-prestasi').textContent = 'Gunakan gambar saat ini atau pilih gambar baru';

    const preview = document.getElementById('preview-gambar-prestasi');
    preview.src = button.dataset.imageUrl;
    preview.dataset.originalUrl = button.dataset.imageUrl;
    preview.classList.remove('hidden');

    if (!form.querySelector('input[name="_method"]')) {
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        form.append(method);
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function tutupFormPrestasi() {
    const modal = document.getElementById('prestasi-modal');
    if (!modal) return;

    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.classList.remove('overflow-hidden');

    hapusPreviewSementaraPrestasi();
}

function hapusPreviewSementaraPrestasi() {
    if (gambarObjectURLPrestasi) {
        URL.revokeObjectURL(gambarObjectURLPrestasi);
        gambarObjectURLPrestasi = null;
    }

    const preview = document.getElementById('preview-gambar-prestasi');
    if (preview) {
        preview.src = '';
        preview.classList.add('hidden');
    }

    const input = document.getElementById('prestasi-gambar-input');
    if (input) input.value = '';
}

function periksaTahunPrestasi() {
    const filter = document.getElementById('filter-tahun-prestasi');
    const pilihan = filter ? filter.value : 'semua';
    const sections = document.querySelectorAll('[data-year-section]');
    let jumlahTampil = 0;

    sections.forEach(section => {
        const tahun = section.dataset.yearSection;
        const items = section.querySelectorAll('.prestasi-item');

        section.classList.toggle('hidden', pilihan !== 'semua' && pilihan !== tahun);

        if (items.length === 0) {
            section.classList.add('hidden');
        } else if (pilihan === 'semua' || pilihan === tahun) {
            jumlahTampil++;
        }
    });

    const emptyMessage = document.getElementById('prestasi-empty-message');
    if (emptyMessage) {
        emptyMessage.classList.toggle('hidden', jumlahTampil > 0);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const filterButton = document.getElementById('filter-prestasi-button');
    const filterPanel = document.getElementById('filter-prestasi-panel');
    const filterSelect = document.getElementById('filter-tahun-prestasi');
    const resetFilter = document.getElementById('reset-filter-prestasi');
    const inputGambar = document.getElementById('prestasi-gambar-input');
    const tombolPilihGambar = document.getElementById('pilih-gambar-prestasi');
    const formPrestasi = document.getElementById('prestasi-form');
    const idPrestasiDiedit = document.getElementById('editing-achievement-id');
    const pesanErrorGambar = document.getElementById('prestasi-gambar-error');
    const modal = document.getElementById('prestasi-modal');

    if (filterButton && filterPanel) {
        filterButton.addEventListener('click', function (event) {
            event.stopPropagation();
            const terbuka = !filterPanel.classList.contains('hidden');
            filterPanel.classList.toggle('hidden', terbuka);
            filterButton.setAttribute('aria-expanded', String(!terbuka));
        });

        filterPanel.addEventListener('click', event => event.stopPropagation());

        document.addEventListener('click', function (event) {
            if (!filterPanel.contains(event.target) && !filterButton.contains(event.target)) {
                filterPanel.classList.add('hidden');
                filterButton.setAttribute('aria-expanded', 'false');
            }
        });
    }

    if (filterSelect) filterSelect.addEventListener('change', periksaTahunPrestasi);

    if (resetFilter) {
        resetFilter.addEventListener('click', function () {
            if (filterSelect) filterSelect.value = 'semua';
            periksaTahunPrestasi();
        });
    }

    if (tombolPilihGambar && inputGambar) {
        tombolPilihGambar.addEventListener('click', () => inputGambar.click());

        inputGambar.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            if (!file.type.startsWith('image/')) {
                alert('Silakan pilih file gambar.');
                this.value = '';
                return;
            }

            if (gambarObjectURLPrestasi) URL.revokeObjectURL(gambarObjectURLPrestasi);

            gambarObjectURLPrestasi = URL.createObjectURL(file);

            const preview = document.getElementById('preview-gambar-prestasi');
            preview.src = gambarObjectURLPrestasi;
            preview.classList.remove('hidden');

            document.getElementById('nama-gambar-prestasi').textContent = file.name;
            pesanErrorGambar.classList.add('hidden');
        });
    }

    if (formPrestasi && inputGambar && tombolPilihGambar && idPrestasiDiedit && pesanErrorGambar) {
        formPrestasi.addEventListener('submit', function (event) {
            const imageRequired = idPrestasiDiedit.value === '';
            const imageMissing = imageRequired && inputGambar.files.length === 0;

            pesanErrorGambar.classList.toggle('hidden', !imageMissing);

            if (imageMissing) {
                event.preventDefault();
                tombolPilihGambar.focus();
            }
        });
    }

    if (modal) {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) tutupFormPrestasi();
        });
    }

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            if (modal && !modal.classList.contains('hidden')) tutupFormPrestasi();

            if (filterPanel) {
                filterPanel.classList.add('hidden');
                filterButton?.setAttribute('aria-expanded', 'false');
            }
        }
    });

    if (modal?.classList.contains('flex')) {
        document.body.classList.add('overflow-hidden');
    }

    periksaTahunPrestasi();
});
</script>



@endsection
