<?php get_header(); ?>
 
 <main>
     <?php
     if ( have_posts() ) :
         while ( have_posts() ) : the_post();
             get_template_part( 'template-parts/content', get_post_format() );
         endwhile;
 
         the_posts_navigation();
 
     else :
         get_template_part( 'template-parts/content', 'none' );
     endif;
     ?>
 </main>




 

 
  <!-- <div class="products-grid">
     <?php
     // Custom query to get products
     $args = array(
         'post_type' => 'product',
         'posts_per_page' => 12, // Number of products to display
         'paged' => ( get_query_var('paged') ) ? get_query_var('paged') : 1,
     );
 
     $loop = new WP_Query($args);
 
     if ($loop->have_posts()) {
         echo '<div class="products-grid-container">';
         while ($loop->have_posts()) : $loop->the_post();
             wc_get_template_part('content', 'product');
         endwhile;
         echo '</div>';
 
         // Pagination
         echo paginate_links(array(
             'total' => $loop->max_num_pages,
         ));
     } else {
         echo __('No products found');
     }
 
     wp_reset_postdata();
     ?>
 </div>  -->
 <?php 
 get_footer();
?>



 
 
 
