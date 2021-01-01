<?php
get_header(); ?>

    <div class="main-wrap" role="main">
 
        <section id="animal-listing">
            <?php if ( have_posts() ) : ?>
                <div class="row">
                <?php while ( have_posts() ) : the_post(); ?>
                    <div class="column"">
	       <?php get_template_part( 'template-parts/animal-content', get_post_format() ); ?>
	    </div>
                <? endwhile; ?>
                </div>
            <?php endif; ?>
        </section>

    </div>

<?php get_footer();