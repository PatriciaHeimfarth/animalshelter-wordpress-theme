<?php
get_header();
?>
<div class="main-wrap" role="main">
    <section id="animal-listing">
        <?php $args = array(
            'post_type' => 'animal',
            'post_status' => 'publish',
            'posts_per_page' => 800,
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_key' => 'species',
            'meta_value' => 'cat'

        );

        $loop = new WP_Query($args);

        while ($loop->have_posts()) : $loop->the_post();
            if (has_post_thumbnail()) {     ?>
                <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
        <?php
            }

        endwhile;

        ?>
    </section>

</div>
<?php get_footer() ?>