@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="mx-auto max-w-4xl py-8">
    <div class="mb-6">
        <a href="{{ route('students.index') }}" class="inline-flex items-center gap-2 rounded-md bg-[#10A4B0] px-4 py-2 text-sm font-semibold text-white transition hover:bg-[#0e8f9a]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <article>
        <h1 class="mb-4 text-4xl font-semibold leading-tight text-[#003135] md:text-5xl">
            Lomen ipsum dot sit a jumping fox running on a
        </h1>

        <p class="mb-6 text-sm text-slate-500 md:text-base">20/12/2099</p>

        <img
            src="https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=1200&q=80"
            alt="News detail"
            class="mb-8 h-[280px] w-full object-cover md:h-[420px]"
        >

        <div class="text-justify text-lg leading-8 text-slate-700">
            <p>
                Lomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on aLomen ipsum dot sit a jumping fox running on a.
            </p>
        </div>
    </article>
</div>
@endsection
