document.addEventListener('DOMContentLoaded', () => {
    const background = document.getElementById('ekskul-background');
    const backgroundAnimation = document.getElementById('ekskul-background-animation');
    const title = document.getElementById('ekskul-title');
    const description = document.getElementById('ekskul-description');
    const cards = document.querySelectorAll('.ekskul-card');

    if (
        !background ||
        !backgroundAnimation ||
        !title ||
        !description ||
        !cards.length
    ) {
        return;
    }


    // =========================================
    // INITIAL PAGE ANIMATION
    // Sama seperti saat memilih card
    // =========================================

    requestAnimationFrame(() => {
        backgroundAnimation.classList.add('ekskul-bg-animation');

        title.classList.add('ekskul-text-animation');
        description.classList.add('ekskul-text-animation');

        cards.forEach((card, index) => {
            card.classList.add('ekskul-card-animation');

            card.style.animationDelay = `${450 + (index * 70)}ms`;
        });
    });


    // =========================================
    // CARD CLICK
    // =========================================

    cards.forEach((card) => {
        card.addEventListener('click', (event) => {
            event.preventDefault();

            const nama = card.dataset.nama;
            const gambar = card.dataset.gambar;
            const deskripsi = card.dataset.deskripsi;


            // Jangan animasi ulang kalau card sedang active
            if (card.classList.contains('is-active')) {
                return;
            }


            // =========================================
            // UPDATE ACTIVE CARD
            // =========================================

            cards.forEach((item) => {
                const overlay = item.querySelector('.ekskul-overlay');

                item.classList.remove(
                    'is-active',
                    'outline',
                    'outline-3',
                    'outline-offset-2',
                    'outline-[#10A4B0]'
                );

                item.classList.add(
                    'hover:outline',
                    'hover:outline-2',
                    'hover:outline-offset-2',
                    'hover:outline-[#10A4B0]/50'
                );

                if (overlay) {
                    overlay.classList.remove('bg-[#10A4B0]');
                    overlay.classList.add('bg-[#003135]/70');
                }
            });


            // =========================================
            // SET CARD ACTIVE
            // =========================================

            card.classList.add(
                'is-active',
                'outline',
                'outline-3',
                'outline-offset-2',
                'outline-[#10A4B0]'
            );

            card.classList.remove(
                'hover:outline',
                'hover:outline-2',
                'hover:outline-offset-2',
                'hover:outline-[#10A4B0]/50'
            );

            const activeOverlay = card.querySelector('.ekskul-overlay');

            if (activeOverlay) {
                activeOverlay.classList.remove('bg-[#003135]/70');
                activeOverlay.classList.add('bg-[#10A4B0]');
            }


            // =========================================
            // BACKGROUND ANIMATION
            // =========================================

            backgroundAnimation.classList.remove('ekskul-bg-animation');

            void backgroundAnimation.offsetWidth;

            backgroundAnimation.classList.add('ekskul-bg-animation');

            background.src = gambar;


            // =========================================
            // TEXT ANIMATION
            // =========================================

            title.classList.remove('ekskul-text-animation');
            description.classList.remove('ekskul-text-animation');

            void title.offsetWidth;
            void description.offsetWidth;

            title.textContent = nama;
            description.textContent = deskripsi;

            title.classList.add('ekskul-text-animation');
            description.classList.add('ekskul-text-animation');
        });
    });
});


//index--------------------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const background = document.getElementById('hero-background');
    const title = document.getElementById('hero-title');
    const description = document.getElementById('hero-description');
    const button = document.getElementById('hero-button');
    const schoolInfo = document.getElementById('school-info');

    if (!background || !title || !description || !button || !schoolInfo) {
        return;
    }

    // Jalankan animasi setelah halaman siap
    requestAnimationFrame(() => {
        background.classList.add('hero-bg-animation');
        title.classList.add('hero-text-animation');
        description.classList.add('hero-description-animation');
        button.classList.add('hero-button-animation');
        schoolInfo.classList.add('school-info-animation');
    });
});


const registerButton = document.getElementById('hero-button');

