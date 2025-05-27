<?php
/**
 * The main template file - WooCommerce Integration
 */

get_header(); ?>

<main id="main" class="site-main">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    <?php echo get_theme_mod('hero_title', 'Find your next travel experience'); ?>
                </h1>
                <p class="hero-subtitle">
                    <?php echo get_theme_mod('hero_subtitle', 'Discover amazing tours and experiences around the world'); ?>
                </p>
                <a href="#experiences" class="hero-cta">
                    <span>Learn more</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9,18 15,12 9,6"></polyline>
                    </svg>
                </a>
            </div>

            <!-- Category Tabs -->
            <div class="category-tabs">
                <div class="tabs-container">
                    <button class="tab-button active" data-category="all">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polygon points="10,8 16,12 10,16 10,8"></polygon>
                        </svg>
                        For you
                    </button>

                    <?php
                    $product_categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                        'exclude' => array(get_option('default_product_cat')), // Exclude uncategorized
                    ));

                    if (!is_wp_error($product_categories) && !empty($product_categories)) :
                        $category_icons = array(
                            'culture' => '<path d="M9,9 L21,9 L21,21 L9,21 Z"></path><path d="M5,15 L5,21 L9,21"></path><path d="M5,5 L5,9 L21,9"></path>',
                            'food-drink' => '<path d="M12,2 L13,2 L13,7 L11,7 Z M16,6 L17,6 L17,11 L15,11 Z M8,6 L9,6 L9,11 L7,11 Z"></path><path d="M5,11 L19,11 L19,12 L5,12 Z"></path><path d="M12,12 L12,22"></path>',
                            'outdoor' => '<path d="M17,8 C8,10 5.9,16.17 3.82,21.34 L5.71,22.45 C7.66,17.7 10.26,12.38 17,10.18 L17,8 Z"></path><path d="M3.34,9.56 C4.93,12.92 7.28,16.17 10.34,18.5 L11.37,17.19 C8.68,15.14 6.56,12.18 5.15,9.07 L3.34,9.56 Z"></path>',
                            'attractions' => '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21,15 16,10 5,21"></polyline>',
                            'tours' => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle>',
                        );

                        foreach (array_slice($product_categories, 0, 4) as $category) :
                            $icon = isset($category_icons[$category->slug]) ? $category_icons[$category->slug] : '<circle cx="12" cy="12" r="10"></circle>';
                            ?>
                            <button class="tab-button" data-category="<?php echo esc_attr($category->slug); ?>">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <?php echo $icon; ?>
                                </svg>
                                <?php echo esc_html($category->name); ?>
                            </button>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Continue Planning Section (if user has wishlist items) -->
    <?php if (is_user_logged_in()) :
        $wishlist = getyourguide_get_user_wishlist();
        if (!empty($wishlist)) : ?>
            <section class="content-section" id="continue-planning">
                <div class="container">
                    <div class="section-header">
                        <h2 class="section-title">Continue planning</h2>
                    </div>
                    <div class="tours-grid" id="wishlist-tours">
                        <?php
                        $wishlist_query = new WP_Query(array(
                            'post_type' => 'product',
                            'posts_per_page' => 4,
                            'post__in' => array_slice($wishlist, 0, 4),
                            'orderby' => 'post__in'
                        ));

                        if ($wishlist_query->have_posts()) :
                            while ($wishlist_query->have_posts()) : $wishlist_query->the_post();
                                global $product;
                                getyourguide_shop_loop_item();
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </section>
        <?php endif;
    endif; ?>

    <!-- Featured Tours Section -->
    <section class="content-section" id="experiences">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Unforgettable cultural experiences</h2>
                <p class="section-subtitle">Discover the world's most amazing tours and activities</p>
            </div>

            <div class="tours-grid">
                <?php
                // Get featured products or recent products if no featured ones
                $featured_query = getyourguide_get_featured_products(8);

                if (!$featured_query->have_posts()) {
                    // Fallback to recent products if no featured products
                    $featured_query = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => 8,
                        'meta_query' => array(
                            array(
                                'key' => '_visibility',
                                'value' => array('catalog', 'visible'),
                                'compare' => 'IN'
                            )
                        ),
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                }

                if ($featured_query->have_posts()) :
                    while ($featured_query->have_posts()) : $featured_query->the_post();
                        global $product;
                        getyourguide_shop_loop_item();
                    endwhile;
                    wp_reset_postdata();
                else : ?>
                    <div class="no-products-message">
                        <h3>No tours available yet</h3>
                        <p>Please add some products in your WordPress admin to see them here.</p>
                        <?php if (current_user_can('manage_woocommerce')) : ?>
                            <a href="<?php echo admin_url('post-new.php?post_type=product'); ?>" class="admin-link">
                                Add Your First Tour
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Product Categories Section -->
    <section class="content-section categories-showcase">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Explore by category</h2>
                <p class="section-subtitle">Find experiences that match your interests</p>
            </div>

            <div class="categories-grid">
                <?php
                if (!is_wp_error($product_categories) && !empty($product_categories)) :
                    foreach (array_slice($product_categories, 0, 6) as $category) :
                        $category_image = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = $category_image ? wp_get_attachment_url($category_image) : 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=600&h=400&fit=crop';

                        // Get product count for category
                        $category_count = $category->count;
                        ?>
                        <div class="category-card">
                            <a href="<?php echo get_term_link($category); ?>">
                                <img src="<?php echo esc_url($image_url); ?>"
                                     alt="<?php echo esc_attr($category->name); ?>" loading="lazy">
                                <div class="category-overlay">
                                    <div class="category-info">
                                        <h3><?php echo esc_html($category->name); ?></h3>
                                        <p><?php echo esc_html($category_count); ?> <?php echo $category_count === 1 ? 'experience' : 'experiences'; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </section>

    <!-- Top Cultural Sights Section -->
    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Top cultural sights you can't miss</h2>
            </div>

            <div class="destinations-grid">
                <?php
                // Get products tagged with specific attractions
                $attraction_products = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'meta_query' => array(
                        array(
                            'key' => '_visibility',
                            'value' => array('catalog', 'visible'),
                            'compare' => 'IN'
                        )
                    ),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field' => 'slug',
                            'terms' => array('attractions', 'culture'),
                        ),
                    ),
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                ));

                $attractions = array(
                    array(
                        'name' => 'Statue of Liberty',
                        'count' => '163 activities',
                        'image' => 'https://images.unsplash.com/photo-1485738422979-f5c462d49f74?w=600&h=400&fit=crop'
                    ),
                    array(
                        'name' => 'Vatican Museums',
                        'count' => '480 activities',
                        'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&h=400&fit=crop'
                    ),
                    array(
                        'name' => 'Eiffel Tower',
                        'count' => '426 activities',
                        'image' => 'https://images.unsplash.com/photo-1471623473093-ac5019caefa9?w=600&h=400&fit=crop'
                    ),
                    array(
                        'name' => 'Metropolitan Museum of Art',
                        'count' => '46 activities',
                        'image' => 'https://images.unsplash.com/photo-1551016595-834406bf4171?w=600&h=400&fit=crop'
                    ),
                );

                foreach ($attractions as $index => $attraction) : ?>
                    <div class="destination-card">
                        <img src="<?php echo esc_url($attraction['image']); ?>"
                             alt="<?php echo esc_attr($attraction['name']); ?>" loading="lazy">
                        <div class="destination-overlay">
                            <div class="destination-info">
                                <h3><?php echo ($index + 1) . '. ' . esc_html($attraction['name']); ?></h3>
                                <p><?php echo esc_html($attraction['count']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    <section class="content-section destinations-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Awe-inspiring destinations around the world</h2>
            </div>

            <div class="destinations-grid">
                <?php
                $destinations = array(
                    array(
                        'name' => 'Washington, DC',
                        'image' => 'https://images.unsplash.com/photo-1571104508999-893933ded431?w=600&h=400&fit=crop',
                        'url' => wc_get_page_permalink('shop') . '?destination=washington-dc'
                    ),
                    array(
                        'name' => 'London',
                        'image' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?w=600&h=400&fit=crop',
                        'url' => wc_get_page_permalink('shop') . '?destination=london'
                    ),
                    array(
                        'name' => 'Paris',
                        'image' => 'https://images.unsplash.com/photo-1539650116574-75c0c6d73c0e?w=600&h=400&fit=crop',
                        'url' => wc_get_page_permalink('shop') . '?destination=paris'
                    ),
                    array(
                        'name' => 'New York City',
                        'image' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=600&h=400&fit=crop',
                        'url' => wc_get_page_permalink('shop') . '?destination=new-york'
                    ),
                    array(
                        'name' => 'Barcelona',
                        'image' => 'https://images.unsplash.com/photo-1567225557594-88d73e55f2cb?w=600&h=400&fit=crop',
                        'url' => wc_get_page_permalink('shop') . '?destination=barcelona'
                    ),
                    array(
                        'name' => 'Tokyo',
                        'image' => 'https://images.unsplash.com/photo-1605108040941-5c8c1c6de5ee?w=600&h=400&fit=crop',
                        'url' => wc_get_page_permalink('shop') . '?destination=tokyo'
                    ),
                );

                foreach ($destinations as $destination) : ?>
                    <div class="destination-card">
                        <a href="<?php echo esc_url($destination['url']); ?>">
                            <img src="<?php echo esc_url($destination['image']); ?>"
                                 alt="<?php echo esc_attr($destination['name']); ?>" loading="lazy">
                            <div class="destination-overlay">
                                <div class="destination-info">
                                    <h3><?php echo esc_html($destination['name']); ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2>Discover the wonder of travel every week</h2>
                    <p>Get inspired with travel recommendations, fun travel deals, local insights, and exclusive deals.</p>
                </div>
                <div class="newsletter-form-wrapper">
                    <form class="newsletter-signup" id="homepage-newsletter">
                        <input type="email" placeholder="Your email address" required>
                        <button type="submit">Sign up</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Additional styles for WooCommerce integration */
.no-products-message {
    text-align: center;
    padding: 4rem 2rem;
    background: #f7fafc;
    border-radius: 12px;
    grid-column: 1 / -1;
}

.no-products-message h3 {
    color: #1a202c;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.no-products-message p {
    color: #4a5568;
    margin-bottom: 2rem;
}

.admin-link {
    display: inline-block;
    background: #3182ce;
    color: white;
    padding: 1rem 2rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.2s ease;
}

.admin-link:hover {
    background: #2c5aa0;
    color: white;
}

.categories-showcase {
    background: #f7fafc;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.category-card {
    position: relative;
    height: 200px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.category-card:hover {
    transform: scale(1.02);
}

.category-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.category-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.7));
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
}

