<?php

/** This will block non-administrators from accessing your WordPress site's backend */
function blockusers_init() {
    if ( is_admin() && ! current_user_can( 'administrator' ) && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
        wp_redirect( home_url('dashboard') );
        exit;
    }
}
add_action( 'init', 'blockusers_init' );

/**
 * Job expiration
 */
function job_check_expiry ($post_id) {
    $post = get_post($post_id);

    // To prevent from sending email to the users, if you want to test it, be careful to do checking the account is yours or not
    if ($post->post_type === 'go2hr_jobs' && $post->post_status === 'publish') {

        $datePosted = $post->post_date;

        $dateToExpire = new DateTime($datePosted);

        $dateToExpire->add(new DateInterval('P60D'));

        $expiryTimestamp = $dateToExpire->getTimestamp();

        // If a CRON job exists with this post_id them remove it
        wp_clear_scheduled_hook( 'expire_job_event', array( $post_id ) );

        // Add the new CRON job to run the day after the event with the post_id as an argument
        wp_schedule_single_event( $expiryTimestamp , 'expire_job_event', array( $post_id ) );
    }
}

// Hook into the save_post_{post-type} function to create/update the cron job everytime an job is saved.
add_action( 'save_post', 'job_check_expiry', 20 );

// Hook into the make_post_event CRON job so that the sent_past_event_category function runs when the CRON job is fired.
add_action( 'expire_job_event', 'expire_job_action', 1, 1);
add_action( 'expire_job_event_email', 'expire_job_action_email', 1, 2);

function expire_job_action($post_id) {
  $query = array(
    'ID' => $post_id,
    'post_status' => 'job_expired',
  );

  wp_update_post( $query, true );
}

/**
 * Send email to users 27 days after event has been modified.
 *
 * @param $post_id
 * @param $user_id
 */
function expire_job_action_email($post_id, $user_id) {
  $template = get_email_template('nofity_user_job_expire_soon');

  //Get User Info
  $user = get_user_by('ID', $user_id);

  //Get Post ID
  $post = get_post($post_id);
  $title = $post->post_title;
  $permalink = get_permalink($post_id);

  //Get Jobs link
  $base_url = get_site_url();
  $jobs_link = $base_url . '/dashboard/my-jobs';

  //Prep the content
  $content = sprintf(wpautop($template->post_content), $title, $permalink, $jobs_link);

  //Prep the HTML
  $html = pack_html($template->post_title, $content);

  send($user->data->user_email, $template->post_title, $html);
}

function set_adminbar( $adminbar ) {
    return $adminbar;
}
if (!current_user_can('administrator')){
    show_admin_bar(false);
}

add_filter( 'show_admin_bar', 'set_adminbar' );


function init_common_scripts() {

    wp_register_style('g2hr-confirm', get_template_directory_uri() . '/dashboard/assets/css/jquery-confirm.css');
    wp_register_script('g2hr-confirm', get_template_directory_uri() . '/dashboard/assets/js/jquery-confirm.min.js', array('jquery-file'));

    wp_enqueue_script('g2hr-jobs');
    wp_enqueue_style('g2hr-confirm');
    wp_enqueue_style( 'account', get_template_directory_uri() . '/dashboard/assets/css/account.css');

    wp_enqueue_script('g2hr-dashboard', get_template_directory_uri() . '/dashboard/assets/js/dashboard.js', array('jquery-file', 'g2hr-confirm'));

    wp_localize_script( 'g2hr-dashboard', 'g2hr_dashboard_object', array(
        'ajax_url'        => admin_url( 'admin-ajax.php' ),
        'redirect_url'    => site_url('login'),
        'nonce'           => wp_create_nonce('g2hr_dashboard')
    ));
}

add_action('wp_enqueue_scripts', 'init_common_scripts');

function check_access_rights() {
    if ((is_page() && \Go2Hr\Helpers\Dashboard\is_child_of('dashboard')) || is_page('dashboard')) {
        \Go2Hr\Helpers\Dashboard\check_access_rights();
    }
}
add_action( 'wp', 'check_access_rights' );

$includes = [
    'dashboard/lib/customizer.php',
    'dashboard/lib/system-events/class-system-events.php',
    'dashboard/lib/system-events/class-events-trigger.php',
    'dashboard/lib/system-events/helper-system-events.php',

    'custom-post-types/class-cpt-email-templates.php',
    // TODO delete it after Andres migrated
    'dashboard/lib/custom-post-types/class-cpt-users.php',

    'dashboard/lib/dashboard/class-dashboard.php',
    'dashboard/lib/dashboard/helper-dashboard.php',
    'dashboard/lib/company-registration/class-company-registration.php',
    'dashboard/lib/company-registration/helper-company-registration.php',
    'dashboard/lib/company-profile/class-company-profile.php',
    'dashboard/lib/company-profile/helper-company-profile.php',

    'dashboard/lib/jobs/class-jobs.php',
    'dashboard/lib/jobs/helper-jobs.php',

    'dashboard/lib/user-registration/class-user-registration.php',
    'dashboard/lib/user-registration/helper-user-registration.php',
    'dashboard/lib/user-profile/class-user-profile.php',
    'dashboard/lib/user-profile/helper-user-profile.php',
    'dashboard/lib/account-setting/class-account-setting.php',
    'dashboard/lib/account-setting/helper-account-setting.php',
    'dashboard/lib/user-login/class-user-login.php',
    'dashboard/lib/user-login/helper-user-login.php',
    'dashboard/lib/user-password-reset/class-password-reset.php',
    'dashboard/lib/user-password-reset/helper-password-reset.php',

    'dashboard/lib/user-list/class-user-list.php',
    'dashboard/lib/user-list/helper-user-list.php',
    'dashboard/lib/subuser-registration/class-subuser-registration.php',
    'dashboard/lib/subuser-registration/helper-subuser-registration.php',
    'dashboard/lib/subuser-list/helper-subuser-list.php',
    'dashboard/lib/subuser-invite/class-subuser-invitation.php',
    'dashboard/lib/subuser-invite/helper-subuser-invite.php',
    'dashboard/lib/subuser-profile/class-subuser-profile.php',
    'dashboard/lib/subuser-profile/helper-subuser-profile.php',

    'dashboard/lib/filters.php'
];

foreach ($includes as $file) {
    if (!$filepath = locate_template($file)) {
        trigger_error("", E_USER_ERROR);
    }
    require_once $filepath;
}

