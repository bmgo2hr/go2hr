<?php
/**
 * Subser Registration Helper
 */

/**
 * Register AJAX handling actions for user login form
 */
add_action( 'wp_ajax_nopriv_g2hrsubuserregister', array(new G2hr_Subuser_Registration(), 'register') );
add_action( 'wp_ajax_g2hrsubuserregister', array(new G2hr_Subuser_Registration(), 'register') );

add_action( 'wp_ajax_nopriv_g2hrsubusermailcheck', array(new G2hr_Subuser_Registration(), 'check_email') );
add_action( 'wp_ajax_g2hrsubusermailcheck', array(new G2hr_Subuser_Registration(), 'check_email') );

add_action( 'wp_ajax_nopriv_g2hrsubusernamecheck', array(new G2hr_Subuser_Registration(), 'check_username') );
add_action( 'wp_ajax_g2hrsubusernamecheck', array(new G2hr_Subuser_Registration(), 'check_username') );

/**
 * Register System Events
 */
\G2hr_System_Events::getInstance()->add("subuser_registration", 'notify_subuser_account_registered');
\G2hr_System_Events::getInstance()->add("subuser_registration_admin", 'notify_admin_subuser_account_registered');
