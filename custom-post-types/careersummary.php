<?php 

// Register Custom Post Type Career Summary
// Post Type Key: Career Summary
function create_career_summary_cpt() {

    $labels = array(
        'name' => _x( 'Career Summaries', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Career Summary', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => _x( 'Career Summaries', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar' => _x( 'Career Summary', 'Add New on Toolbar', 'textdomain' ),
        'archives' => __( 'Career Summary', 'textdomain' ),
        'attributes' => __( 'Career Summary', 'textdomain' ),
        'parent_item_colon' => __( 'Career Summary', 'textdomain' ),
        'all_items' => __( 'All Career Summaries', 'textdomain' ),
        'add_new_item' => __( 'Add New Career Summary', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Career Summary', 'textdomain' ),
        'edit_item' => __( 'Edit Career Summary', 'textdomain' ),
        'update_item' => __( 'Update Career Summary', 'textdomain' ),
        'view_item' => __( 'View Career Summary', 'textdomain' ),
        'view_items' => __( 'View Career Summaries', 'textdomain' ),
        'search_items' => __( 'Search Career Summary', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
        'featured_image' => __( 'Featured Image', 'textdomain' ),
        'set_featured_image' => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item' => __( 'Insert into Career Summary', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Career Summary', 'textdomain' ),
        'items_list' => __( 'Career Summaries list', 'textdomain' ),
        'items_list_navigation' => __( 'Career Summaries list navigation', 'textdomain' ),
        'filter_items_list' => __( 'Filter Career Summaries list', 'textdomain' ),
    );
    
    $args = array(
        'label' => __( 'Career Summary', 'textdomain' ),
        'description' => __( 'description', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-hammer',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'author', 'custom-fields', 'revisions'),
        'taxonomies' => array(),
        'hierarchical' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'has_archive' => true,
		'rewrite' => array( 
			'slug' => 'career-summary', // use this slug instead of post type name
			'with_front' => FALSE // if you have a permalink base such as /blog/ then setting this to false ensures your custom post type permalink structure will be /products/ instead of /blog/products/
		),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'show_in_nav_menus' => true,
        'menu_position' => 5,
        'capability_type' => 'post',
        'show_in_rest' => true,
    );
    
    register_post_type( 'go2hr_careersummary', $args );

}
add_action( 'init', 'create_career_summary_cpt', 0 );



// Register Taxonomy Career Sector
// Taxonomy Key: career_s_sector
function create_career_sector_tax() {
	$labels = array(
		'name'              => _x( 'Career Sectors', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Career Sector', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Career Sectors', 'textdomain' ),
		'all_items'         => __( 'All Career Sectors', 'textdomain' ),
		'parent_item'       => __( 'Parent Career Sector', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Career Sector:', 'textdomain' ),
		'edit_item'         => __( 'Edit Career Sector', 'textdomain' ),
		'update_item'       => __( 'Update Career Sector', 'textdomain' ),
		'add_new_item'      => __( 'Add New Career Sector', 'textdomain' ),
		'new_item_name'     => __( 'New Career Sector Name', 'textdomain' ),
		'menu_name'         => __( 'Career Sector', 'textdomain' ),
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
	register_taxonomy( 'career_s_sector', array('go2hr_careersummary'), $args );

}
add_action( 'init', 'create_career_sector_tax' );



// Register Taxonomy Career Region
// Taxonomy Key: career_s_region
function create_career_region_tax() {
	$labels = array(
		'name'              => _x( 'Career Regions', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Career Region', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Career Regions', 'textdomain' ),
		'all_items'         => __( 'All Career Regions', 'textdomain' ),
		'parent_item'       => __( 'Parent Career Region', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Career Region:', 'textdomain' ),
		'edit_item'         => __( 'Edit Career Region', 'textdomain' ),
		'update_item'       => __( 'Update Career Region', 'textdomain' ),
		'add_new_item'      => __( 'Add New Career Region', 'textdomain' ),
		'new_item_name'     => __( 'New Career Region Name', 'textdomain' ),
		'menu_name'         => __( 'Career Region', 'textdomain' ),
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
	register_taxonomy( 'career_s_region', array('go2hr_careersummary'), $args );

}
add_action( 'init', 'create_career_region_tax' );