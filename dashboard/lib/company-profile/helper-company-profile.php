<?php
	/**
	 * Company Registration Helper
	 *
	 * Hooks, helper functions
	 */

	namespace Go2HR\Helpers\CompanyProfile;

	/**
	 * Register AJAX handling actions for user login form
	 */
	add_action( 'wp_ajax_nopriv_g2hrcompanyprofileupdate', array(new \G2hr_Company_Profile(), 'update') );
	add_action( 'wp_ajax_g2hrcompanyprofileupdate', array(new \G2hr_Company_Profile(), 'update') );

	add_action( 'wp_ajax_nopriv_g2hrcompanylogoupdate', array(new \G2hr_Company_Profile(), 'logo_upload') );
	add_action( 'wp_ajax_g2hrcompanylogoupdate', array(new \G2hr_Company_Profile(), 'logo_upload') );

	add_action( 'wp_ajax_nopriv_g2hrcompanylocationsupdate', array(new \G2hr_Company_Profile(), 'update_locations') );
	add_action( 'wp_ajax_g2hrcompanylocationsupdate', array(new \G2hr_Company_Profile(), 'update_locations') );

	add_action( 'wp_ajax_nopriv_g2hrcompanymanagementupdate', array(new \G2hr_Company_Profile(), 'update_management_rights') );
	add_action( 'wp_ajax_g2hrcompanymanagementupdate', array(new \G2hr_Company_Profile(), 'update_management_rights') );

	add_action( 'wp_ajax_nopriv_g2hrcompanyfeaturedpurchase', array(new \G2hr_Company_Profile(), 'purchase_featured_status') );
	add_action( 'wp_ajax_g2hrcompanyfeaturedpurchase', array(new \G2hr_Company_Profile(), 'purchase_featured_status') );


	/**
	 * Register System Events
	 */
	\G2hr_System_Events::getInstance()->add("company_job_rights_assigned", 'notify_hr_company_asssigned');
	\G2hr_System_Events::getInstance()->add("company_job_rights_removed", 'notify_hr_company_removed');
	\G2hr_System_Events::getInstance()->add("company_profile_updated", 'notify_admin_company_profile_update');

	/**
	 * Helper function which returns a complete company profile including meta fields
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-08-04
	 * @version 1.0.0
	 * @return  array
	 */
	function get_company_profile() {
		$g2hr_company = new \Go2hr_Companies_Core();



		$company_id = $g2hr_company->get_company_by_owner(get_current_user_id());

		if(!$company_id) return;

		$g2hr_company->set_id($company_id[0]);

		return $g2hr_company->get_company();
	}

	/**
	 * Small helper function which returns array with all company locations
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-08-05
	 * @version 1.0.0
	 * @param   int     $company_id Company ID
	 * @return  array
	 */
	function get_company_locations($company_id) {
		return get_field('company_locations', $company_id);
	}

	/**
	 * Helper function that checks if company profile is approved
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-08-07
	 * @version 1.0.0
	 * @return  boolean
	 */
	function is_company_active() {
		$company_id = get_field('user_company', 'user_' . get_current_user_id());
		$g2hr_company = new \Go2hr_Companies_Core(is_object($company_id) ? $company_id->ID : $company_id);

		return $g2hr_company->is_active();
	}

	function does_company_exist() {
		$company_id = get_field('user_company', 'user_' . get_current_user_id());

		//var_dump($company_id);
		$g2hr_company = new \Go2hr_Companies_Core(is_object($company_id) ? $company_id->ID : $company_id);

		return $g2hr_company->exists(); //jeremy change
	}

	/**
	 * A simple helepr function that returns information about company type
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-08-09
	 * @version 1.0.0
	 * @return  boolean
	 */
	function is_hr() {
		$company_id = get_field('user_company', 'user_' . get_current_user_id());
		$g2hr_company = new \Go2hr_Companies_Core(is_object($company_id) ? $company_id->ID : $company_id);

		return $g2hr_company->is_hr();
	}

	/**
	 * Returns a list of companies managed by HR company
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-08-09
	 * @version 1.0.0
	 */
	function get_managed_companies() {
		$company_id = get_field('user_company', 'user_' . get_current_user_id());

		$g2hr_company = new \Go2hr_Companies_Core(is_object($company_id) ? $company_id->ID : $company_id);
		$managed = $g2hr_company->get_managed_companies();

		return $managed->posts;
	}

	/**
	 * Used to determine if company passed HR rights to some other company
	 * @author Igor Hrcek (igor.hrcek@mint.rs)
	 * @date    2017-08-09
	 * @version 1.0.0
	 * @return  boolean
	 */
	function is_managed() {
		$company_id = get_field('user_company', 'user_' . get_current_user_id());
		$g2hr_company = new \Go2hr_Companies_Core(is_object($company_id) ? $company_id->ID : $company_id);

		return $g2hr_company->is_managed();
	}
