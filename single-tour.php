<?php
/**
 * Template for displaying single tour posts
 */

get_header(); ?>

<main id="main" class="site-main">
    <?php while (have_posts()) : the_post();
        $tour_id = get_the_ID();
        $price = get_post_meta($tour_id, '_tour_price', true);
        $duration = get_post_meta($tour_id, '_tour_duration', true);
        $rating = get_post_meta($tour_id, '_tour_rating', true);
        $reviews_count = get_post_meta($tour_id, '_tour_reviews_count', true);
        $max_group_size = get_post_meta($tour_id, '_tour_max_group_size', true);
        $meeting_point = get_post_meta($tour_id, '_tour_meeting_point', true);
        $highlights = get_post_meta($tour_id, '_tour_highlights', true);
        $included = get_post_meta($tour_id, '_tour_included', true);
        $not_included = get_post_meta($tour_id, '_tour_not_included', true);

        $tour_categories = get_the_terms($tour_id, 'tour_category');
        $destinations = get_the_terms($tour_id, 'destination');
        ?>

        <!-- Breadcrumb -->
        <div class="breadcrumb-section" style="background: #f7fafc; padding: 1rem 0;">
            <div class="container">
                <nav class="breadcrumb">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                    <span class="separator">></span>
                    <?php if ($destinations && !is_wp_error($destinations)) : ?>
                        <a href="<?php echo esc_url(get_term_link($destinations[0])); ?>"><?php echo esc_html($destinations[0]->name); ?></a>
                        <span class="separator">></span>
                    <?php endif; ?>
                    <span class="current"><?php the_title(); ?></span>
                </nav>
            </div>
        </div>

        <!-- Tour Header -->
        <section class="tour-header">
            <div class="container">
                <div class="tour-header-content">
                    <div class="tour-header-left">
                        <?php if ($tour_categories && !is_wp_error($tour_categories)) : ?>
                            <div class="tour-category">
                                <span class="category-badge"><?php echo esc_html($tour_categories[0]->name); ?></span>
                            </div>
                        <?php endif; ?>

                        <h1 class="tour-title"><?php the_title(); ?></h1>

                        <div class="tour-meta-header">
                            <?php if ($rating && $reviews_count) : ?>
                                <div class="tour-rating">
                                    <span class="stars"><?php echo get_tour_rating_stars($tour_id); ?></span>
                                    <span class="rating-number"><?php echo esc_html($rating); ?></span>
                                    <span class="reviews-count">(<?php echo esc_html($reviews_count); ?> reviews)</span>
                                </div>
                            <?php endif; ?>

                            <div class="tour-actions-header">
                                <button class="tour-action-btn wishlist-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.84,4.61a5.5,5.5 0 0,0 -7.78,0L12,5.67L10.94,4.61a5.5,5.5 0 0,0 -7.78,7.78l1.06,1.06L12,21.23l7.78,-7.78l1.06,-1.06a5.5,5.5 0 0,0 0,-7.78z"></path>
                                    </svg>
                                    Add to wishlist
                                </button>
                                <button class="tour-action-btn share-btn">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="18" cy="5" r="3"></circle>
                                        <circle cx="6" cy="12" r="3"></circle>
                                        <circle cx="18" cy="19" r="3"></circle>
                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                    </svg>
                                    Share
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tour Images -->
        <section class="tour-images">
            <div class="container">
                <div class="tour-gallery">
                    <div class="main-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'tour-main-image')); ?>
                        <?php else : ?>
                            <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&h=800&fit=crop"
                                 alt="<?php the_title(); ?>" class="tour-main-image">
                        <?php endif; ?>

                        <div class="image-overlay">
                            <button class="view-all-photos">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21,15 16,10 5,21"></polyline>
                                </svg>
                                View all photos
                            </button>
                        </div>
                    </div>

                    <div class="thumbnail-images">
                        <!-- Additional images would go here -->
                        <div class="thumbnail-grid">
                            <img src="https://images.unsplash.com/photo-1571104508999-893933ded431?w=400&h=300&fit=crop" alt="Tour image 2">
                            <img src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=400&h=300&fit=crop" alt="Tour image 3">
                            <img src="https://images.unsplash.com/photo-1539650116574-75c0c6d73c0e?w=400&h=300&fit=crop" alt="Tour image 4">
                            <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=400&h=300&fit=crop" alt="Tour image 5">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tour Content -->
        <section class="tour-content-section">
            <div class="container">
                <div class="tour-content-grid">
                    <!-- Main Content -->
                    <div class="tour-main-content">
                        <!-- About This Activity -->
                        <div class="content-block">
                            <h2>About this activity</h2>
                            <div class="activity-features">
                                <?php if ($duration) : ?>
                                    <div class="feature-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12,6 12,12 16,14"></polyline>
                                        </svg>
                                        <div>
                                            <strong>Free cancellation</strong>
                                            <p>Cancel up to 24 hours in advance for a full refund</p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="feature-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                                    </svg>
                                    <div>
                                        <strong>Reserve now & pay later</strong>
                                        <p>Keep your travel plans flexible — book your spot and pay nothing today</p>
                                    </div>
                                </div>

                                <?php if ($duration) : ?>
                                    <div class="feature-item">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12,6 12,12 16,14"></polyline>
                                        </svg>
                                        <div>
                                            <strong>Duration <?php echo esc_html($duration); ?></strong>
                                            <p>Check availability to see starting times</p>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="feature-item">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12"></polyline>
                                    </svg>
                                    <div>
                                        <strong>Skip the line</strong>
                                        <p>Don't wait in line with this skip-the-line ticket</p>
                                    </div>
                                </div>
                            </div>

                            <div class="tour-description">
                                <?php the_content(); ?>
                            </div>
                        </div>

                        <!-- Highlights -->
                        <?php if ($highlights) : ?>
                            <div class="content-block">
                                <h2>Highlights</h2>
                                <ul class="highlights-list">
                                    <?php
                                    $highlights_array = explode("\n", $highlights);
                                    foreach ($highlights_array as $highlight) :
                                        if (trim($highlight)) : ?>
                                            <li><?php echo esc_html(trim($highlight)); ?></li>
                                        <?php endif;
                                    endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- What's Included -->
                        <div class="content-block">
                            <div class="includes-grid">
                                <?php if ($included) : ?>
                                    <div class="includes-section">
                                        <h3>Includes</h3>
                                        <ul class="includes-list">
                                            <?php
                                            $included_array = explode("\n", $included);
                                            foreach ($included_array as $item) :
                                                if (trim($item)) : ?>
                                                    <li class="included-item">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <polyline points="20,6 9,17 4,12"></polyline>
                                                        </svg>
                                                        <?php echo esc_html(trim($item)); ?>
                                                    </li>
                                                <?php endif;
                                            endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <?php if ($not_included) : ?>
                                    <div class="includes-section">
                                        <h3>Not suitable for</h3>
                                        <ul class="includes-list">
                                            <?php
                                            $not_included_array = explode("\n", $not_included);
                                            foreach ($not_included_array as $item) :
                                                if (trim($item)) : ?>
                                                    <li class="not-included-item">
                                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                        <?php echo esc_html(trim($item)); ?>
                                                    </li>
                                                <?php endif;
                                            endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Meeting Point -->
                        <?php if ($meeting_point) : ?>
                            <div class="content-block">
                                <h2>Important information</h2>
                                <div class="meeting-point">
                                    <h3>What to bring</h3>
                                    <ul>
                                        <li>Passport or ID card</li>
                                        <li>Camera</li>
                                        <li>Comfortable shoes</li>
                                        <li>Sun hat</li>
                                        <li>Sunglasses</li>
                                    </ul>

                                    <h3>Not allowed</h3>
                                    <ul>
                                        <li>Luggage or large bags</li>
                                        <li>Pets</li>
                                        <li>Smoking</li>
                                        <li>Alcohol and drugs</li>
                                    </ul>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Booking Sidebar -->
                    <div class="tour-booking-sidebar">
                        <div class="booking-card">
                            <div class="booking-price">
                                <span class="price-from">From</span>
                                <span class="price-amount"><?php echo get_tour_price_formatted($tour_id); ?></span>
                                <span class="price-per">per person</span>
                            </div>

                            <div class="booking-guarantee">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                                </svg>
                                <span>Lowest price & money back guarantee</span>
                            </div>

                            <!-- Date & Participants Selection -->
                            <div class="booking-form">
                                <div class="form-section">
                                    <h4>Select participants and date</h4>

                                    <div class="form-group">
                                        <label>Step 1</label>
                                        <select class="form-control" id="participants">
                                            <option>1 Adult</option>
                                            <option>2 Adults</option>
                                            <option>3 Adults</option>
                                            <option>4 Adults</option>
                                            <option>5+ Adults</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Step 2</label>
                                        <input type="date" class="form-control" id="tour-date" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>

                                <button class="book-now-btn-large" onclick="bookTour()">
                                    Check availability
                                </button>

                                <div class="booking-features">
                                    <div class="booking-feature">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20,6 9,17 4,12"></polyline>
                                        </svg>
                                        Free cancellation up to 24 hours in advance
                                    </div>
                                    <div class="booking-feature">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="20,6 9,17 4,12"></polyline>
                                        </svg>
                                        Reserve now & pay later to secure your spot
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Other Popular Tours -->
                        <div class="related-tours">
                            <h3>You might also like...</h3>
                            <?php
                            $related_tours = new WP_Query(array(
                                'post_type' => 'tour',
                                'posts_per_page' => 4,
                                'post__not_in' => array($tour_id),
                                'meta_key' => '_tour_rating',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC'
                            ));

                            if ($related_tours->have_posts()) :
                                while ($related_tours->have_posts()) : $related_tours->the_post();
                                    $related_id = get_the_ID();
                                    $related_price = get_post_meta($related_id, '_tour_price', true);
                                    $related_rating = get_post_meta($related_id, '_tour_rating', true);
                                    ?>
                                    <div class="related-tour-item">
                                        <a href="<?php the_permalink(); ?>" class="related-tour-link">
                                            <div class="related-tour-image">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('tour-thumbnail'); ?>
                                                <?php else : ?>
                                                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&h=300&fit=crop" alt="<?php the_title(); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="related-tour-content">
                                                <h4><?php the_title(); ?></h4>
                                                <div class="related-tour-meta">
                                                    <?php if ($related_rating) : ?>
                                                        <span class="rating">★ <?php echo esc_html($related_rating); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($related_price) : ?>
                                                        <span class="price">From <?php echo get_tour_price_formatted($related_id); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Customer Reviews -->
        <section class="reviews-section">
            <div class="container">
                <div class="reviews-header">
                    <h2>Customer reviews</h2>
                    <div class="overall-rating">
                        <span class="rating-large"><?php echo esc_html($rating); ?>/5</span>
                        <div class="rating-breakdown">
                            <div class="stars-large"><?php echo get_tour_rating_stars($tour_id); ?></div>
                            <span class="review-count">Based on <?php echo esc_html($reviews_count); ?> reviews</span>
                        </div>
                    </div>
                </div>

                <!-- Sample Reviews -->
                <div class="reviews-grid">
                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">JD</div>
                                <div class="reviewer-details">
                                    <span class="reviewer-name">John Doe</span>
                                    <span class="reviewer-location">United States</span>
                                </div>
                            </div>
                            <div class="review-rating">★ 5</div>
                        </div>
                        <div class="review-content">
                            <p>Amazing experience! The tour guide was knowledgeable and friendly. We learned so much about the history and had a fantastic time. Highly recommended!</p>
                        </div>
                        <div class="review-date">October 2024</div>
                    </div>

                    <div class="review-item">
                        <div class="review-header">
                            <div class="reviewer-info">
                                <div class="reviewer-avatar">SM</div>
                                <div class="reviewer-details">
                                    <span class="reviewer-name">Sarah Miller</span>
                                    <span class="reviewer-location">Canada</span>
                                </div>
                            </div>
                            <div class="review-rating">★ 4</div>
                        </div>
                        <div class="review-content">
                            <p>Great tour with beautiful views. The only downside was that it was quite crowded, but the guide managed the group well. Would do it again!</p>
                        </div>
                        <div class="review-date">September 2024</div>
                    </div>
                </div>

                <button class="view-more-reviews">See more reviews</button>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<style>
