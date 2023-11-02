<?php
// Register Custom Post Type New
// Post Type Key: New
function create_new_cpt() {

    $labels = array(
        'name' => _x( 'News', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'New', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => _x( 'News', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar' => _x( 'New', 'Add New on Toolbar', 'textdomain' ),
        'archives' => __( 'New', 'textdomain' ),
        'attributes' => __( 'New', 'textdomain' ),
        'parent_item_colon' => __( 'New', 'textdomain' ),
        'all_items' => __( 'All News', 'textdomain' ),
        'add_new_item' => __( 'Add New New', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New New', 'textdomain' ),
        'edit_item' => __( 'Edit New', 'textdomain' ),
        'update_item' => __( 'Update New', 'textdomain' ),
        'view_item' => __( 'View New', 'textdomain' ),
        'view_items' => __( 'View News', 'textdomain' ),
        'search_items' => __( 'Search New', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
        'featured_image' => __( 'Featured Image', 'textdomain' ),
        'set_featured_image' => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item' => __( 'Insert into New', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this New', 'textdomain' ),
        'items_list' => __( 'News list', 'textdomain' ),
        'items_list_navigation' => __( 'News list navigation', 'textdomain' ),
        'filter_items_list' => __( 'Filter News list', 'textdomain' ),
    );

    $rewrite = array(
        'slug' => 'news',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'label' => __( 'New', 'textdomain' ),
        'description' => __( 'description', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'comments', 'trackbacks', 'page-attributes', 'post-formats', 'custom-fields'),
        'taxonomies' => array(),
        'hierarchical' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'has_archive' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'show_in_nav_menus' => true,
        'menu_position' => 5,
        'capability_type' => 'post',
        'show_in_rest' => true,
        'rewrite' => $rewrite,
    );

    register_post_type( 'go2hr_news', $args );

}
add_action( 'init', 'create_new_cpt', 0 );



// Register Taxonomy News Region
// Taxonomy Key: news_region
function create_news_region_tax() {
	$labels = array(
		'name'              => _x( 'News Regions', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'News Region', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search News Regions', 'textdomain' ),
		'all_items'         => __( 'All News Regions', 'textdomain' ),
		'parent_item'       => __( 'Parent News Region', 'textdomain' ),
		'parent_item_colon' => __( 'Parent News Region:', 'textdomain' ),
		'edit_item'         => __( 'Edit News Region', 'textdomain' ),
		'update_item'       => __( 'Update News Region', 'textdomain' ),
		'add_new_item'      => __( 'Add New News Region', 'textdomain' ),
		'new_item_name'     => __( 'New News Region Name', 'textdomain' ),
		'menu_name'         => __( 'News Region', 'textdomain' ),
	);

	$args = array(
		'labels' => $labels,
		'description' => __( '', 'textdomain' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
		'show_in_rest' => true,
	);
	register_taxonomy( 'news_region', array('go2hr_news'), $args );

}
add_action( 'init', 'create_news_region_tax' );

/** News */
acf_add_options_page(array(
    'page_title'	=> 'News Settings',
    'menu_title'	=> 'News Settings',
    'menu_slug' 	=> 'News Settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false,
    'parent_slug'    => 'edit.php?post_type=go2hr_news',
));
