<?php
/**
 * Custom filters and actions
 */

//    use G2Hr\Helpers\Awu;
//    use G2Hr\Helpers\ContactUs;
//    use Go2HR\Helpers\Events;
//    use Go2Hr\Helpers\Dfp;

add_filter('g2hr_set_page_attributes','g2hr_set_page_attributes');

/**
 * Used for gradual initialization of separate theme components.
 * @param   string     $attr
 */
function g2hr_set_page_attributes($attr) {
    global $post;

    if (is_page('login')) {

        $user_login = new G2hr_User_Login();
        $user_login->init_ajax_login();

    } elseif (is_page('password-reset')) {
        $user_preset = new G2hr_User_Psw_Reset();
        if(!isset($_GET['key']) && !isset($_GET['login'])) {
            $user_preset->init_ajax_psw_reset();
        } else {
            $user_preset->init_ajax_psw_change();
        }

    } else if(is_page('register')) {
        $user_reg = new G2hr_User_Registration();
        $user_reg->init_ajax_registration();

    } else if(is_page('register-company')) {
        $company_reg = new G2hr_Company_Registration();
        $company_reg->init_ajax_registration();

    } else if(is_page('my-profile')) {
        $user_profile = new G2hr_User_Profile();
        $user_profile->init_ajax_update();

    } else if (is_page('account-setting')) {
        (new G2hr_Account_Setting())->init_ajax_update();

    } else if(is_page('my-company')) {
        (new G2hr_Company_Profile())->init_ajax_update();

    } else if(is_page('add-sub-user')) {
        (new G2hr_Subuser_Registration())->init_ajax_registration();

    } else if(is_page('modify-sub-user')) {
        (new G2hr_Subuser_Profile())->init_ajax_profile();

    } else if(is_page('my-users')) {
        (new G2hr_User_List())->init_ajax_list();

    } else if(is_page('add-job') || is_page('my-jobs') || is_parent_my_jobs($post) || is_singular( 'go2hr_jobs' )) {
        (new G2hr_Jobs())->init_ajax_add();

    } else if(is_page('modify-job')) {
        (new G2hr_Jobs())->init_ajax_update();

    }
}

function is_parent_my_jobs($post) {
    $parent_id = wp_get_post_parent_id( $post->ID );
    $parent_post = get_post($parent_id);
    return $parent_post->post_title === "My Jobs" || $parent_id === 404 ? true : false;
}
