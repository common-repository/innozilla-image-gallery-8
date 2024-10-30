<?php 

    /**
    * Description : Very simple Image Gallery with filter and load more
    * Package : Innozilla Image Gallery 8
    * Version : 1.0
    * Author : Innozilla
    */

function IIG8_sript_enqueue() {  
    $iig8_option = get_option( 'iig8_options' );
    
    wp_register_script( 'isotop_min_iig8', IIG8_PLUGIN_URL . '/js/isotope.pkgd.min.js', array('jquery') );
    wp_register_script( 'imagesloaded-pkgd_iig8', IIG8_PLUGIN_URL . '/js/imagesloaded.pkgd.min.js', array('jquery') );
    wp_register_script( 'filter_js_iig8', IIG8_PLUGIN_URL . '/js/isotope_configure.js', array('jquery') );
    wp_register_script( 'infinite-scroll_ig8', IIG8_PLUGIN_URL . '/js/infinite-scroll.pkgd.min.js', array('jquery') ); 
    wp_register_style( 'front_style_iig8', IIG8_PLUGIN_URL . '/css/front_style.css' );
    if ($iig8_option['lbox'] == '1'):
        wp_register_script( 'lightbox_ig8_js', IIG8_PLUGIN_URL . '/js/lity.js', array('jquery') );
        wp_register_style( 'lightbox_ig8_style', IIG8_PLUGIN_URL . '/css/lity.css' );
    endif;

    wp_localize_script('filter_js_iig8', 'iig8_option', $iig8_option );
}
add_action('wp_enqueue_scripts', 'IIG8_sript_enqueue', 11);


/* Create Gallery Post Type */

function iIIG8_gallery_postype() {
    $labels = array(
        'name'               => _x( 'Gallery', 'post type general name', 'your-plugin-textdomain' ),
        'singular_name'      => _x( 'Gallery', 'post type singular name', 'your-plugin-textdomain' ),
        'menu_name'          => _x( 'IIG8 Gallery', 'admin menu', 'your-plugin-textdomain' ),
        'name_admin_bar'     => _x( 'IIG8 Gallery', 'add new on admin bar', 'your-plugin-textdomain' ),
        'add_new'            => _x( 'Add New', 'Gallery', 'your-plugin-textdomain' ),
        'add_new_item'       => __( 'Add New Gallery', 'your-plugin-textdomain' ),
        'new_item'           => __( 'New Gallery', 'your-plugin-textdomain' ),
        'edit_item'          => __( 'Edit Gallery', 'your-plugin-textdomain' ),
        'view_item'          => __( 'View Gallery', 'your-plugin-textdomain' ),
        'all_items'          => __( 'All Gallery', 'your-plugin-textdomain' ),
        'search_items'       => __( 'Search Gallery', 'your-plugin-textdomain' ),
        'parent_item_colon'  => __( 'Parent Gallery:', 'your-plugin-textdomain' ),
        'not_found'          => __( 'No Gallery found.', 'your-plugin-textdomain' ),
        'not_found_in_trash' => __( 'No Gallery found in Trash.', 'your-plugin-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'your-plugin-textdomain' ),
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'cs-gallery' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'           => 'dashicons-images-alt2',       
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );

    register_post_type( 'cs_gallery', $args );


}
add_action( 'init', 'iIIG8_gallery_postype' );

/* Text Convert to slug */

function  IIG8_createSlug($str, $delimiter = '-'){

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

} 