if (registerButton) {
    registerButton.addEventListener('mouseenter', (event) => {
        const rect = registerButton.getBoundingClientRect();

        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        registerButton.style.setProperty('--x', `${x}px`);
        registerButton.style.setProperty('--y', `${y}px`);
    });

    registerButton.addEventListener('mousemove', (event) => {
        const rect = registerButton.getBoundingClientRect();

        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;

        registerButton.style.setProperty('--x', `${x}px`);
        registerButton.style.setProperty('--y', `${y}px`);
    });
}


//vimi--------------------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', () => {
    const background = document.getElementById('vision-background');
    const pageTitle = document.getElementById('vision-page-title');
    const visionTitle = document.getElementById('vision-title');
    const visionDescription = document.getElementById('vision-description');
    const missionTitle = document.getElementById('mission-title');
    const missionDescription = document.getElementById('mission-description');

    if (
        !background ||
        !pageTitle ||
        !visionTitle ||
        !visionDescription ||
        !missionTitle ||
        !missionDescription
    ) {
        return;
    }

    requestAnimationFrame(() => {
        background.classList.add('vision-bg-animation');
        pageTitle.classList.add('vision-text-animation');
        visionTitle.classList.add('vision-text-animation');
        visionDescription.classList.add('vision-text-animation');
        missionTitle.classList.add('vision-text-animation');
        missionDescription.classList.add('vision-text-animation');
    });
});


//prestasi--------------------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {

    const header = document.querySelector('.prestasi-header');
    const years = document.querySelectorAll('.prestasi-year');

    if (!years.length) {
        return;
    }


    // =========================================
    // HEADER
    // =========================================

    if (header) {
        header.classList.add('prestasi-fade-in');
    }


    // =========================================
    // YEAR + CARD ANIMATION
    // =========================================

    years.forEach((year, yearIndex) => {

        year.classList.add('prestasi-year-animation');

        year.style.animationDelay = `${150 + (yearIndex * 120)}ms`;


        const cards = year.querySelectorAll('.prestasi-card');

        cards.forEach((card, cardIndex) => {

            card.classList.add('prestasi-card-animation');

            card.style.animationDelay =
                `${300 + (yearIndex * 120) + (cardIndex * 80)}ms`;

        });

    });

});

