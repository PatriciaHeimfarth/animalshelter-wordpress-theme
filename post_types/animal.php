<?php
define("TRANSLATION_CONST", "TC");
add_action( 'init', 'register_animal_post_type' );
function register_animal_post_type() {
     $labels = array(
        'name'                  => __( 'Animals', TRANSLATION_CONST ),
        'singular_name'         => __( 'Animal', TRANSLATION_CONST ),
        'add_new'               => __( 'Add', TRANSLATION_CONST ),
        'add_new_item'          => __( 'Add Animal', TRANSLATION_CONST ),
        'edit_item'             => __( 'Edit Animal', TRANSLATION_CONST ),
        'new_item'              => __( 'Add Animal', TRANSLATION_CONST ),
        'view_item'             => __( 'Show Animal', TRANSLATION_CONST ),
        'view_items'             => __( 'Show Animals', TRANSLATION_CONST ),
        'search_items'          => __( 'Search Animal', TRANSLATION_CONST ),
        'not_found'             => __( 'Not Found', TRANSLATION_CONST ),
        'not_found_in_trash'    => __( 'Not Found in Trash', TRANSLATION_CONST ),
        'parent_item_colon'     => __( 'Animals ...:', TRANSLATION_CONST ),
        'all_items'             => __( 'All Animals:', TRANSLATION_CONST ),
        'archives'              => __( 'Animal Archive:', TRANSLATION_CONST ),
        'attributes'            => __( 'Animal Attribute:', TRANSLATION_CONST ),
        'insert_into_item'      => __( 'Add to Animal', TRANSLATION_CONST ),
        'uploaded_to_this_item' => __( 'Added to Animal', TRANSLATION_CONST ),
        'featured_image'        => __( 'Image', TRANSLATION_CONST ),
        'set_featured_image'    => __( 'Set Image', TRANSLATION_CONST ),
        'remove_featured_image' => __( 'Delete Image', TRANSLATION_CONST ),
        'use_featured_image'    => __( 'Take as Image', TRANSLATION_CONST ),
        'menu_name'             => __( 'Animals', TRANSLATION_CONST ),
    );
 
    $supports = array(
        'title',
        'editor',  
        'excerpt',  
        'author',
        'thumbnail', 
        //'trackbacks',
        'custom-fields',
        //'revisions',
        'page-attributes',
        'comments'
    );
 
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __( 'Animals', TRANSLATION_CONST ),
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
        'capability_type' => 'post'
    );
 
    register_post_type( 'animal', $args );
}
add_action( 'init', 'register_animal_post_type' );


function add_custom_animal_meta_box($meta_box_id, $meta_box_title) {
    $plugin_prefix = 'animal_post_type_';
 
    $html_id_attribute = $plugin_prefix . $meta_box_id . '_meta_box';
    $php_callback_function = $plugin_prefix . 'build_' . $meta_box_id . '_meta_box';
    $show_me_on_post_type = 'animal';
    $box_placement = 'side';
    $box_priority = 'low';
 
    add_meta_box(
        $html_id_attribute,
        $meta_box_title,
        $php_callback_function,
        $show_me_on_post_type,
        $box_placement,
        $box_priority
    );

    function animal_post_type_add_meta_boxes( $post ){
        add_custom_animal_meta_box('price', __( 'Preis', TRANSLATION_CONST ));
         
    }
    add_action( 'add_meta_boxes_animal', 'animal_post_type_add_meta_boxes' );
}

function animal_post_type_build_price_meta_box($post) {
    wp_nonce_field( basename( __FILE__ ), 'animal_post_type_price_meta_box_nonce' );
 
    $current_price = get_post_meta( $post->ID, 'animal_price', true );
    ?>
    <div class="inside">
        <section id="price-meta-box-container">
            <p>
                <input type="number" name="animal_price" id="animal-price"<?php echo ' value="'.$current_price.'"'; ?>>
            </p>
        </section>
    </div>
    <?php
}
function animal_post_type_save_price_meta_boxes_data( $post_id ){
    if ( !isset( $_POST['animal_post_type_price_meta_box_nonce'] ) ||
            !wp_verify_nonce(
                $_POST['animal_post_type_price_meta_box_nonce'],
                basename( __FILE__ )
            ) ){
        return;
    }
 
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
        return;
 
    if ( !current_user_can( 'edit_post', $post_id ) )
        return;
 
    if ( isset( $_REQUEST['animalprice'] ) ) {
        update_post_meta(
            $post_id,
            'animal_price',
            sanitize_text_field( $_POST['animal_price'] )
        );
    }
}
add_action( 'save_post_animal', 'animal_post_type_save_price_meta_boxes_data', 10, 2 );

function the_animal_price($post = 0, $echo = true) {
    $post = get_post( $post );
 
    $id = isset( $post->ID ) ? $post->ID : 0;
    $value = get_post_meta( $id, 'animal_price', true );
 
    if($echo) {
        echo sprintf(
            '<span class="animal-detail--price">%s %s</span>',
            esc_html($value),
            __('€', TRANSLATION_CONST)
        );
    }
    else
        return $value;
}
?>