@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
    <section class="min-h-[70vh] bg-[#F7F6F2] px-4 py-10 font-['DM_Sans'] text-[#003135] sm:px-6 lg:px-10 lg:py-14">
        <div class="mx-auto max-w-7xl space-y-8">
            <header class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#10A4B0]">Admin dashboard</p>
                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#003135] sm:text-4xl">Manajemen Pengguna</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-600 sm:text-base">
                        Lihat dan kelola akun pengguna sekolah dari satu tempat.
                    </p>
                </div>
                <button
                    type="button"
                    id="user-create"
                    class="inline-flex shrink-0 items-center justify-center gap-2 rounded-lg bg-[#10A4B0] px-5 py-3 font-bold text-white shadow-sm transition hover:bg-[#0d8a95] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#003135]"
                >
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14"></path>
                    </svg>
                    Tambah pengguna
                </button>
            </header>

            <p class="flex items-start gap-3 rounded-lg border border-[#10A4B0]/30 bg-white px-4 py-3 text-sm text-slate-600 shadow-sm" role="status">
                <svg class="mt-0.5 h-5 w-5 shrink-0 text-[#10A4B0]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01"></path>
                </svg>
                Mode frontend: perubahan data hanya tersimpan sementara di halaman ini dan akan hilang saat halaman dimuat ulang.
            </p>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-600">Total pengguna</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#10A4B0]/10 text-[#10A4B0]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M14 3.13a4 4 0 0 1 0 7.75"></path>
                                <circle cx="10" cy="7" r="4"></circle>
                            </svg>
                        </span>
                    </div>
                    <p id="stat-total" class="mt-4 text-3xl font-bold text-[#003135]">0</p>
                </article>

                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-600">Admin</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-50 text-violet-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3 4.5 6v5.5c0 4.1 2.8 7.8 7.5 9.5 4.7-1.7 7.5-5.4 7.5-9.5V6L12 3Z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"></path>
                            </svg>
                        </span>
                    </div>
                    <p id="stat-admin" class="mt-4 text-3xl font-bold text-[#003135]">0</p>
                </article>

            </div>

            <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm" aria-labelledby="users-heading">
                <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 id="users-heading" class="text-xl font-bold text-[#003135]">Daftar pengguna</h2>
                        <p class="mt-1 text-sm text-slate-500">Kelola akun admin, guru, siswa, dan pengguna lainnya.</p>
                    </div>

                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:w-auto">
                        <label class="relative block">
                            <span class="sr-only">Cari pengguna</span>
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input
                                type="search"
                                id="user-search"
                                placeholder="Cari nama atau email"
                                class="w-full rounded-lg border border-slate-300 py-2.5 pl-9 pr-3 text-sm text-[#003135] outline-none transition placeholder:text-slate-400 focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20 sm:w-64"
                            >
                        </label>
                        <label>
                            <span class="sr-only">Filter peran</span>
                            <select id="user-role-filter" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
                                <option value="">Semua peran</option>
                                <option value="Admin">Admin</option>
                                <option value="Guru">Guru</option>
                                <option value="Siswa">Siswa</option>
                                <option value="Pengguna">Pengguna</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[680px] text-left text-sm">
                        <thead class="bg-[#003135]/[0.04] text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-bold">Pengguna</th>
                                <th scope="col" class="px-5 py-4 font-bold">Peran</th>
                                <th scope="col" class="px-5 py-4 font-bold">Tanggal bergabung</th>
                                <th scope="col" class="px-5 py-4 text-right font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body" class="divide-y divide-slate-100"></tbody>
                    </table>
                </div>

                <div id="user-empty-state" class="hidden px-5 py-14 text-center">
                    <span class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-[#10A4B0]/10 text-[#10A4B0]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M8 11h6"></path>
                        </svg>
                    </span>
                    <h3 class="mt-4 font-bold text-[#003135]">Pengguna tidak ditemukan</h3>
                    <p class="mt-1 text-sm text-slate-500">Coba ubah kata kunci pencarian atau filter peran.</p>
                </div>

                <div class="flex flex-col gap-2 border-t border-slate-200 px-5 py-4 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                    <p id="user-count">Menampilkan 0 pengguna</p>
                    <p>Data contoh untuk pratinjau antarmuka</p>
                </div>
            </section>
        </div>
    </section>

    <dialog
        id="user-dialog"
        class="m-auto w-[min(92vw,36rem)] max-w-none rounded-xl border border-[#10A4B0]/30 bg-white p-0 text-[#003135] shadow-2xl backdrop:bg-[#003135]/60"
        aria-labelledby="user-dialog-title"
    >
        <form id="user-form" class="space-y-5 p-6 sm:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 id="user-dialog-title" class="text-2xl font-bold">Tambah pengguna</h2>
                    <p id="user-dialog-description" class="mt-1 text-sm text-slate-500">Isi informasi akun pengguna.</p>
                </div>
                <button type="button" id="user-dialog-close" class="rounded-md p-1 text-slate-400 transition hover:bg-slate-100 hover:text-[#003135] focus-visible:outline-2 focus-visible:outline-[#10A4B0]" aria-label="Tutup formulir">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m6 6 12 12M18 6 6 18"></path>
                    </svg>
                </button>
            </div>

            <input type="hidden" name="id">

            <label class="block space-y-1.5 text-sm font-semibold">
                <span>Nama lengkap</span>
                <input name="name" type="text" required maxlength="120" autocomplete="name" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 font-normal text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
            </label>

            <label class="block space-y-1.5 text-sm font-semibold">
                <span>Email</span>
                <input name="email" type="email" required maxlength="255" autocomplete="email" class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 font-normal text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
            </label>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <label class="block space-y-1.5 text-sm font-semibold">
                    <span>Peran</span>
                    <select name="role" required class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 font-normal text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20">
                        <option value="Admin">Admin</option>
                        <option value="Guru">Guru</option>
                        <option value="Siswa">Siswa</option>
                        <option value="Pengguna">Pengguna</option>
                    </select>
                </label>
            </div>

            <p id="user-form-error" class="hidden rounded-lg bg-red-50 px-3 py-2 text-sm text-red-700" role="alert"></p>

            <div class="flex justify-end gap-3 border-t border-slate-100 pt-5">
                <button type="button" id="user-dialog-cancel" class="rounded-lg border border-slate-300 px-4 py-2.5 font-semibold text-[#003135] transition hover:bg-slate-50">Batal</button>
                <button type="submit" id="user-save" class="rounded-lg bg-[#10A4B0] px-5 py-2.5 font-bold text-white transition hover:bg-[#0d8a95] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#003135]">Simpan pengguna</button>
            </div>
        </form>
    </dialog>

@endsection
