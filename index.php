<?php
/* Main Template File */
get_header();

?>

<div class="row">
    <div class="side">
        <h1><?php echo get_the_title() ?></h1>
    </div>

    <main class="main-content">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                the_content();

            endwhile;
        endif;
        ?>

    </main>
</div>

<?php get_footer(); ?>