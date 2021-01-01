<?php 
get_header();
?>
<div class="main-wrap" role="main">
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
        if(has_post_thumbnail( )){         
            the_post_thumbnail('full' );
        }
       
    endwhile;

    ?>
 </section>

</div>
<?php get_footer() ?>