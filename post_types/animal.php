<?php
define("TRANSLATION_CONST", "TC");

function register_animal_post_type()
{
    $labels = array(
        'name'                  => __('Animals', TRANSLATION_CONST),
        'singular_name'         => __('Animal', TRANSLATION_CONST),
        'add_new'               => __('Add', TRANSLATION_CONST),
        'add_new_item'          => __('Add Animal', TRANSLATION_CONST),
        'edit_item'             => __('Edit Animal', TRANSLATION_CONST),
        'new_item'              => __('Add Animal', TRANSLATION_CONST),
        'view_item'             => __('Show Animal', TRANSLATION_CONST),
        'view_items'             => __('Show Animals', TRANSLATION_CONST),
        'search_items'          => __('Search Animal', TRANSLATION_CONST),
        'not_found'             => __('Not Found', TRANSLATION_CONST),
        'not_found_in_trash'    => __('Not Found in Trash', TRANSLATION_CONST),
        'parent_item_colon'     => __('Animals ...:', TRANSLATION_CONST),
        'all_items'             => __('All Animals', TRANSLATION_CONST),
        'archives'              => __('Animal Archive', TRANSLATION_CONST),
        'attributes'            => __('Animal Attribute', TRANSLATION_CONST),
        'insert_into_item'      => __('Add to Animal', TRANSLATION_CONST),
        'uploaded_to_this_item' => __('Added to Animal', TRANSLATION_CONST),
        'featured_image'        => __('Image', TRANSLATION_CONST),
        'set_featured_image'    => __('Set Image', TRANSLATION_CONST),
        'remove_featured_image' => __('Delete Image', TRANSLATION_CONST),
        'use_featured_image'    => __('Take as Image', TRANSLATION_CONST),
        'menu_name'             => __('Animals', TRANSLATION_CONST),
    );

    $supports = array(
        'title',
        'editor',
        'excerpt',
        //'author',
        'thumbnail',
        //'trackbacks',
        //'custom-fields',
        //'revisions',
        'page-attributes',
        'comments'
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('Animals', TRANSLATION_CONST),
        
        'supports' => $supports,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-card',
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'capability_type' => 'post',
        'rewrite' => true,
        'supports' => array('title', 'editor', 'thumbnail' )
    );

    register_post_type('animal', $args);
   
}
add_action('init', 'register_animal_post_type');

add_action("admin_init", "admin_init");
 

function admin_init()
{
    add_meta_box("animalmeta", "Species", "animalmeta", "animal", "side", "low");
}

function animalmeta() {
	global $post;

	wp_nonce_field( basename( __FILE__ ), 'animal_fields' );

	$species = get_post_meta( $post->ID, 'species', true );

	echo '<input type="text" name="species" value="' . esc_textarea( $species )  . '" class="widefat">';

}

function wpt_save_animal_meta( $post_id, $post ) {

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
    }
    
	if ( ! isset( $_POST['species'] ) || ! wp_verify_nonce( $_POST['animal_fields'], basename(__FILE__) ) ) {
		return $post_id;
	}
	$animal_meta['species'] = esc_textarea( $_POST['species'] );

	foreach ( $animal_meta as $key => $value ) :

		if ( 'revision' === $post->post_type ) {
			return;
		}

		if ( get_post_meta( $post_id, $key, false ) ) {
			update_post_meta( $post_id, $key, $value );
		} else {
			add_post_meta( $post_id, $key, $value);
		}

		if ( ! $value ) {
			delete_post_meta( $post_id, $key );
		}

	endforeach;

}
add_action( 'save_post', 'wpt_save_animal_meta', 1, 2 );

?>