.category-info h3 {
    color: white;
    font-size: 1.25rem;
    margin-bottom: 0.25rem;
}

.category-info p {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.875rem;
    margin: 0;
}

.newsletter-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4rem 0;
}

.newsletter-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.newsletter-text h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: white;
}

.newsletter-text p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.newsletter-signup {
    display: flex;
    gap: 0.5rem;
    max-width: 400px;
}

.newsletter-signup input {
    flex: 1;
    padding: 1rem;
    border: none;
    border-radius: 8px;
    font-size: 16px;
}

.newsletter-signup button {
    background: #ff6b35;
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.newsletter-signup button:hover {
    background: #e55a2b;
}

@media (max-width: 768px) {
    .newsletter-content {
        grid-template-columns: 1fr;
        gap: 2rem;
        text-align: center;
    }

    .newsletter-signup {
        margin: 0 auto;
    }

    .categories-grid,
    .destinations-grid {
        grid-template-columns: 1fr;
    }
}

/* WooCommerce product cards styling */
.tour-card-woocommerce {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid #e2e8f0;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.tour-card-woocommerce:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.tour-card-woocommerce .tour-image {
    position: relative;
    height: 240px;
    overflow: hidden;
}

.tour-card-woocommerce .tour-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.tour-card-woocommerce:hover .tour-image img {
    transform: scale(1.05);
}

.tour-card-woocommerce .tour-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.tour-card-woocommerce .tour-footer {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1rem;
    border-top: 1px solid #f7fafc;
}

.tour-badge {
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

.tour-wishlist {
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

.tour-wishlist:hover {
    background: white;
    transform: scale(1.1);
}

.tour-wishlist.active {
    background: #ff6b35;
    color: white;
}
</style>

<script>
// Homepage specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Category tab filtering
    const categoryTabs = document.querySelectorAll('.tab-button');
    const productCards = document.querySelectorAll('.tour-card-woocommerce');

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;

            // Update active tab
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Filter products
            productCards.forEach(card => {
                const cardCategory = card.querySelector('.tour-category')?.textContent.toLowerCase();

                if (category === 'all' || (cardCategory && cardCategory.includes(category.replace('-', ' ')))) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Newsletter signup
    const newsletterForm = document.getElementById('homepage-newsletter');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;

            // Show success message
            if (typeof GetyourguideTheme !== 'undefined') {
                GetyourguideTheme.showNotification('Thank you for subscribing!', 'success');
            } else {
                alert('Thank you for subscribing!');
            }

            this.querySelector('input[type="email"]').value = '';
        });
    }
});
</script>

<?php get_footer(); ?>