/* Single Tour Page Styles */
.breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.breadcrumb .separator {
    color: #718096;
}

.breadcrumb .current {
    color: #718096;
}

.tour-header {
    padding: 2rem 0;
}

.tour-header-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.category-badge {
    background: #ff6b35;
    color: white;
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.tour-title {
    font-size: 2rem;
    margin: 1rem 0;
    color: #1a202c;
}

.tour-meta-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
}

.tour-actions-header {
    display: flex;
    gap: 1rem;
}

.tour-action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    background: white;
    color: #344053;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
}

.tour-action-btn:hover {
    border-color: #3182ce;
    color: #3182ce;
}

.tour-images {
    margin-bottom: 3rem;
}

.tour-gallery {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1rem;
    height: 500px;
}

.main-image {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
}

.tour-main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
}

.view-all-photos {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    backdrop-filter: blur(10px);
}

.thumbnail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    height: 100%;
}

.thumbnail-grid img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.tour-content-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 3rem;
    margin-top: 3rem;
}

.content-block {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid #e2e8f0;
}

.content-block:last-child {
    border-bottom: none;
}

.content-block h2 {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: #1a202c;
}

.activity-features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: #f7fafc;
    border-radius: 8px;
}

.feature-item svg {
    color: #3182ce;
    margin-top: 2px;
}

