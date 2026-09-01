@extends('layouts.app')

@section('title', 'Register - Sekolah Ciptaju')

@section('content')
    <div class="min-h-screen flex text-gray-800 bg-white" x-data="{ showPassword: false }">
        <!-- Form Section (Kiri) -->
        <div class="w-full lg:w-5/12 flex flex-col justify-between p-8 md:p-12 lg:p-16">

            <!-- Logo Sekolah -->
            <div class="mb-8">
                <img src="{{ asset('images/logo-ciptaju.png') }}" alt="Sekolah Ciptaju Logo" class="h-24 w-auto">
            </div>

            <!-- Form Container -->
            <div class="w-full max-w-md mx-auto my-auto">
                <h1 class="text-3xl font-bold mb-8 text-gray-900">Register</h1>

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition duration-150 text-sm placeholder-gray-400">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Password (dengan Toggle Eye Icon) -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" id="password" name="password"
                                placeholder="Enter your password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition duration-150 text-sm placeholder-gray-400 pr-10">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                <!-- Eye Icon -->
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm
                            Password</label>
                        <input :type="showPassword ? 'text' : 'password'" id="password_confirmation"
                            name="password_confirmation" placeholder="Enter your password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent transition duration-150 text-sm placeholder-gray-400">
                    </div>

                    <!-- Action Button -->
                    <div class="pt-2">
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

            <!-- Login Link (Bottom Left) -->
            <div class="mt-8 text-sm">
                <p class="text-teal-900 font-medium">Already have an account?</p>
                <a href="{{ route('login') }}" class="font-bold text-gray-900 hover:underline">
                    Log in here
                </a>
            </div>
        </div>

        <!-- Hero Image Section (Kanan) -->
        <div class="hidden lg:block lg:w-7/12 relative">
            <img src="{{ asset('images/ciptaju-building.jpg') }}" alt="Gedung Sekolah Ciptaju"
                class="absolute inset-0 w-full h-full object-cover object-center">
        </div>
    </div>
@endsection