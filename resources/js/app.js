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