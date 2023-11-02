<?php
	/**
	 * Jobs Custom Post Type
	 *
	 * CPT Definition, additonal taxonomies and custom post statuses
	 * Insert default values for taxonomy terms
	 */

	namespace G2Hr\Cpt\Jobs;


	/**
	 * Used to initialize Jobs custom post type
	 */
	function init_jobs_cpt() {
		$labels = array(
			'name'                  => _x( 'Jobs', 'Post Type General Name', 'go2hr' ),
			'singular_name'         => _x( 'Job', 'Post Type Singular Name', 'go2hr' ),
			'menu_name'             => __( 'Jobs', 'go2hr' ),
			'name_admin_bar'        => __( 'Jobs', 'go2hr' ),
			'archives'              => __( 'Jobs Archives', 'go2hr' ),
			'attributes'            => __( 'Jobs Attributes', 'go2hr' ),
			'parent_item_colon'     => __( 'Parent Job:', 'go2hr' ),
			'all_items'             => __( 'All Jobs', 'go2hr' ),
			'add_new_item'          => __( 'Add New Job', 'go2hr' ),
			'add_new'               => __( 'Add New Job', 'go2hr' ),
			'new_item'              => __( 'New Job', 'go2hr' ),
			'edit_item'             => __( 'Edit Job', 'go2hr' ),
			'update_item'           => __( 'Update Job', 'go2hr' ),
			'view_item'             => __( 'View Job', 'go2hr' ),
			'view_items'            => __( 'View Jobs', 'go2hr' ),
			'search_items'          => __( 'Search Jobs', 'go2hr' ),
			'not_found'             => __( 'Not found', 'go2hr' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'go2hr' ),
			'featured_image'        => __( 'Featured Image', 'go2hr' ),
			'set_featured_image'    => __( 'Set featured image', 'go2hr' ),
			'remove_featured_image' => __( 'Remove featured image', 'go2hr' ),
			'use_featured_image'    => __( 'Use as featured image', 'go2hr' ),
			'insert_into_item'      => __( 'Insert into job', 'go2hr' ),
			'uploaded_to_this_item' => __( 'Uploaded to this job', 'go2hr' ),
			'items_list'            => __( 'Jobs list', 'go2hr' ),
			'items_list_navigation' => __( 'Jobs list navigation', 'go2hr' ),
			'filter_items_list'     => __( 'Filter jobs list', 'go2hr' ),
		);
		$rewrite = array(
			'slug'                  => 'job-board',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Job', 'go2hr' ),
			'description'           => __( 'Go2HR Jobs', 'go2hr' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', 'editor', 'author' ),
			'taxonomies'            => array( 'jobs_region', 'jobs_status', 'jobs_levels', 'jobs_types', 'jobs_sectors', 'jobs_province' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 149,
			'menu_icon'             => 'dashicons-megaphone',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'rewrite'               => $rewrite,
			'capability_type'       => 'page',
			'show_in_rest'          => false
		);
		register_post_type( 'go2hr_jobs', $args );
	}

	/**
	 * Initialize Region taxonomy for Jobs post type
	 */
	function init_region_tax() {
		$labels = array(
			'name'                       => _x( 'Region', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Job Region', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Job Regions', 'go2hr' ),
			'all_items'                  => __( 'All Regions', 'go2hr' ),
			'parent_item'                => __( 'Parent Region', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Region:', 'go2hr' ),
			'new_item_name'              => __( 'New Region Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Region', 'go2hr' ),
			'edit_item'                  => __( 'Edit Region', 'go2hr' ),
			'update_item'                => __( 'Update Region', 'go2hr' ),
			'view_item'                  => __( 'View Region', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate regions with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove regions', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Regions', 'go2hr' ),
			'search_items'               => __( 'Search Regions', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Regions', 'go2hr' ),
			'items_list'                 => __( 'Regions list', 'go2hr' ),
			'items_list_navigation'      => __( 'Regions list navigation', 'go2hr' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'show_in_rest'               => false,
		);
		register_taxonomy( 'jobs_region', array( 'go2hr_jobs' ), $args );
	}

	/**
	 * Initialize Status taxonomy for Jobs post type
	 */
	function init_status_tax() {
		$labels = array(
			'name'                       => _x( 'Status', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Job Status', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Job Statuses', 'go2hr' ),
			'all_items'                  => __( 'All Statuses', 'go2hr' ),
			'parent_item'                => __( 'Parent Status', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Status:', 'go2hr' ),
			'new_item_name'              => __( 'New Status Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Status', 'go2hr' ),
			'edit_item'                  => __( 'Edit Status', 'go2hr' ),
			'update_item'                => __( 'Update Status', 'go2hr' ),
			'view_item'                  => __( 'View Status', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate statuses with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove statuses', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Statuses', 'go2hr' ),
			'search_items'               => __( 'Search Statuses', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Types', 'go2hr' ),
			'items_list'                 => __( 'Statuses list', 'go2hr' ),
			'items_list_navigation'      => __( 'Statuses list navigation', 'go2hr' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'show_in_rest'               => false,
		);
		register_taxonomy( 'jobs_status', array( 'go2hr_jobs' ), $args );
	}

	/**
	 * Initialize Type taxonomy for Jobs post type
	 */
	function init_type_tax() {
		$labels = array(
			'name'                       => _x( 'Type', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Job Type', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Job Types', 'go2hr' ),
			'all_items'                  => __( 'All Types', 'go2hr' ),
			'parent_item'                => __( 'Parent Type', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Type:', 'go2hr' ),
			'new_item_name'              => __( 'New Type Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Type', 'go2hr' ),
			'edit_item'                  => __( 'Edit Type', 'go2hr' ),
			'update_item'                => __( 'Update Type', 'go2hr' ),
			'view_item'                  => __( 'View Type', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate types with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove types', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Types', 'go2hr' ),
			'search_items'               => __( 'Search Types', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Types', 'go2hr' ),
			'items_list'                 => __( 'Types list', 'go2hr' ),
			'items_list_navigation'      => __( 'Types list navigation', 'go2hr' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'show_in_rest'               => false,
		);
		register_taxonomy( 'jobs_types', array( 'go2hr_jobs' ), $args );

	}

	/**
	 * Initialize Level taxonomy for Jobs post type
	 */
	function init_level_tax() {
		$labels = array(
			'name'                       => _x( 'Level', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Job Level', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Job Levels', 'go2hr' ),
			'all_items'                  => __( 'All Levels', 'go2hr' ),
			'parent_item'                => __( 'Parent Level', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Level:', 'go2hr' ),
			'new_item_name'              => __( 'New Level Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Level', 'go2hr' ),
			'edit_item'                  => __( 'Edit Level', 'go2hr' ),
			'update_item'                => __( 'Update Level', 'go2hr' ),
			'view_item'                  => __( 'View Level', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate levels with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove levels', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Levels', 'go2hr' ),
			'search_items'               => __( 'Search Levels', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Levels', 'go2hr' ),
			'items_list'                 => __( 'Levels list', 'go2hr' ),
			'items_list_navigation'      => __( 'Levels list navigation', 'go2hr' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'show_in_rest'               => false,
		);
		register_taxonomy( 'jobs_levels', array( 'go2hr_jobs' ), $args );
	}

	/**
	 * Initialize Sector taxonomy for Jobs post type
	 */
	function init_sector_tax() {
		$labels = array(
			'name'                       => _x( 'Sector', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Job Sector', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Job Sectors', 'go2hr' ),
			'all_items'                  => __( 'All Sectors', 'go2hr' ),
			'parent_item'                => __( 'Parent Sector', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Sector:', 'go2hr' ),
			'new_item_name'              => __( 'New Sector Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Sector', 'go2hr' ),
			'edit_item'                  => __( 'Edit Sector', 'go2hr' ),
			'update_item'                => __( 'Update Sector', 'go2hr' ),
			'view_item'                  => __( 'View Sector', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate sectors with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove sectors', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Sectors', 'go2hr' ),
			'search_items'               => __( 'Search Sectors', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Types', 'go2hr' ),
			'items_list'                 => __( 'Sectors list', 'go2hr' ),
			'items_list_navigation'      => __( 'Sectors list navigation', 'go2hr' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'show_in_rest'               => false,
		);
		register_taxonomy( 'jobs_sectors', array( 'go2hr_jobs' ), $args );
	}

	/**
	 * Initialize Province taxonomy for Events
	 */
	function init_province_tax() {

		$labels = array(
			'name'                       => _x( 'Provinces', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Province', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Job Provinces', 'go2hr' ),
			'all_items'                  => __( 'All Provinces', 'go2hr' ),
			'parent_item'                => __( 'Parent Province', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Province:', 'go2hr' ),
			'new_item_name'              => __( 'New Province Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Province', 'go2hr' ),
			'edit_item'                  => __( 'Edit Province', 'go2hr' ),
			'update_item'                => __( 'Update Province', 'go2hr' ),
			'view_item'                  => __( 'View Province', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Provinces', 'go2hr' ),
			'search_items'               => __( 'Search Provinces', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Provinces', 'go2hr' ),
			'items_list'                 => __( 'Province list', 'go2hr' ),
			'items_list_navigation'      => __( 'Province list navigation', 'go2hr' ),
		);
		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'show_in_rest'               => false,
		);
		register_taxonomy( 'jobs_province', array( 'go2hr_jobs' ), $args );

	}

	/**
	 * Callback function used for count update for both Sector and Occupation taxonomy
	 * What this does is update the count of a specific term
     * by the number of users that have been given the term.  We're not doing any checks for users specifically here.
     * We're just updating the count with no specifics for simplicity.
     *
     * See the _update_post_term_count() function in WordPress for more info.

	 * @param   array     $terms    List of Term taxonomy IDs
	 * @param   object     $taxonomy Current taxonomy object of terms
	 */
	function update_occupation_count($terms, $taxonomy) {
		global $wpdb;

		foreach ((array) $terms as $term) {

			$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );
			do_action( 'edit_term_taxonomy', $term, $taxonomy );
			$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
			do_action( 'edited_term_taxonomy', $term, $taxonomy );
		}
	}


	/**
	 * Function that registers custom post statuses for Jobs
	 */
	function register_post_statuses() {
		register_post_status( 'job_draft', array(
			'label'                     => _x( 'Draft', 'post status label', 'go2hr' ),
			'public'                    => false,
			'private'					          => true,
			'label_count'               => _n_noop( 'Draft <span class="count">(%s)</span>', 'Draft <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_jobs' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
			'dashicon'                  => 'dashicons-no',
		) );

		register_post_status( 'publish', array(
			'label'                     => _x( 'Active', 'post status label', 'go2hr' ),
			'public'                    => true,
			'private'					          => false,
			'label_count'               => _n_noop( 'Active <span class="count">(%s)</span>', 'Active <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_jobs' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
			'dashicon'                  => 'dashicons-yes',
		) );

		register_post_status( 'job_deleted', array(
			'label'                     => _x( 'Deleted', 'post status label', 'go2hr' ),
			'public'                    => false,
			'private'					          => true,
			'label_count'               => _n_noop( 'Deleted <span class="count">(%s)</span>', 'Deleted <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_jobs' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
			'dashicon'                  => 'dashicons-no',
		) );

		register_post_status( 'job_expired', array(
			'label'                     => _x( 'Expired', 'post status label', 'go2hr' ),
			'public'                    => false,
			'private'					          => true,
			'label_count'               => _n_noop( 'Expired <span class="count">(%s)</span>', 'Expired <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_jobs' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
			'dashicon'                  => 'dashicons-no',
		) );

    register_post_status( 'job_archived', array(
      'label'                     => _x( 'Archived', 'post status label', 'go2hr' ),
      'public'                    => false,
      'private'					          => true,
      'label_count'               => _n_noop( 'Archived <span class="count">(%s)</span>', 'Archived <span class="count">(%s)</span>', 'go2hr' ),
      'post_type'                 => array( 'go2hr_jobs' ),
      'show_in_admin_all_list'    => true,
      'show_in_admin_status_list' => true,
      'show_in_metabox_dropdown'  => true,
      'show_in_inline_dropdown'   => true,
      'dashicon'                  => 'dashicons-archive',
    ) );

		register_post_status( 'job_unvalidated', array(
			'label'                     => _x( 'Pending Review', 'post status label', 'go2hr' ),
			'public'                    => false,
			'private'					=> true,
			'label_count'               => _n_noop( 'Pending Review <span class="count">(%s)</span>', 'Pending Review <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_jobs' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
			'dashicon'                  => 'dashicons-warning',
		) );

		register_post_status( 'job_unpaid', array(
			'label'                     => _x( 'Waiting for Payment', 'post status label', 'go2hr' ),
			'public'                    => false,
			'private'					=> true,
			'label_count'               => _n_noop( 'Waiting for Payment <span class="count">(%s)</span>', 'Waiting for Payment <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_jobs' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
			'dashicon'                  => 'dashicons-warning',
		) );
	}

	/**
	 * Method used to filter our unnecessary post statuses such as Draft, Password Protected, Published etc from Jobs custom
	 * post type editor.
	 * @param   array      $post_types  Array with all custom post types
	 * @param   string     $status_name Status name
	 * @return  array                  Array of allowed statuses
	 */
	function restrict_statuses($post_types = array(), $status_name = '') {
		return array_diff( $post_types, array( 'go2hr_jobs' ) );
	}

	//Custom post type and taxonomies registration
	add_action( 'init',  __NAMESPACE__ . '\\init_jobs_cpt', 0 );
	add_action( 'init',  __NAMESPACE__ . '\\init_region_tax', 0 );
	add_action( 'init',  __NAMESPACE__ . '\\init_type_tax', 0 );
	add_action( 'init',  __NAMESPACE__ . '\\init_level_tax', 0 );
	add_action( 'init',  __NAMESPACE__ . '\\init_sector_tax', 0 );
	add_action( 'init',  __NAMESPACE__ . '\\init_status_tax', 0 );
	add_action( 'init',  __NAMESPACE__ . '\\init_province_tax', 0 );

	//Statuses
	add_action( 'init',  __NAMESPACE__ . '\\register_post_statuses');
	add_filter( 'wp_statuses_get_registered_post_types',  __NAMESPACE__ . '\\restrict_statuses', 10, 2 );



/** Job Board resources */
acf_add_options_page(array(
    'page_title'	=> 'Job Board Settings',
    'menu_title'	=> 'Job Board Settings Settings',
    'menu_slug' 	=> 'Job Board Settings Settings',
    'capability'	=> 'edit_posts',
    'redirect'		=> false,
    'parent_slug'    => 'edit.php?post_type=go2hr_jobs',
));
