
@extends('layouts.app')
@section('title', 'Prestasi')
@section('content')

@php
    $currentRole = 'admin';
    $isAdmin = $currentRole === 'admin';

    $prestasiPerTahun = [
        2099 => [
            ['gambar' => 'resources/assets/achievement1.png', 'judul' => "Meraih Pencapaian Sekolah Dengan Men's Singles Player Of The Year Badminton terbanyak", 'tanggal' => '20/12/2099'],
            ['gambar' => 'resources/assets/acheivement2.png', 'judul' => 'Meraih Gelar School of the Year Pada Tahun 2099', 'tanggal' => '15/11/2099'],
            ['gambar' => 'resources/assets/achievement3.png', 'judul' => 'Dicap Sebagai Sekolah Dengan Penghasil Pendebat Terbaik', 'tanggal' => '10/08/2099'],
            ['gambar' => 'resources/assets/achievement4.png', 'judul' => 'Juara 1 Olimpiade Sains Nasional Bidang Astronomi Terbanyak Satu Asia', 'tanggal' => '05/05/2099'],
        ],
        2098 => [
            ['gambar' => 'resources/assets/achievement4.png', 'judul' => 'Meraih Penghargaan Best Graduate Of The Year', 'tanggal' => '18/12/2098'],
            ['gambar' => 'resources/assets/achievement5.png', 'judul' => 'Meraih Penghargaan Sebagai Sekolah Penghasil Public Speaker Terbaik', 'tanggal' => '12/09/2098'],
            ['gambar' => 'resources/assets/achievement6.png', 'judul' => 'Sekolah Dengan Partisipasi Lomba Terbanyak Pada Tahun 2098', 'tanggal' => '01/06/2098'],
            ['gambar' => 'resources/assets/achievement7.png', 'judul' => 'Juara Umum Kompetisi Robotik Antar Sekolah Tingkat Nasional Terbanyak Sedunia', 'tanggal' => '14/02/2098'],
        ],
        2097 => [
            ['gambar' => 'resources/assets/achievement7.png', 'judul' => 'Sekolah Dengan Pemenang Lomba Terbanyak Pada Tahun 2097', 'tanggal' => '22/11/2097'],
            ['gambar' => 'resources/assets/achievement8.png', 'judul' => 'Dicap Sebagai Sekolah Dengan Guru Terbaik', 'tanggal' => '19/08/2097'],
            ['gambar' => 'resources/assets/achievement9.png', 'judul' => 'Meraih Pencapaian Sebagai Sekolah Dengan Partisipan Lomba Terbanyak', 'tanggal' => '11/04/2097'],
            ['gambar' => 'resources/assets/achievement1.png', 'judul' => 'Medali Emas Festival Seni Terbanyak Sepanjang Abad', 'tanggal' => '03/01/2097'],
        ],
    ];
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
                        @foreach (array_keys($prestasiPerTahun) as $tahun)
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
        @foreach ($prestasiPerTahun as $tahun => $daftarPrestasi)
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
                        @foreach ($daftarPrestasi as $index => $prestasi)
                            <div class="prestasi-item shrink-0 w-[30%] min-w-[260px] max-w-[340px]" data-id="awal-{{ $tahun }}-{{ $index }}" data-year="{{ $tahun }}">
                                <div class="prestasi-card group relative flex h-full min-w-0 flex-col overflow-hidden rounded-md border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl">

                                    <a href="{{ route('achievements.view') }}" class="block">
                                        <div class="relative h-48 overflow-hidden">
                                            <img
                                                src="{{ Vite::asset($prestasi['gambar']) }}"
                                                alt="{{ $prestasi['judul'] }}"
                                                class="prestasi-image w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105"
                                            >
                                            <div class="absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0"></div>
                                        </div>

                                        <div class="relative flex flex-col bg-[#003135] px-5 py-4">
                                            <p class="prestasi-title min-h-[2.75rem] overflow-hidden text-lg text-white font-['DM_Sans'] leading-snug whitespace-normal break-words line-clamp-2 [display:-webkit-box] [-webkit-box-orient:vertical] [-webkit-line-clamp:2]" title="{{ $prestasi['judul'] }}">
                                                {{ $prestasi['judul'] }}
                                            </p>
                                            <p class="prestasi-date mt-3 text-sm text-white/60 font-['DM_Sans']">
                                                {{ $prestasi['tanggal'] }}
                                            </p>
                                        </div>
                                    </a>

                                    {{-- EDIT DAN DELETE: SAMA DENGAN TOMBOL NEWS --}}
                                    @if ($isAdmin)
                                        <div class="mt-auto flex flex-1 items-end gap-3 bg-[#003135] px-5 pb-5">

                                            <button
                                                type="button"
                                                onclick="editPrestasi(this)"
                                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-md bg-[#10A4B0] px-3 py-2 text-sm font-medium text-white transition duration-300 hover:bg-white hover:text-[#003135]"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                                </svg>
                                                Edit
                                            </button>

                                            <button
                                                type="button"
                                                onclick="hapusPrestasi(this)"
                                                class="inline-flex flex-1 items-center justify-center gap-2 rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition duration-300 hover:border-red-500 hover:bg-red-500"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12m-10 0V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0l-1 13H9L8 7m2 3v6m4-6v6"/>
                                                </svg>
                                                Delete
                                            </button>

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

        <p id="prestasi-empty-message" class="hidden py-12 text-center text-gray-500">
            Tidak ada prestasi pada tahun yang dipilih.
        </p>
    </div>
</section>

{{-- POPUP TAMBAH DAN EDIT --}}
@if ($isAdmin)
<div id="prestasi-modal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/60 px-4 py-6" role="dialog" aria-modal="true">
    <div class="relative max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-xl bg-white p-6 shadow-2xl md:p-8">

        <div class="mb-6 flex items-center justify-between border-b border-gray-200 pb-4">
            <div>
                <h2 id="prestasi-modal-title" class="text-2xl font-bold text-[#003135]">Tambah Prestasi</h2>
                <p class="mt-1 text-sm text-gray-500">Masukkan informasi prestasi sekolah.</p>
            </div>
            <button type="button" onclick="tutupFormPrestasi()" class="flex h-9 w-9 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-red-500" aria-label="Tutup popup">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="prestasi-form" class="space-y-5">
            <div>
                <label for="prestasi-judul-input" class="mb-2 block text-sm font-semibold text-[#003135]">Judul Prestasi <span class="text-red-500">*</span></label>
                <input id="prestasi-judul-input" type="text" maxlength="200" required placeholder="Masukkan judul prestasi" class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
            </div>

            <div>
                <label for="prestasi-tanggal-input" class="mb-2 block text-sm font-semibold text-[#003135]">Tanggal Prestasi <span class="text-red-500">*</span></label>
                <input id="prestasi-tanggal-input" type="date" required class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
            </div>

            <div>
                <label for="prestasi-tahun-input" class="mb-2 block text-sm font-semibold text-[#003135]">Tahun Prestasi <span class="text-red-500">*</span></label>
                <input id="prestasi-tahun-input" type="number" min="1900" max="9999" required placeholder="Contoh: 2099" class="w-full rounded-md border border-gray-300 px-4 py-3 text-sm outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-[#003135]">Gambar Prestasi <span id="prestasi-gambar-required" class="text-red-500">*</span></label>
                <input id="prestasi-gambar-input" type="file" accept="image/*" class="hidden">

                <div class="flex flex-wrap items-center gap-3">
                    <button id="pilih-gambar-prestasi" type="button" class="inline-flex items-center gap-2 rounded-md bg-[#10A4B0] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#003135]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21"/>
                        </svg>
                        Pilih Gambar
                    </button>
                    <span id="nama-gambar-prestasi" class="text-sm text-gray-500">Belum ada gambar dipilih</span>
                </div>

                <img id="preview-gambar-prestasi" src="" alt="Preview gambar prestasi" class="mt-4 hidden h-48 w-full rounded-md border border-gray-200 object-cover">
            </div>

            <p id="prestasi-form-error" class="hidden text-sm text-red-600"></p>

            <div class="flex flex-col-reverse gap-3 border-t border-gray-200 pt-5 sm:flex-row sm:justify-end">
                <button type="button" onclick="tutupFormPrestasi()" class="rounded-md border border-gray-300 px-6 py-3 text-sm font-semibold text-gray-600 transition hover:bg-gray-100">Cancel</button>
                <button id="prestasi-submit-button" type="submit" class="rounded-md bg-[#10A4B0] px-6 py-3 text-sm font-semibold text-white transition hover:bg-[#003135]">Simpan Prestasi</button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
let prestasiSedangDiedit = null;
let gambarTerpilihPrestasi = '';
let gambarObjectURLPrestasi = null;

const urlDetailPrestasi = @json(route('achievements.view'));

function bukaFormPrestasi() {
    const modal = document.getElementById('prestasi-modal');
    const form = document.getElementById('prestasi-form');
    if (!modal || !form) return;

    form.reset();
    hapusPreviewSementaraPrestasi();
    prestasiSedangDiedit = null;
    gambarTerpilihPrestasi = '';

    document.getElementById('prestasi-modal-title').textContent = 'Tambah Prestasi';
    document.getElementById('prestasi-submit-button').textContent = 'Simpan Prestasi';
    document.getElementById('nama-gambar-prestasi').textContent = 'Belum ada gambar dipilih';
    document.getElementById('prestasi-gambar-required').classList.remove('hidden');
    document.getElementById('prestasi-form-error').classList.add('hidden');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.classList.add('overflow-hidden');
}

function editPrestasi(button) {
    const item = button.closest('.prestasi-item');
    if (!item) return;

    const modal = document.getElementById('prestasi-modal');
    const form = document.getElementById('prestasi-form');
    if (!modal || !form) return;

    form.reset();
    hapusPreviewSementaraPrestasi();

    prestasiSedangDiedit = item;
    gambarTerpilihPrestasi = item.querySelector('.prestasi-image')?.src || '';

    document.getElementById('prestasi-judul-input').value = item.querySelector('.prestasi-title')?.textContent.trim() || '';
    document.getElementById('prestasi-tanggal-input').value = tanggalKeInput(item.querySelector('.prestasi-date')?.textContent.trim() || '');
    document.getElementById('prestasi-tahun-input').value = item.dataset.year || '';

    document.getElementById('prestasi-modal-title').textContent = 'Edit Prestasi';
    document.getElementById('prestasi-submit-button').textContent = 'Simpan Perubahan';
    document.getElementById('prestasi-gambar-required').classList.add('hidden');
    document.getElementById('nama-gambar-prestasi').textContent = 'Gunakan gambar saat ini atau pilih gambar baru';

    const preview = document.getElementById('preview-gambar-prestasi');
    preview.src = gambarTerpilihPrestasi;
    preview.classList.remove('hidden');

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
    prestasiSedangDiedit = null;
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

function tanggalKeInput(tanggal) {
    const bagian = tanggal.split('/');
    if (bagian.length !== 3) return '';
    return `${bagian[2]}-${bagian[1].padStart(2, '0')}-${bagian[0].padStart(2, '0')}`;
}

function formatTanggalPrestasi(tanggal) {
    const [tahun, bulan, hari] = tanggal.split('-');
    return `${hari}/${bulan}/${tahun}`;
}

function buatBagianTahunPrestasi(tahun) {
    let section = document.querySelector(`[data-year-section="${tahun}"]`);
    if (section) return section;

    section = document.createElement('div');
    section.className = 'prestasi-year mb-24';
    section.dataset.yearSection = tahun;

    const heading = document.createElement('h2');
    heading.className = "text-2xl font-bold text-[#003135] font-['DM_Sans'] mb-6";
    heading.textContent = tahun;

    const wrapper = document.createElement('div');
    wrapper.className = 'relative';

    const track = document.createElement('div');
    track.id = `prestasi-track-${tahun}`;
    track.className = 'prestasi-track flex items-stretch gap-10 overflow-x-auto scroll-smooth [scrollbar-width:none] [-ms-overflow-style:none] [&::-webkit-scrollbar]:hidden py-4';

    const kiri = document.createElement('button');
    kiri.type = 'button';
    kiri.setAttribute('aria-label', 'Sebelumnya');
    kiri.className = 'absolute -left-5 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135] text-white hover:bg-[#10A4B0] transition-colors shadow-md';
    kiri.innerHTML = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>';
    kiri.addEventListener('click', () => track.scrollBy({left: -400, behavior: 'smooth'}));

    const kanan = document.createElement('button');
    kanan.type = 'button';
    kanan.setAttribute('aria-label', 'Berikutnya');
    kanan.className = 'absolute -right-5 top-1/2 -translate-y-1/2 z-20 flex items-center justify-center w-11 h-11 rounded-full bg-[#003135] text-white hover:bg-[#10A4B0] transition-colors shadow-md';
    kanan.innerHTML = '<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>';
    kanan.addEventListener('click', () => track.scrollBy({left: 400, behavior: 'smooth'}));

    wrapper.append(kiri, track, kanan);
    section.append(heading, wrapper);

    const container = document.querySelector('.max-w-7xl.mx-auto');
    const emptyMessage = document.getElementById('prestasi-empty-message');
    container.insertBefore(section, emptyMessage);

    return section;
}

function buatKartuPrestasi(data) {
    const item = document.createElement('div');
    item.className = 'prestasi-item shrink-0 w-[30%] min-w-[260px] max-w-[340px]';
    item.dataset.id = data.id;
    item.dataset.year = data.tahun;

    const card = document.createElement('div');
    card.className = 'prestasi-card group relative flex h-full min-w-0 flex-col overflow-hidden rounded-md border border-gray-200 bg-white transition-all duration-500 ease-out hover:-translate-y-2 hover:shadow-xl';

    const link = document.createElement('a');
    link.href = urlDetailPrestasi;
    link.className = 'block';

    const imageContainer = document.createElement('div');
    imageContainer.className = 'relative h-48 overflow-hidden';

    const image = document.createElement('img');
    image.src = data.gambar;
    image.alt = data.judul;
    image.className = 'prestasi-image w-full h-full object-cover transition-transform duration-500 ease-out group-hover:scale-105';

    const gradient = document.createElement('div');
    gradient.className = 'absolute inset-0 bg-gradient-to-t from-[#003135]/70 to-transparent opacity-0 translate-y-8 transition-all duration-300 ease-out group-hover:opacity-100 group-hover:translate-y-0';

    imageContainer.append(image, gradient);

    const textContainer = document.createElement('div');
    textContainer.className = 'relative flex flex-col bg-[#003135] px-5 py-4';

    const title = document.createElement('p');
    title.className = "prestasi-title min-h-[2.75rem] overflow-hidden text-lg text-white font-['DM_Sans'] leading-snug whitespace-normal break-words line-clamp-2";
    title.textContent = data.judul;
    title.title = data.judul;

    const date = document.createElement('p');
    date.className = "prestasi-date mt-3 text-sm text-white/60 font-['DM_Sans']";
    date.textContent = data.tanggal;

    textContainer.append(title, date);
    link.append(imageContainer, textContainer);
    card.appendChild(link);

    const actions = document.createElement('div');
    actions.className = 'mt-auto flex flex-1 items-end gap-3 bg-[#003135] px-5 pb-5';

    const editButton = document.createElement('button');
    editButton.type = 'button';
    editButton.className = 'inline-flex flex-1 items-center justify-center gap-2 rounded-md bg-[#10A4B0] px-3 py-2 text-sm font-medium text-white transition duration-300 hover:bg-white hover:text-[#003135]';
    editButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg> Edit';
    editButton.addEventListener('click', () => editPrestasi(editButton));

    const deleteButton = document.createElement('button');
    deleteButton.type = 'button';
    deleteButton.className = 'inline-flex flex-1 items-center justify-center gap-2 rounded-md border border-white/40 px-3 py-2 text-sm font-medium text-white transition duration-300 hover:border-red-500 hover:bg-red-500';
    deleteButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12m-10 0V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0l-1 13H9L8 7m2 3v6m4-6v6"/></svg> Delete';
    deleteButton.addEventListener('click', () => hapusPrestasi(deleteButton));

    actions.append(editButton, deleteButton);
    card.appendChild(actions);
    item.appendChild(card);

    return item;
}

function hapusPrestasi(button) {
    const item = button.closest('.prestasi-item');
    if (!item) return;

    const judul = item.querySelector('.prestasi-title')?.textContent.trim() || 'prestasi ini';

    if (!confirm(`Apakah kamu yakin ingin menghapus "${judul}"?`)) return;

    item.remove();
    periksaTahunPrestasi();
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
    const form = document.getElementById('prestasi-form');
    const inputGambar = document.getElementById('prestasi-gambar-input');
    const tombolPilihGambar = document.getElementById('pilih-gambar-prestasi');
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
            gambarTerpilihPrestasi = gambarObjectURLPrestasi;

            const preview = document.getElementById('preview-gambar-prestasi');
            preview.src = gambarObjectURLPrestasi;
            preview.classList.remove('hidden');

            document.getElementById('nama-gambar-prestasi').textContent = file.name;
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

    if (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const judul = document.getElementById('prestasi-judul-input').value.trim();
            const tanggalInput = document.getElementById('prestasi-tanggal-input').value;
            const tahun = document.getElementById('prestasi-tahun-input').value.trim();
            const error = document.getElementById('prestasi-form-error');

            error.textContent = '';
            error.classList.add('hidden');

            if (!judul || !tanggalInput || !tahun) {
                error.textContent = 'Judul, tanggal, dan tahun wajib diisi.';
                error.classList.remove('hidden');
                return;
            }

            const tahunAngka = Number(tahun);

            if (!Number.isInteger(tahunAngka) || tahunAngka < 1900 || tahunAngka > 9999) {
                error.textContent = 'Masukkan tahun yang valid.';
                error.classList.remove('hidden');
                return;
            }

            if (!gambarTerpilihPrestasi) {
                error.textContent = 'Silakan pilih gambar prestasi.';
                error.classList.remove('hidden');
                return;
            }

            const tanggal = formatTanggalPrestasi(tanggalInput);
            const gambar = gambarTerpilihPrestasi;
            const sedangEdit = Boolean(prestasiSedangDiedit);

            if (sedangEdit) {
                const item = prestasiSedangDiedit;
                const tahunLama = item.dataset.year;

                item.querySelector('.prestasi-title').textContent = judul;
                item.querySelector('.prestasi-title').title = judul;
                item.querySelector('.prestasi-date').textContent = tanggal;
                item.querySelector('.prestasi-image').src = gambar;

                if (tahunLama !== String(tahunAngka)) {
                    item.dataset.year = String(tahunAngka);
                    const sectionBaru = buatBagianTahunPrestasi(String(tahunAngka));
                    sectionBaru.querySelector('.prestasi-track').appendChild(item);
                }
            } else {
                const data = {
                    id: `baru-${Date.now()}`,
                    judul: judul,
                    tanggal: tanggal,
                    tahun: String(tahunAngka),
                    gambar: gambar,
                };

                const sectionBaru = buatBagianTahunPrestasi(String(tahunAngka));
                sectionBaru.querySelector('.prestasi-track').appendChild(buatKartuPrestasi(data));
            }

            if (filterSelect) filterSelect.value = 'semua';

            periksaTahunPrestasi();
            tutupFormPrestasi();

            alert(sedangEdit
                ? 'Prestasi berhasil diperbarui pada tampilan.'
                : 'Prestasi berhasil ditambahkan pada tampilan.');
        });
    }

    periksaTahunPrestasi();
});
</script>



@endsection
