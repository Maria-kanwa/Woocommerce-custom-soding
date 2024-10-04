<?php
/**
 * Template Name: Custom My Account Page
 *
 * This template will display the WooCommerce My Account content.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Ensure WooCommerce is active
        if ( class_exists( 'WooCommerce' ) ) {
            // Display the My Account content
            echo '<h1>' . esc_html( 'My Account' ) . '</h1>';
            
            // Display WooCommerce My Account shortcode
            echo do_shortcode( '[woocommerce_my_account]' );

            // Custom content or additional functionality
            echo '<div class="custom-content">';
            echo '<p>Welcome to your custom My Account page!</p>';
            echo '</div>';
        } else {
            echo '<p>WooCommerce is not active.</p>';
        }
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
