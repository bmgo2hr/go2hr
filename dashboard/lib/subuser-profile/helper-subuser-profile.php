<?php
	/**
	 * Subser Profile Helper
	 *
	 * Hooks, helper functions
	 */

	use Roots\Sage\Wrapper;

	/**
	 * Register AJAX handling actions for user login form
	 */
	add_action( 'wp_ajax_nopriv_g2hrsubuserprofileupdate', array(new G2hr_Subuser_Profile(), 'update') );
	add_action( 'wp_ajax_g2hrsubuserprofileupdate', array(new G2hr_Subuser_Profile(), 'update') );

	add_action( 'wp_ajax_nopriv_g2hrsubuserprofilusernamecheck', array(new G2hr_Subuser_Profile(), 'check_username') );
	add_action( 'wp_ajax_g2hrsubuserprofilusernamecheck', array(new G2hr_Subuser_Profile(), 'check_username') );

	add_action( 'wp_ajax_nopriv_g2hrsubuserprofilemailcheck', array(new G2hr_Subuser_Profile(), 'check_email') );
	add_action( 'wp_ajax_g2hrsubuserprofilemailcheck', array(new G2hr_Subuser_Profile(), 'check_email') );

	function get_subuser_by_fid($fid) {
		$g2hr_users = new Go2hr_Users_Core();

		return $g2hr_users->get_subuser($fid);
	}
