@extends('layouts.app')

@section('title', 'Pendaftaran Siswa')

@section('content')
<div class="relative left-1/2 -my-10 min-h-screen w-screen -translate-x-1/2 bg-white">
    <section>
        <img
            src="https://i.pinimg.com/736x/a1/0f/17/a10f17300e0ea1cea46c22afb75481e7.jpg"
            alt="Siswa Ciptaju memegang piala"
            class="block h-80 w-full object-cover object-center"
            onerror="this.src='https://ui-avatars.com/api/?name=Siswa+Ciptaju&background=0D9488&color=fff&size=1200'"
        >

        <div class="px-6 py-8 md:py-9">
            <div class="mx-auto w-[85%] max-w-2xl">
                <h1 class="mb-6 text-center text-base font-normal text-[#003135]">Register</h1>

                @if (session('success'))
                    <div class="mb-4 rounded-md bg-emerald-50 px-4 py-3 text-sm text-emerald-700" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                        Periksa kembali data pendaftaran yang belum sesuai.
                    </div>
                @endif

                <form action="{{ route('students.registration.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 items-center gap-x-[3%] gap-y-4 md:grid-cols-[25%_minmax(0,1fr)]">
                        <div class="contents">
                            <div class="grid grid-cols-1 items-center gap-[3%] order-1 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="school_target" class="text-[10px] text-[#003135]">School Target</label>
                                <select id="school_target" name="school_target" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-[10px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <option value="">Dropdown item</option>
                                    <option value="SD" @selected(old('school_target') === 'SD')>SD</option>
                                    <option value="SMP" @selected(old('school_target') === 'SMP')>SMP</option>
                                    <option value="SMA" @selected(old('school_target') === 'SMA')>SMA</option>
                                </select>
                                @error('school_target')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 items-center gap-[3%] order-3 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="student_name" class="text-[10px] text-[#003135]">Student's Name</label>
                                <input id="student_name" name="student_name" type="text" value="{{ old('student_name') }}" required class="h-9 w-full rounded-md border border-[#7d9da0] px-3 text-[10px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('student_name')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 items-center gap-[3%] order-5 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="password" class="text-[10px] text-[#003135]">Make Password</label>
                                <div class="relative">
                                    <input id="password" name="password" type="password" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 py-2.5 pr-10 text-[10px] text-[#003135] opacity-100 outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <button type="button" data-password-toggle="password" class="absolute inset-y-0 right-0 flex items-center px-3 text-[#64748b]" aria-label="Tampilkan kata sandi" aria-pressed="false">
                                        <svg data-eye-icon="password" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                                @error('password')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 items-center gap-[3%] order-7 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="active_number" class="text-[10px] text-[#003135]">Active Number</label>
                                <input id="active_number" name="active_number" type="tel" value="{{ old('active_number') }}" required class="h-9 w-full rounded-md border border-[#7d9da0] px-3 text-[10px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('active_number')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="contents">
                            <div class="grid grid-cols-1 items-center gap-[3%] order-2 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="school_year" class="text-[10px] text-[#003135]">School Year</label>
                                <select id="school_year" name="school_year" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-[10px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <option value="">Dropdown item</option>
                                    <option value="2026/2027" @selected(old('school_year') === '2026/2027')>2026/2027</option>
                                    <option value="2027/2028" @selected(old('school_year') === '2027/2028')>2027/2028</option>
                                </select>
                                @error('school_year')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 items-center gap-[3%] order-4 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="email" class="text-[10px] text-[#003135]">Email Address</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required class="h-9 w-full rounded-md border border-[#7d9da0] px-3 text-[10px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('email')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="grid grid-cols-1 items-center gap-[3%] order-6 md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="password_confirmation" class="text-[10px] text-[#003135]">Re-enter Password</label>
                                <div class="relative">
                                    <input id="password_confirmation" name="password_confirmation" type="password" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 py-2.5 pr-10 text-[10px] text-[#003135] opacity-100 outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <button type="button" data-password-toggle="password_confirmation" class="absolute inset-y-0 right-0 flex items-center px-3 text-[#64748b]" aria-label="Tampilkan konfirmasi kata sandi" aria-pressed="false">
                                        <svg data-eye-icon="password_confirmation" class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 md:ml-[28%] md:w-[72%]">
                        <button type="submit" class="w-full rounded-lg bg-[#10A4B0] px-6 py-2.5 text-sm font-medium text-white transition hover:bg-[#0e8f9a] focus:outline-none focus:ring-2 focus:ring-[#10A4B0] focus:ring-offset-2">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((toggleButton) => {
            toggleButton.addEventListener('click', () => {
                const passwordInput = document.getElementById(toggleButton.dataset.passwordToggle);
                const isPasswordHidden = passwordInput.type === 'password';

                passwordInput.type = isPasswordHidden ? 'text' : 'password';
                toggleButton.setAttribute('aria-pressed', String(isPasswordHidden));
                toggleButton.setAttribute('aria-label', isPasswordHidden ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
            });
        });
    </script>
</div>
@endsection