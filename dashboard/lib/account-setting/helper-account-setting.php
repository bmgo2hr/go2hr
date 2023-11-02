<?php
    /**
     * User Registration Helper
     *
     * Hooks, helper functions
     */
    namespace Go2HR\Helpers\AccountSetting;

    /**
     * Register AJAX handling actions for user login form
     */
    add_action( 'wp_ajax_nopriv_g2hruseraccountsettingupdate', array(new \G2hr_Account_Setting(), 'update') );
    add_action( 'wp_ajax_g2hraccountsettingupdate', array(new \G2hr_Account_Setting(), 'update') );

    /**
     * Returns information about current user
     * @return  array
     */
    function get_user_profile() {
        $g2hr_user = new \Go2hr_Users_Core(get_current_user_id());
        $user = $g2hr_user->get_user();

        return $user;
    }

    /**
     * Function returns Company ID ffor currently logged in user
     * @return  int
     */
    function get_user_company() {
        return get_user_meta(get_current_user_id(), 'user_company');
    }

    function is_user_owner($id = false) {
        $user_id = ($id !== FALSE) ? $id : get_current_user_id();

        $g2hr_user = new \Go2hr_Users_Core($user_id);

        return $g2hr_user->is_owner();
    }

    function is_user_subuser($id = false) {
        $user_id = ($id !== FALSE) ? $id : get_current_user_id();

        $g2hr_user = new \Go2hr_Users_Core($user_id);

        return $g2hr_user->is_subuser();
    }
    function is_user_employee($id = false) {
        $user_id = ($id !== FALSE) ? $id : get_current_user_id();

        $g2hr_user = new \Go2hr_Users_Core($user_id);

        return $g2hr_user->is_employee();
    }

    function is_user_job_seeker($id = false) {
        $user_id = ($id !== FALSE) ? $id : get_current_user_id();

        $g2hr_user = new \Go2hr_Users_Core($user_id);

        return $g2hr_user->is_job_seeker();
    }

    function get_user_statuses() {
        $g2hr_user = new \Go2hr_Users_Core();

        return $g2hr_user->get_status_terms();
    }
