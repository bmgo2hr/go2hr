<?php
    /**
     * System Event Functions
     */

    namespace Go2Hr\Helpers\SystemEvents;

    /**
     * Monitor for Post status changes
     */
    add_action( 'transition_post_status', __NAMESPACE__ . '\\monitor_post_transition', 20, 3 );

    /**
     * This function monitors changes in post statuses. It is quite essential part of the system because on each post status change, we deliver notifications to users and admins.
     * Without this function, Job, Event, Company and Invoice transitions would go unnoticed.
     * @param   string     $new_status New Post status
     * @param   string     $old_status Old Post status
     * @param   object     $post       WP Post object
     */
    function monitor_post_transition($new_status, $old_status, $post) {
        $type = get_post_type($post);

        if(wp_is_post_revision($post->ID) || wp_is_post_autosave($post->ID)) return;

        if($type == 'go2hr_companies' && $new_status == 'company_active' && $old_status == 'company_unvalidated') {
            \G2hr_System_Events::getInstance()->trigger("company_approved", array('post' => $post));
            return;
        }

        if($type == 'go2hr_jobs' && $new_status == 'job_expired' && $old_status == 'publish') {
//            \G2hr_System_Events::getInstance()->trigger("job_has_expired", array('post' => $post));
//            return;
        }

    }