.feature-item strong {
    display: block;
    margin-bottom: 0.25rem;
    color: #1a202c;
}

.feature-item p {
    color: #4a5568;
    font-size: 0.875rem;
    margin: 0;
}

.highlights-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.highlights-list li {
    padding: 0.75rem 0;
    border-bottom: 1px solid #f7fafc;
    position: relative;
    padding-left: 2rem;
}

.highlights-list li:before {
    content: "★";
    position: absolute;
    left: 0;
    color: #ff6b35;
    font-weight: bold;
}

.includes-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.includes-section h3 {
    margin-bottom: 1rem;
    color: #1a202c;
}

.includes-list {
    list-style: none;
    margin: 0;
    padding: 0;
}

.includes-list li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0;
    font-size: 0.875rem;
}

.included-item svg {
    color: #10b981;
}

.not-included-item svg {
    color: #ef4444;
}

.booking-card {
    position: sticky;
    top: 2rem;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.booking-price {
    text-align: center;
    margin-bottom: 1rem;
}

.price-from {
    font-size: 0.875rem;
    color: #718096;
}

.price-amount {
    font-size: 2rem;
    font-weight: 700;
    color: #1a202c;
    display: block;
}

.price-per {
    font-size: 0.875rem;
    color: #718096;
}

.booking-guarantee {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center;
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
    color: #10b981;
}

.form-section h4 {
    margin-bottom: 1rem;
    color: #1a202c;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #344053;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 16px;
    background: white;
}

.form-control:focus {
    outline: none;
    border-color: #3182ce;
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
}

.book-now-btn-large {
    width: 100%;
    background: #3182ce;
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-bottom: 1rem;
}

.book-now-btn-large:hover {
    background: #2c5aa0;
}

.booking-features {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.booking-feature {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #4a5568;
}

.booking-feature svg {
    color: #10b981;
}

.related-tours {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.related-tours h3 {
    margin-bottom: 1rem;
    color: #1a202c;
}

.related-tour-item {
    margin-bottom: 1rem;
}

.related-tour-link {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border-radius: 8px;
    transition: background-color 0.2s ease;
    text-decoration: none;
    color: inherit;
}

.related-tour-link:hover {
    background: #f7fafc;
}

.related-tour-image {
    width: 80px;
    height: 60px;
    flex-shrink: 0;
}

.related-tour-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
}

.related-tour-content h4 {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
    color: #1a202c;
}

.related-tour-meta {
    font-size: 0.75rem;
    color: #718096;
}

.reviews-section {
    background: #f7fafc;
    padding: 3rem 0;
}

.reviews-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.overall-rating {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.rating-large {
    font-size: 2rem;
    font-weight: 700;
    color: #1a202c;
}

.stars-large {
    color: #ff6b35;
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
}

.review-count {
    font-size: 0.875rem;
    color: #718096;
}

.reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.review-item {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.reviewer-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.reviewer-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #3182ce;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.reviewer-name {
    font-weight: 600;
    color: #1a202c;
    display: block;
}

.reviewer-location {
    font-size: 0.875rem;
    color: #718096;
}

.review-rating {
    color: #ff6b35;
    font-weight: 600;
}

.review-content p {
    margin: 0;
    line-height: 1.6;
    color: #4a5568;
}

.review-date {
    font-size: 0.875rem;
    color: #718096;
    margin-top: 1rem;
}

.view-more-reviews {
    background: #3182ce;
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.view-more-reviews:hover {
    background: #2c5aa0;
}

@media (max-width: 768px) {
    .tour-content-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .tour-gallery {
        grid-template-columns: 1fr;
        height: auto;
    }

    .main-image {
        height: 300px;
    }

    .thumbnail-grid {
        height: 200px;
    }

    .includes-grid {
        grid-template-columns: 1fr;
    }

    .reviews-grid {
        grid-template-columns: 1fr;
    }

    .tour-meta-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}
</style>

<script>
function bookTour() {
    const participants = document.getElementById('participants').value;
    const date = document.getElementById('tour-date').value;

    if (!date) {
        alert('Please select a date for your tour.');
        return;
    }

    // Simulate booking process
    alert(`Checking availability for ${participants} on ${date}...`);

    // In a real implementation, this would redirect to a booking/checkout page
    // or integrate with WooCommerce
}

// Initialize date picker with minimum date as today
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('tour-date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
    }
});
</script>

<?php get_footer(); ?>
