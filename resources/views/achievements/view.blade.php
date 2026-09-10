@extends('layouts.app')

@section('title', 'Detail Berita')

@section('content')
{{-- Wrapper Luar disamakan dengan halaman Prestasi (px-6 md:px-10 py-12 bg-[#ffffff]) --}}
<section class="w-full min-h-screen bg-[#ffffff] font-['DM_Sans'] px-6 md:px-10 py-12">
    
    {{-- Container Utama disamakan dengan max-w-7xl --}}
    <div class="max-w-8xl mx-auto">
        
        {{-- Tombol Back mentok kiri mengikuti batas max-w-7xl --}}
        <div class="mb-10">
            <a href="{{ route('achievements.index') }}" class="inline-flex items-center gap-2 rounded-sm bg-[#044952] px-4 py-2 text-lg font-bold text-white transition hover:bg-[#03363d]">
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
                    Siswa Ciptaju Berhasil Meraih Prestasi dan Membawa Pulang Piala
                </h1>

                <p class="mb-6 text-sm text-slate-500 md:text-base">20/12/2099</p>

                <img
                    src="{{ Vite::asset('resources/assets/siswaprestasi.jpg') }}"
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

    </div>
</section>
@endsection