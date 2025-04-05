document.addEventListener("DOMContentLoaded", function() {
    // Initial page load animation
    setTimeout(() => {
        document.getElementById('loading-screen').classList.add('hidden');
        document.body.classList.add('loaded');
        document.querySelector('main').classList.add('show');
        document.querySelector('#home').classList.add('active');
    }, 1200);

    // Handle all navigation links
    document.querySelectorAll('.animated-button').forEach(button => {
        button.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            const isAnchor = href.startsWith('#');
            const isExternal = this.hasAttribute('target') && this.getAttribute('target') === '_blank';
            const isTerroristsLink = href.includes('Terrorists');
            
            // Handle external links (Home and Terrorists)
            if ((!isAnchor && isExternal) || isTerroristsLink) {
                e.preventDefault();
                showButtonLoading(() => {
                    if (isExternal) {
                        window.open(href, '_blank');
                    } else {
                        window.location.href = href;
                    }
                });
            }
            // Handle anchor links
            else if (isAnchor) {
                e.preventDefault();
                navigateToSection(href);
            }
        });
    });

    // Show button loading screen with callback
    function showButtonLoading(callback) {
        const buttonLoading = document.getElementById('button-loading');
        buttonLoading.style.display = 'flex';
        
        setTimeout(() => {
            callback();
            setTimeout(() => {
                buttonLoading.style.display = 'none';
            }, 500);
        }, 800);
    }

    // Navigate to section with smooth scrolling
    function navigateToSection(sectionId) {
        const targetSection = document.querySelector(sectionId);
        if (!targetSection) return;
        
        // Hide current active section
        const currentActive = document.querySelector('.section.active');
        if (currentActive) {
            currentActive.classList.remove('active');
        }
        
        // Show new section
        targetSection.classList.add('active');
        
        // Smooth scroll to section
        window.scrollTo({
            top: targetSection.offsetTop - 80,
            behavior: 'smooth'
        });
    }

    // Add intersection observer for section transitions
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    // Observe all sections
    document.querySelectorAll('.section').forEach(section => {
        observer.observe(section);
    });

    // Search form handling
    const searchForm = document.querySelector('.search-container form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            const searchInput = this.querySelector('input[name="search"]');
            if (!searchInput.value.trim()) {
                e.preventDefault();
                alert('Please enter a search term');
            }
        });
    }
});