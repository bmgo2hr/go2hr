<?php
	/**
	 * Companies Custom Post Type
	 *
	 * CPT Definition, additonal taxonomies and custom post statuses
	 * Insert default values for taxonomy terms
	 */

	namespace G2Hr\Cpt\Companies;

	/**
	 * Used to initialize custom post type for companies
	 */
	function init_companies_cpt() {
		$labels = array(
			'name'                  => _x( 'Companies', 'Post Type General Name', 'go2hr' ),
			'singular_name'         => _x( 'Company', 'Post Type Singular Name', 'go2hr' ),
			'menu_name'             => __( 'Companies', 'go2hr' ),
			'name_admin_bar'        => __( 'Companies', 'go2hr' ),
			'archives'              => __( 'Company Archives', 'go2hr' ),
			'attributes'            => __( 'Company Attributes', 'go2hr' ),
			'parent_item_colon'     => __( 'Parent Company:', 'go2hr' ),
			'all_items'             => __( 'All Companies', 'go2hr' ),
			'add_new_item'          => __( 'Add New Company', 'go2hr' ),
			'add_new'               => __( 'Add New Company', 'go2hr' ),
			'new_item'              => __( 'New Company', 'go2hr' ),
			'edit_item'             => __( 'Edit Company', 'go2hr' ),
			'update_item'           => __( 'Update Company', 'go2hr' ),
			'view_item'             => __( 'View Company', 'go2hr' ),
			'view_items'            => __( 'View Companies', 'go2hr' ),
			'search_items'          => __( 'Search Companies', 'go2hr' ),
			'not_found'             => __( 'Not found', 'go2hr' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'go2hr' ),
			'featured_image'        => __( 'Featured Image', 'go2hr' ),
			'set_featured_image'    => __( 'Set featured image', 'go2hr' ),
			'remove_featured_image' => __( 'Remove featured image', 'go2hr' ),
			'use_featured_image'    => __( 'Use as featured image', 'go2hr' ),
			'insert_into_item'      => __( 'Insert into company', 'go2hr' ),
			'uploaded_to_this_item' => __( 'Uploaded to this company', 'go2hr' ),
			'items_list'            => __( 'Companies list', 'go2hr' ),
			'items_list_navigation' => __( 'Companies list navigation', 'go2hr' ),
			'filter_items_list'     => __( 'Filter companies list', 'go2hr' ),
		);
		$rewrite = array(
			'slug'                  => 'company-directory',
			'with_front'            => true,
			'pages'                 => true,
			'feeds'                 => true,
		);
		$args = array(
			'label'                 => __( 'Company', 'go2hr' ),
			'description'           => __( 'Go2HR Companies', 'go2hr' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'revisions', 'editor', 'author', 'thumbnail' ),
			'taxonomies'            => array( 'company_region', 'company_size', 'company_type', 'company_province' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 150,
			'menu_icon'             => 'dashicons-portfolio',
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
		register_post_type( 'go2hr_companies', $args );
	}

	/**
	 * Initialize Region taxonomy for Companies post type
	 */
	function init_region_tax() {
		$labels = array(
			'name'                       => _x( 'Region', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Region', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Company Regions', 'go2hr' ),
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
		register_taxonomy( 'company_region', array( 'go2hr_companies' ), $args );
	}

	/**
	 * Initialize Size taxonomy for Companies post type
	 */
	function init_size_tax() {
		$labels = array(
			'name'                       => _x( 'Size', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Size', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Company Sizes', 'go2hr' ),
			'all_items'                  => __( 'All Sizes', 'go2hr' ),
			'parent_item'                => __( 'Parent Size', 'go2hr' ),
			'parent_item_colon'          => __( 'Parent Size:', 'go2hr' ),
			'new_item_name'              => __( 'New Size Name', 'go2hr' ),
			'add_new_item'               => __( 'Add New Size', 'go2hr' ),
			'edit_item'                  => __( 'Edit Size', 'go2hr' ),
			'update_item'                => __( 'Update Size', 'go2hr' ),
			'view_item'                  => __( 'View Size', 'go2hr' ),
			'separate_items_with_commas' => __( 'Separate sizes with commas', 'go2hr' ),
			'add_or_remove_items'        => __( 'Add or remove sizes', 'go2hr' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'go2hr' ),
			'popular_items'              => __( 'Popular Sizes', 'go2hr' ),
			'search_items'               => __( 'Search Sizes', 'go2hr' ),
			'not_found'                  => __( 'Not Found', 'go2hr' ),
			'no_terms'                   => __( 'No Sizes', 'go2hr' ),
			'items_list'                 => __( 'Sizes list', 'go2hr' ),
			'items_list_navigation'      => __( 'Sizes list navigation', 'go2hr' ),
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
		register_taxonomy( 'company_size', array( 'go2hr_companies' ), $args );
	}

	function init_type_tax() {
		$labels = array(
			'name'                       => _x( 'Type', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Company Types', 'go2hr' ),
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
		register_taxonomy( 'company_type', array( 'go2hr_companies' ), $args );
	}

	/**
	 * Initialize Sector taxonomy for Companies post type
	 */
	function init_sector_tax() {
		$labels = array(
			'name'                       => _x( 'Sector', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Sector', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Company Sectors', 'go2hr' ),
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
		register_taxonomy( 'company_sector', array( 'go2hr_companies' ), $args );
	}

	/**
	 * Initialize Province taxonomy for Events
	 */
	function init_province_tax() {

		$labels = array(
			'name'                       => _x( 'Provinces', 'Taxonomy General Name', 'go2hr' ),
			'singular_name'              => _x( 'Province', 'Taxonomy Singular Name', 'go2hr' ),
			'menu_name'                  => __( 'Company Provinces', 'go2hr' ),
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
		register_taxonomy( 'company_province', array( 'go2hr_companies' ), $args );

	}

	/**
	 * Function that registers custom post statuses for Companies
	 */
	function register_post_statuses() {
		register_post_status( 'company_active', array(
			'label'                     => _x( 'Active', 'post status label', 'go2hr' ),
			'public'                    => true,
			'label_count'               => _n_noop( 'Active <span class="count">(%s)</span>', 'Active <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_companies' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
      'exclude_from_search'       => false,
			'dashicon'                  => 'dashicons-yes',
		) );

		register_post_status( 'company_inactive', array(
			'label'                     => _x( 'Inactive', 'post status label', 'go2hr' ),
			'public'                    => true,
			'label_count'               => _n_noop( 'Inactive <span class="count">(%s)</span>', 'Inactive <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_companies' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
      'exclude_from_search'       => true,
			'dashicon'                  => 'dashicons-no',
		) );

		register_post_status( 'company_unvalidated', array(
			'label'                     => _x( 'Pending validation', 'post status label', 'go2hr' ),
			'public'                    => true,
			'label_count'               => _n_noop( 'Pending validation <span class="count">(%s)</span>', 'Pending validation <span class="count">(%s)</span>', 'go2hr' ),
			'post_type'                 => array( 'go2hr_companies' ),
			'show_in_admin_all_list'    => true,
			'show_in_admin_status_list' => true,
			'show_in_metabox_dropdown'  => true,
			'show_in_inline_dropdown'   => true,
      'exclude_from_search'       => true,
			'dashicon'                  => 'dashicons-warning',
		) );
	}

	/**
	 * Method used to filter our unnecessary post statuses such as Draft, Password Protected, Published etc from Companies custom
	 * post type editor.
	 * @param   array      $post_types  Array with all custom post types
	 * @param   string     $status_name Status name
	 * @return  array                  Array of allowed statuses
	 */
	function restrict_statuses($post_types = array(), $status_name = '') {
		return array_diff( $post_types, array( 'go2hr_companies' ) );
	}

	/**
	 * Add default terms for Type Taxonomy
	 */
	function insert_type_terms() {
		$terms = [
			//'HR Company' //This is used to determine if the company is HR company and that information is later used for Job posting and Management rights
		];

		for($i = 0; $i < count($terms); $i++) {
			$exist = term_exists($terms[$i], 'company_type');
			if($exist == 0 || $exist = null) {
				$id = wp_insert_term($terms[$i], 'company_type');
			}
		}
	}

	//Custom post type and taxonomies registration
	add_action( 'init', __NAMESPACE__ . '\\init_companies_cpt', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_region_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_size_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_type_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_sector_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_province_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\insert_type_terms', 0 );

	//Custom post statuses
	add_action( 'init', __NAMESPACE__ . '\\register_post_statuses');
	add_filter( 'wp_statuses_get_registered_post_types', __NAMESPACE__ . '\\restrict_statuses', 10, 2 );
