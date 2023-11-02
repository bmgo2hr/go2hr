<?php
	/**
	 * E-mail Templates Custom Post Type
	 *
	 * CPT Definition, additonal taxonomies
	 */

	namespace G2Hr\Cpt\EmailTemplates;

	/**
	 * Register Email Templates Custom Post Type
	 */
	function register_cpt() {
		$labels = array(
			'name'                  => _x( 'Email Templates', 'Post Type General Name', 'go2hr' ),
			'singular_name'         => _x( 'Email Template', 'Post Type Singular Name', 'go2hr' ),
			'menu_name'             => __( 'Email Templates', 'go2hr' ),
			'name_admin_bar'        => __( 'Email Template', 'go2hr' ),
			'archives'              => __( 'Email Template Archives', 'go2hr' ),
			'attributes'            => __( 'Email Template Attributes', 'go2hr' ),
			'parent_item_colon'     => __( 'Parent Template:', 'go2hr' ),
			'all_items'             => __( 'All Templates', 'go2hr' ),
			'add_new_item'          => __( 'Add New Template', 'go2hr' ),
			'add_new'               => __( 'Add New Template', 'go2hr' ),
			'new_item'              => __( 'New Template', 'go2hr' ),
			'edit_item'             => __( 'Edit Template', 'go2hr' ),
			'update_item'           => __( 'Update Template', 'go2hr' ),
			'view_item'             => __( 'View Template', 'go2hr' ),
			'view_items'            => __( 'View Templates', 'go2hr' ),
			'search_items'          => __( 'Search Templates', 'go2hr' ),
			'not_found'             => __( 'Not found', 'go2hr' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'go2hr' ),
			'featured_image'        => __( 'Featured Image', 'go2hr' ),
			'set_featured_image'    => __( 'Set featured image', 'go2hr' ),
			'remove_featured_image' => __( 'Remove featured image', 'go2hr' ),
			'use_featured_image'    => __( 'Use as featured image', 'go2hr' ),
			'insert_into_item'      => __( 'Insert into template', 'go2hr' ),
			'uploaded_to_this_item' => __( 'Uploaded to this template', 'go2hr' ),
			'items_list'            => __( 'Templates list', 'go2hr' ),
			'items_list_navigation' => __( 'Templates list navigation', 'go2hr' ),
			'filter_items_list'     => __( 'Filter Templates list', 'go2hr' ),
		);
		$rewrite = array(
			'slug'                  => 'email-templates',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Email Templates', 'go2hr' ),
			'description'           => __( 'Go2HR Email Templates', 'go2hr' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', 'editor',  ),
			'taxonomies'            => array(  ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 191,
			'menu_icon'             => 'dashicons-email',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => false,
		);
		register_post_type( 'go2hr_emailtemplates', $args );
	}


	add_action( 'init', __NAMESPACE__ . '\\register_cpt', 0 );

