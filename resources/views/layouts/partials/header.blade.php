{{-- 
    Komponen: Header Navigasi
    File: header.blade.php
    Deskripsi: Header responsif dengan Smart Scroll (Hide on down, Show on up) & Mobile Hamburger Menu.
    Font: DM Sans (Google Fonts)
    Palet Warna:
        - Dark Teal (teks utama)   : #003135
        - Bright Teal / Cyan (aksen): #10A4B0
        - Putih (bg / teks tombol) : #ffffff
--}}

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,700;0,9..40,800;1,9..40,400&display=swap" rel="stylesheet">

<header id="navbar" class="sticky top-0 z-50 w-full bg-[#ffffff] border-b border-gray-100 font-['DM_Sans'] transition-transform duration-300 ease-in-out">
    <div class="w-full flex items-center justify-between px-6 lg:px-10 py-4">

        {{-- ============================= --}}
        {{-- BAGIAN KIRI: Logo & Nama      --}}
        {{-- ============================= --}}
        <div class="flex items-center gap-3">
            <svg
                class="w-10 h-10 lg:w-12 lg:h-12 shrink-0"
                viewBox="0 0 48 48"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-label="Logo Sekolah Ciptaju"
            >
                <circle cx="24" cy="24" r="24" fill="#10A4B0" />
            </svg>

            <span class="text-xl lg:text-2xl font-bold text-[#003135] font-['DM_Sans']">
                Logo
            </span>
        </div>

        {{-- ============================= --}}
        {{-- BAGIAN TENGAH: Navigasi (Desktop) --}}
        {{-- ============================= --}}
        <nav class="hidden lg:flex items-center gap-8 xl:gap-14">
            <a href="{{ route('students.index') }}"
               class="text-lg font-bold font-['DM_Sans'] px-4 py-2 rounded-full transition-all duration-200 hover:bg-gray-100 active:bg-gray-200 {{ request()->routeIs('students.index') ? 'text-[#10A4B0]' : 'text-[#003135] hover:text-[#10A4B0]' }}">
                Home
            </a>

            <a href="{{ route('about.index') }}"
               class="text-lg font-bold font-['DM_Sans'] px-4 py-2 rounded-full transition-all duration-200 hover:bg-gray-100 active:bg-gray-200 {{ request()->routeIs('about.index') ? 'text-[#10A4B0]' : 'text-[#003135] hover:text-[#10A4B0]' }}">
                About
            </a>

            <a href="{{ route('news.index') }}"
               class="text-lg font-bold font-['DM_Sans'] px-4 py-2 rounded-full transition-all duration-200 hover:bg-gray-100 active:bg-gray-200 {{ request()->routeIs('news.index') ? 'text-[#10A4B0]' : 'text-[#003135] hover:text-[#10A4B0]' }}">
                News
            </a>

            <a href="{{ route('auth.registration') }}"
               class="rounded-full bg-[#10A4B0] text-white border-2 border-[#10A4B0] font-bold font-['DM_Sans'] text-lg px-6 py-2 hover:bg-white hover:text-[#10A4B0] active:scale-95 transition-all duration-300 ease-in-out shadow-sm">
                Register
            </a>
        </nav>

        {{-- ============================= --}}
        {{-- BAGIAN KANAN: Profile & Menu  --}}
        {{-- ============================= --}}
        <div class="flex items-center gap-3">
            {{-- Profile Icon --}}
            <a
                href="{{ route('auth.login') }}"
                class="flex items-center justify-center bg-[#10A4B0] rounded-full w-10 h-10 lg:w-11 lg:h-11 hover:bg-[#0d8a95] active:scale-95 transition-all shadow-sm"
                aria-label="User profile login"
            >
                <svg
                    class="w-5 h-5 lg:w-6 lg:h-6"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#003135"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                >
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
            </a>

            {{-- Hamburger Button --}}
            <button
                id="hamburger-btn"
                class="lg:hidden flex items-center justify-center p-2 text-[#003135] hover:bg-gray-100 active:bg-gray-200 rounded-full transition-all"
                aria-expanded="false"
                aria-controls="mobile-menu"
                aria-label="Buka menu navigasi"
            >
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MOBILE MENU (Dropdown)        --}}
    {{-- ============================= --}}
    <div id="mobile-menu" class="hidden lg:hidden w-full bg-white border-t border-gray-100 shadow-lg absolute left-0 top-full flex-col px-6 py-4 gap-2 max-h-[80vh] overflow-y-auto">
        <a href="{{ route('students.index') }}" 
           class="block text-lg font-bold py-2.5 px-4 rounded-xl transition-all hover:bg-gray-100 active:bg-gray-200 {{ request()->routeIs('students.index') ? 'text-[#10A4B0]' : 'text-[#003135]' }}">
            Home
        </a>
        <a href="{{ route('about.index') }}" 
           class="block text-lg font-bold py-2.5 px-4 rounded-xl transition-all hover:bg-gray-100 active:bg-gray-200 {{ request()->routeIs('about.index') ? 'text-[#10A4B0]' : 'text-[#003135]' }}">
            About
        </a>
        <a href="{{ route('news.index') }}" 
           class="block text-lg font-bold py-2.5 px-4 rounded-xl transition-all hover:bg-gray-100 active:bg-gray-200 {{ request()->routeIs('news.index') ? 'text-[#10A4B0]' : 'text-[#003135]' }}">
            News
        </a>
        <a href="{{ route('auth.registration') }}" 
           class="block text-center mt-2 rounded-full bg-[#10A4B0] text-white border border-[#10A4B0] font-bold text-lg px-4 py-2.5 hover:bg-white hover:text-[#10A4B0] active:scale-95 transition-all duration-300 ease-in-out mb-4">
            Register
        </a>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.getElementById("navbar");
        const hamburgerBtn = document.getElementById("hamburger-btn");
        const mobileMenu = document.getElementById("mobile-menu");
        
        let lastScrollY = window.scrollY;

        window.addEventListener("scroll", () => {
            if (!mobileMenu.classList.contains("hidden")) return;

            if (window.scrollY > lastScrollY && window.scrollY > 80) {
                navbar.classList.add("-translate-y-full");
            } else {
                navbar.classList.remove("-translate-y-full");
            }
            lastScrollY = window.scrollY;
        });

        hamburgerBtn.addEventListener("click", () => {
            const isExpanded = hamburgerBtn.getAttribute("aria-expanded") === "true";
            hamburgerBtn.setAttribute("aria-expanded", !isExpanded);
            mobileMenu.classList.toggle("hidden");
            mobileMenu.classList.toggle("flex");
        });
    });
</script>   