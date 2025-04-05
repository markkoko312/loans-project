document.addEventListener("DOMContentLoaded", function() {
    // Initial page load animation
    setTimeout(() => {
        document.getElementById('loading-screen').classList.add('hidden');
        document.body.classList.add('loaded');
        document.querySelector('main').classList.add('show');
        document.querySelector('#home').classList.add('active');
    }, 1200);

    // Handle all navigation links
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            const isAnchor = this.getAttribute('href').startsWith('#');
            const isExternal = this.hasAttribute('target') && this.getAttribute('target') === '_blank';
            
            // Handle external links
            if (!isAnchor && isExternal) {
                e.preventDefault();
                showFullLoading(() => {
                    window.open(this.href, '_blank');
                });
            }
            // Handle regular external links
            else if (!isAnchor && !isExternal) {
                e.preventDefault();
                showFullLoading(() => {
                    window.location.href = this.href;
                });
            }
            // Handle anchor links
            else if (isAnchor) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                navigateToSection(targetId);
            }
        });
    });

    // Show full loading screen with callback
    function showFullLoading(callback) {
        const loadingScreen = document.getElementById('loading-screen');
        loadingScreen.classList.remove('hidden');
        loadingScreen.style.opacity = '1';
        
        setTimeout(() => {
            callback();
            setTimeout(() => {
                loadingScreen.classList.add('hidden');
            }, 500);
        }, 800);
    }

    // Navigate to section with loading animation
    function navigateToSection(sectionId) {
        const buttonLoading = document.getElementById('button-loading');
        const targetSection = document.querySelector(sectionId);
        
        if (!targetSection) return;
        
        // Show loading animation
        buttonLoading.style.display = 'flex';
        
        // Hide current active section
        document.querySelector('.section.active').classList.remove('active');
        
        setTimeout(() => {
            // Hide loading and show new section
            buttonLoading.style.display = 'none';
            targetSection.classList.add('active');
            
            // Smooth scroll to section
            window.scrollTo({
                top: targetSection.offsetTop - 80,
                behavior: 'smooth'
            });
        }, 600);
    }

    // Add intersection observer for section transitions
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.section').forEach(section => {
        observer.observe(section);
    });
});