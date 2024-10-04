<?php

 function mytheme_scripts() {
     // Enqueue styles
     wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );

     wp_enqueue_style('custom-shop-page-style', get_template_directory_uri() . '/css/custom-shop-page.css');
    
 
     // Enqueue scripts
     wp_enqueue_script( 'mytheme-script', get_template_directory_uri() . '/js/script.js', array(), null, true );
 }
 add_action( 'wp_enqueue_scripts', 'mytheme_scripts' );




 function myproject_features(){
    register_nav_menus(array(
'primary'=>'Main menu',
'secondary'=>'footer menu',
'useful'=>'useful links',

    ));
    add_theme_support('custom-logo');// logo registration
    add_theme_support('post-thumbnails');// feature image or thumbnail registration
   
}
add_action('after_setup_theme','myproject_features') ;




// Add a custom shortcode for user registration form
function custom_user_registration_form() {
    if ( is_user_logged_in() ) {
        return '<p>You are already logged in.</p>';
    }

    ob_start();
    ?>
    <form id="custom-registration-form" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">
        <label for="reg_email">Email:</label>
        <input type="email" name="reg_email" id="reg_email" required>
        <label for="reg_password">Password:</label>
        <input type="password" name="reg_password" id="reg_password" required>
        <input type="hidden" name="action" value="custom_register_user">
        <input type="submit" value="Register">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_registration_form', 'custom_user_registration_form');

// Handle user registration via AJAX
function custom_register_user() {
    if ( ! isset( $_POST['reg_email'] ) || ! isset( $_POST['reg_password'] ) ) {
        wp_send_json_error( 'Missing fields' );
    }

    $email = sanitize_email( $_POST['reg_email'] );
    $password = sanitize_text_field( $_POST['reg_password'] );

    $user_id = wp_create_user( $email, $password, $email );
    if ( is_wp_error( $user_id ) ) {
        wp_send_json_error( $user_id->get_error_message() );
    }

    wp_send_json_success( 'Registration successful' );
}
add_action('wp_ajax_custom_register_user', 'custom_register_user');
add_action('wp_ajax_nopriv_custom_register_user', 'custom_register_user');

// Add a custom shortcode for user login form
function custom_user_login_form() {
    if ( is_user_logged_in() ) {
        return '<p>You are already logged in.</p>';
    }

    ob_start();
    ?>
    <form id="custom-login-form" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">
        <label for="login_email">Email:</label>
        <input type="email" name="login_email" id="login_email" required>
        <label for="login_password">Password:</label>
        <input type="password" name="login_password" id="login_password" required>
        <input type="hidden" name="action" value="custom_login_user">
        <input type="submit" value="Login">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_login_form', 'custom_user_login_form');

// Handle user login via AJAX
function custom_login_user() {
    if ( ! isset( $_POST['login_email'] ) || ! isset( $_POST['login_password'] ) ) {
        wp_send_json_error( 'Missing fields' );
    }

    $email = sanitize_email( $_POST['login_email'] );
    $password = sanitize_text_field( $_POST['login_password'] );

    $creds = array(
        'user_login'    => $email,
        'user_password' => $password,
        'remember'=> true
    );
    
    $user = wp_signon( $creds, false );
    if ( is_wp_error( $user ) ) {
        wp_send_json_error( $user->get_error_message() );
    }
    
    wp_send_json_success( 'Login successful' );
    add_action('wp_ajax_custom_login_user', 'custom_login_user'); 
    add_action('wp_ajax_nopriv_custom_login_user', 'custom_login_user');
}

add_filter('woocommerce_add_to_cart_redirect', 'custom_redirect_after_add_to_cart');
function custom_redirect_after_add_to_cart($url) {
    // Change the URL to your checkout page URL
    $checkout_url = wc_get_checkout_url();
    return $checkout_url;
}




// Add a custom message to the My Account page
add_action( 'woocommerce_before_my_account', 'custom_my_account_message' );
function custom_my_account_message() {
    echo '<p>Thank you for being a valued customer!</p>';
}

// Add a custom section to the My Account page
add_action( 'woocommerce_account_dashboard', 'custom_my_account_section' );
function custom_my_account_section() {
    echo '<h2>Custom Section</h2>';
    echo '<p>This is a custom section added to the My Account dashboard.</p>';
}





    



 