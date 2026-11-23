@extends('layouts.app')

@section('title', 'Pendaftaran Siswa')

@section('content')
<div class="min-h-screen bg-white">
    <section class="overflow-hidden">
        <img
            src="{{ Vite::asset('resources/assets/gambarpendaf.png') }}"
            alt="Siswa Ciptaju memegang piala"
            class="block h-64 w-full object-cover object-center md:h-80"
            onerror="this.src='https://ui-avatars.com/api/?name=Siswa+Ciptaju&background=0D9488&color=fff&size=1200'"
        >

        <div class="px-6 py-12 md:py-16">
            <div class="mx-auto max-w-2xl">
                <h1 class="mb-8 text-center text-2xl font-bold text-[#003135]">Student Registration</h1>

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

                <form action="{{ route('auth.registration.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 items-center gap-x-[3%] gap-y-4 md:grid-cols-[25%_minmax(0,1fr)]">
                        <div class="contents">
                            <div class="order-1 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="school_target" class="text-[14px] text-[#003135]">School Target</label>
                                <select id="school_target" name="school_target" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <option value="">Dropdown item</option>
                                    <option value="SD" @selected(old('school_target') === 'SD')>SD</option>
                                    <option value="SMP" @selected(old('school_target') === 'SMP')>SMP</option>
                                    <option value="SMA" @selected(old('school_target') === 'SMA')>SMA</option>
                                </select>
                                @error('school_target')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-2 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="school_year" class="text-[14px] text-[#003135]">School Year</label>
                                <select id="school_year" name="school_year" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <option value="">Dropdown item</option>
                                    <option value="2026/2027" @selected(old('school_year') === '2026/2027')>2026/2027</option>
                                    <option value="2027/2028" @selected(old('school_year') === '2027/2028')>2027/2028</option>
                                </select>
                                @error('school_year')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-3 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="student_name" class="text-[14px] text-[#003135]">Student's Full Name</label>
                                <input id="student_name" name="student_name" type="text" value="{{ old('student_name') }}" required maxlength="255" class="h-9 w-full rounded-md border border-[#7d9da0] px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('student_name')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-4 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="gender" class="text-[14px] text-[#003135]">Gender</label>
                                <select id="gender" name="gender" required class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                    <option value="">Dropdown item</option>
                                    <option value="male" @selected(old('gender') === 'male')>Male</option>
                                    <option value="female" @selected(old('gender') === 'female')>Female</option>
                                </select>
                                @error('gender')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-5 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="date_of_birth" class="text-[14px] text-[#003135]">Date of Birth</label>
                                <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth') }}" required max="{{ now()->toDateString() }}" class="h-9 w-full rounded-md border border-[#7d9da0] bg-white px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('date_of_birth')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-6 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="parent_guardian_name" class="text-[14px] text-[#003135]">Parent/Guardian Name</label>
                                <input id="parent_guardian_name" name="parent_guardian_name" type="text" value="{{ old('parent_guardian_name') }}" required maxlength="255" class="h-9 w-full rounded-md border border-[#7d9da0] px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('parent_guardian_name')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-7 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="parent_guardian_phone" class="text-[14px] text-[#003135]">Parent/Guardian Phone Number</label>
                                <input id="parent_guardian_phone" name="parent_guardian_phone" type="tel" value="{{ old('parent_guardian_phone') }}" required maxlength="30" class="h-9 w-full rounded-md border border-[#7d9da0] px-3 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">
                                @error('parent_guardian_phone')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="order-8 grid grid-cols-1 items-center gap-[3%] md:col-span-2 md:grid-cols-[25%_minmax(0,1fr)]">
                                <label for="home_address" class="text-[14px] text-[#003135]">Home Address</label>
                                <textarea id="home_address" name="home_address" rows="3" required maxlength="2000" class="w-full rounded-md border border-[#7d9da0] px-3 py-2 text-[14px] text-[#003135] outline-none focus:border-[#10A4B0] focus:ring-1 focus:ring-[#10A4B0]">{{ old('home_address') }}</textarea>
                                @error('home_address')<p class="mt-1 text-xs text-red-600 md:col-start-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 md:ml-[28%] md:w-[72%]">
                        <button type="submit" class="w-full rounded-lg bg-[#10A4B0] px-6 py-2.5 text-base font-medium text-white transition hover:bg-[#0e8f9a] focus:outline-none focus:ring-2 focus:ring-[#10A4B0] focus:ring-offset-2">Submit Registration</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
