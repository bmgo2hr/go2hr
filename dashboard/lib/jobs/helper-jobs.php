<?php
    /**
     * Jobs Helper
     *
     * Hooks, helper functions
     */

    namespace Go2HR\Helpers\Jobs;

    /**
     * Register AJAX handling actions for jobs form
     */
    add_action( 'wp_ajax_nopriv_g2hrjobadd', array(new \G2hr_Jobs(), 'add') );
    add_action( 'wp_ajax_g2hrjobadd', array(new \G2hr_Jobs(), 'add') );

    add_action( 'wp_ajax_nopriv_g2hrjobdraft', array(new \G2hr_Jobs(), 'draft') );
    add_action( 'wp_ajax_g2hrjobdraft', array(new \G2hr_Jobs(), 'draft') );

    add_action( 'wp_ajax_nopriv_g2hrjobpreview', array(new \G2hr_Jobs(), 'preview') );
    add_action( 'wp_ajax_g2hrjobpreview', array(new \G2hr_Jobs(), 'preview') );

    add_action( 'wp_ajax_nopriv_g2hrjobpublish', array(new \G2hr_Jobs(), 'publish') );
    add_action( 'wp_ajax_g2hrjobpublish', array(new \G2hr_Jobs(), 'publish') );

    add_action( 'wp_ajax_nopriv_g2hrjobmodify', array(new \G2hr_Jobs(), 'modify') );
    add_action( 'wp_ajax_g2hrjobmodify', array(new \G2hr_Jobs(), 'modify') );

    add_action( 'wp_ajax_nopriv_g2hrjobupdate', array(new \G2hr_Jobs(), 'update') );
    add_action( 'wp_ajax_g2hrjobupdate', array(new \G2hr_Jobs(), 'update') );

    add_action( 'wp_ajax_nopriv_g2hrjobdeactivate', array(new \G2hr_Jobs(), 'deactivate') );
    add_action( 'wp_ajax_g2hrjobdeactivate', array(new \G2hr_Jobs(), 'deactivate') );

    add_action( 'wp_ajax_nopriv_g2hrjobrenew', array(new \G2hr_Jobs(), 'renew') );
    add_action( 'wp_ajax_g2hrjobrenew', array(new \G2hr_Jobs(), 'renew') );

    add_action( 'wp_ajax_nopriv_g2hrjobarchive', array(new \G2hr_Jobs(), 'archive') );
    add_action( 'wp_ajax_g2hrjobarchive', array(new \G2hr_Jobs(), 'archive') );

    add_action( 'wp_ajax_nopriv_g2hrjobdelete', array(new \G2hr_Jobs(), 'delete') );
    add_action( 'wp_ajax_g2hrjobdelete', array(new \G2hr_Jobs(), 'delete') );

    /**
     * Register System Events
     */
    \G2hr_System_Events::getInstance()->add("job_required_validation", 'notify_admin_job_validation');
    \G2hr_System_Events::getInstance()->add("job_is_approved", 'notify_user_job_approved');
    \G2hr_System_Events::getInstance()->add("job_has_expired", 'notify_user_job_expired');
    \G2hr_System_Events::getInstance()->add("job_is_republished", 'notify_admin_job_republished');
    \G2hr_System_Events::getInstance()->add("job_is_unpublished", 'notify_admin_job_unpublished');

    /**
     * Helper functions
     */

    /**
     * Helper function for finding out if the currently logged in company is HR company
     * @return  boolean
     */
    function is_hr_company() {
        $g2hr_company = new \Go2hr_Companies_Core();
        $company_id = $g2hr_company->get_company_by_owner(get_current_user_id());
        $g2hr_company->set_id($company_id[0]);

        return $g2hr_company->is_hr();
    }

    /**
     * Returns a list of region terms
     * @return  array
     */
    function get_job_regions() {
        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_region_terms();
    }

    /**
     * Returns a list of status terms
     * @return  array
     */
    function get_job_statuses() {
        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_status_terms();
    }

  /**
   * Returns a list training options
   * @return  array
   */
  function get_job_training() {
    $g2hr_jobs = new \Go2hr_Jobs_Core();

    return $g2hr_jobs->get_training_options();
  }

    /**
     * Returns a list of type terms
     * @return  array
     */
    function get_job_types() {
        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_type_terms();
    }

    /**
     * Returns a list of secto terms
     * @return  array
     */
    function get_job_sectors() {
        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_sector_terms();
    }

    /**
     * Returns a list of level terms
     * @return  array
     */
    function get_job_levels() {
        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_level_terms();
    }

    /**
     * Returns a list of province terms
     * @return \stdClass
     */
    function get_job_provinces() {
        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_province_terms();
    }

    /**
     * Returns a list of jobs owned by one company. The company is determined by currently logged in user.
     * @return  array
     */
    function get_company_jobs($status = false) {
        $g2hr_company = new \Go2hr_Companies_Core();
        $company_id = $g2hr_company->get_company_by_owner(get_current_user_id());

        $g2hr_jobs = new \Go2hr_Jobs_Core();

        //write_log($g2hr_jobs->get_company_jobs($company_id[0], $status));

        return $g2hr_jobs->get_company_jobs($company_id[0], $status);
    }

    /**
     * Returns a list of jobs managed by HR company. The HR company is determined by currently logged in user.
     * @return  array
     */
    function get_hr_company_jobs($status = false) {
        $g2hr_company = new \Go2hr_Companies_Core();
        $company_id = $g2hr_company->get_company_by_owner(get_current_user_id());

        $g2hr_jobs = new \Go2hr_Jobs_Core();

        return $g2hr_jobs->get_hr_company_jobs($company_id[0], $status);
    }

    /**
     * Returns information about single job
     * @param   string     $fid Fake Job ID
     * @return  array
     */
    function get_company_job($fid) {
        $g2hr_jobs = new \Go2hr_Jobs_Core();
        $g2hr_jobs->set_id($g2hr_jobs->get_job_id_by_fid($fid));

        return $g2hr_jobs->get_job();
    }

    /**
     * Returns HTML drop-down select options
     * @param string $val option value
     * @param string $label option label
     * @param string $selected selected value
     * @return string
     */
    function get_select_option_list($val="",$label="",$selected=""){
        $string = '<option value="'.$val.'"';
        if(!empty($selected) && !empty($val) && htmlspecialchars_decode($val) == $selected){
            $string .= ' selected';
        }
        $string .= '>'.$label.'</option>';
        return $string;
    }

    /**
     * This function changes the default value of number of posts per page for Jobs custom post type
     * @param   object     $query WP Query instance
     */
    function jobs_per_page($query) {
    if(isset($query->query_vars['post_type'])) {
      if ($query->query_vars['post_type'] == 'go2hr_jobs')
        $query->set('posts_per_page', 20);
    }
    }

    /**
     * This function is necessary because we are using custom statuses, and they are not used in the loop by default (by default the Publish is used). Since we have a replacement for the Publish, we need to modify the WP Query post_status and set a proper status to be used in a query.
     * @version 1.0.0
     * @param   object     $query WP Query instance
     */
    function jobs_listing($query) {
        if(isset($query->query_vars['post_type'])) {
          if ($query->query_vars['post_type'] == 'go2hr_jobs' && is_archive('go2hr_jobs')) {
            $query->set('post_status', 'publish');
          }
        }
    }

    /**
     * This function returns a number of active job posts per taxonomy
     * @param   string     $name Taxonomy name
     * @return  array
     */
    function get_job_count_per_term($name) {
        $terms = get_terms(array(
            'taxonomy'         => $name,
            'hide_empty'    =>    false
        ) );

        if(empty($terms) && is_wp_error($terms)) return 0;

        return $terms;
    }
