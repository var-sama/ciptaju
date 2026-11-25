@extends('layouts.app')

@section('title', 'Pendaftaran Murid')

@section('content')
    <section class="min-h-[70vh] bg-[#F7F6F2] px-4 py-10 font-['DM_Sans'] text-[#003135] sm:px-6 lg:px-10 lg:py-14">
        <div class="mx-auto max-w-7xl space-y-8">
            <div class="space-y-4">
                <div>
                    <a
                        href="{{ route('admins.index') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3.5 py-2 text-sm font-semibold text-[#003135] shadow-sm transition hover:border-[#10A4B0] hover:text-[#087f89] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#003135]"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali
                    </a>
                </div>

                <header>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#10A4B0]">Admin dashboard</p>
                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#003135] sm:text-4xl">Pendaftaran Murid</h1>
                    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-600 sm:text-base">
                        Lihat data calon murid dan tinjau status pendaftarannya.
                    </p>
                </header>
            </div>

            @if (session('success'))
                <p class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                    {{ session('success') }}
                </p>
            @endif

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-600">Total Pendaftar</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#10A4B0]/10 text-[#10A4B0]">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M14 3.13a4 4 0 0 1 0 7.75"></path>
                                <circle cx="10" cy="7" r="4"></circle>
                            </svg>
                        </span>
                    </div>
                    <p id="stat-total-registrations" class="mt-4 text-3xl font-bold text-[#003135]">{{ $statistics->total }}</p>
                </article>

                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-600">Pending</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7v5l3 2"></path>
                            </svg>
                        </span>
                    </div>
                    <p id="stat-pending-registrations" class="mt-4 text-3xl font-bold text-[#003135]">{{ $statistics->pending }}</p>
                </article>

                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-600">Diterima</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-50 text-emerald-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8 12 2.5 2.5L16 9"></path>
                            </svg>
                        </span>
                    </div>
                    <p id="stat-accepted-registrations" class="mt-4 text-3xl font-bold text-[#003135]">{{ $statistics->accepted }}</p>
                </article>

                <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-sm font-semibold text-slate-600">Ditolak</p>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50 text-rose-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="12" cy="12" r="9"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 9 6 6m0-6-6 6"></path>
                            </svg>
                        </span>
                    </div>
                    <p id="stat-rejected-registrations" class="mt-4 text-3xl font-bold text-[#003135]">{{ $statistics->rejected }}</p>
                </article>
            </div>

            <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm" aria-labelledby="registration-heading">
                <div class="flex flex-col gap-4 border-b border-slate-200 p-5 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 id="registration-heading" class="text-xl font-bold text-[#003135]">Daftar pendaftar</h2>
                        <p class="mt-1 text-sm text-slate-500">Cari nama pendaftar dan saring berdasarkan status.</p>
                    </div>

                    <form method="GET" action="{{ route('admins.registrations.index') }}" class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:w-auto">
                        <label class="relative block">
                            <span class="sr-only">Cari nama pendaftar</span>
                            <svg class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35"></path>
                            </svg>
                            <input
                                type="search"
                                name="search"
                                value="{{ $search }}"
                                placeholder="Cari nama pendaftar"
                                class="w-full rounded-lg border border-slate-300 py-2.5 pl-9 pr-3 text-sm text-[#003135] outline-none transition placeholder:text-slate-400 focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20 sm:w-64"
                            >
                        </label>

                        <label>
                            <span class="sr-only">Filter status</span>
                            <select
                                name="status"
                                onchange="this.form.requestSubmit()"
                                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-[#003135] outline-none transition focus:border-[#10A4B0] focus:ring-2 focus:ring-[#10A4B0]/20"
                            >
                                <option value="" @selected($status === null)>Semua Status</option>
                                @foreach ($statusOptions as $value => $label)
                                    <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </label>

                        <div class="flex items-center gap-3 sm:col-span-2 sm:justify-end">
                            <button
                                type="submit"
                                class="rounded-lg bg-[#10A4B0] px-5 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#0d8a95] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#003135]"
                            >
                                Cari
                            </button>
                            @if ($search !== '' || $status !== null)
                                <a
                                    href="{{ route('admins.registrations.index') }}"
                                    class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-[#003135] transition hover:bg-slate-50"
                                >
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[760px] text-left text-sm">
                        <thead class="bg-[#003135]/[0.04] text-xs uppercase tracking-wide text-slate-500">
                            <tr>
                                <th scope="col" class="px-5 py-4 font-bold">Nama calon murid</th>
                                <th scope="col" class="px-5 py-4 font-bold">Target / tahun ajaran</th>
                                <th scope="col" class="px-5 py-4 font-bold">Tanggal daftar</th>
                                <th scope="col" class="px-5 py-4 font-bold">Status</th>
                                <th scope="col" class="px-5 py-4 text-right font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($registrations as $registration)
                                <tr>
                                    <td class="px-5 py-4 font-semibold">{{ $registration->student_name }}</td>
                                    <td class="px-5 py-4">{{ $registration->school_target }} / {{ $registration->school_year }}</td>
                                    <td class="px-5 py-4">{{ $registration->created_at->format('d M Y') }}</td>
                                    <td class="px-5 py-4 capitalize">{{ $registration->status }}</td>
                                    <td class="px-5 py-4 text-right">
                                        <a
                                            href="{{ route('admins.registrations.show', $registration) }}"
                                            class="font-bold text-[#087f89] underline-offset-4 hover:underline"
                                        >
                                            Lihat detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center text-slate-500">
                                        @if ($search !== '' || $status !== null)
                                            Tidak ada pendaftar yang sesuai dengan pencarian atau filter.
                                        @else
                                            Belum ada pendaftaran murid.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($registrations->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4">
                        <div class="flex flex-col gap-2 text-sm text-slate-500 sm:flex-row sm:items-center sm:justify-between">
                            <p>
                                Menampilkan {{ $registrations->firstItem() }}–{{ $registrations->lastItem() }}
                                dari {{ $registrations->total() }} pendaftar
                            </p>
                            {{ $registrations->links() }}
                        </div>
                    </div>
                @else
                    <div class="border-t border-slate-200 px-5 py-4 text-sm text-slate-500">
                        Menampilkan {{ $registrations->count() }} dari {{ $registrations->total() }} pendaftar
                    </div>
                @endif
            </section>
        </div>
    </section>
@endsection