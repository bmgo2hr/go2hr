<?php
	/**
	 * User Registration Helper
	 *
	 * Hooks, helper functions
	 */

	namespace Go2HR\Helpers\UserRegistration;
//	use Roots\Sage\Wrapper;

	/**
	 * Register AJAX handling actions for user login form
	 */
	add_action( 'wp_ajax_nopriv_g2hruserregister', array(new \G2hr_User_Registration(), 'register') );
	add_action( 'wp_ajax_g2hruserregister', array(new \G2hr_User_Registration(), 'register') );

	add_action( 'wp_ajax_nopriv_g2hrusermailcheck', array(new \G2hr_User_Registration(), 'check_email') );
	add_action( 'wp_ajax_g2hrusermailcheck', array(new \G2hr_User_Registration(), 'check_email') );

	add_action( 'wp_ajax_nopriv_g2hrusernamecheck', array(new \G2hr_User_Registration(), 'check_username') );
	add_action( 'wp_ajax_g2hrusernamecheck', array(new \G2hr_User_Registration(), 'check_username') );

	/** For Company Logo when a user registering **/
	add_action( 'wp_ajax_nopriv_g2hrcompanylogoupload', array(new \G2hr_Company_Registration(), 'logo_upload') );
	add_action( 'wp_ajax_g2hrcompanylogoupload', array(new \G2hr_Company_Registration(), 'logo_upload') );

	/**
	 * Register System Events
	 */
	\G2hr_System_Events::getInstance()->add("user_activation", 'notify_user_activation');
	\G2hr_System_Events::getInstance()->add("user_activation_finished", 'notify_admin_user_activation');

	/**
	 * Helper functions
	 */

	/**
	 * Retrieves terms for Occupation taxonomy
	 * @return  object
	 */
	function get_user_occupations() {
		$user_reg = new \Go2hr_Users_Core();
		$occupations = $user_reg->get_occupations();

		return $occupations;
	}

	/**
	 * Retrieves terms for Country taxonomy
	 * @return  object
	 */
	function get_user_countries() {
		$user_reg = new \Go2hr_Users_Core();
		$countries = $user_reg->get_countries();

		$mycountries = array();
		array_push($mycountries, $countries[0]);
		for($i = 0; $i < count($countries); $i++) {
			if($countries[$i]->official_name == 'Canada') {
				$mycountries[0] = $countries[$i];
			}else{
				array_push($mycountries, $countries[$i]);
			}
		}

		return $mycountries;
	}

	/**
	 * Retrieves terms for Sector taxonomy
	 * @return  object
	 */
	function get_user_sectors() {
		$user_reg = new \Go2hr_Users_Core();
		$occupations = $user_reg->get_sectors();

		return $occupations;
	}

	/**
	 * UUIDv4 generator
	 * @param   string     $data
	 * @return  string
	 */
	function guidv4($data) {
	    assert(strlen($data) == 16);

	    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
	    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

	    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}

	/**
	 * Helper function for activation token check
	 * @param   string     $key Activation key
	 * @return  boolean
	 */
	function check_registration_activation_tokens($key) {
		$user_reg = new \Go2hr_Users_Core();

		$activation = $user_reg->activate_user_account($key);

		if (!$activation) return false;

		return true;
	}
