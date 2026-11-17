@extends('layouts.app')

@section('title', 'Detail Pendaftaran Murid')

@section('content')
    <section class="min-h-[70vh] bg-[#F7F6F2] px-4 py-10 font-['DM_Sans'] text-[#003135] sm:px-6 lg:px-10 lg:py-14">
        <div class="mx-auto max-w-4xl space-y-8">
            <header class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-[#10A4B0]">Admin dashboard</p>
                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#003135] sm:text-4xl">Detail Pendaftaran</h1>
                    <p class="mt-3 text-sm text-slate-600">Informasi pendaftaran calon murid.</p>
                </div>
                <a
                    href="{{ route('admin.registrations.index') }}"
                    class="font-bold text-[#087f89] underline-offset-4 hover:underline"
                >
                    Kembali ke daftar
                </a>
            </header>

            @if (session('success'))
                <p class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="status">
                    {{ session('success') }}
                </p>
            @endif

            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7" aria-labelledby="student-details-heading">
                <h2 id="student-details-heading" class="text-xl font-bold text-[#003135]">Data calon murid</h2>
                <dl class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">School Target</dt>
                        <dd class="mt-1">{{ $registration->school_target }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">School Year</dt>
                        <dd class="mt-1">{{ $registration->school_year }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">Student's Full Name</dt>
                        <dd class="mt-1">{{ $registration->student_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">Gender</dt>
                        <dd class="mt-1">{{ ucfirst($registration->gender) }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">Date of Birth</dt>
                        <dd class="mt-1">{{ $registration->date_of_birth->format('d M Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">Parent/Guardian Name</dt>
                        <dd class="mt-1">{{ $registration->parent_guardian_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-semibold text-slate-500">Parent/Guardian Phone Number</dt>
                        <dd class="mt-1">{{ $registration->parent_guardian_phone }}</dd>
                    </div>
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-semibold text-slate-500">Home Address</dt>
                        <dd class="mt-1 whitespace-pre-line">{{ $registration->home_address }}</dd>
                    </div>
                </dl>
            </section>

            <section class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7" aria-labelledby="registration-status-heading">
                <h2 id="registration-status-heading" class="text-xl font-bold text-[#003135]">Status pendaftaran</h2>
                <form action="{{ route('admin.registrations.status', $registration) }}" method="POST" class="mt-5 flex flex-col gap-4 sm:flex-row sm:items-end">
                    @csrf
                    @method('PATCH')
                    <label class="flex-1 text-sm font-semibold text-[#003135]" for="status">
                        Status
                        <select id="status" name="status" required class="mt-2 h-10 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-sm outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                            <option value="pending" @selected(old('status', $registration->status) === 'pending')>Pending</option>
                            <option value="accepted" @selected(old('status', $registration->status) === 'accepted')>Accepted</option>
                            <option value="rejected" @selected(old('status', $registration->status) === 'rejected')>Rejected</option>
                        </select>
                    </label>
                    <button type="submit" class="rounded-lg bg-[#10A4B0] px-5 py-2.5 font-bold text-white transition hover:bg-[#0e8f9a] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#003135]">
                        Perbarui status
                    </button>
                </form>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </section>
        </div>
    </section>
@endsection
