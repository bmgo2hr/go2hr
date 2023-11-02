<?php
// Register Custom Post Type Resource
// Post Type Key: Resource
function create_resource_library_cpt() {

    $labels = array(
        'name' => _x( 'Explore All Resources', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Resource', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => _x( 'Explore All Resources', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar' => _x( 'Explore All Resources', 'Add New on Toolbar', 'textdomain' ),
        'archives' => __( 'Resource', 'textdomain' ),
        'attributes' => __( 'Resource', 'textdomain' ),
        'parent_item_colon' => __( 'Resource', 'textdomain' ),
        'all_items' => __( 'All Items', 'textdomain' ),
        'add_new_item' => __( 'Add New Resource', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Resource', 'textdomain' ),
        'edit_item' => __( 'Edit Resource', 'textdomain' ),
        'update_item' => __( 'Update Resource', 'textdomain' ),
        'view_item' => __( 'View Resource', 'textdomain' ),
        'view_items' => __( 'View Explore All Resources', 'textdomain' ),
        'search_items' => __( 'Search Resource', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
        'featured_image' => __( 'Featured Image', 'textdomain' ),
        'set_featured_image' => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item' => __( 'Insert into Resource', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Resource', 'textdomain' ),
        'items_list' => __( 'Explore All Resources list', 'textdomain' ),
        'items_list_navigation' => __( 'Explore All Resources list navigation', 'textdomain' ),
        'filter_items_list' => __( 'Filter Explore All Resources list', 'textdomain' ),
    );

    $rewrite = array(
        'slug' => 'explore-all-resources',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'label' => __( 'Resource', 'textdomain' ),
        'description' => __( 'description', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-book-alt',
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'),
        'taxonomies' => array('resource_topic', 'resource_type', 'resource_sector', 'resource_tag'),
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

    register_post_type( 'go2hr_resources', $args );

}
add_action( 'init', 'create_resource_library_cpt', 0 );



// Register Taxonomy Resource Topic
// Taxonomy Key: resource_topic
function create_resource_topic_tax() {
	$labels = array(
		'name'              => _x( 'Resource Topics', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Resource Topic', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Resource Topics', 'textdomain' ),
		'all_items'         => __( 'All Resource Topics', 'textdomain' ),
		'parent_item'       => __( 'Parent Resource Topic', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Resource Topic:', 'textdomain' ),
		'edit_item'         => __( 'Edit Resource Topic', 'textdomain' ),
		'update_item'       => __( 'Update Resource Topic', 'textdomain' ),
		'add_new_item'      => __( 'Add New Resource Topic', 'textdomain' ),
		'new_item_name'     => __( 'New Resource Topic Name', 'textdomain' ),
		'menu_name'         => __( 'Resource Topics', 'textdomain' ),
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
	register_taxonomy( 'resource_topic', array('go2hr_resources'), $args );

}
add_action( 'init', 'create_resource_topic_tax' );


// Register Taxonomy Resource Type
// Taxonomy Key: resource_type
function create_resource_type_tax() {
	$labels = array(
		'name'              => _x( 'Resource Types', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Resource Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Resource Types', 'textdomain' ),
		'all_items'         => __( 'All Resource Types', 'textdomain' ),
		'parent_item'       => __( 'Parent Resource Type', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Resource Type:', 'textdomain' ),
		'edit_item'         => __( 'Edit Resource Type', 'textdomain' ),
		'update_item'       => __( 'Update Resource Type', 'textdomain' ),
		'add_new_item'      => __( 'Add New Resource Type', 'textdomain' ),
		'new_item_name'     => __( 'New Resource Type Name', 'textdomain' ),
		'menu_name'         => __( 'Resource Types', 'textdomain' ),
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
	register_taxonomy( 'resource_type', array('go2hr_resources'), $args );

}
add_action( 'init', 'create_resource_type_tax' );


// Register Taxonomy Resource Sector
// Taxonomy Key: resource_sector
function create_resource_sector_tax() {
	$labels = array(
		'name'              => _x( 'Resource Sectors', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Resource Sector', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Resource Sectors', 'textdomain' ),
		'all_items'         => __( 'All Resource Sectors', 'textdomain' ),
		'parent_item'       => __( 'Parent Resource Sector', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Resource Sector:', 'textdomain' ),
		'edit_item'         => __( 'Edit Resource Sector', 'textdomain' ),
		'update_item'       => __( 'Update Resource Sector', 'textdomain' ),
		'add_new_item'      => __( 'Add New Resource Sector', 'textdomain' ),
		'new_item_name'     => __( 'New Resource Sector Name', 'textdomain' ),
		'menu_name'         => __( 'Resource Sectors', 'textdomain' ),
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
	register_taxonomy( 'resource_sector', array('go2hr_resources'), $args );

}
add_action( 'init', 'create_resource_sector_tax' );


// Register Taxonomy Tag
// Taxonomy Key: resource_tag
function create_tag_tax() {
	$labels = array(
		'name'              => _x( 'Tags', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Tags', 'textdomain' ),
		'all_items'         => __( 'All Tags', 'textdomain' ),
		'parent_item'       => __( 'Parent Tag', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Tag:', 'textdomain' ),
		'edit_item'         => __( 'Edit Tag', 'textdomain' ),
		'update_item'       => __( 'Update Tag', 'textdomain' ),
		'add_new_item'      => __( 'Add New Tag', 'textdomain' ),
		'new_item_name'     => __( 'New Tag Name', 'textdomain' ),
		'menu_name'         => __( 'Tags', 'textdomain' ),
	);

	$args = array(
		'labels' => $labels,
		'description' => __( '', 'textdomain' ),
		'hierarchical' => false,
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
	register_taxonomy( 'resource_tag', array('go2hr_resources'), $args );

}
add_action( 'init', 'create_tag_tax' );

// Register Taxonomy Subtopic
// Taxonomy Key: subtopic
function create_subtopic_tax() {
	$labels = array(
		'name'              => _x( 'Subtopic', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Subtopic', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Subtopic', 'textdomain' ),
		'all_items'         => __( 'All Subtopic', 'textdomain' ),
		'parent_item'       => __( 'Parent Sector', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Subtopic:', 'textdomain' ),
		'edit_item'         => __( 'Edit Subtopic', 'textdomain' ),
		'update_item'       => __( 'Update Subtopic', 'textdomain' ),
		'add_new_item'      => __( 'Add New Subtopic', 'textdomain' ),
		'new_item_name'     => __( 'New Subtopic Name', 'textdomain' ),
		'menu_name'         => __( 'Subtopic', 'textdomain' ),
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
	register_taxonomy( 'subtopic', array('go2hr_resources'), $args );

}
add_action( 'init', 'create_subtopic_tax' );

/** Explore resources */
acf_add_options_page(array(
    'page_title'	=> 'Explore All Resources Settings',
    'menu_title'	=> 'Explore All Resources Settings',
    'menu_slug' 	=> 'Explore All Resources Settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false,
    'parent_slug'    => 'edit.php?post_type=go2hr_resources',
));

