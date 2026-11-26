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
        <div class="flex items-center gap-1">
            <img
                src="{{ asset('assets/logo-ciptaju.png') }}"
                alt="Sekolah Ciptaju Logo"
                class="w-10 h-10 lg:w-12 lg:h-12 shrink-0 object-contain"
            >

            <span class="text-xl lg:text-2xl font-bold text-[#003135] font-['DM_Sans']">
                CIPTAJU
            </span>
        </div>

        {{-- ============================= --}}
        {{-- BAGIAN TENGAH: Navigasi (Desktop) --}}
        {{-- ============================= --}}
        <nav class="hidden xl:absolute xl:left-1/2 xl:top-1/2 xl:flex xl:-translate-x-1/2 xl:-translate-y-1/2 items-center gap-4 xl:gap-8">
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

            <div class="flex items-center gap-4 xl:gap-6">
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('admins.users.index') }}"
                       class="rounded-full bg-[#10A4B0] px-5 py-2 font-['DM_Sans'] text-lg font-bold text-white shadow-sm transition-all duration-200 hover:bg-[#0d8a95]">
                        Dashboard
                    </a>
                @endif

                <a href="{{ route('auth.registration') }}"
                   class="rounded-full bg-[#10A4B0] text-white font-bold font-['DM_Sans'] text-lg px-6 py-2 hover:bg-white hover:text-[#10A4B0] active:scale-95 transition-all duration-300 ease-in-out shadow-sm">
                    Register
                </a>
            </div>
        </nav>

        {{-- ============================= --}}
        {{-- BAGIAN KANAN: Profile & Menu  --}}
        {{-- ============================= --}}
        
        {{-- Profile / Login / Logout --}}
        <div class="hidden xl:block">
            @if (Auth::check())
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="flex items-center justify-center bg-[#10A4B0] rounded-full w-10 h-10 lg:w-11 lg:h-11 hover:bg-[#0d8a95] active:scale-95 transition-all shadow-sm"
                        aria-label="Logout"
                        title="Logout"
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
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            <path d="M16 17l5-5-5-5" />
                            <path d="M21 12H9" />
                        </svg>
                    </button>
                </form>
            @else
                <a
                    href="{{ route('auth.login') }}"
                    class="flex items-center justify-center bg-[#10A4B0] rounded-full w-10 h-10 lg:w-11 lg:h-11 hover:bg-[#0d8a95] active:scale-95 transition-all shadow-sm"
                    aria-label="Login"
                    title="Login"
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
            @endif
        </div>

        <button
            id="hamburger-btn"
            type="button"
            class="flex h-10 w-10 items-center justify-center rounded-full bg-[#10A4B0] text-[#003135] shadow-sm transition hover:bg-[#0d8a95] active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#003135] focus-visible:ring-offset-2 xl:hidden"
            aria-label="Buka menu navigasi"
            aria-expanded="false"
            aria-controls="mobile-menu"
        >
            <svg data-menu-icon="open" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg data-menu-icon="close" class="hidden h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M6 6l12 12M18 6L6 18" />
            </svg>
        </button>

    </div>

    {{-- ============================= --}}
    {{-- MOBILE MENU (Dropdown)        --}}
    {{-- ============================= --}}
    <nav id="mobile-menu" aria-label="Navigasi seluler" aria-hidden="true" class="hidden xl:hidden w-full bg-white border-t border-gray-100 shadow-lg absolute left-0 top-full flex-col px-6 py-4 gap-2 max-h-[80vh] overflow-y-auto">
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
        <div class="flex flex-col gap-1">
            @if (Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('admins.users.index') }}"
                   class="block text-center rounded-full bg-[#10A4B0] text-white font-bold text-lg px-4 py-2.5 hover:bg-white hover:text-[#10A4B0] active:scale-95 transition-all duration-300 ease-in-out shadow-sm">
                    Dashboard
                </a>
            @endif
            <a
                href="{{ route('auth.registration') }}"
                class="block text-center rounded-full bg-[#10A4B0] text-white font-bold text-lg px-4 py-2.5 hover:bg-white hover:text-[#10A4B0] active:scale-95 transition-all duration-300 ease-in-out shadow-sm">
                Register
            </a>

            @if (Auth::check())
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="block w-full rounded-full border border-[#10A4B0] px-4 py-2.5 text-center text-lg font-bold text-[#003135] transition hover:bg-gray-100"
                    >
                        Logout
                    </button>
                </form>
            @else
                <a
                    href="{{ route('auth.login') }}"
                    class="block rounded-full border border-[#10A4B0] px-4 py-2.5 text-center text-lg font-bold text-[#003135] transition hover:bg-gray-100"
                >
                    Login
                </a>
            @endif
        </div>
    </nav>
</header>