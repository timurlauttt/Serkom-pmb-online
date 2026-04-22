// Mobile Menu Toggle
const mobileToggle = document.getElementById('mobile-toggle');
const navLinks = document.getElementById('nav-links');

if (mobileToggle) {
    mobileToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        const icon = mobileToggle.querySelector('i');
        if (navLinks.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
}

// Dropdown Menu Click Handler
const dropdowns = document.querySelectorAll('.dropdown');

dropdowns.forEach(dropdown => {
    const dropdownLink = dropdown.querySelector('a');

    if (dropdownLink) {
        dropdownLink.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            // Close other dropdowns
            dropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown) {
                    otherDropdown.classList.remove('active');
                }
            });

            // Toggle current dropdown
            dropdown.classList.toggle('active');
        });
    }
});

// Close dropdown when clicking outside
document.addEventListener('click', (e) => {
    if (!e.target.closest('.dropdown')) {
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
        });
    }
});

// Search Functionality (for list pages)
const searchInput = document.getElementById('searchInput');
const searchItems = document.querySelectorAll('.search-item'); // Add this class to searchable items (news cards, etc)

if (searchInput) {
    searchInput.addEventListener('input', (e) => {
        const searchTerm = e.target.value.toLowerCase();

        searchItems.forEach(item => {
            const title = item.querySelector('h3') ? item.querySelector('h3').textContent.toLowerCase() : '';
            const content = item.querySelector('p') ? item.querySelector('p').textContent.toLowerCase() : '';

            if (title.includes(searchTerm) || content.includes(searchTerm)) {
                item.style.display = 'block'; // Or 'flex' depending on layout, block is safer generally
                // If it's a grid item, we might need to be careful with display property. 
                // Usually grid items are block-like.
                if (item.classList.contains('card') || item.classList.contains('news-card')) {
                    // Keep default display or set to initial
                    item.style.display = '';
                }
            } else {
                item.style.display = 'none';
            }
        });
    });
}

// Sticky Header Effect
window.addEventListener('scroll', () => {
    const header = document.querySelector('header');
    if (window.scrollY > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});
