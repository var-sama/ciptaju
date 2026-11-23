@extends('layouts.app')

@section('title', 'Pendaftaran Murid')

@section('content')
    <section class="min-h-[70vh] bg-[#F7F6F2] px-4 py-10 font-['DM_Sans'] text-[#003135] sm:px-6 lg:px-10 lg:py-14">
        <div class="mx-auto max-w-7xl space-y-8">
            <header>
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#10A4B0]">Admin dashboard</p>
                <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#003135] sm:text-4xl">Pendaftaran Murid</h1>
                <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-600 sm:text-base">
                    Lihat data calon murid dan tinjau status pendaftarannya.
                </p>
            </header>

            @if (session('success'))
                <p class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                    {{ session('success') }}
                </p>
            @endif

            <section class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm" aria-labelledby="registration-heading">
                <div class="border-b border-slate-200 p-5 sm:p-6">
                    <h2 id="registration-heading" class="text-xl font-bold text-[#003135]">Daftar pendaftar</h2>
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
                                            href="{{ route('admin.registrations.show', $registration) }}"
                                            class="font-bold text-[#087f89] underline-offset-4 hover:underline"
                                        >
                                            Lihat detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center text-slate-500">
                                        Belum ada pendaftaran murid.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($registrations->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4">
                        {{ $registrations->links() }}
                    </div>
                @endif
            </section>
        </div>
    </section>
@endsection
