@extends('layouts.app')
@section('title', 'Pilihan Ekskul')
@section('content')
    @php
        $isAdminPreview = request()->boolean('admin');
    @endphp

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
            <div class="mb-12 flex flex-wrap items-center justify-between gap-4">
                <h1 class="text-lg font-medium text-[#ffffff] font-['DM_Sans']">
                    Pilihan Ekskul
                </h1>
                @if ($isAdminPreview)
                    <button
                        type="button"
                        id="ekskul-create"
                        class="inline-flex items-center gap-2 rounded-md bg-[#10A4B0] px-4 py-2.5 text-sm font-bold text-white transition-colors hover:bg-[#0d8a95] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"></path>
                        </svg>
                        Tambah Ekskul
                    </button>
                @endif
                <hr class="mt-3 border-t border-white/40 w-full">
            </div>

            @if ($isAdminPreview)
                <p class="-mt-8 mb-10 rounded-md border border-[#10A4B0]/40 bg-[#003135]/80 px-4 py-3 text-sm text-white/90" role="status">
                    Mode preview admin. Perubahan CRUD hanya tersimpan sementara di halaman ini.
                </p>
            @endif

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
            <div class="relative flex items-center gap-2">

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
                        <div
                            data-ekskul-id="{{ $loop->index }}"
                            data-nama="{{ $ekskul['nama'] }}"
                            data-gambar="{{ $ekskul['gambar'] }}"
                            data-deskripsi="{{ $ekskul['deskripsi'] }}"
                            data-flip-background="{{ $ekskul['flipBackground'] ? 'true' : 'false' }}"
                            class="ekskul-card group relative block h-24 w-48 shrink-0 overflow-hidden rounded-[2px] transition-all duration-300 hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-[#10A4B0]/50
                            {{ $ekskul['active']
                                ? 'is-active outline outline-3 outline-offset-2 outline-[#10A4B0]'
                                : '' }}"
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
                            <button
                                type="button"
                                data-ekskul-select="{{ $loop->index }}"
                                class="relative z-10 flex h-full w-full items-center justify-center text-xl font-bold text-[#ffffff] font-['DM_Sans'] focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-white"
                            >
                                {{ $ekskul['nama'] }}
                            </button>

                            @if ($isAdminPreview)
                                <div class="absolute right-2 top-2 z-20 flex gap-1">
                                    <button
                                        type="button"
                                        data-ekskul-edit="{{ $loop->index }}"
                                        class="flex h-8 w-8 items-center justify-center rounded bg-[#003135]/90 text-white transition-colors hover:bg-[#10A4B0] focus-visible:outline-2 focus-visible:outline-white"
                                        aria-label="Edit {{ $ekskul['nama'] }}"
                                        title="Edit ekskul"
                                    >
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16 4 4 4M4 20l4-.8L19 8a2.12 2.12 0 0 0-3-3L5 16l-1 4Z"></path>
                                        </svg>
                                    </button>
                                    <button
                                        type="button"
                                        data-ekskul-delete="{{ $loop->index }}"
                                        class="flex h-8 w-8 items-center justify-center rounded bg-[#003135]/90 text-white transition-colors hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-white"
                                        aria-label="Hapus {{ $ekskul['nama'] }}"
                                        title="Hapus ekskul"
                                    >
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18m-2 0-.9 14H5.9L5 6m4 0V4h6v2m-5 4v6m4-6v6"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endif
                        </div>
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

    @if ($isAdminPreview)
        <dialog
            id="ekskul-dialog"
            class="m-auto w-[min(92vw,36rem)] max-w-none rounded-xl border border-[#10A4B0]/40 bg-[#003135] p-0 text-white shadow-2xl backdrop:bg-black/70"
            aria-labelledby="ekskul-dialog-title"
        >
            <form id="ekskul-form" class="space-y-5 p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 id="ekskul-dialog-title" class="text-2xl font-bold text-white">Tambah Ekskul</h2>
                        <p class="mt-1 text-sm text-white/70">Lengkapi informasi ekstrakurikuler.</p>
                    </div>
                    <button
                        type="button"
                        id="ekskul-dialog-close"
                        class="rounded p-1 text-white/70 transition-colors hover:text-white focus-visible:outline-2 focus-visible:outline-[#10A4B0]"
                        aria-label="Tutup formulir"
                    >
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m6 6 12 12M18 6 6 18"></path>
                        </svg>
                    </button>
                </div>

                <input type="hidden" name="id">

                <label class="block space-y-1.5 text-sm font-medium">
                    <span>Nama ekskul</span>
                    <input
                        name="nama"
                        type="text"
                        required
                        maxlength="100"
                        class="w-full rounded-md border border-white/20 bg-white px-3 py-2.5 text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/40"
                    >
                </label>

                <label class="block space-y-1.5 text-sm font-medium">
                    <span>Gambar ekskul</span>
                    <input
                        name="gambar"
                        type="file"
                        accept="image/*"
                        required
                        class="w-full cursor-pointer rounded-md border border-white/20 bg-white text-sm text-[#003135] outline-none transition file:mr-4 file:border-0 file:bg-[#10A4B0] file:px-4 file:py-2.5 file:font-semibold file:text-white hover:file:bg-[#0d8a95] focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/40"
                    >
                    <span class="block text-xs font-normal text-white/70">Pilih file gambar dari perangkat Anda.</span>
                </label>

                <img id="ekskul-image-preview" class="hidden max-h-48 w-full rounded-md border border-white/20 object-cover" alt="Pratinjau gambar ekskul">
                <p id="ekskul-image-error" class="hidden text-sm text-red-300" role="alert"></p>

                <label class="block space-y-1.5 text-sm font-medium">
                    <span>Deskripsi</span>
                    <textarea
                        name="deskripsi"
                        required
                        rows="4"
                        maxlength="1000"
                        class="w-full resize-y rounded-md border border-white/20 bg-white px-3 py-2.5 text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/40"
                    ></textarea>
                </label>

                <div class="flex justify-end gap-3 pt-2">
                    <button
                        type="button"
                        id="ekskul-dialog-cancel"
                        class="rounded-md border border-white/30 px-4 py-2.5 font-semibold text-white transition-colors hover:bg-white/10"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="rounded-md bg-[#10A4B0] px-5 py-2.5 font-bold text-white transition-colors hover:bg-[#0d8a95]"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </dialog>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('ekskul-track');
            const title = document.getElementById('ekskul-title');
            const description = document.getElementById('ekskul-description');
            const background = document.getElementById('ekskul-background');

            if (!track || !title || !description || !background) {
                return;
            }

            const cardTemplate = track.querySelector('.ekskul-card')?.cloneNode(true);
            const cards = () => Array.from(track.querySelectorAll('.ekskul-card'));
            const selectCard = (card) => {
                cards().forEach((item) => {
                    const isActive = item === card;
                    item.classList.toggle('is-active', isActive);
                    item.classList.toggle('outline', isActive);
                    item.classList.toggle('outline-3', isActive);
                    item.classList.toggle('outline-offset-2', isActive);
                    item.classList.toggle('outline-[#10A4B0]', isActive);

                    const overlay = item.querySelector('.ekskul-overlay');
                    if (overlay) {
                        overlay.classList.toggle('bg-[#10A4B0]', isActive);
                        overlay.classList.toggle('bg-[#003135]/70', !isActive);
                    }
                });

                title.textContent = card.dataset.nama;
                description.textContent = card.dataset.deskripsi;
                background.src = card.dataset.gambar;
            };

            track.addEventListener('click', (event) => {
                const target = event.target;
                if (!(target instanceof Element)) {
                    return;
                }

                const selectButton = target.closest('[data-ekskul-select]');
                if (!selectButton) {
                    return;
                }

                const card = selectButton.closest('.ekskul-card');
                if (card) {
                    selectCard(card);
                }
            });

            const initialCard = track.querySelector('.ekskul-card.is-active');
            if (initialCard) {
                selectCard(initialCard);
            }

            @if ($isAdminPreview)
                const dialog = document.getElementById('ekskul-dialog');
                const form = document.getElementById('ekskul-form');
                const formTitle = document.getElementById('ekskul-dialog-title');
                const createButton = document.getElementById('ekskul-create');
                const formId = form.elements.namedItem('id');
                const imageInput = form.elements.namedItem('gambar');
                const imagePreview = document.getElementById('ekskul-image-preview');
                const imageError = document.getElementById('ekskul-image-error');
                let selectedImageUrl = null;
                let temporaryImageUrl = null;
                let nextId = cards().length;

                const clearTemporaryImage = () => {
                    if (temporaryImageUrl) {
                        URL.revokeObjectURL(temporaryImageUrl);
                        temporaryImageUrl = null;
                    }
                    selectedImageUrl = null;
                };

                const showImageError = (message = '') => {
                    imageError.textContent = message;
                    imageError.classList.toggle('hidden', message === '');
                };

                const openForm = (card = null) => {
                    clearTemporaryImage();
                    form.reset();
                    formId.value = card?.dataset.ekskulId ?? '';
                    form.elements.namedItem('nama').value = card?.dataset.nama ?? '';
                    form.elements.namedItem('deskripsi').value = card?.dataset.deskripsi ?? '';
                    imageInput.required = !card;
                    showImageError();
                    imagePreview.src = card?.dataset.gambar ?? '';
                    imagePreview.classList.toggle('hidden', !card);
                    formTitle.textContent = card ? 'Edit Ekskul' : 'Tambah Ekskul';
                    dialog.showModal();
                };

                const updateCard = (card, values) => {
                    card.dataset.nama = values.nama;
                    card.dataset.gambar = values.gambar;
                    card.dataset.deskripsi = values.deskripsi;
                    card.querySelector('img').src = values.gambar;
                    card.querySelector('img').alt = values.nama;
                    card.querySelector('[data-ekskul-select]').textContent = values.nama;
                    card.querySelector('[data-ekskul-edit]').setAttribute('aria-label', `Edit ${values.nama}`);
                    card.querySelector('[data-ekskul-delete]').setAttribute('aria-label', `Hapus ${values.nama}`);
                };

                const closeForm = () => {
                    clearTemporaryImage();
                    dialog.close();
                };

                imageInput.addEventListener('change', () => {
                    clearTemporaryImage();
                    showImageError();

                    const file = imageInput.files[0];
                    if (!file) {
                        return;
                    }

                    if (!file.type.startsWith('image/')) {
                        imageInput.value = '';
                        imagePreview.removeAttribute('src');
                        imagePreview.classList.add('hidden');
                        showImageError('File yang dipilih harus berupa gambar.');
                        return;
                    }

                    temporaryImageUrl = URL.createObjectURL(file);
                    selectedImageUrl = temporaryImageUrl;
                    imagePreview.src = selectedImageUrl;
                    imagePreview.classList.remove('hidden');
                });

                createButton.addEventListener('click', () => openForm());
                document.getElementById('ekskul-dialog-close').addEventListener('click', closeForm);
                document.getElementById('ekskul-dialog-cancel').addEventListener('click', closeForm);

                track.addEventListener('click', (event) => {
                    const target = event.target;
                    if (!(target instanceof Element)) {
                        return;
                    }

                    const editButton = target.closest('[data-ekskul-edit]');
                    if (editButton) {
                        openForm(editButton.closest('.ekskul-card'));
                        return;
                    }

                    const deleteButton = target.closest('[data-ekskul-delete]');
                    if (!deleteButton) {
                        return;
                    }

                    const card = deleteButton.closest('.ekskul-card');
                    if (!card || !window.confirm(`Hapus ekskul "${card.dataset.nama}" dari preview ini?`)) {
                        return;
                    }

                    const wasSelected = card.classList.contains('is-active');
                    card.remove();
                    const remainingCards = cards();
                    if (wasSelected && remainingCards.length > 0) {
                        selectCard(remainingCards[0]);
                    } else if (remainingCards.length === 0) {
                        title.textContent = 'Belum ada ekskul';
                        description.textContent = 'Tambahkan ekstrakurikuler untuk mulai mengisi daftar.';
                        background.removeAttribute('src');
                    }
                });

                form.addEventListener('submit', async (event) => {
                    event.preventDefault();

                    const editingId = formId.value;
                    const currentCard = editingId !== ''
                        ? cards().find((item) => item.dataset.ekskulId === editingId)
                        : null;
                    const imageUrl = selectedImageUrl ?? currentCard?.dataset.gambar;
                    if (!imageUrl) {
                        showImageError('Pilih gambar untuk ekskul ini.');
                        return;
                    }

                    const values = {
                        nama: form.elements.namedItem('nama').value.trim(),
                        gambar: imageUrl,
                        deskripsi: form.elements.namedItem('deskripsi').value.trim(),
                    };
                    let card;

                    if (editingId !== '') {
                        card = currentCard;
                        if (!card) {
                            showImageError('Ekskul yang akan diedit tidak ditemukan.');
                            return;
                        }
                        updateCard(card, values);
                    } else {
                        card = cardTemplate?.cloneNode(true);
                        if (!card) {
                            showImageError('Tidak dapat membuat kartu ekskul baru.');
                            return;
                        }

                        card.dataset.ekskulId = String(nextId++);
                        updateCard(card, values);
                        track.append(card);
                    }

                    selectCard(card);
                    temporaryImageUrl = null;
                    selectedImageUrl = null;
                    closeForm();
                });

                dialog.addEventListener('click', (event) => {
                    if (event.target === dialog) {
                        closeForm();
                    }
                });
            @endif
        });
    </script>

@endsection
