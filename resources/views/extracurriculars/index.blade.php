@extends('layouts.app')
@section('title', 'Pilihan Ekskul')
@section('content')
    @php
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
        $initialExtracurricular = $initialExtracurricular ?? null;
        $editingExtracurricular = $isAdmin
            && $errors->any()
            && old('extracurricular_form')
            && old('editing_extracurricular_id')
                ? $extracurriculars->firstWhere('id', (int) old('editing_extracurricular_id'))
                : null;
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
                    src="{{ $initialExtracurricular ? Illuminate\Support\Facades\Storage::disk('public')->url($initialExtracurricular->image_path) : Vite::asset('resources/assets/badminton.avif') }}"
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
                @if ($isAdmin)
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

            @if ($isAdmin)
                <p class="-mt-8 mb-10 rounded-md border border-[#10A4B0]/40 bg-[#003135]/80 px-4 py-3 text-sm text-white/90" role="status">
                    Perubahan ekstrakurikuler tersimpan di database.
                </p>
            @endif

            {{-- Teks Judul & Deskripsi --}}
            <div class="max-w-xl mb-20">
                <h2
                    id="ekskul-title"
                    class="text-5xl text-[#ffffff] font-['DM_Sans'] mb-6"
                >
                    {{ $initialExtracurricular?->name ?? 'Belum ada ekskul' }}
                </h2>
                <p
                    id="ekskul-description"
                    class="text-lg text-[#ffffff] leading-relaxed font-['DM_Sans']"
                >
                    {{ $initialExtracurricular?->description ?? 'Tambahkan ekstrakurikuler untuk mulai mengisi daftar.' }}
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
                    @foreach ($extracurriculars as $extracurricular)
                        @php
                            $imageUrl = Illuminate\Support\Facades\Storage::disk('public')->url($extracurricular->image_path);
                            $isSelected = $initialExtracurricular?->is($extracurricular) ?? false;
                        @endphp
                        <div
                            data-ekskul-id="{{ $extracurricular->id }}"
                            data-update-url="{{ route('extracurriculars.update', $extracurricular) }}"
                            data-nama="{{ $extracurricular->name }}"
                            data-gambar="{{ $imageUrl }}"
                            data-deskripsi="{{ $extracurricular->description }}"
                            data-flip-background="{{ $extracurricular->flip_background ? 'true' : 'false' }}"
                            class="ekskul-card group relative block h-24 w-48 shrink-0 overflow-hidden rounded-[2px] transition-all duration-300 hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-[#10A4B0]/50
                            {{ $isSelected
                                ? 'is-active outline outline-3 outline-offset-2 outline-[#10A4B0]'
                                : '' }}"
                        >

                            {{-- Background gambar kartu --}}
                            <img
                                src="{{ $imageUrl }}"
                                alt="{{ $extracurricular->name }}"
                                class="absolute inset-0 w-full h-full object-cover"
                            >

                            {{-- Overlay --}}
                            <div
                                class="ekskul-overlay absolute inset-0 transition-colors duration-300
                                {{ $isSelected ? 'bg-[#10A4B0]' : 'bg-[#003135]/70' }}"
                            ></div>

                            {{-- Hover fill --}}
                            <div
                                class="absolute inset-0 bg-[#10A4B0] translate-y-full transition-transform duration-300 ease-out group-hover:translate-y-0"
                            ></div>

                            {{-- Nama --}}
                            <button
                                type="button"
                                data-ekskul-select="{{ $extracurricular->id }}"
                                class="relative z-10 flex h-full w-full items-center justify-center text-xl font-bold text-[#ffffff] font-['DM_Sans'] focus-visible:outline-2 focus-visible:outline-offset-[-4px] focus-visible:outline-white"
                            >
                                {{ $extracurricular->name }}
                            </button>

                            @if ($isAdmin)
                                <div class="absolute right-2 top-2 z-20 flex gap-1">
                                    <button
                                        type="button"
                                        data-ekskul-edit="{{ $extracurricular->id }}"
                                        class="group/edit flex h-8 w-8 items-center justify-center rounded bg-[#003135]/90 text-white transition-colors hover:bg-white focus-visible:outline-2 focus-visible:outline-white"
                                        aria-label="Edit {{ $extracurricular->name }}"
                                        title="Edit ekskul"
                                    >
                                        <svg class="h-4 w-4 transition-colors group-hover/edit:text-[#044952]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16 4 4 4M4 20l4-.8L19 8a2.12 2.12 0 0 0-3-3L5 16l-1 4Z"></path>
                                        </svg>
                                    </button>
                                    <button
                                        type="submit"
                                        form="ekskul-delete-{{ $extracurricular->id }}"
                                        class="flex h-8 w-8 items-center justify-center rounded bg-[#003135]/90 text-white transition-colors hover:bg-red-700 focus-visible:outline-2 focus-visible:outline-white"
                                        aria-label="Hapus {{ $extracurricular->name }}"
                                        title="Hapus ekskul"
                                    >
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18m-2 0-.9 14H5.9L5 6m4 0V4h6v2m-5 4v6m4-6v6"></path>
                                        </svg>
                                    </button>
                                    <form
                                        id="ekskul-delete-{{ $extracurricular->id }}"
                                        action="{{ route('extracurriculars.destroy', $extracurricular) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah kamu yakin ingin menghapus ekskul ini?')"
                                        class="hidden"
                                    >
                                        @csrf
                                        @method('DELETE')
                                    </form>
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

    @if ($isAdmin)
        <dialog
            id="ekskul-dialog"
            class="m-auto w-[min(92vw,36rem)] max-w-none rounded-xl border border-[#10A4B0]/40 bg-[#003135] p-0 text-white shadow-2xl backdrop:bg-black/70"
            aria-labelledby="ekskul-dialog-title"
        >
            <form
                id="ekskul-form"
                action="{{ $editingExtracurricular ? route('extracurriculars.update', $editingExtracurricular) : route('extracurriculars.store') }}"
                data-create-action="{{ route('extracurriculars.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-5 p-6 sm:p-8"
            >
                @csrf
                @if ($editingExtracurricular)
                    @method('PUT')
                @endif
                <input type="hidden" name="extracurricular_form" value="1">
                <input type="hidden" name="editing_extracurricular_id" value="{{ $editingExtracurricular?->id ?? '' }}">

                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 id="ekskul-dialog-title" class="text-2xl font-bold text-white">{{ $editingExtracurricular ? 'Edit Ekskul' : 'Tambah Ekskul' }}</h2>
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

                <label class="block space-y-1.5 text-sm font-medium">
                    <span>Nama ekskul</span>
                    <input
                        name="name"
                        type="text"
                        required
                        maxlength="100"
                        value="{{ old('name', $editingExtracurricular?->name) }}"
                        class="w-full rounded-md border border-white/20 bg-white px-3 py-2.5 text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/40"
                    >
                    @error('name')
                        <span class="block text-sm text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block space-y-1.5 text-sm font-medium">
                    <span>Gambar ekskul</span>
                    <input
                        name="image"
                        type="file"
                        accept="image/*"
                        @required(! $editingExtracurricular)
                        class="w-full cursor-pointer rounded-md border border-white/20 bg-white text-sm text-[#003135] outline-none transition file:mr-4 file:border-0 file:bg-[#10A4B0] file:px-4 file:py-2.5 file:font-semibold file:text-white hover:file:bg-[#0d8a95] focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/40"
                    >
                    <span class="block text-xs font-normal text-white/70">
                        {{ $editingExtracurricular ? 'Pilih gambar baru jika ingin mengganti gambar saat ini.' : 'Pilih file gambar dari perangkat Anda.' }}
                    </span>
                    @error('image')
                        <span class="block text-sm text-red-300">{{ $message }}</span>
                    @enderror
                </label>

                <img
                    id="ekskul-image-preview"
                    src="{{ $editingExtracurricular ? Illuminate\Support\Facades\Storage::disk('public')->url($editingExtracurricular->image_path) : '' }}"
                    class="{{ $editingExtracurricular ? '' : 'hidden' }} max-h-48 w-full rounded-md border border-white/20 object-cover"
                    alt="Pratinjau gambar ekskul"
                >
                <p id="ekskul-image-error" class="hidden text-sm text-red-300" role="alert"></p>

                <label class="block space-y-1.5 text-sm font-medium">
                    <span>Deskripsi</span>
                    <textarea
                        name="description"
                        required
                        rows="4"
                        maxlength="1000"
                        class="w-full resize-y rounded-md border border-white/20 bg-white px-3 py-2.5 text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/40"
                    >{{ old('description', $editingExtracurricular?->description) }}</textarea>
                    @error('description')
                        <span class="block text-sm text-red-300">{{ $message }}</span>
                    @enderror
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
                if (selectButton) {
                    const card = selectButton.closest('.ekskul-card');
                    if (card) {
                        selectCard(card);
                    }
                }

                @if ($isAdmin)
                    const editButton = target.closest('[data-ekskul-edit]');
                    if (editButton) {
                        openForm(editButton.closest('.ekskul-card'));
                    }
                @endif
            });

            const initialCard = track.querySelector('.ekskul-card.is-active');
            if (initialCard) {
                selectCard(initialCard);
            }

            @if ($isAdmin)
                const dialog = document.getElementById('ekskul-dialog');
                const form = document.getElementById('ekskul-form');
                const formTitle = document.getElementById('ekskul-dialog-title');
                const createButton = document.getElementById('ekskul-create');
                const formId = form.elements.namedItem('editing_extracurricular_id');
                const nameInput = form.elements.namedItem('name');
                const descriptionInput = form.elements.namedItem('description');
                const imageInput = form.elements.namedItem('image');
                const imagePreview = document.getElementById('ekskul-image-preview');
                const imageError = document.getElementById('ekskul-image-error');
                let temporaryImageUrl = null;
                let methodInput = form.querySelector('input[name="_method"]');
                const validationFailed = @json($errors->any() && old('extracurricular_form'));

                const clearTemporaryImage = () => {
                    if (temporaryImageUrl) {
                        URL.revokeObjectURL(temporaryImageUrl);
                        temporaryImageUrl = null;
                    }
                };

                const showImageError = (message = '') => {
                    imageError.textContent = message;
                    imageError.classList.toggle('hidden', message === '');
                };

                const setRequestMethod = (isEditing) => {
                    if (isEditing && !methodInput) {
                        methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        form.append(methodInput);
                    } else if (!isEditing && methodInput) {
                        methodInput.remove();
                        methodInput = null;
                    }
                };

                const openForm = (card = null) => {
                    clearTemporaryImage();
                    form.reset();
                    form.action = card?.dataset.updateUrl ?? form.dataset.createAction;
                    formId.value = card?.dataset.ekskulId ?? '';
                    nameInput.value = card?.dataset.nama ?? '';
                    descriptionInput.value = card?.dataset.deskripsi ?? '';
                    imageInput.required = !card;
                    showImageError();
                    if (card) {
                        imagePreview.src = card.dataset.gambar;
                    } else {
                        imagePreview.removeAttribute('src');
                    }
                    imagePreview.classList.toggle('hidden', !card);
                    setRequestMethod(Boolean(card));
                    formTitle.textContent = card ? 'Edit Ekskul' : 'Tambah Ekskul';
                    dialog.showModal();
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
                    imagePreview.src = temporaryImageUrl;
                    imagePreview.classList.remove('hidden');
                });

                createButton.addEventListener('click', () => openForm());
                document.getElementById('ekskul-dialog-close').addEventListener('click', closeForm);
                document.getElementById('ekskul-dialog-cancel').addEventListener('click', closeForm);

                dialog.addEventListener('click', (event) => {
                    if (event.target === dialog) {
                        closeForm();
                    }
                });

                if (validationFailed) {
                    dialog.showModal();
                }
            @endif
        });
    </script>

@endsection
