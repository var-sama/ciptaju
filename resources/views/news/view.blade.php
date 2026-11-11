@extends('layouts.app')

@section('title', $news->title)

@section('content')
{{-- Wrapper Luar disamakan dengan halaman Prestasi (px-6 md:px-10 py-12 bg-[#ffffff]) --}}
<section class="w-full min-h-screen bg-[#ffffff] font-['DM_Sans'] px-6 md:px-10 py-12">
    
    {{-- Container Utama disamakan dengan max-w-7xl --}}
    <div class="max-w-8xl mx-auto">
        
        {{-- Tombol Back mentok kiri mengikuti batas max-w-7xl --}}
        <div class="mb-10">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 rounded-sm bg-[#044952] px-4 py-2 text-lg font-bold text-white transition hover:bg-[#03363d]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back
            </a>
        </div>

        {{-- Konten Artikel (Tetap ditengah dengan batas max-w-4xl) --}}
        <div class="mx-auto max-w-4xl">
            <article>
                <h1 class="mb-4 text-4xl font-semibold leading-tight text-[#003135] md:text-5xl">
                    {{ $news->title }}
                </h1>

                <div class="mb-6 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500 md:text-base">
                    <span>{{ $news->published_at->format('d/m/Y') }}</span>
                </div>

                <img
                    src="{{ Illuminate\Support\Facades\Storage::disk('public')->url($news->image_path) }}"
                    alt="{{ $news->title }}"
                    class="mb-8 h-70 w-full object-cover md:h-105"
                >

                <div class="text-justify text-lg leading-8 text-slate-700 whitespace-pre-line">
                    {{ $news->content }}
                </div>
            </article>
        </div>

    </div>
</section>
@endsection