@extends('layouts.app')

@section('title', 'Biodata Siswa - Sekolah Ciptaju')

@section('content')
<div class="py-10 bg-gray-200 min-h-screen flex justify-center items-start px-4 sm:px-6">
    <!-- Main Card Container -->
    <div class="w-full max-w-6xl bg-white rounded-3xl p-6 sm:p-10 md:p-14 shadow-sm border border-gray-100">
        
        <!-- Header Judul -->
        <h1 class="text-center text-2xl md:text-3xl font-bold text-teal-950 tracking-wide mb-6">
            Biodata Siswa
        </h1>

        <!-- Profile Photo -->
        <div class="flex justify-center mb-8">
            <div class="relative w-36 h-36 rounded-full overflow-hidden border-4 border-gray-200 shadow-inner bg-gray-100">
                <img 
                    src="{{ asset('images/avatar-student.jpg') }}" 
                    alt="Foto Profile Siswa" 
                    class="w-full h-full object-cover object-center"
                    onerror="this.src='https://ui-avatars.com/api/?name=Siswa+Ciptaju&background=0D9488&color=fff&size=200'"
                >
            </div>
        </div>

        <!-- Section Sub-Header -->
        <h2 class="text-center text-xl font-bold text-teal-950 tracking-wide mb-10 pb-2 border-b border-gray-100">
            Data Pribadi
        </h2>

        <!-- Form Biodata -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6">
                
                <!-- KOLOM KIRI -->
                <div class="space-y-5">
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-800 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- NIS -->
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-800 mb-1.5">NIS</label>
                        <input type="text" id="nis" name="nis" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- NISN -->
                    <div>
                        <label for="nisn" class="block text-sm font-medium text-gray-800 mb-1.5">NISN</label>
                        <input type="text" id="nisn" name="nisn" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-800 mb-1.5">Jenis Kelamin</label>
                        <div class="relative">
                            <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700 pr-10">
                                <option value="Betina">Betina</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Warganegara -->
                    <div>
                        <label for="warganegara" class="block text-sm font-medium text-gray-800 mb-1.5">Warganegara</label>
                        <input type="text" id="warganegara" name="warganegara" value="Belanda" placeholder="Belanda" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-800 mb-1.5">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" name="tempat_lahir" value="Indonesia" placeholder="Indonesia" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Nomor KK & NIK (Grid 2 Kolom) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="nomor_kk" class="block text-sm font-medium text-gray-800 mb-1.5">Nomor KK</label>
                            <input type="text" id="nomor_kk" name="nomor_kk" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                        </div>
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-800 mb-1.5">NIK</label>
                            <input type="text" id="nik" name="nik" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                        </div>
                    </div>

                    <!-- Nomor Paspor -->
                    <div>
                        <label for="nomor_paspor" class="block text-sm font-medium text-gray-800 mb-1.5">Nomor Paspor</label>
                        <input type="text" id="nomor_paspor" name="nomor_paspor" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Anak Ke -->
                    <div>
                        <label for="anak_ke" class="block text-sm font-medium text-gray-800 mb-1.5">Anak Ke</label>
                        <input type="number" id="anak_ke" name="anak_ke" value="2" placeholder="2" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Agama -->
                    <div>
                        <label for="agama" class="block text-sm font-medium text-gray-800 mb-1.5">Agama</label>
                        <input type="text" id="agama" name="agama" value="Belanda" placeholder="Belanda" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>
                </div>

                <!-- KOLOM KANAN -->
                <div class="space-y-5">
                    <!-- Alamat Tempat Tinggal -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-800 mb-1.5">Alamat Tempat Tinggal</label>
                        <input type="text" id="alamat" name="alamat" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- RT & RW (Grid 2 Kolom) -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="rt" class="block text-sm font-medium text-gray-800 mb-1.5">RT</label>
                            <input type="text" id="rt" name="rt" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                        </div>
                        <div>
                            <label for="rw" class="block text-sm font-medium text-gray-800 mb-1.5">RW</label>
                            <input type="text" id="rw" name="rw" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                        </div>
                    </div>

                    <!-- Kota/Kabupaten -->
                    <div>
                        <label for="kota_kabupaten" class="block text-sm font-medium text-gray-800 mb-1.5">Kota/Kabupaten</label>
                        <div class="relative">
                            <select id="kota_kabupaten" name="kota_kabupaten" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700 pr-10">
                                <option value="Betina">Betina</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Bandung">Bandung</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label for="kecamatan" class="block text-sm font-medium text-gray-800 mb-1.5">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" value="Belanda" placeholder="Belanda" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Kelurahan/Desa -->
                    <div>
                        <label for="kelurahan_desa" class="block text-sm font-medium text-gray-800 mb-1.5">Kelurahan/Desa</label>
                        <input type="text" id="kelurahan_desa" name="kelurahan_desa" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Kode Pos -->
                    <div>
                        <label for="kode_pos" class="block text-sm font-medium text-gray-800 mb-1.5">Kode Pos</label>
                        <div class="relative">
                            <select id="kode_pos" name="kode_pos" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700 pr-10">
                                <option value="Betina">Betina</option>
                                <option value="12345">12345</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status Tempat Tinggal -->
                    <div>
                        <label for="status_tempat_tinggal" class="block text-sm font-medium text-gray-800 mb-1.5">Status Tempat Tinggal</label>
                        <input type="text" id="status_tempat_tinggal" name="status_tempat_tinggal" value="Dengan Orang Tua" placeholder="Dengan Orang Tua" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Nomor Whatsapp -->
                    <div>
                        <label for="nomor_whatsapp" class="block text-sm font-medium text-gray-800 mb-1.5">Nomor Whatsapp</label>
                        <input type="text" id="nomor_whatsapp" name="nomor_whatsapp" placeholder="Dropdown item" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>

                    <!-- Alamat Email Pribadi -->
                    <div>
                        <label for="email_pribadi" class="block text-sm font-medium text-gray-800 mb-1.5">Alamat Email Pribadi</label>
                        <div class="relative">
                            <select id="email_pribadi" name="email_pribadi" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm appearance-none bg-white focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700 pr-10">
                                <option value="ANONIM@gmail.com">ANONIM@gmail.com</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Email SKI -->
                    <div>
                        <label for="email_ski" class="block text-sm font-medium text-gray-800 mb-1.5">Alamat Email SKI</label>
                        <input type="email" id="email_ski" name="email_ski" value="anonim@ski.sch.id" placeholder="anonim@ski.sch.id" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-teal-600 focus:border-transparent text-gray-700">
                    </div>
                </div>

            </div>

            <!-- Optional Submit Button -->
            <div class="mt-10 text-right">
                <button type="submit" class="px-6 py-2.5 bg-teal-800 hover:bg-teal-900 text-white font-medium rounded-lg text-sm transition duration-200">
                    Simpan Profile
                </button>
            </div>
        </form>

    </div>
</div>
@endsection

