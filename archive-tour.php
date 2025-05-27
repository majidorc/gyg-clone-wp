<?php
/**
 * Template for displaying tour archives
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Page Header -->
    <section class="archive-header">
        <div class="container">
            <div class="archive-header-content">
                <h1 class="archive-title">
                    <?php
                    if (is_tax()) {
                        single_term_title();
                    } else {
                        echo 'Tours & Experiences';
                    }
                    ?>
                </h1>

                <?php if (is_tax()) :
                    $term_description = term_description();
                    if ($term_description) : ?>
                        <div class="archive-description">
                            <?php echo $term_description; ?>
                        </div>
                    <?php endif;
                endif; ?>

                <div class="archive-stats">
                    <span class="results-count">
                        <?php echo $wp_query->found_posts; ?> experiences found
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filters-section">
        <div class="container">
            <div class="filters-container">
                <!-- Search Bar -->
                <div class="filter-search">
                    <form class="search-form-archive" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="hidden" name="post_type" value="tour">
                        <input type="search"
                               name="s"
                               value="<?php echo get_search_query(); ?>"
                               placeholder="Search tours and experiences"
                               class="search-input-archive">
                        <button type="submit" class="search-btn-archive">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.35-4.35"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Filter Buttons -->
                <div class="filter-buttons">
                    <button class="filter-btn" data-filter="all" <?php echo !isset($_GET['tour_category']) ? 'aria-pressed="true"' : ''; ?>>
                        All Tours
                    </button>

                    <?php
                    $tour_categories = get_terms(array(
                        'taxonomy' => 'tour_category',
                        'hide_empty' => true,
                    ));

                    if (!is_wp_error($tour_categories)) :
                        foreach ($tour_categories as $category) :
                            $is_active = isset($_GET['tour_category']) && $_GET['tour_category'] === $category->slug;
                            ?>
                            <button class="filter-btn"
                                    data-filter="<?php echo esc_attr($category->slug); ?>"
                                    <?php echo $is_active ? 'aria-pressed="true"' : ''; ?>>
                                <?php echo esc_html($category->name); ?>
                                <span class="filter-count">(<?php echo $category->count; ?>)</span>
                            </button>
                        <?php endforeach;
                    endif; ?>
                </div>

                <!-- Sort Options -->
                <div class="sort-options">
                    <label for="sort-select">Sort by:</label>
                    <select id="sort-select" onchange="updateSort(this.value)">
                        <option value="popularity" <?php echo (!isset($_GET['orderby']) || $_GET['orderby'] === 'popularity') ? 'selected' : ''; ?>>
                            Recommended
                        </option>
                        <option value="rating" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] === 'rating') ? 'selected' : ''; ?>>
                            Best rated
                        </option>
                        <option value="price_low" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] === 'price_low') ? 'selected' : ''; ?>>
                            Price (low to high)
                        </option>
                        <option value="price_high" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] === 'price_high') ? 'selected' : ''; ?>>
                            Price (high to low)
                        </option>
                        <option value="duration" <?php echo (isset($_GET['orderby']) && $_GET['orderby'] === 'duration') ? 'selected' : ''; ?>>
                            Duration
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Grid -->
    <section class="tours-archive-section">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="tours-archive-grid">
                    <?php while (have_posts()) : the_post();
                        $tour_id = get_the_ID();
                        $price = get_post_meta($tour_id, '_tour_price', true);
                        $duration = get_post_meta($tour_id, '_tour_duration', true);
                        $rating = get_post_meta($tour_id, '_tour_rating', true);
                        $reviews_count = get_post_meta($tour_id, '_tour_reviews_count', true);

                        $tour_categories = get_the_terms($tour_id, 'tour_category');
                        $destinations = get_the_terms($tour_id, 'destination');
                        $category_name = $tour_categories ? $tour_categories[0]->name : '';
                        $destination_name = $destinations ? $destinations[0]->name : '';
                        ?>

                        <article class="tour-card-archive" data-category="<?php echo esc_attr(strtolower($category_name)); ?>">
                            <div class="tour-image-archive">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('tour-featured', array('loading' => 'lazy')); ?>
                                    <?php else : ?>
                                        <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=600&fit=crop"
                                             alt="<?php the_title(); ?>" loading="lazy">
                                    <?php endif; ?>
                                </a>

                                <?php if ($category_name) : ?>
                                    <span class="tour-badge-archive"><?php echo esc_html($category_name); ?></span>
                                <?php endif; ?>

                                <button class="tour-wishlist-archive" aria-label="Add to wishlist" data-tour-id="<?php echo $tour_id; ?>">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84,4.61a5.5,5.5 0 0,0 -7.78,0L12,5.67L10.94,4.61a5.5,5.5 0 0,0 -7.78,7.78l1.06,1.06L12,21.23l7.78,-7.78l1.06,-1.06a5.5,5.5 0 0,0 0,-7.78z"></path>
                                    </svg>
                                </button>
                            </div>

                            <div class="tour-content-archive">
                                <?php if ($destination_name) : ?>
                                    <div class="tour-location">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                            <circle cx="12" cy="10" r="3"></circle>
                                        </svg>
                                        <?php echo esc_html($destination_name); ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="tour-title-archive">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>

                                <div class="tour-meta-archive">
                                    <?php if ($duration) : ?>
                                        <span class="tour-duration-archive">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12,6 12,12 16,14"></polyline>
                                            </svg>
                                            <?php echo esc_html($duration); ?>
                                        </span>
                                    <?php endif; ?>

                                    <span class="tour-feature-archive">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"></polyline>
                                        </svg>
                                        Skip the line
                                    </span>

                                    <span class="tour-feature-archive">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M17,21v-2a4,4 0 0,0 -4,-4H5a4,4 0 0,0 -4,4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23,21v-2a4,4 0 0,0 -3,-3.87"></path>
                                            <path d="M16,3.13a4,4 0 0,1 0,7.75"></path>
                                        </svg>
                                        Small group
                                    </span>
                                </div>

                                <div class="tour-description-archive">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                                </div>

                                <div class="tour-footer-archive">
                                    <div class="tour-rating-archive">
                                        <?php if ($rating && $reviews_count) : ?>
                                            <div class="rating-stars"><?php echo get_tour_rating_stars($tour_id); ?></div>
                                            <span class="rating-number"><?php echo esc_html($rating); ?></span>
                                            <span class="reviews-count">(<?php echo esc_html($reviews_count); ?>)</span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tour-pricing-archive">
                                        <div class="tour-price-archive">
                                            <span class="price-from">From</span>
                                            <span class="price-amount"><?php echo get_tour_price_formatted($tour_id); ?></span>
                                            <div class="price-per">per person</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    <?php
                    $pagination = paginate_links(array(
                        'total' => $wp_query->max_num_pages,
                        'prev_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15,18 9,12 15,6"></polyline></svg>',
                        'next_text' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9,18 15,12 9,6"></polyline></svg>',
                        'type' => 'array'
                    ));

                    if ($pagination) :
                        echo '<nav class="pagination-nav">';
                        echo '<ul class="pagination-list">';
                        foreach ($pagination as $page) {
                            echo '<li class="pagination-item">' . $page . '</li>';
                        }
                        echo '</ul>';
                        echo '</nav>';
                    endif;
                    ?>
                </div>

            <?php else : ?>
                <div class="no-tours-found">
                    <div class="no-tours-content">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <h2>No tours found</h2>
                        <p>Sorry, we couldn't find any tours matching your criteria. Try adjusting your filters or search terms.</p>
                        <a href="<?php echo esc_url(home_url('/tours/')); ?>" class="view-all-tours-btn">View All Tours</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<style>
/* Archive Page Styles */
.archive-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 3rem 0;
}

