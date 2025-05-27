/**
 * Enhanced Tour Reviews System
 */
function getyourguide_enhanced_reviews() {
    // Enable reviews for products by default
    add_post_type_support('product', 'comments');

    // Modify review form
    add_filter('comment_form_defaults', 'getyourguide_custom_review_form');

    // Add custom review fields
    add_action('comment_form_logged_in_after', 'getyourguide_add_review_fields');
    add_action('comment_form_after_fields', 'getyourguide_add_review_fields');

    // Save custom review fields
    add_action('comment_post', 'getyourguide_save_review_fields');

    // Display custom review fields
    add_filter('comment_text', 'getyourguide_display_review_fields');

    // Add review verification
    add_action('comment_post', 'getyourguide_verify_purchase_review', 10, 2);
}
add_action('init', 'getyourguide_enhanced_reviews');

function getyourguide_custom_review_form($defaults) {
    if (is_product()) {
        $defaults['title_reply'] = __('Write a Review', 'getyourguide-clone');
        $defaults['comment_notes_before'] = '<p class="review-note">' . __('Share your experience with this tour to help other travelers.', 'getyourguide-clone') . '</p>';
        $defaults['label_submit'] = __('Submit Review', 'getyourguide-clone');
        $defaults['comment_field'] = '<div class="comment-form-comment"><label for="comment">' . __('Your Review', 'getyourguide-clone') . ' <span class="required">*</span></label><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" placeholder="Tell us about your experience..."></textarea></div>';
    }
    return $defaults;
}

function getyourguide_add_review_fields() {
    if (is_product()) {
        ?>
        <div class="review-additional-fields">
            <div class="review-field">
                <label for="review_travel_date"><?php _e('Travel Date', 'getyourguide-clone'); ?></label>
                <input type="date" name="review_travel_date" id="review_travel_date" />
            </div>

            <div class="review-field">
                <label for="review_travel_type"><?php _e('Travel Type', 'getyourguide-clone'); ?></label>
                <select name="review_travel_type" id="review_travel_type">
                    <option value=""><?php _e('Select travel type', 'getyourguide-clone'); ?></option>
                    <option value="solo"><?php _e('Solo traveler', 'getyourguide-clone'); ?></option>
                    <option value="couple"><?php _e('Couple', 'getyourguide-clone'); ?></option>
                    <option value="family"><?php _e('Family with children', 'getyourguide-clone'); ?></option>
                    <option value="friends"><?php _e('Group of friends', 'getyourguide-clone'); ?></option>
                    <option value="business"><?php _e('Business travel', 'getyourguide-clone'); ?></option>
                </select>
            </div>

            <div class="review-field">
                <label for="review_recommend"><?php _e('Would you recommend this tour?', 'getyourguide-clone'); ?></label>
                <div class="review-recommend-options">
                    <label><input type="radio" name="review_recommend" value="yes" /> <?php _e('Yes', 'getyourguide-clone'); ?></label>
                    <label><input type="radio" name="review_recommend" value="no" /> <?php _e('No', 'getyourguide-clone'); ?></label>
                </div>
            </div>
        </div>

        <style>
        .review-additional-fields {
            margin: 1rem 0;
            padding: 1rem;
            background: #f7fafc;
            border-radius: 8px;
        }
        .review-field {
            margin-bottom: 1rem;
        }
        .review-field label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #344053;
        }
        .review-field input,
        .review-field select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }
        .review-recommend-options {
            display: flex;
            gap: 1rem;
        }
        .review-recommend-options label {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: normal;
        }
        </style>
        <?php
    }
}

function getyourguide_save_review_fields($comment_id) {
    if (isset($_POST['review_travel_date'])) {
        add_comment_meta($comment_id, 'travel_date', sanitize_text_field($_POST['review_travel_date']));
    }
    if (isset($_POST['review_travel_type'])) {
        add_comment_meta($comment_id, 'travel_type', sanitize_text_field($_POST['review_travel_type']));
    }
    if (isset($_POST['review_recommend'])) {
        add_comment_meta($comment_id, 'recommend', sanitize_text_field($_POST['review_recommend']));
    }
}

function getyourguide_display_review_fields($comment_text) {
    global $comment;

    if (get_post_type($comment->comment_post_ID) === 'product') {
        $travel_date = get_comment_meta($comment->comment_ID, 'travel_date', true);
        $travel_type = get_comment_meta($comment->comment_ID, 'travel_type', true);
        $recommend = get_comment_meta($comment->comment_ID, 'recommend', true);

        $additional_info = '';

        if ($travel_date || $travel_type || $recommend) {
            $additional_info .= '<div class="review-meta-info">';

            if ($travel_date) {
                $additional_info .= '<span class="review-travel-date"><strong>Traveled:</strong> ' . date('F Y', strtotime($travel_date)) . '</span>';
            }

            if ($travel_type) {
                $travel_types = array(
                    'solo' => 'Solo traveler',
                    'couple' => 'Couple',
                    'family' => 'Family with children',
                    'friends' => 'Group of friends',
                    'business' => 'Business travel'
                );
                $additional_info .= '<span class="review-travel-type"><strong>Travel type:</strong> ' . $travel_types[$travel_type] . '</span>';
            }

            if ($recommend === 'yes') {
                $additional_info .= '<span class="review-recommend recommend-yes">👍 Recommends this tour</span>';
            } elseif ($recommend === 'no') {
                $additional_info .= '<span class="review-recommend recommend-no">👎 Does not recommend this tour</span>';
            }

            $additional_info .= '</div>';

            $additional_info .= '<style>
            .review-meta-info {
                margin: 1rem 0;
                padding: 1rem;
                background: #f7fafc;
                border-radius: 6px;
                font-size: 0.875rem;
            }
            .review-meta-info span {
                display: block;
                margin-bottom: 0.5rem;
            }
            .recommend-yes { color: #10b981; }
            .recommend-no { color: #ef4444; }
            </style>';
        }

        return $comment_text . $additional_info;
    }

    return $comment_text;
}

function getyourguide_verify_purchase_review($comment_id, $comment_approved) {
    $comment = get_comment($comment_id);

    if (get_post_type($comment->comment_post_ID) === 'product') {
        // Check if user has purchased this product
        $user_id = $comment->user_id;
        if ($user_id) {
            $has_purchased = wc_customer_bought_product($comment->comment_email, $user_id, $comment->comment_post_ID);

            if ($has_purchased) {
                add_comment_meta($comment_id, 'verified_purchase', 'yes');
            }
        }
    }
}
