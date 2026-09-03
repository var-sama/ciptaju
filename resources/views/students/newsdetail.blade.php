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
            Siswa Ciptaju Berhasil Meraih Prestasi dan Membawa Pulang Piala
        </h1>

        <p class="mb-6 text-sm text-slate-500 md:text-base">20 Desember 2025</p>

        <img
            src="https://i.pinimg.com/736x/a1/0f/17/a10f17300e0ea1cea46c22afb75481e7.jpg"
            alt="Siswa memegang piala dan merayakan prestasi"
            class="mb-8 h-[280px] w-full object-cover md:h-[420px]"
        >

        <div class="text-justify text-lg leading-8 text-slate-700">
            <p>
               Salah satu siswa Ciptaju berhasil meraih prestasi membanggakan dalam sebuah perlombaan dan membawa pulang piala sebagai bentuk penghargaan atas kerja kerasnya. Dengan senyum penuh kebanggaan dan semangat kemenangan, ia menunjukkan bahwa usaha yang dilakukan dengan sungguh-sungguh dapat menghasilkan pencapaian yang berarti. Prestasi ini tidak hanya menjadi kebanggaan bagi siswa dan keluarganya, tetapi juga bagi seluruh warga sekolah. Pihak sekolah memberikan apresiasi atas pencapaian tersebut dan berharap keberhasilan ini dapat menginspirasi siswa lainnya untuk berani mengikuti berbagai kegiatan, mengembangkan bakat, serta terus berusaha meraih prestasi di bidang yang mereka minati.
            </p>
        </div>
    </article>
</div>
@endsection
