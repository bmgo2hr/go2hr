<?php
	/**
	 * User Taxonomies
	 *
	 * additonal taxonomies
	 */

	namespace G2Hr\Cpt\Users;

	/**
	 * Initialize Occupations taxonomy for users
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-06-12
	 * @version 1.0.0
	 */
	function init_occupation_tax() {
		 register_taxonomy(
			'users_occupations',
			'user',
			array(
				'public' => true,
				'labels' => array(
					'name' => __( 'Occupations' ),
					'singular_name' => __( 'Occupation' ),
					'menu_name' => __( 'User Occupations' ),
					'search_items' => __( 'Search Occupations' ),
					'popular_items' => __( 'Popular Occupations' ),
					'all_items' => __( 'All Occupations' ),
					'edit_item' => __( 'Edit Occupation' ),
					'update_item' => __( 'Update Occupation' ),
					'add_new_item' => __( 'Add New Occupation' ),
					'new_item_name' => __( 'New Occupation Name' ),
					'separate_items_with_commas' => __( 'Separate occupations with commas' ),
					'add_or_remove_items' => __( 'Add or remove occupations' ),
					'choose_from_most_used' => __( 'Choose from the most popular occupations' ),
				),
				'rewrite' => array(
					'with_front' => true,
					'slug' => 'author/occupations' // Use 'author' (default WP user slug).
				),
				'capabilities' => array(
					'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
					'edit_terms'   => 'edit_users',
					'delete_terms' => 'edit_users',
					'assign_terms' => 'read',
				),
				'update_count_callback' => array(__NAMESPACE__, 'update_occupation_count') // Use a custom function to update the count.
			)
		);
	}

	/**
	 * Initialize Sectors taxonomy for users
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-06-12
	 * @version 1.0.0
	 */
	function init_sectors_tax() {
		 register_taxonomy(
			'users_sectors',
			'user',
			array(
				'public' => true,
				'labels' => array(
					'name' => __( 'Sectors' ),
					'singular_name' => __( 'Sector' ),
					'menu_name' => __( 'User Job Sectors' ),
					'search_items' => __( 'Search Sectors' ),
					'popular_items' => __( 'Popular Sectors' ),
					'all_items' => __( 'All Sectors' ),
					'edit_item' => __( 'Edit Sector' ),
					'update_item' => __( 'Update Sector' ),
					'add_new_item' => __( 'Add New Sector' ),
					'new_item_name' => __( 'New Sector Name' ),
					'separate_items_with_commas' => __( 'Separate sectors with commas' ),
					'add_or_remove_items' => __( 'Add or remove sectors' ),
					'choose_from_most_used' => __( 'Choose from the most popular sectors' ),
				),
				'rewrite' => array(
					'with_front' => true,
					'slug' => 'author/sectors' // Use 'author' (default WP user slug).
				),
				'capabilities' => array(
					'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
					'edit_terms'   => 'edit_users',
					'delete_terms' => 'edit_users',
					'assign_terms' => 'read',
				),
				'update_count_callback' => array(__NAMESPACE__, 'update_occupation_count') // Use a custom function to update the count.
			)
		);
	}

	/**
	 * Initialize Status taxonomy for users
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-06-12
	 * @version 1.0.0
	 */
	function init_status_tax() {
		 register_taxonomy(
			'users_statuses',
			'user',
			array(
				'public' => true,
				'labels' => array(
					'name' => __( 'Statuses' ),
					'singular_name' => __( 'Status' ),
					'menu_name' => __( 'User Statuses' ),
					'search_items' => __( 'Search Statuses' ),
					'popular_items' => __( 'Popular Statuses' ),
					'all_items' => __( 'All Statuses' ),
					'edit_item' => __( 'Edit Status' ),
					'update_item' => __( 'Update Status' ),
					'add_new_item' => __( 'Add New Status' ),
					'new_item_name' => __( 'New Status Name' ),
					'separate_items_with_commas' => __( 'Separate statuses with commas' ),
					'add_or_remove_items' => __( 'Add or remove statuses' ),
					'choose_from_most_used' => __( 'Choose from the most popular statuses' ),
				),
				'rewrite' => array(
					'with_front' => true,
					'slug' => 'author/statuses' // Use 'author' (default WP user slug).
				),
				'capabilities' => array(
					'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
					'edit_terms'   => 'edit_users',
					'delete_terms' => 'edit_users',
					'assign_terms' => 'read',
				),
				'update_count_callback' => array(__NAMESPACE__, 'update_occupation_count') // Use a custom function to update the count.
			)
		);
	}


	/**
	 * Initialize Referral taxonomy for users
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-06-12
	 * @version 1.0.0
	 */
	function init_referral_tax() {
		 register_taxonomy(
			'users_referrals',
			'user',
			array(
				'public' => true,
				'labels' => array(
					'name' => __( 'Referrals' ),
					'singular_name' => __( 'Referrals' ),
					'menu_name' => __( 'User Referrals' ),
					'search_items' => __( 'Search Referrals' ),
					'popular_items' => __( 'Popular Referrals' ),
					'all_items' => __( 'All Referrals' ),
					'edit_item' => __( 'Edit Referral' ),
					'update_item' => __( 'Update Referral' ),
					'add_new_item' => __( 'Add New Referral' ),
					'new_item_name' => __( 'New Referral Name' ),
					'separate_items_with_commas' => __( 'Separate referrals with commas' ),
					'add_or_remove_items' => __( 'Add or remove referrals' ),
					'choose_from_most_used' => __( 'Choose from the most popular referrals' ),
				),
				'rewrite' => array(
					'with_front' => true,
					'slug' => 'author/referrals' // Use 'author' (default WP user slug).
				),
				'capabilities' => array(
					'manage_terms' => 'edit_users', // Using 'edit_users' cap to keep this simple.
					'edit_terms'   => 'edit_users',
					'delete_terms' => 'edit_users',
					'assign_terms' => 'read',
				),
				'update_count_callback' => array(__NAMESPACE__, 'update_occupation_count') // Use a custom function to update the count.
			)
		);
	}

	/**
	 * Callback function used for count update for both Sector and Occupation taxonomy
	 * What this does is update the count of a specific term
     * by the number of users that have been given the term.  We're not doing any checks for users specifically here.
     * We're just updating the count with no specifics for simplicity.
     *
     * See the _update_post_term_count() function in WordPress for more info.

	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-06-12
	 * @version 1.0.0
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

	add_action( 'init', __NAMESPACE__ . '\\init_occupation_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_sectors_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_status_tax', 0 );
	add_action( 'init', __NAMESPACE__ . '\\init_referral_tax', 0 );
