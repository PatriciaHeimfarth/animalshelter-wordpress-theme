<?php 
get_header();
?>
<div class="main-wrap" role="main">
 <h1>Cats Heading</h1>
 <section id="animal-listing">
     <?php  $args = array(  
        'post_type' => 'animal',
        'post_status' => 'publish',
        'posts_per_page' => 8, 
        'orderby' => 'title', 
        'order' => 'ASC', 
    );

    $loop = new WP_Query( $args ); 
        
    while ( $loop->have_posts() ) : $loop->the_post(); 
        print the_title(); 
        the_excerpt(); 
    endwhile;

    wp_reset_postdata(); ?>
 </section>

</div>
<?php get_footer() ?>