<?php
 /* Template Name: Products by Category */
 get_header();
 ?>
 
 <div class="container">
     <?php
     // Get all product categories
     $product_categories = get_terms(array(
         'taxonomy'   => 'product_cat',
         'orderby'    => 'name',
         'hide_empty' => false, // Set to true to hide categories without products
     ));
 
     if (!empty($product_categories) && !is_wp_error($product_categories)) {
         foreach ($product_categories as $category) {
             // Display category title
             echo '<h2>' . esc_html($category->name) . '</h2>';
 
             // Query products by category
             $args = array(
                 'post_type'      => 'product',
                 'posts_per_page' => 12,
                 'tax_query'      => array(
                     array(
                         'taxonomy' => 'product_cat',
                         'field'    => 'slug',
                         'terms'    => $category->slug,
                     ),
                 ),
             );
 
             $loop = new WP_Query($args);
 
             if ($loop->have_posts()) {
                 echo '<ul class="products">';
                 while ($loop->have_posts()) : $loop->the_post();
                     wc_get_template_part('content', 'product'); // Display each product
                 endwhile;
                 echo '</ul>';
             } else {
                 echo __('No products found in this category');
             }
 
             wp_reset_postdata(); // Reset after each query
         }
     } else {
         echo __('No product categories found');
     }
     ?> 
 </div>
 
 <?php get_footer(); ?>