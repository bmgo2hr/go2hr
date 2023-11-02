<?php
	/**
	 * User Password Reset Helper
	 *
	 * Hooks, helper functions
	 */
	
	use Roots\Sage\Wrapper;

	// if(is_user_logged_in() && is_page('password-reset')) {
	// 	$user = wp_get_current_user();
	// 	if(user_can($user, 'use_dashboard')) {
	// 		wp_safe_redirect(site_url('dashboard'));
	// 	}
	// }

	/**
	 * Register AJAX handling actions for user login form
	 */
//	add_filter( 'retrieve_password_message', array( new G2hr_User_Psw_Reset(), 'replace_retrieve_password_message' ), 10, 4 );
	
	add_action( 'wp_ajax_nopriv_g2hruserpswreset', array(new G2hr_User_Psw_Reset(), 'reset') );
	add_action( 'wp_ajax_g2hruserpswreset', array(new G2hr_User_Psw_Reset(), 'reset') );

	add_action( 'wp_ajax_nopriv_g2hruserpswchange', array(new G2hr_User_Psw_Reset(), 'change') );
	add_action( 'wp_ajax_g2hruserpswchange', array(new G2hr_User_Psw_Reset(), 'change') );

	add_action ('wp_loaded', 'check_password_reset_tokens');

	/**
	 * Custom helper functions
	 */
	
	function check_password_reset_tokens() {
		if(!is_user_logged_in() || !is_page('password-reset')) return;
		
		$psw_reset = new G2hr_User_Psw_Reset();
		$psw_reset->check_password_reset_tokens();
	}