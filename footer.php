<footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <!-- Footer Section 1 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h4>Top attractions worldwide</h4>
                        <ul>
                            <li><a href="#">Moulin Rouge</a></li>
                            <li><a href="#">Seine River</a></li>
                            <li><a href="#">Ha Long Bay</a></li>
                            <li><a href="#">Notre Dame Cathedral</a></li>
                            <li><a href="#">Colosseum</a></li>
                            <li><a href="#">Louvre Museum</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Section 2 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h4>Top destinations</h4>
                        <ul>
                            <li><a href="#">Paris</a></li>
                            <li><a href="#">London</a></li>
                            <li><a href="#">New York City</a></li>
                            <li><a href="#">Rome</a></li>
                            <li><a href="#">Barcelona</a></li>
                            <li><a href="#">Tokyo</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Section 3 -->
                <div class="footer-section">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h4>Support</h4>
                        <ul>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Legal Notice</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms and Conditions</a></li>
                            <li><a href="#">Help Center</a></li>
                        </ul>
                    <?php endif; ?>
                </div>

                <!-- Footer Section 4 - Company -->
                <div class="footer-section">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Press</a></li>
                        <li><a href="#">Gift Cards</a></li>
                    </ul>
                </div>

                <!-- Footer Section 5 - Work With Us -->
                <div class="footer-section">
                    <h4>Work With Us</h4>
                    <ul>
                        <li><a href="#">As a Supply Partner</a></li>
                        <li><a href="#">As a Content Creator</a></li>
                        <li><a href="#">As an Affiliate Partner</a></li>
                    </ul>

                    <div class="payment-methods" style="margin-top: 2rem;">
                        <h4>Ways You Can Pay</h4>
                        <div class="payment-icons" style="display: flex; gap: 8px; flex-wrap: wrap; margin-top: 1rem;">
                            <img src="https://ext.same-assets.com/2168762247/3096023326.svg" alt="PayPal" style="height: 24px;">
                            <img src="https://ext.same-assets.com/2168762247/3266104713.svg" alt="Mastercard" style="height: 24px;">
                            <img src="https://ext.same-assets.com/2168762247/479294803.svg" alt="Visa" style="height: 24px;">
                            <img src="https://ext.same-assets.com/2168762247/2381490523.svg" alt="American Express" style="height: 24px;">
                            <img src="https://ext.same-assets.com/2168762247/795659355.svg" alt="Google Pay" style="height: 24px;">
                            <img src="https://ext.same-assets.com/2168762247/1526671865.svg" alt="Apple Pay" style="height: 24px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div class="copyright">
                        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Made with WordPress.</p>
                    </div>

                    <div class="social-links" style="display: flex; gap: 1rem;">
                        <a href="#" aria-label="Facebook" style="color: #a0aec0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram" style="color: #a0aec0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987s11.987-5.367 11.987-11.987C24.014 5.367 18.647.001 12.017.001zM8.449 20.25c-2.098 0-3.798-1.7-3.798-3.798V7.548c0-2.098 1.7-3.798 3.798-3.798h7.102c2.098 0 3.798 1.7 3.798 3.798v8.904c0 2.098-1.7 3.798-3.798 3.798H8.449z"/>
                                <path d="M12.017 5.838c-3.403 0-6.149 2.746-6.149 6.149s2.746 6.149 6.149 6.149 6.149-2.746 6.149-6.149-2.746-6.149-6.149-6.149zm0 10.13c-2.196 0-3.981-1.785-3.981-3.981s1.785-3.981 3.981-3.981 3.981 1.785 3.981 3.981-1.785 3.981-3.981 3.981z"/>
                                <circle cx="18.406" cy="5.594" r="1.44"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="Twitter" style="color: #a0aec0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" style="color: #a0aec0;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<!-- Newsletter Signup Modal -->
<div id="newsletter-modal" class="modal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <button class="modal-close" id="newsletter-close">&times;</button>
        <div class="newsletter-content">
            <h3>Discover the wonder of travel every week</h3>
            <p>Get inspired with travel recommendations, fun travel deals, local insights, and exclusive deals.</p>
            <form class="newsletter-form" id="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit" class="newsletter-submit">Sign up</button>
            </form>
        </div>
    </div>
</div>

<style>
/* Modal Styles */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.modal-content {
    position: relative;
    background: white;
    border-radius: 12px;
    padding: 2rem;
    max-width: 500px;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #718096;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s ease;
}

.modal-close:hover {
    background: #f7fafc;
}

.newsletter-content h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #1a202c;
}

.newsletter-content p {
    color: #4a5568;
    margin-bottom: 1.5rem;
}

