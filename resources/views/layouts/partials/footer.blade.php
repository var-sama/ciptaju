{{-- 
    Komponen: Footer
    File: footer.blade.php
    Deskripsi: Footer 4 kolom + bar copyright terpisah, sesuai desain.
    Font: DM Sans (Google Fonts)
    Palet Warna:
        - Dark Teal (bg area utama)   : #003135
        - Bright Teal (logo)          : #10A4B0
        - Putih (teks area utama / bg copyright) : #ffffff
        - Hitam (teks copyright)      : #000000
--}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;0,9..40,800;1,9..40,400&display=swap" rel="stylesheet">

<footer class="w-full font-['DM_Sans']">

    {{-- ================================= --}}
    {{-- AREA UTAMA FOOTER (4 Kolom)       --}}
    {{-- ================================= --}}
    <div class="w-full bg-[#003135] px-8 py-12">
        <div class="flex flex-wrap items-start justify-between gap-10">

            {{-- ============================= --}}
            {{-- KOLOM 1: Logo & Nama Merek    --}}
            {{-- ============================= --}}
            <div class="flex flex-col items-start">
                {{-- Placeholder SVG Logo (lingkaran penuh, mudah diganti) --}}
                <svg
                    class="w-24 h-24 shrink-0"
                    viewBox="0 0 96 96"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-label="Logo"
                >
                    <circle cx="48" cy="48" r="48" fill="#10A4B0" />
                </svg>

                {{-- Nama merek (opsional, tampil jika dibutuhkan) --}}
                {{-- <span class="mt-3 text-xl font-bold text-[#ffffff]">Nama Merek</span> --}}
            </div>

            {{-- ============================= --}}
            {{-- KOLOM 2: Fondasi Kami         --}}
            {{-- ============================= --}}
            <div class="flex flex-col gap-3">
                <h3 class="text-2xl font-bold text-[#ffffff] font-['DM_Sans']">
                    Fondasi Kami
                </h3>
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="#" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Jalan bla bla
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Nomor telepon
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Email
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ============================= --}}
            {{-- KOLOM 3: Links                --}}
            {{-- ============================= --}}
            <div class="flex flex-col gap-3">
                <h3 class="text-2xl font-bold text-[#ffffff] font-['DM_Sans']">
                    Links
                </h3>
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="{{ url('/terms-of-service') }}" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/privacy-policy') }}" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Privacy Of Policy
                        </a>
                    </li>
                </ul>
            </div>

            {{-- ============================= --}}
            {{-- KOLOM 4: Social Networks      --}}
            {{-- ============================= --}}
            <div class="flex flex-col gap-3">
                <h3 class="text-2xl font-bold text-[#ffffff] font-['DM_Sans']">
                    Social Networks
                </h3>
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="#" target="_blank" rel="noopener noreferrer" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Yutub
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank" rel="noopener noreferrer" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            Fb
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank" rel="noopener noreferrer" class="text-base text-[#ffffff] font-['DM_Sans'] hover:text-[#10A4B0] transition-colors">
                            IG
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- ================================= --}}
    {{-- BAR COPYRIGHT (Terpisah, Bawah)   --}}
    {{-- ================================= --}}
    <div class="w-full bg-[#ffffff] py-3">
        <p class="text-center text-sm text-[#000000] font-['DM_Sans']">
            &copy; 2026 Ciptaju. All Rights Reserved.
        </p>
    </div>

</footer>