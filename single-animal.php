<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class() ?> id="animal-<?php the_ID(); ?>">
        <div class="row column" id="animal-header">
            <h1 class="entry-title"><?php the_title(); ?></h1>
        </div>
        <div class="main-wrap" role="main">
            <div class="entry-content">
                <div class="row">
                    <div class="medium-6 columns">
                        <?php if (has_post_thumbnail()) : ?>
                            <img class="animal-detail-image" src="<?php the_post_thumbnail_url('full'); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row columns">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer();
