<?php
	/**
	 * Company Registration Helper
	 *
	 * Hooks, helper functions
	 */

	namespace Go2HR\Helpers\CompanyRegistration;
	use Go2HR\Helpers\UserProfile;

	/**
	 * Register AJAX handling actions for user login form
	 */
	add_action( 'wp_ajax_nopriv_g2hrcompanyregister', array(new \G2hr_Company_Registration(), 'register') );
	add_action( 'wp_ajax_g2hrcompanyregister', array(new \G2hr_Company_Registration(), 'register') );

	add_action( 'wp_ajax_nopriv_g2hrcompanylogoupload', array(new \G2hr_Company_Registration(), 'logo_upload') );
	add_action( 'wp_ajax_g2hrcompanylogoupload', array(new \G2hr_Company_Registration(), 'logo_upload') );

	add_action( 'wp_ajax_nopriv_g2hruserpostalcodecheck', array(new \G2hr_Company_Registration(), 'postcode_check') );
	add_action( 'wp_ajax_g2hruserpostalcodecheck', array(new \G2hr_Company_Registration(), 'postcode_check') );

	/**
	 * Register System Events
	 */
	\G2hr_System_Events::getInstance()->add("company_registration", 'notify_user_company_registration');
	\G2hr_System_Events::getInstance()->add("company_registration_admin", 'notify_admin_company_registration');
	\G2hr_System_Events::getInstance()->add("company_approved", 'notify_user_company_approved');

	/**
	 * PDF Download
	 */
	// if( !is_user_logged_in() || (is_user_logged_in() && ( UserProfile\is_user_job_seeker() == false || UserProfile\is_user_owner() == false ) ) ) {
	// 	add_action('template_redirect', __NAMESPACE__ . '\\determine_access_rights');
	// }

	/**
	 * Retrieves terms for Country taxonomy
	 * @return  object
	 */
	function get_company_countries() {
		$company_reg = new \Go2hr_Companies_Core();
		$countries = $company_reg->get_countries();

		return $countries;
	}

	/**
	 * Helper function for getting a list of company regions
	 * @return  array
	 */
	function get_company_regions() {
		$company_reg = new \Go2hr_Companies_Core();
		$regions = $company_reg->get_region_terms();

		return $regions;
	}

	/**
	 * Helper function for getting a list of company sizes
	 * @return  array
	 */
	function get_company_sizes() {
		$company_reg = new \Go2hr_Companies_Core();
		$sizes = $company_reg->get_size_terms();

		return $sizes;
	}

	/**
	 * Helper function for getting a list of company types
	 * @return  array
	 */
	function get_company_types() {
		$company_reg = new \Go2hr_Companies_Core();
		$types = $company_reg->get_type_terms();

		return $types;
	}

	/**
	 * Helper function for getting a list of company sectors
	 * @return  array
	 */
	function get_company_sectors() {
		$company_reg = new \Go2hr_Companies_Core();
		$sectors = $company_reg->get_sector_terms();

		return $sectors;
	}

	/**
	 * Helper function for getting a list of company provinces
	 * @return  array
	 */
	function get_company_provinces() {
		$company_reg = new \Go2hr_Companies_Core();
		$sectors = $company_reg->get_province_terms();

		return $sectors;
	}
