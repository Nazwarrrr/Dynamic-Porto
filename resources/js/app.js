import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    if (typeof window.lucide !== 'undefined') {
        window.lucide.createIcons();
    }

    const reveals = document.querySelectorAll('.reveal, .reveal-item');

    if ('IntersectionObserver' in window && reveals.length > 0) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px',
        });

        reveals.forEach((element) => revealObserver.observe(element));

        return;
    }

    reveals.forEach((element) => element.classList.add('active'));
});
