# GetYourGuide WordPress Theme

A modern, responsive WordPress theme inspired by GetYourGuide.com, perfect for travel agencies, tour operators, and experience booking websites.

## Features

### 🎨 Design
- **Pixel-perfect recreation** of GetYourGuide's design
- **Responsive layout** that works on all devices
- **Modern UI components** with smooth animations
- **Professional color scheme** matching GetYourGuide brand

### 🏗️ Structure
- **Custom Post Type**: Tours & Experiences
- **Custom Taxonomies**: Tour Categories, Destinations
- **Custom Fields**: Price, Duration, Rating, Reviews, etc.
- **Template Hierarchy**: Homepage, Single Tour, Archive, Search

### 🔍 Search & Filtering
- **AJAX-powered search** with autocomplete
- **Advanced filtering** by category, price, rating
- **Sort options**: Popularity, Rating, Price, Duration
- **Pagination** for large result sets

### 💝 User Features
- **Wishlist functionality** (localStorage based)
- **User accounts** integration
- **Mobile-responsive** navigation
- **Newsletter signup** modal

### 🛒 Booking System Ready
- **WooCommerce compatible** structure
- **Booking forms** with date/participant selection
- **Price display** and availability checking
- **Review system** integration ready

## Installation

1. **Download** the theme files
2. **Upload** to your WordPress `/wp-content/themes/` directory
3. **Activate** the theme in WordPress Admin → Appearance → Themes
4. **Install required plugins** (see Dependencies section)

## Dependencies

### Required Plugins
- **Advanced Custom Fields (ACF)** - For tour meta fields (optional, built-in fallback included)
- **WooCommerce** - For booking functionality (optional)

### Recommended Plugins
- **Yoast SEO** - For search engine optimization
- **Contact Form 7** - For contact forms
- **UpdraftPlus** - For backups

## Setup Guide

### 1. Initial Setup
1. Go to **WordPress Admin → Tours → Add New**
2. Create your first tour with:
   - Title and description
   - Featured image
   - Tour details (price, duration, rating)
   - Categories and destinations

### 2. Configure Menus
1. Go to **Appearance → Menus**
2. Create a menu and assign to "Primary Menu"
3. Add pages: Home, Tours, Destinations, About, Contact

### 3. Customize Theme
1. Go to **Appearance → Customize**
2. Set your logo and site identity
3. Configure hero section text
4. Set up widgets in footer areas

### 4. Create Essential Pages
- **Tours Archive**: Automatically created at `/tours/`
- **Wishlist Page**: Create manually for wishlist functionality
- **About Page**: Company information
- **Contact Page**: Contact details and form

## Tour Management

### Adding Tours
1. **WordPress Admin → Tours → Add New**
2. Fill in tour details:
   - **Title**: Tour name
   - **Description**: Full tour description
   - **Featured Image**: Main tour image
   - **Price**: Tour price in USD
   - **Duration**: e.g., "3 hours", "Full day"
   - **Rating**: 1-5 scale
   - **Reviews Count**: Number of reviews
   - **Highlights**: Key tour highlights (one per line)
   - **Included/Not Included**: What's covered

### Tour Categories
- Go to **Tours → Tour Categories**
- Create categories like: Culture, Food, Nature, Adventure
- Assign tours to appropriate categories

### Destinations
- Go to **Tours → Destinations**
- Create destinations like: Paris, London, New York
- Assign tours to destinations

## Customization

### Colors
The theme uses GetYourGuide's color palette:
- **Primary**: `#ff6b35` (Orange)
- **Secondary**: `#3182ce` (Blue)
- **Text**: `#344053` (Dark gray)
- **Background**: `#ffffff` (White)

### Fonts
- **Primary Font**: System fonts (performance optimized)
- **Fallback**: Inter font from Google Fonts

### Custom CSS
Add custom styles in **Appearance → Customize → Additional CSS**

```css
/* Example: Change primary color */
.hero-section {
    background: linear-gradient(135deg, #your-color, #another-color);
}
```

## File Structure

```
getyourguide-wp-theme/
├── style.css              # Main stylesheet with theme info
├── functions.php          # Theme functionality
├── index.php             # Homepage template
├── header.php            # Header template
├── footer.php            # Footer template
├── single-tour.php       # Single tour page
├── archive-tour.php      # Tours listing page
├── js/
│   └── main.js          # JavaScript functionality
└── README.md            # This file
```

## JavaScript Features

The theme includes advanced JavaScript functionality:

- **Mobile menu** with smooth animations
- **Search autocomplete** with keyboard navigation
- **Wishlist system** using localStorage
- **Category filtering** with smooth transitions
- **Modal system** for newsletters
- **Smooth scrolling** for anchor links
- **Lazy loading** for images
- **Notification system** for user feedback

## Hooks and Filters

### Available Filters
```php
// Modify featured tours query
add_filter('getyourguide_featured_tours_args', 'my_featured_tours');

// Customize search results
add_filter('getyourguide_search_results', 'my_search_results');
```

### Available Actions
```php
// Add content after tour details
add_action('getyourguide_after_tour_content', 'my_tour_content');

// Modify booking form
add_action('getyourguide_booking_form', 'my_booking_form');
```

## Browser Support

- **Chrome** 70+
- **Firefox** 65+
- **Safari** 12+
- **Edge** 79+
- **Internet Explorer** 11+ (basic support)

## Performance

The theme is optimized for performance:
- **Minimal HTTP requests**
- **Optimized images** with lazy loading
- **Efficient CSS** with critical path optimization
- **JavaScript** loaded only when needed
- **Cache-friendly** structure

## SEO Features

- **Schema markup** for tours and reviews
- **Meta tags** optimization
- **Clean URLs** for tours and categories
- **Sitemap** compatibility
- **Social media** meta tags

## Accessibility

- **WCAG 2.1** Level AA compliance
- **Keyboard navigation** support
- **Screen reader** friendly
- **High contrast** mode support
- **Focus indicators** for all interactive elements

## Troubleshooting

### Common Issues

**Tours not displaying?**
- Check if tours are published
- Verify tour category assignments
- Clear cache if using caching plugins

**Search not working?**
- Ensure JavaScript is enabled
- Check browser console for errors
- Verify AJAX endpoints are accessible

**Mobile menu not opening?**
- Check for JavaScript conflicts
- Disable other plugins temporarily
- Clear browser cache

### Debug Mode
Add this to your wp-config.php for debugging:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Contributing

If you find bugs or want to contribute:
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Submit a pull request

## License

This theme is licensed under GPL v2 or later.

## Support

For support and questions:
- Check the documentation above
- Review common issues in troubleshooting
- Test with default WordPress themes to isolate issues

## Changelog

### Version 1.0
- Initial release
- Complete GetYourGuide design recreation
- Full tour management system
- Mobile responsive design
- Advanced search and filtering
- Wishlist functionality
- WooCommerce compatibility

---

**Built with ❤️ for WordPress**
