<?php
    /**
     * Helper Functions for Sub User Invitation system
     */

    namespace Go2HR\Helpers\SubUserInvite;

    /**
     * Register AJAX handling actions for the form
     */
    add_action( 'wp_ajax_nopriv_g2hrsubuserinvitemailcheck', array(new \G2hr_Subuser_Invitation(), 'check_email') );
    add_action( 'wp_ajax_g2hrsubuserinvitemailcheck', array(new \G2hr_Subuser_Invitation(), 'check_email') );

    add_action( 'wp_ajax_nopriv_g2hrsubuserinvite', array(new \G2hr_Subuser_Invitation(), 'invite') );
    add_action( 'wp_ajax_g2hrsubuserinvite', array(new \G2hr_Subuser_Invitation(), 'invite') );

    add_action( 'wp_ajax_nopriv_g2hrsubuserinviteconfirm', array(new \G2hr_Subuser_Invitation(), 'confirm') );
    add_action( 'wp_ajax_g2hrsubuserinviteconfirm', array(new \G2hr_Subuser_Invitation(), 'confirm') );

    add_action( 'wp_ajax_nopriv_g2hrsubuserinvitecancel', array(new \G2hr_Subuser_Invitation(), 'cancel') );
    add_action( 'wp_ajax_g2hrsubuserinvitecancel', array(new \G2hr_Subuser_Invitation(), 'cancel') );

    add_action( 'wp_ajax_nopriv_g2hrsubuserinvitedecline', array(new \G2hr_Subuser_Invitation(), 'decline') );
    add_action( 'wp_ajax_g2hrsubuserinvitedecline', array(new \G2hr_Subuser_Invitation(), 'decline') );

    add_action( 'wp_ajax_nopriv_g2hrsubuserinviteapply', array(new \G2hr_Subuser_Invitation(), 'apply') );
    add_action( 'wp_ajax_g2hrsubuserinviteapply', array(new \G2hr_Subuser_Invitation(), 'apply') );

    /**
     * Register System Events
     */
    \G2hr_System_Events::getInstance()->add("subuser_invited", 'notify_user_invited');
    \G2hr_System_Events::getInstance()->add("subuser_applied", 'notify_company_applied');
    \G2hr_System_Events::getInstance()->add("application_accepted", 'notify_user_application_accepted');
    \G2hr_System_Events::getInstance()->add("invitation_accepted", 'notify_company_invitation_accepted');
    \G2hr_System_Events::getInstance()->add("user_company_application", 'notify_company_application_user');
    \G2hr_System_Events::getInstance()->add("subuser_application_declined", 'notify_user_application_declined');

    /**
     * Returns a list of invitations and applications for currently logged in company owner
     * @return  array
     */
    function get_invited_sub_users() {
        $company_id = get_field('user_company', 'user_' . get_current_user_id());
        $g2hr_company = new \Go2hr_Companies_Core($company_id);

        return $g2hr_company->get_invitations();
    }

    /**
     * Returns information about single Invitation. Used in the process of reviewing the Invitation by sub user.
     * @param   string     $token Invitation Token
     * @return  mixed
     */
    function get_invitation($token) {
        $g2hr_company = new \Go2hr_Companies_Core();

        return $g2hr_company->get_invitation($token);
    }

