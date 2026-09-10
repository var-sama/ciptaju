@extends('layouts.auth')

@section('title', 'Login - Sekolah Ciptaju')

@section('content')
    <div class="min-h-screen flex text-gray-800 bg-white">
        
        {{-- Bagian Kiri (Form) --}}
        <div class="w-full lg:w-5/12 flex flex-col justify-between">

            {{-- Header Kiri: Tombol Back & Logo --}}
            <div class="w-full px-6 md:px-10 pt-8">
                {{-- Back Button (Margin Atas & Kiri/Kanan) --}}
                <div class="mb-12">
                    <a href="{{ route('students.index') }}" class="inline-flex items-center gap-2 text-teal-900 hover:text-teal-700 transition-colors font-['DM_Sans'] font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Back
                    </a>
                </div>
            </div>

            {{-- Form Login (Centered) --}}
            <div class="w-full flex flex-col justify-center items-center py-12 px-8">
                {{-- Logo Ciptaju --}}
                <div class="mb-8">
                    <img src="{{ asset('assets/logo-ciptaju.png') }}" alt="Sekolah Ciptaju Logo" class="h-32 w-auto">
                </div>

                <div class="w-full max-w-md">
                    <h1 class="text-3xl font-bold mb-8 text-gray-900">Login</h1>

                    <form action="{{ route('auth.login') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition duration-150 text-sm placeholder-gray-400">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition duration-150 text-sm placeholder-gray-400">
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tombol Submit Ditengahkan --}}
                        <div class="pt-2 flex justify-center">
                            <button type="submit"
                                class="w-12 h-12 rounded-lg border border-teal-700 text-teal-800 hover:bg-teal-700 hover:text-white transition duration-200 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-teal-600">
                                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Footer Kiri (Dengan Margin Halaman) --}}
            <div class="px-6 md:px-10 pb-8 text-sm">
                <p class="text-teal-900 font-medium">Don't have an account yet?</p>
                <a href="{{ route('auth.register') }}" class="font-bold text-gray-900 hover:underline">
                    Register now
                </a>
            </div>
        </div>

        {{-- Bagian Kanan (Gambar Gedung) --}}
        <div class="hidden lg:block lg:w-7/12 relative">
            <img src="{{ asset('assets/ciptaju-building.png') }}" alt="Gedung Sekolah Ciptaju"
                class="absolute inset-0 w-full h-full object-cover object-center">
        </div>
    </div>
@endsection