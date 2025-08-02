document.addEventListener('DOMContentLoaded', function() {

    console.log('Counter animation script loaded');

    const counters = document.querySelectorAll('.counter');
    
    const options = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    animateCounter(entry.target);
                }, entry.target.dataset.delay || 0);
                observer.unobserve(entry.target);
            }
        });
    }, options);

    counters.forEach((counter, index) => {
        counter.dataset.delay = index * 200;
        observer.observe(counter);
    });

    function animateCounter(counter) {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 1500;
        const step = target / (duration / 16);
        let current = 0;
        
        counter.classList.add('counting', 'counter-animate');
        counter.textContent = '0';

        const timer = setInterval(() => {
            current += step;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                counter.classList.remove('counting');
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 16);
    }
});