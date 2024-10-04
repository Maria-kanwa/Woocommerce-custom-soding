<?php
get_header();

?>


<?php
/**
 * Checkout Page Template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/checkout.php.
 *
 * @package WooCommerce/Templates
 * @version 7.0.0
 */

defined( 'ABSPATH' ) || exit;

// Display custom message or action before the checkout form
do_action( 'woocommerce_before_checkout_form' );

// Check if user is logged in
if ( ! is_user_logged_in() && ! wc_get_page_id( 'myaccount' ) ) {
    wc_get_template( 'global/notice.php', array( 'notice' => __( 'You must be logged in to checkout.' ) ) );
    return;
}

// Check if cart is empty
if ( WC()->cart->is_empty() ) {
    wc_get_template( 'global/notice.php', array( 'notice' => __( 'Your cart is empty.' ) ) );
    return;
}
?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

    <?php
    // Display notices
    wc_print_notices();

    // Output the checkout form
    do_action( 'woocommerce_checkout_before_customer_details' );
    ?>

    <div id="customer_details">
        <?php
        // Billing and shipping details
        do_action( 'woocommerce_checkout_billing' );
        do_action( 'woocommerce_checkout_shipping' );
        ?>
    </div>

    <?php
    // Additional details after customer details
    do_action( 'woocommerce_checkout_after_customer_details' );
    ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
        <?php
        // Order review and payment
        do_action( 'woocommerce_checkout_order_review' );
        ?>
    </div>

    <?php wp_nonce_field( 'woocommerce-checkout', 'woocommerce-checkout-nonce' ); ?>

</form>

<?php
// Additional content after the checkout form
do_action( 'woocommerce_after_checkout_form' );
?>
<?php 
get_footer();
?>