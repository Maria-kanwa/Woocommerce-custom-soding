<?php
/* Template Name: Custom Cart Page */
get_header(); ?>

<div class="container">
    <h1>Your Cart</h1>
    <?php
    if (class_exists('WooCommerce')) {
        echo do_shortcode('[woocommerce_cart]');
    } else {
        echo '<p>WooCommerce is not active.</p>';
    }
    ?>
</div>

<?php get_footer(); ?>
