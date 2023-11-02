<?php
	/**
	 * User Login Helper
	 *
	 * Hooks, helper functions
	 */
	
	namespace Go2Hr\Helpers\Login;
	use Roots\Sage\Wrapper;

	/**
	 * Register AJAX handling actions for user login form
	 */
	add_action( 'wp_ajax_nopriv_g2hruserlogin', array(new \G2hr_User_Login(), 'login') );
	add_action( 'wp_ajax_g2hruserlogin', array(new \G2hr_User_Login(), 'login') );

	/**
	 * A simple helper function that returns information about lat user login date
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-07-10
	 * @version 1.0.0
	 * @return  integer UNIX Epoch Time
	 */
	function has_logged_before() {
		return get_user_meta(get_current_user_id(), 'user_last_login')[0];
	}