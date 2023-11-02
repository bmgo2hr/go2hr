<?php
    /**
     * Dashboard functions & helpers
     */
    namespace Go2Hr\Helpers\Dashboard;
    use Go2HR\Helpers\UserProfile;
    use G2hr_Dashboard;

    add_action( 'wp_ajax_nopriv_g2hrlogout', array(new G2hr_Dashboard(), 'logout') );
    add_action( 'wp_ajax_g2hrlogout', array(new G2hr_Dashboard(), 'logout') );

    /**
     * Function used to determine if the current page is the child page of the Dashboard
     * @param   mixed     $page_id_or_slug ID / String
     * @return  boolean
     */
    function is_child_of( $page_id_or_slug ) {
        global $post;

        if ( !is_numeric( $page_id_or_slug ) ) {
            $page = get_page_by_path( $page_id_or_slug );
            $page_id_or_slug = $page->ID;
        }

        $ancestors = array_reverse(get_post_ancestors($post->ID));

        if ( is_page() && ( in_array($page_id_or_slug, $ancestors)  ) )
            return true;
        else
            return false;
    };

    /**
     * This function redirects user if he is trying to access various parts of the Dashboard but is not logged in!
     */
    function check_access_rights() {
        global $current_user;

        $requested_uri = $_SERVER['REQUEST_URI'];
        if ($current_user->ID == 0) {
            wp_redirect('/login/?redirect_to=' . $requested_uri);
            exit();
        }

        $roles = get_userdata($current_user->ID)->roles;

        if (is_page(['my-users', 'add-sub-user', 'modify-sub-user', 'my-company']) && (!UserProfile\is_user_owner() && !in_array('administrator', $roles)) ) {
            wp_redirect(site_url('login'));
            exit();
        } else {
//            if(is_page(['add-event','add-job','modify-event','modify-job']) && UserProfile\is_user_employee()){
//                wp_redirect(site_url('permission-denied'));
//                exit();
//            }

            if (is_user_logged_in()) return;

            wp_redirect('/login/?redirect_to=' . $requested_uri);
            exit();
        }
    }

    function get_user_posted_job_num() {
        return get_user_meta(get_current_user_id(), 'user_job_posted_num')[0] ?? 0;
    }

    function get_user_added_user_num() {
        return get_user_meta(get_current_user_id(), 'user_added_user_num')[0] ?? 0;
    }
