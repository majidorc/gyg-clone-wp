<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="container-wide">
            <div class="header-content">
                <!-- Logo -->
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                            <svg width="120" height="32" viewBox="0 0 120 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0" y="0" width="32" height="32" rx="6" fill="#ff6b35"/>
                                <path d="M8 12h16M8 16h16M8 20h12" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                <text x="40" y="20" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="#ff6b35">GetYourGuide</text>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Main Navigation -->
                <nav id="site-navigation" class="main-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="nav-menu">
                                    <li><a href="' . esc_url(home_url('/')) . '">Home</a></li>
                                    <li><a href="' . esc_url(home_url('/tours/')) . '">Tours</a></li>
                                    <li><a href="' . esc_url(home_url('/destinations/')) . '">Destinations</a></li>
                                    <li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>
                                  </ul>';
                        }
                    ));
                    ?>
                </nav>

                <!-- Search Form -->
                <div class="header-search">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search"
                               class="search-input"
                               placeholder="Find places and things to do"
                               value="<?php echo get_search_query(); ?>"
                               name="s"
                               autocomplete="off"
                               id="search-field">
                        <input type="hidden" name="post_type" value="tour">
                        <button type="submit" class="search-button">Search</button>
                    </form>

                    <!-- Search Results Dropdown -->
                    <div id="search-results" class="search-results-dropdown" style="display: none;">
                        <!-- Search results will be populated here via AJAX -->
                    </div>
                </div>

                <!-- User Actions -->
                <div class="user-actions">
                    <?php if (is_user_logged_in()) : ?>
                        <div class="user-menu">
                            <button class="user-action-btn" id="user-menu-toggle">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <?php echo esc_html(wp_get_current_user()->display_name); ?>
                            </button>

                            <div class="user-dropdown" id="user-dropdown" style="display: none;">
                                <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">My Account</a>
                                <a href="<?php echo esc_url(home_url('/wishlist/')); ?>">Wishlist</a>
                                <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">Logout</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="user-action-btn">Sign in</a>
                        <a href="<?php echo esc_url(wp_registration_url()); ?>" class="user-action-btn primary">Sign up</a>
                    <?php endif; ?>

                    <!-- Wishlist -->
                    <a href="<?php echo esc_url(home_url('/wishlist/')); ?>" class="user-action-btn wishlist-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20.84,4.61a5.5,5.5 0 0,0 -7.78,0L12,5.67L10.94,4.61a5.5,5.5 0 0,0 -7.78,7.78l1.06,1.06L12,21.23l7.78,-7.78l1.06,-1.06a5.5,5.5 0 0,0 0,-7.78z"></path>
                        </svg>
                        <span class="wishlist-text">Wishlist</span>
                        <span class="wishlist-count" id="wishlist-count">0</span>
                    </a>

                    <!-- Cart (if WooCommerce is active) -->
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="user-action-btn cart-btn">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="8" cy="21" r="1"></circle>
                                <circle cx="19" cy="21" r="1"></circle>
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path>
                            </svg>
                            <span class="cart-text">Cart</span>
                            <?php if (WC()->cart && WC()->cart->get_cart_contents_count() > 0) : ?>
                                <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle mobile menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="mobile-navigation" id="mobile-navigation" style="display: none;">
            <div class="mobile-nav-content">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'mobile-nav-menu',
                    'fallback_cb'    => function() {
                        echo '<ul class="mobile-nav-menu">
                                <li><a href="' . esc_url(home_url('/')) . '">Home</a></li>
                                <li><a href="' . esc_url(home_url('/tours/')) . '">Tours</a></li>
                                <li><a href="' . esc_url(home_url('/destinations/')) . '">Destinations</a></li>
                                <li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>
                              </ul>';
                    }
                ));
                ?>

                <div class="mobile-nav-actions">
                    <?php if (!is_user_logged_in()) : ?>
                        <a href="<?php echo esc_url(wp_login_url(get_permalink())); ?>" class="mobile-nav-btn">Sign in</a>
                        <a href="<?php echo esc_url(wp_registration_url()); ?>" class="mobile-nav-btn primary">Sign up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <style>
    /* Additional Header Styles */
    .search-results-dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
    }

    .search-result-item {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #f7fafc;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .search-result-item:hover {
        background-color: #f7fafc;
    }

    .search-result-image {
        width: 50px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 12px;
    }

    .search-result-content {
        flex: 1;
    }

    .search-result-title {
        font-weight: 500;
        color: #1a202c;
        font-size: 14px;
        margin-bottom: 2px;
    }

    .search-result-meta {
        font-size: 12px;
        color: #718096;
    }

    .user-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        min-width: 150px;
        padding: 8px 0;
    }

    .user-dropdown a {
        display: block;
        padding: 8px 16px;
        color: #344053;
        font-size: 14px;
        transition: background-color 0.2s ease;
    }

    .user-dropdown a:hover {
        background-color: #f7fafc;
    }

    .mobile-menu-toggle {
        display: none;
        flex-direction: column;
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
    }

    .mobile-menu-toggle span {
        display: block;
        width: 20px;
        height: 2px;
        background: #344053;
        margin: 2px 0;
        transition: all 0.3s ease;
    }

    .mobile-navigation {
        background: white;
        border-top: 1px solid #e2e8f0;
        padding: 1rem 0;
    }

    .mobile-nav-menu {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .mobile-nav-menu li {
        border-bottom: 1px solid #f7fafc;
    }

    .mobile-nav-menu a {
        display: block;
        padding: 12px 20px;
        color: #344053;
        font-weight: 500;
    }

    .mobile-nav-actions {
        padding: 20px;
        display: flex;
        gap: 10px;
    }

    .mobile-nav-btn {
        flex: 1;
        text-align: center;
        padding: 12px;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        color: #344053;
        font-weight: 500;
    }

    .mobile-nav-btn.primary {
        background: #3182ce;
        color: white;
        border-color: #3182ce;
    }

    .wishlist-count,
    .cart-count {
        background: #ff6b35;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 11px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-left: 4px;
    }

    @media (max-width: 768px) {
        .main-navigation,
        .header-search {
            display: none;
        }

        .mobile-menu-toggle {
            display: flex;
        }

        .user-actions {
            gap: 0.5rem;
        }

        .user-action-btn .wishlist-text,
        .user-action-btn .cart-text {
            display: none;
        }

        .header-content {
            flex-wrap: nowrap;
        }
    }
    </style>
