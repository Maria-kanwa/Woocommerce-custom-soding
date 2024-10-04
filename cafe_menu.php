<?php
get_header();

if (have_posts()) :
    ?>
    <div class="cafe-menu-archive">
        <h1>Café Menu</h1>
        <div class="cafe-menu-grid">
            <?php
            while (have_posts()) : the_post(); ?>
                <div class="cafe-menu-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="cafe-menu-image">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="cafe-menu-info">
                            <h2><?php the_title(); ?></h2>
                            <p><?php the_excerpt(); ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php
else :
    echo '<p>No café menu items found.</p>';
endif;

get_footer();
