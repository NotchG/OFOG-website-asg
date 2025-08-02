document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('testimoniesCarousel');
    const prevBtn = document.getElementById('prevTestimony');
    const nextBtn = document.getElementById('nextTestimony');
    const dots = document.querySelectorAll('.dot');
    
    let currentSlide = 0;
    const originalSlides = document.querySelectorAll('.testimony-card');
    const totalSlides = originalSlides.length;
    const slidesToShow = window.innerWidth > 768 ? 3 : 1;
    let isAutoScrolling = false;
    let autoScrollPosition = 0;
    let isPaused = false;
    
    function createInfiniteLoop() {
        const carouselContainer = carousel;
        
        for (let i = 0; i < totalSlides; i++) {
            const clone = originalSlides[i].cloneNode(true);
            clone.classList.add('cloned-slide');
            carouselContainer.appendChild(clone);
        }
        
        for (let i = 0; i < totalSlides; i++) {
            const clone = originalSlides[i].cloneNode(true);
            clone.classList.add('cloned-slide');
            carouselContainer.insertBefore(clone, carouselContainer.firstChild);
        }
        
        currentSlide = totalSlides;
        autoScrollPosition = currentSlide * (100 / slidesToShow);
        
        carousel.style.transition = 'none';
        carousel.style.transform = `translateX(-${autoScrollPosition}%)`;
    }
    
    function updateCarousel(smooth = true) {
        const translateX = -(currentSlide * (100 / slidesToShow));
        
        if (smooth) {
            carousel.style.transition = 'transform 0.5s ease';
        } else {
            carousel.style.transition = 'none';
        }
        
        carousel.style.transform = `translateX(${translateX}%)`;
        
        const realSlideIndex = ((currentSlide - totalSlides) % totalSlides + totalSlides) % totalSlides;
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === realSlideIndex);
        });
    }
    
    function checkInfiniteLoop() {
        const allSlides = document.querySelectorAll('.testimony-card');
        const totalSlidesWithClones = allSlides.length;
        
        if (currentSlide >= totalSlides * 2) {
            carousel.style.transition = 'none';
            currentSlide = totalSlides;
            autoScrollPosition = currentSlide * (100 / slidesToShow);
            carousel.style.transform = `translateX(-${autoScrollPosition}%)`;
        }
        
        if (currentSlide < totalSlides) {
            carousel.style.transition = 'none';
            currentSlide = totalSlides * 2 - 1;
            autoScrollPosition = currentSlide * (100 / slidesToShow);
            carousel.style.transform = `translateX(-${autoScrollPosition}%)`;
        }
    }
    
    function smoothAutoScroll() {
        if (!isAutoScrolling || isPaused) return;
        
        autoScrollPosition += 0.02;
        
        carousel.style.transition = 'none';
        carousel.style.transform = `translateX(-${autoScrollPosition}%)`;
        
        const slideWidth = 100 / slidesToShow;
        const nextSlidePosition = slideWidth * (currentSlide + 1);
        
        if (autoScrollPosition >= nextSlidePosition) {
            currentSlide++;
            
            const realSlideIndex = ((currentSlide - totalSlides) % totalSlides + totalSlides) % totalSlides;
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === realSlideIndex);
            });
            
            if (currentSlide >= totalSlides * 2) {
                currentSlide = totalSlides;
                autoScrollPosition = currentSlide * slideWidth;
            }
        }
        
        requestAnimationFrame(smoothAutoScroll);
    }
    
    function nextSlide(manual = false) {
        if (manual) {
            stopAutoScroll();
            currentSlide++;
            
            if (currentSlide >= totalSlides * 2) {
                currentSlide = totalSlides;
            }
            
            updateCarousel(true);
            autoScrollPosition = currentSlide * (100 / slidesToShow);
            setTimeout(startAutoScroll, 3000);
        } else {
            currentSlide++;
            updateCarousel(false);
            checkInfiniteLoop();
        }
    }
    
    function prevSlide(manual = false) {
        if (manual) {
            stopAutoScroll();
            currentSlide--;
            
            if (currentSlide < totalSlides) {
                currentSlide = totalSlides * 2 - 1;
            }
            
            updateCarousel(true);
            autoScrollPosition = currentSlide * (100 / slidesToShow);
            setTimeout(startAutoScroll, 3000);
        } else {
            currentSlide--;
            updateCarousel(false);
            checkInfiniteLoop();
        }
    }
    
    function startAutoScroll() {
        isAutoScrolling = true;
        isPaused = false;
        autoScrollPosition = currentSlide * (100 / slidesToShow);
        smoothAutoScroll();
    }
    
    function stopAutoScroll() {
        isAutoScrolling = false;
        isPaused = false;
    }
    
    function pauseAutoScroll() {
        isPaused = true;
    }
    
    function resumeAutoScroll() {
        isPaused = false;
        if (isAutoScrolling) {
            smoothAutoScroll();
        }
    }
    
    // Event listeners
    nextBtn.addEventListener('click', () => nextSlide(true));
    prevBtn.addEventListener('click', () => prevSlide(true));
    
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoScroll();
            currentSlide = index + totalSlides;
            updateCarousel(true);
            autoScrollPosition = currentSlide * (100 / slidesToShow);
            setTimeout(startAutoScroll, 3000);
        });
    });
    
    // Hover events
    carousel.addEventListener('mouseenter', pauseAutoScroll);
    carousel.addEventListener('mouseleave', resumeAutoScroll);
    
    // Touch events
    let startX = 0;
    let endX = 0;
    
    carousel.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        pauseAutoScroll();
    });
    
    carousel.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        const threshold = 50;
        
        if (startX - endX > threshold) nextSlide(true);
        if (endX - startX > threshold) prevSlide(true);
    });
    
    createInfiniteLoop();
    
    setTimeout(() => {
        updateCarousel(false);
        startAutoScroll();
    }, 100);
    
    window.addEventListener('resize', () => {
        const newSlidesToShow = window.innerWidth > 768 ? 3 : 1;
        if (newSlidesToShow !== slidesToShow) {
            location.reload();
        }
    });
});