.newsletter-form {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.newsletter-form input {
    flex: 1;
    padding: 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 16px;
    min-width: 200px;
}

.newsletter-submit {
    background: #3182ce;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.newsletter-submit:hover {
    background: #2c5aa0;
}

@media (max-width: 480px) {
    .newsletter-form {
        flex-direction: column;
    }

    .newsletter-form input {
        min-width: auto;
    }
}
</style>

<?php wp_footer(); ?>

<script>
// Main JavaScript functionality
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileNavigation = document.getElementById('mobile-navigation');

    if (mobileMenuToggle && mobileNavigation) {
        mobileMenuToggle.addEventListener('click', function() {
            const isVisible = mobileNavigation.style.display !== 'none';
            mobileNavigation.style.display = isVisible ? 'none' : 'block';

            // Toggle hamburger animation
            this.classList.toggle('active');
        });
    }

    // User Menu Toggle
    const userMenuToggle = document.getElementById('user-menu-toggle');
    const userDropdown = document.getElementById('user-dropdown');

    if (userMenuToggle && userDropdown) {
        userMenuToggle.addEventListener('click', function() {
            const isVisible = userDropdown.style.display !== 'none';
            userDropdown.style.display = isVisible ? 'none' : 'block';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userMenuToggle.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.style.display = 'none';
            }
        });
    }

    // Search Functionality
    const searchField = document.getElementById('search-field');
    const searchResults = document.getElementById('search-results');
    let searchTimeout;

    if (searchField && searchResults) {
        searchField.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.style.display = 'none';
                return;
            }

            searchTimeout = setTimeout(() => {
                performSearch(query);
            }, 300);
        });

        // Hide search results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchField.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }

    // Category Tab Filtering
    const categoryTabs = document.querySelectorAll('.tab-button');
    const tourCards = document.querySelectorAll('.tour-card');

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;

            // Update active tab
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Filter tour cards
            tourCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Wishlist Functionality
    const wishlistButtons = document.querySelectorAll('.tour-wishlist');
    let wishlist = JSON.parse(localStorage.getItem('getyourguide_wishlist') || '[]');

    // Update wishlist count
    updateWishlistCount();

    wishlistButtons.forEach(button => {
        const tourCard = button.closest('.tour-card');
        const tourId = tourCard.dataset.tourId || Math.random().toString(36).substr(2, 9);

        // Check if already in wishlist
        if (wishlist.includes(tourId)) {
            button.classList.add('active');
        }

        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (wishlist.includes(tourId)) {
                // Remove from wishlist
                wishlist = wishlist.filter(id => id !== tourId);
                this.classList.remove('active');
            } else {
                // Add to wishlist
                wishlist.push(tourId);
                this.classList.add('active');
            }

            localStorage.setItem('getyourguide_wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
        });
    });

    // Newsletter Modal
    const newsletterModal = document.getElementById('newsletter-modal');
    const newsletterClose = document.getElementById('newsletter-close');
    const modalOverlay = newsletterModal.querySelector('.modal-overlay');

    // Show newsletter modal after 30 seconds (if not shown before)
    if (!localStorage.getItem('newsletter_shown')) {
        setTimeout(() => {
            newsletterModal.style.display = 'flex';
        }, 30000);
    }

    // Close modal events
    [newsletterClose, modalOverlay].forEach(element => {
        if (element) {
            element.addEventListener('click', function() {
                newsletterModal.style.display = 'none';
                localStorage.setItem('newsletter_shown', 'true');
            });
        }
    });

    // Newsletter form submission
    const newsletterForm = document.getElementById('newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;

            // Here you would typically send the email to your server
            alert('Thank you for subscribing!');
            newsletterModal.style.display = 'none';
            localStorage.setItem('newsletter_shown', 'true');
        });
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Search function
function performSearch(query) {
    const searchResults = document.getElementById('search-results');

    // Show loading state
    searchResults.innerHTML = '<div style="padding: 1rem; text-align: center; color: #718096;">Searching...</div>';
    searchResults.style.display = 'block';

    // Perform AJAX search (if WordPress AJAX is available)
    if (typeof ajax_object !== 'undefined') {
        const formData = new FormData();
        formData.append('action', 'getyourguide_search');
        formData.append('search_term', query);
        formData.append('nonce', ajax_object.nonce);

        fetch(ajax_object.ajax_url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        })
        .catch(error => {
            searchResults.innerHTML = '<div style="padding: 1rem; text-align: center; color: #e53e3e;">Search failed. Please try again.</div>';
        });
    } else {
        // Fallback: simple text-based search of visible content
        setTimeout(() => {
            const results = performClientSearch(query);
            displaySearchResults(results);
        }, 500);
    }
}

// Client-side search fallback
function performClientSearch(query) {
    const results = [];
    const tourCards = document.querySelectorAll('.tour-card');

    tourCards.forEach(card => {
        const title = card.querySelector('.tour-title a').textContent.toLowerCase();
        const description = card.querySelector('.tour-description').textContent.toLowerCase();

        if (title.includes(query.toLowerCase()) || description.includes(query.toLowerCase())) {
            const image = card.querySelector('.tour-image img').src;
            const priceElement = card.querySelector('.tour-price');
            const ratingElement = card.querySelector('.rating-number');
            const durationElement = card.querySelector('.tour-duration');

            results.push({
                title: card.querySelector('.tour-title a').textContent,
                url: card.querySelector('.tour-title a').href,
                image: image,
                price: priceElement ? priceElement.textContent : '',
                rating: ratingElement ? ratingElement.textContent : '',
                duration: durationElement ? durationElement.textContent : ''
            });
        }
    });

    return results.slice(0, 5); // Limit to 5 results
}

// Display search results
function displaySearchResults(results) {
    const searchResults = document.getElementById('search-results');

    if (results.length === 0) {
        searchResults.innerHTML = '<div style="padding: 1rem; text-align: center; color: #718096;">No results found.</div>';
        return;
    }

    let html = '';
    results.forEach(result => {
        html += `
            <div class="search-result-item" onclick="location.href='${result.url}'">
                <img src="${result.image}" alt="${result.title}" class="search-result-image">
                <div class="search-result-content">
                    <div class="search-result-title">${result.title}</div>
                    <div class="search-result-meta">
                        ${result.price ? result.price + ' • ' : ''}
                        ${result.rating ? '★ ' + result.rating + ' • ' : ''}
                        ${result.duration || ''}
                    </div>
                </div>
            </div>
        `;
    });

    searchResults.innerHTML = html;
}

// Update wishlist count
function updateWishlistCount() {
    const wishlistCount = document.getElementById('wishlist-count');
    if (wishlistCount) {
        const count = JSON.parse(localStorage.getItem('getyourguide_wishlist') || '[]').length;
        wishlistCount.textContent = count;
        wishlistCount.style.display = count > 0 ? 'inline-flex' : 'none';
    }
}
</script>

</body>
</html>
