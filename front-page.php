<?php
 get_header();
 ?>

<h1>Cafe Menu</h1>

<?php
// Fetch products in category ID 15
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1, // Adjust the number to control how many products to show
    'tax_query'      => array(
        array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => 15, // Only include products in category with ID 15
            'operator' => 'IN',
        ),
    ),
);

$categorized_products = new WP_Query( $args );

if ( $categorized_products->have_posts() ) : ?>
    <div class="categorized-products-grid">
        <?php while ( $categorized_products->have_posts() ) : $categorized_products->the_post(); 
            $product = wc_get_product(get_the_ID()); // Get the WC_Product object
        ?>
            <div class="product-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail( 'woocommerce_thumbnail' ); ?>
                    <?php endif; ?>
                    <h2><?php the_title(); ?></h2>
                    <span class="price"><?php echo $product->get_price_html(); ?></span>
                </a>
                <?php 
                // Display the "Add to Cart" button
                echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" class="button add_to_cart_button">' . esc_html( $product->add_to_cart_text() ) . '</a>';
                ?>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
<?php endif; ?>


</div>

<?php
get_footer( 'shop' );
