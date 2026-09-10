@extends('layouts.app')
@section('title', $title)
@section('content')

    <div class="w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] -mt-4 md:-mt-6 h-[350px] md:h-[450px] flex items-center justify-center bg-cover bg-center grayscale mb-12 shadow-md" style="background-image: url('https://images.unsplash.com/photo-1461360370896-922624d12aa1?q=80&w=1200&auto=format&fit=crop');">
        <div class="absolute inset-0 bg-black/50"></div>
        <h1 class="relative z-10 text-4xl md:text-5xl font-bold text-white tracking-wider">
            History
        </h1>
    </div>

    <!-- History Cards -->
    <div class="w-screen relative left-1/2 right-1/2 -ml-[50vw] -mr-[50vw] px-8 lg:px-12 mb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7 w-full">

            <!-- 1945 -->
            <div onclick="openModal(
                '1945 - Pendirian Awal',
                'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=800&auto=format&fit=crop',
                'Loremipsum kentut botol jelek sduhdfg deew wy w rewl wuirweuirheur ewuli yrey rwur uew ruew ruy ryu ry r78. Ini adalah deskripsi lengkap mengenai sejarah berdirinya pada tahun 1945.'
            )"
            class="bg-white p-5 rounded-lg shadow-md border border-slate-200 cursor-pointer hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">

                <div>
                    <div class="h-64 w-full bg-slate-100 rounded-md mb-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=600&auto=format&fit=crop"
                             alt="History 1"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-2xl font-bold text-center text-slate-900 mb-2">
                        1945
                    </h3>

                    <p class="text-sm text-slate-600 leading-relaxed text-center line-clamp-3">
                       Sekolah mulai berdiri dengan tujuan memberikan pendidikan yang baik bagi masyarakat dan menjadi tempat belajar bagi generasi muda.
                    </p>
                </div>
            </div>


            <!-- 1950 -->
            <div onclick="openModal(
                '1950 - Perkembangan Pesat',
                'https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800&auto=format&fit=crop',
                'Loremipsum kentut botol jelek sduhdfg deew wy w rewl wuirweuirheur ewuli yrey rwur uew ruew ruy ryu ry r78. Penambahan fasilitas dan perluasan area pembelajaran.'
            )"
            class="bg-white p-5 rounded-lg shadow-md border border-slate-200 cursor-pointer hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">

                <div>
                    <div class="h-64 w-full bg-slate-100 rounded-md mb-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=600&auto=format&fit=crop"
                             alt="History 2"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-2xl font-bold text-center text-slate-900 mb-2">
                        1950
                    </h3>

                    <p class="text-sm text-slate-600 leading-relaxed text-center line-clamp-3">
                        Sekolah mulai berkembang dengan bertambahnya jumlah siswa, tenaga pengajar, serta fasilitas yang mendukung kegiatan pembelajaran.
                    </p>
                </div>
            </div>


            <!-- 1980 -->
            <div onclick="openModal(
                '1980 - Era Modernisasi',
                'https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=800&auto=format&fit=crop',
                'Loremipsum kentut botol jelek sduhdfg deew wy w rewl wuirweuirheur ewuli yrey rwur uew ruew ruy ryu ry r78. Pembangunan gedung baru dan laboratorium komputer pertama.'
            )"
            class="bg-white p-5 rounded-lg shadow-md border border-slate-200 cursor-pointer hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">

                <div>
                    <div class="h-64 w-full bg-slate-100 rounded-md mb-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=600&auto=format&fit=crop"
                             alt="History 3"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-2xl font-bold text-center text-slate-900 mb-2">
                        1980
                    </h3>

                    <p class="text-sm text-slate-600 leading-relaxed text-center line-clamp-3">
                        Pada periode ini, sekolah mengalami perkembangan yang cukup pesat melalui pembangunan fasilitas baru dan peningkatan kualitas pendidikan.
                    </p>
                </div>
            </div>


            <!-- 2000 -->
            <div onclick="openModal(
                '2000 - Menuju Digitalisasi',
                'https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=800&auto=format&fit=crop',
                'Loremipsum kentut botol jelek sduhdfg deew wy w rewl wuirweuirheur ewuli yrey rwur uew ruew ruy ryu ry r78. Integrasi sistem digital penuh ke dalam kegiatan akademik.'
            )"
            class="bg-white p-5 rounded-lg shadow-md border border-slate-200 cursor-pointer hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col justify-between">

                <div>
                    <div class="h-64 w-full bg-slate-100 rounded-md mb-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?q=80&w=600&auto=format&fit=crop"
                             alt="History 4"
                             class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-2xl font-bold text-center text-slate-900 mb-2">
                        2000
                    </h3>

                    <p class="text-sm text-slate-600 leading-relaxed text-center line-clamp-3">
                        Sekolah mulai mengikuti perkembangan teknologi dengan memanfaatkan komputer dan sistem digital dalam kegiatan belajar dan administrasi.
                    </p>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="historyModal"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden opacity-0 transition-opacity duration-300">

        <div id="modalContent"
             class="bg-white w-11/12 max-w-xl p-6 rounded-xl shadow-2xl transform scale-95 transition-transform duration-300">

            <div class="flex justify-between items-center mb-4">
                <h3 id="modalTitle"
                    class="text-2xl font-bold text-slate-900">
                </h3>

                <button onclick="closeModal()"
                        class="text-slate-500 hover:text-slate-800 text-2xl font-bold">
                    &times;
                </button>
            </div>

            <div class="h-64 rounded-lg overflow-hidden mb-4">
                <img id="modalImage"
                     src=""
                     alt="History Detail"
                     class="w-full h-full object-cover">
            </div>

            <p id="modalDesc"
               class="text-slate-600 leading-relaxed text-base mb-6">
            </p>

            <div class="text-right">
                <button onclick="closeModal()"
                        class="px-5 py-2 bg-cyan-600 text-white font-medium rounded-md hover:bg-cyan-700 transition">
                    Tutup
                </button>
            </div>

        </div>
    </div>


    <script>
        function openModal(title, imageSrc, description) {

            const modal = document.getElementById('historyModal');
            const modalContent = document.getElementById('modalContent');

            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalDesc').innerText = description;

            modal.classList.remove('hidden');

            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }


        function closeModal() {

            const modal = document.getElementById('historyModal');
            const modalContent = document.getElementById('modalContent');

            modal.classList.add('opacity-0');

            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }


        // Tutup modal jika klik di luar area kotak putih
        window.onclick = function(event) {

            const modal = document.getElementById('historyModal');

            if (event.target === modal) {
                closeModal();
            }
        }
    </script>

@endsection