//news--------------------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', () => {

    const banner = document.getElementById('news-banner');

    if (!banner) return;

    const track = document.getElementById('news-banner-track');
    const dotsContainer = document.getElementById('news-banner-dots');
    const prevButton = document.getElementById('news-banner-prev');
    const nextButton = document.getElementById('news-banner-next');
    const heading = document.getElementById('news-banner-heading');

    if (!track || !dotsContainer || !prevButton || !nextButton) {
        return;
    }

    const slides = [
        {
            gambar: 'https://i.pinimg.com/736x/cc/c8/c6/ccc8c6e3d3c66ac3139e9b8a8685099c.jpg',
            judul: 'Lomen',
            deskripsi: 'Lomen ipsum running on a jumping fox Lomen ipsum running on a simping jumping fox Lomen ipsum running on a running on a jumping fox',
            tanggal: '20/12/2099'
        },

        {
            gambar: 'https://i.pinimg.com/736x/c0/f2/a8/c0f2a856e62173119c48838213144fb7.jpg',
            judul: 'Berita Kedua',
            deskripsi: 'Lomen ipsum running on a jumping fox Lomen ipsum running on a simping jumping fox.',
            tanggal: '21/12/2099'
        },

        {
            gambar: 'https://i.pinimg.com/736x/78/8b/d7/788bd73f3e433bca90029d91376cdbc8.jpg',
            judul: 'Berita Ketiga',
            deskripsi: 'Lomen ipsum running on a jumping fox Lomen ipsum running on a running jumping fox.',
            tanggal: '22/12/2099'
        },

        {
            gambar: 'https://i.pinimg.com/736x/eb/1b/f9/eb1bf99faa953780c3e35e6044303d64.jpg',
            judul: 'Berita Keempat',
            deskripsi: 'Lomen ipsum running on a jumping fox.',
            tanggal: '23/12/2099'
        },

        {
            gambar: 'https://i.pinimg.com/736x/28/14/75/2814758d070b4e6edfe143bf97fedc4f.jpg',
            judul: 'Berita Kelima',
            deskripsi: 'Lomen ipsum running on a jumping fox.',
            tanggal: '24/12/2099'
        },

        {
            gambar: 'https://i.pinimg.com/736x/78/60/2b/78602b1fa491433354878fe12ed71d88.jpg',
            judul: 'Berita Keenam',
            deskripsi: 'Lomen ipsum running on a jumping fox.',
            tanggal: '25/12/2099'
        },

        {
            gambar: 'https://i.pinimg.com/736x/56/b1/81/56b181f305d9fd57e81178d8ea954d6e.jpg',
            judul: 'Berita Ketujuh',
            deskripsi: 'Lomen ipsum running on a jumping fox.',
            tanggal: '26/12/2099'
        }
    ];

    let currentIndex = 1;
    let isTransitioning = false;
    let timer = null;

    const totalSlides = slides.length;

    // =========================================================
    // INFINITE LOOP
    // =========================================================

    const firstClone = slides[0];
    const lastClone = slides[totalSlides - 1];

    const allSlides = [
        lastClone,
        ...slides,
        firstClone
    ];

    // =========================================================
    // GENERATE SLIDES
    // =========================================================

    track.innerHTML = allSlides.map((slide, index) => {

        return `
            <div
                class="relative w-full h-full flex-shrink-0"
                data-slide-index="${index}"
            >

                <img
                    src="${slide.gambar}"
                    alt="${slide.judul}"
                    class="news-banner-background absolute inset-0 w-full h-full object-cover object-right"
                >

                <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/80 to-transparent"></div>

                <div class="relative z-10 flex flex-col justify-center h-full px-8 md:px-16 w-full pt-10">

                    <div class="max-w-2xl mt-4 ml-6 md:ml-8 lg:ml-18">

                        <h2
                            class="news-banner-title text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6"
                        >
                            ${slide.judul}
                        </h2>

                        <p
                            class="news-banner-description text-white/90 text-base md:text-lg leading-relaxed mb-4 line-clamp-3"
                        >
                            ${slide.deskripsi}
                        </p>

                        <span
                            class="news-banner-date text-white/60 text-sm"
                        >
                            ${slide.tanggal}
                        </span>

                    </div>

                </div>

            </div>
        `;

    }).join('');

    // =========================================================
    // GENERATE DOTS
    // =========================================================

    dotsContainer.innerHTML = slides.map((_, i) => {

        return `
            <button
                type="button"
                data-slide="${i}"
                class="news-banner-dot h-2.5 rounded-full transition-all duration-300 ease-in-out ${
                    i === 0
                        ? 'w-8 bg-[#10A4B0]'
                        : 'w-2.5 bg-white/40 hover:bg-white/70'
                }"
                aria-label="Slide ${i + 1}"
            ></button>
        `;

    }).join('');

    const dots = document.querySelectorAll('.news-banner-dot');

    // =========================================================
    // POSISI AWAL
    // =========================================================

    track.style.transition = 'none';
    track.style.transform = 'translateX(-100%)';

    // =========================================================
    // UPDATE DOT
    // =========================================================

    function updateDots() {

        let activeDot = currentIndex - 1;

        if (activeDot === totalSlides) {
            activeDot = 0;
        }

        if (activeDot === -1) {
            activeDot = totalSlides - 1;
        }

        dots.forEach((dot, i) => {

            if (i === activeDot) {

                dot.classList.remove(
                    'w-2.5',
                    'bg-white/40'
                );

                dot.classList.add(
                    'w-8',
                    'bg-[#10A4B0]'
                );

            } else {

                dot.classList.remove(
                    'w-8',
                    'bg-[#10A4B0]'
                );

                dot.classList.add(
                    'w-2.5',
                    'bg-white/40'
                );
            }

        });
    }

    // =========================================================
    // OPENING ANIMATION
    // =========================================================

    function openingAnimation() {

        const activeSlide = track.children[currentIndex];

        if (!activeSlide) return;

        const background =
            activeSlide.querySelector('.news-banner-background');

        const title =
            activeSlide.querySelector('.news-banner-title');

        const description =
            activeSlide.querySelector('.news-banner-description');

        const date =
            activeSlide.querySelector('.news-banner-date');

        // Header
        if (heading) {
            heading.classList.add('news-banner-heading-animation');
        }

        // Background
        if (background) {
            background.classList.add('news-banner-bg-animation');
        }

        // Title
        if (title) {
            title.classList.add('news-banner-text-animation');
        }

        // Description
        if (description) {
            description.classList.add('news-banner-text-animation');
            description.style.animationDelay = '120ms';
        }

        // Date
        if (date) {
            date.classList.add('news-banner-text-animation');
            date.style.animationDelay = '200ms';
        }
    }

    // =========================================================
    // SLIDE TEXT ANIMATION
    // =========================================================

    function animateActiveSlide() {

        const activeSlide = track.children[currentIndex];

        if (!activeSlide) return;

        const title =
            activeSlide.querySelector('.news-banner-title');

        const description =
            activeSlide.querySelector('.news-banner-description');

        const date =
            activeSlide.querySelector('.news-banner-date');

        [title, description, date].forEach(element => {

            if (!element) return;

            element.classList.remove(
                'news-banner-text-transition'
            );

            void element.offsetWidth;

            element.classList.add(
                'news-banner-text-transition'
            );

        });

        if (description) {
            description.style.animationDelay = '100ms';
        }

        if (date) {
            date.style.animationDelay = '180ms';
        }
    }

    // =========================================================
    // GO TO SLIDE
    // =========================================================

    function goToSlide(index) {

        if (isTransitioning) return;

        isTransitioning = true;

        currentIndex = index;

        track.style.transition =
            'transform 550ms cubic-bezier(0.65, 0, 0.35, 1)';

        track.style.transform =
            `translateX(-${currentIndex * 100}%)`;

        updateDots();
    }

    // =========================================================
    // INFINITE LOOP FIX
    // =========================================================

    track.addEventListener('transitionend', () => {

        if (currentIndex === 0) {

            track.style.transition = 'none';

            currentIndex = totalSlides;

            track.style.transform =
                `translateX(-${currentIndex * 100}%)`;

        }

        else if (currentIndex === totalSlides + 1) {

            track.style.transition = 'none';

            currentIndex = 1;

            track.style.transform =
                `translateX(-${currentIndex * 100}%)`;

        }

        isTransitioning = false;

        animateActiveSlide();
    });

    // =========================================================
    // NEXT
    // =========================================================

    function nextSlide() {

        goToSlide(currentIndex + 1);

        resetTimer();
    }

    // =========================================================
    // PREVIOUS
    // =========================================================

    function prevSlide() {

        goToSlide(currentIndex - 1);

        resetTimer();
    }

    // =========================================================
    // AUTOPLAY
    // =========================================================

    function resetTimer() {

        clearInterval(timer);

        timer = setInterval(() => {

            if (!isTransitioning) {
                nextSlide();
            }

        }, 5000);
    }

    // =========================================================
    // BUTTON EVENT
    // =========================================================

    nextButton.addEventListener(
        'click',
        nextSlide
    );

    prevButton.addEventListener(
        'click',
        prevSlide
    );

    // =========================================================
    // DOT EVENT
    // =========================================================

    dots.forEach(dot => {

        dot.addEventListener('click', () => {

            if (isTransitioning) return;

            const index =
                Number(dot.dataset.slide) + 1;

            goToSlide(index);

            resetTimer();
        });

    });

    // =========================================================
    // INITIALIZE
    // =========================================================

    updateDots();

    openingAnimation();

    resetTimer();

});
// =========================================================
// NEWS SECTION 2 — OPENING ANIMATION
// Sama seperti opening halaman Prestasi
// =========================================================
document.addEventListener('DOMContentLoaded', () => {
    const newsSection = document.querySelector('.news-section');
    const newsTitle = document.querySelector('.news-section-title');
    const newsCards = document.querySelectorAll('.news-card');

    if (!newsSection || !newsCards.length) {
        return;
    }

    // Header / Judul
    if (newsTitle) {
        newsTitle.classList.add('news-title-animation');
    }

    // Card animation
    newsCards.forEach((card, index) => {
        card.classList.add('news-card-animation');
        card.style.animationDelay = `${150 + (index * 80)}ms`;
    });
});

