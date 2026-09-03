@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
<div class="mx-auto max-w-4xl py-8">
    <div class="mb-6">
        <a href="{{ route('students.index') }}" class="-ml-20 inline-flex items-center gap-3 rounded-sm bg-[#044952] px-12 py-3 text-lg font-semibold text-white transition hover:bg-[#03363d]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                class="mb-8 h-70 w-full object-cover md:h-105"
        >

        <div class="text-justify text-lg leading-8 text-slate-700">
            <p>
                Salah satu siswa Ciptaju berhasil meraih prestasi membanggakan dalam sebuah perlombaan dan membawa pulang piala sebagai bentuk penghargaan atas kerja kerasnya. Dengan senyum penuh kebanggaan dan semangat kemenangan, ia menunjukkan bahwa usaha yang dilakukan dengan sungguh-sungguh dapat menghasilkan pencapaian yang berarti. Sebelum mengikuti perlombaan, siswa tersebut rutin berlatih dan mempersiapkan diri dengan bimbingan guru serta dukungan penuh dari keluarga. Setiap proses latihan menjadi kesempatan untuk meningkatkan kemampuan, membangun rasa percaya diri, dan belajar menghadapi tantangan dengan sikap pantang menyerah. Prestasi ini tidak hanya menjadi kebanggaan bagi siswa dan keluarganya, tetapi juga bagi seluruh warga sekolah. Pihak sekolah memberikan apresiasi atas pencapaian tersebut dan berharap keberhasilan ini dapat menginspirasi siswa lainnya untuk berani mengikuti berbagai kegiatan, mengembangkan bakat, serta terus berusaha meraih prestasi di bidang yang mereka minati. Pencapaian ini juga menjadi pengingat bahwa kerja sama antara siswa, guru, dan orang tua memiliki peran penting dalam mendukung perkembangan serta keberhasilan setiap peserta didik.
            </p>
        </div>
    </article>
</div>
@endsection
