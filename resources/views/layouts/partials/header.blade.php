{{-- 
    Komponen: Header Navigasi
    File: header.blade.php
    Deskripsi: Header presisi sesuai desain (Logo, Navigasi, Tombol Register, Icon Profile)
    Font: DM Sans (Google Fonts)
    Palet Warna:
        - Dark Teal (teks utama)   : #003135
        - Bright Teal (aksen)      : #10A4B0
        - Putih (bg / teks tombol) : #ffffff
--}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;0,9..40,800;1,9..40,400&display=swap" rel="stylesheet">

<header class="w-full bg-[#ffffff] border-b border-gray-100 font-['DM_Sans']">
    <div class="w-full flex items-center justify-between px-10 py-4">

        {{-- ============================= --}}
        {{-- BAGIAN KIRI: Logo & Nama      --}}
        {{-- ============================= --}}
        <div class="flex items-center gap-3">
            {{-- Placeholder SVG Logo (lingkaran penuh, mudah diganti) --}}
            <svg
                class="w-12 h-12 shrink-0"
                viewBox="0 0 48 48"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-label="Logo"
            >
                <circle cx="24" cy="24" r="24" fill="#10A4B0" />
            </svg>

            <span class="text-2xl font-bold text-[#003135] font-['DM_Sans']">
                Logo
            </span>
        </div>

        {{-- ============================= --}}
        {{-- BAGIAN TENGAH: Navigasi       --}}
        {{-- ============================= --}}
        <nav class="flex items-center gap-20">
            <a href="{{ route('students.index') }}"
               class="text-lg font-bold text-[#003135] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                Home
            </a>

            <a href="{{ url('/about') }}"
               class="text-lg font-bold text-[#003135] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                About
            </a>

            <a href="{{ route('students.news') }}"
               class="text-lg font-bold text-[#003135] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                News
            </a>

            <a href="{{ url('/register') }}"
               class="rounded-full bg-[#10A4B0] text-[#ffffff] font-bold font-['DM_Sans'] text-lg px-4 py-1 hover:bg-[#0d8a95] transition-colors">
                Register
            </a>
        </nav>

        {{-- ============================= --}}
        {{-- BAGIAN KANAN: Profile Icon    --}}
        {{-- ============================= --}}
        <div>
            <button
                type="button"
                class="flex items-center justify-center bg-[#10A4B0] rounded-full w-11 h-11 hover:bg-[#0d8a95] transition-colors"
                aria-label="User profile"
            >
                {{-- SVG icon profile/user garis linier --}}
                <svg
                    class="w-6 h-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#003135"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </button>
        </div>

    </div>
</header>