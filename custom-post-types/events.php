<?php

// Register Custom Post Type Event
// Post Type Key: Event
function create_event_cpt() {

    $labels = array(
        'name' => _x( 'Events', 'Post Type General Name', 'textdomain' ),
        'singular_name' => _x( 'Event', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => _x( 'Events', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar' => _x( 'Event', 'Add New on Toolbar', 'textdomain' ),
        'archives' => __( 'Event', 'textdomain' ),
        'attributes' => __( 'Event', 'textdomain' ),
        'parent_item_colon' => __( 'Event', 'textdomain' ),
        'all_items' => __( 'All Events', 'textdomain' ),
        'add_new_item' => __( 'Add New Event', 'textdomain' ),
        'add_new' => __( 'Add New', 'textdomain' ),
        'new_item' => __( 'New Event', 'textdomain' ),
        'edit_item' => __( 'Edit Event', 'textdomain' ),
        'update_item' => __( 'Update Event', 'textdomain' ),
        'view_item' => __( 'View Event', 'textdomain' ),
        'view_items' => __( 'View Events', 'textdomain' ),
        'search_items' => __( 'Search Event', 'textdomain' ),
        'not_found' => __( 'Not found', 'textdomain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
        'featured_image' => __( 'Featured Image', 'textdomain' ),
        'set_featured_image' => __( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
        'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
        'insert_into_item' => __( 'Insert into Event', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Event', 'textdomain' ),
        'items_list' => __( 'Events list', 'textdomain' ),
        'items_list_navigation' => __( 'Events list navigation', 'textdomain' ),
        'filter_items_list' => __( 'Filter Events list', 'textdomain' ),
    );

    $rewrite = array(
        'slug' => 'events',
        'with_front' => true,
        'pages' => true,
        'feeds' => true,
    );

    $args = array(
        'label' => __( 'Event', 'textdomain' ),
        'description' => __( 'description', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author', 'custom-fields'),
        'taxonomies' => array('events_region', 'events_category', 'events_province'),
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

    register_post_type( 'go2hr_events', $args );

}
add_action( 'init', 'create_event_cpt', 0 );



// Register Taxonomy Event Region
// Taxonomy Key: events_region
function create_event_region_tax() {
	$labels = array(
		'name'              => _x( 'Event Regions', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Event Region', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Event Regions', 'textdomain' ),
		'all_items'         => __( 'All Event Regions', 'textdomain' ),
		'parent_item'       => __( 'Parent Event Region', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Event Region:', 'textdomain' ),
		'edit_item'         => __( 'Edit Event Region', 'textdomain' ),
		'update_item'       => __( 'Update Event Region', 'textdomain' ),
		'add_new_item'      => __( 'Add New Event Region', 'textdomain' ),
		'new_item_name'     => __( 'New Event Region Name', 'textdomain' ),
		'menu_name'         => __( 'Event Regions', 'textdomain' ),
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
	register_taxonomy( 'events_region', array('go2hr_events'), $args );

}
add_action( 'init', 'create_event_region_tax' );




// Register Taxonomy Event Category
// Taxonomy Key: events_category
function create_event_category_tax() {
	$labels = array(
		'name'              => _x( 'Event Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Event Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Event Categories', 'textdomain' ),
		'all_items'         => __( 'All Event Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Event Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Event Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Event Category', 'textdomain' ),
		'update_item'       => __( 'Update Event Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Event Category', 'textdomain' ),
		'new_item_name'     => __( 'New Event Category Name', 'textdomain' ),
		'menu_name'         => __( 'Event Categories', 'textdomain' ),
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
	register_taxonomy( 'events_category', array('go2hr_events'), $args );

}
add_action( 'init', 'create_event_category_tax' );