.archive-header-content {
    text-align: center;
}

.archive-title {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.archive-description {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 1rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.archive-stats {
    font-size: 0.875rem;
    opacity: 0.8;
}

.filters-section {
    background: white;
    padding: 2rem 0;
    border-bottom: 1px solid #e2e8f0;
    position: sticky;
    top: 70px;
    z-index: 100;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.filters-container {
    display: flex;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.filter-search {
    flex: 1;
    min-width: 300px;
}

.search-form-archive {
    position: relative;
    display: flex;
    max-width: 400px;
}

.search-input-archive {
    flex: 1;
    padding: 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 8px 0 0 8px;
    font-size: 16px;
    outline: none;
}

.search-input-archive:focus {
    border-color: #3182ce;
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
}

.search-btn-archive {
    background: #3182ce;
    color: white;
    border: none;
    padding: 12px 16px;
    border-radius: 0 8px 8px 0;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.search-btn-archive:hover {
    background: #2c5aa0;
}

.filter-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    background: white;
    color: #344053;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.875rem;
    font-weight: 500;
}

.filter-btn:hover,
.filter-btn[aria-pressed="true"] {
    background: #3182ce;
    color: white;
    border-color: #3182ce;
}

.filter-count {
    font-size: 0.75rem;
    opacity: 0.8;
}

.sort-options {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-left: auto;
}

.sort-options label {
    font-weight: 500;
    color: #344053;
    font-size: 0.875rem;
}

.sort-options select {
    padding: 0.5rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    background: white;
    color: #344053;
    cursor: pointer;
}

.tours-archive-section {
    padding: 3rem 0;
}

.tours-archive-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.tour-card-archive {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
}

.tour-card-archive:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.tour-image-archive {
    position: relative;
    height: 240px;
    overflow: hidden;
}

.tour-image-archive img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.tour-card-archive:hover .tour-image-archive img {
    transform: scale(1.05);
}

.tour-badge-archive {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #ff6b35;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.tour-wishlist-archive {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.tour-wishlist-archive:hover {
    background: white;
    transform: scale(1.1);
}

.tour-wishlist-archive.active {
    background: #ff6b35;
    color: white;
}

.tour-content-archive {
    padding: 1.5rem;
}

.tour-location {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    color: #718096;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    font-weight: 600;
}

.tour-title-archive {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    line-height: 1.4;
}

.tour-title-archive a {
    color: #1a202c;
    text-decoration: none;
}

.tour-title-archive a:hover {
    color: #3182ce;
}

.tour-meta-archive {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.75rem;
    color: #718096;
}

.tour-duration-archive,
.tour-feature-archive {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.tour-description-archive {
    color: #4a5568;
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 1.5rem;
}

.tour-footer-archive {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #f7fafc;
    padding-top: 1rem;
}

.tour-rating-archive {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.rating-stars {
    color: #ff6b35;
}

.rating-number {
    font-weight: 600;
    color: #1a202c;
}

.reviews-count {
    color: #718096;
}

.tour-pricing-archive {
    text-align: right;
}

.price-from {
    font-size: 0.75rem;
    color: #718096;
}

.price-amount {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1a202c;
    display: block;
}

.price-per {
    font-size: 0.75rem;
    color: #718096;
}

.pagination-wrapper {
    margin-top: 3rem;
    display: flex;
    justify-content: center;
}

.pagination-nav {
    display: flex;
}

.pagination-list {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 0.5rem;
}

.pagination-item a,
.pagination-item span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    text-decoration: none;
    color: #344053;
    transition: all 0.2s ease;
}

.pagination-item a:hover,
.pagination-item .current {
    background: #3182ce;
    color: white;
    border-color: #3182ce;
}

.no-tours-found {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
}

.no-tours-content {
    text-align: center;
    max-width: 400px;
}

.no-tours-content svg {
    color: #a0aec0;
    margin-bottom: 1rem;
}

.no-tours-content h2 {
    color: #1a202c;
    margin-bottom: 1rem;
}

.no-tours-content p {
    color: #4a5568;
    margin-bottom: 2rem;
}

.view-all-tours-btn {
    display: inline-block;
    background: #3182ce;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.2s ease;
}

.view-all-tours-btn:hover {
    background: #2c5aa0;
}

@media (max-width: 768px) {
    .filters-container {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }

    .filter-search {
        min-width: auto;
    }

    .sort-options {
        margin-left: 0;
        justify-content: space-between;
    }

    .tours-archive-grid {
        grid-template-columns: 1fr;
    }

    .tour-footer-archive {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .tour-pricing-archive {
        text-align: left;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tourCards = document.querySelectorAll('.tour-card-archive');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;

            // Update URL with filter parameter
            const url = new URL(window.location);
            if (filter === 'all') {
                url.searchParams.delete('tour_category');
            } else {
                url.searchParams.set('tour_category', filter);
            }
            window.history.pushState({}, '', url);

            // Update active button
            filterButtons.forEach(btn => btn.setAttribute('aria-pressed', 'false'));
            this.setAttribute('aria-pressed', 'true');

            // Filter cards
            tourCards.forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Wishlist functionality
    const wishlistButtons = document.querySelectorAll('.tour-wishlist-archive');
    let wishlist = JSON.parse(localStorage.getItem('getyourguide_wishlist') || '[]');

    wishlistButtons.forEach(button => {
        const tourId = button.dataset.tourId;

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

            // Update wishlist count in header
            const wishlistCount = document.getElementById('wishlist-count');
            if (wishlistCount) {
                wishlistCount.textContent = wishlist.length;
                wishlistCount.style.display = wishlist.length > 0 ? 'inline-flex' : 'none';
            }
        });
    });
});

// Sort functionality
function updateSort(orderby) {
    const url = new URL(window.location);
    url.searchParams.set('orderby', orderby);
    window.location.href = url.toString();
}
</script>

<?php get_footer(); ?>
