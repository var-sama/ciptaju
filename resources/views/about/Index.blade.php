@extends('layouts.app')
@section('title', $title)
@section('content')

    <div class="w-full overflow-x-hidden">
        <a href="{{ route('about.view') }}"
           class="block w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]
                 h-[350px] md:h-[450px] flex items-center justify-center
                 bg-cover bg-center grayscale mb-8 shadow-md
                 transition-all duration-300 hover:shadow-2xl
                 hover:grayscale-0 cursor-pointer"
           style="background-image: url('https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=1200&auto=format&fit=crop');">

            <div class="absolute inset-0 bg-black/40"></div>

            <h1 class="relative z-10 text-4xl md:text-5xl font-bold text-white tracking-wider">
                About Us
            </h1>

        </a>


        <a href="{{ route('about.discover') }}"
           class="block w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw]
                 h-[350px] md:h-[450px] flex items-center justify-center
                 bg-cover bg-center grayscale mb-8 shadow-md
                 transition-all duration-300 hover:shadow-2xl
                 hover:grayscale-0 cursor-pointer"
           style="background-image: url('https://images.unsplash.com/photo-1461360370896-922624d12aa1?q=80&w=1200&auto=format&fit=crop');">

            <div class="absolute inset-0 bg-black/50"></div>

            <h2 class="relative z-10 text-4xl md:text-5xl font-bold text-white tracking-wider">
                History
            </h2>

        </a>
    </div>

@endsection