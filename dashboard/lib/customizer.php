<?php

//namespace Roots\Sage\Customizer;

//use Roots\Sage\Assets;
//use Go2HR\Helpers\Services;

/**
 * Customizer JS
 */
//function customize_preview_js() {
//  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
//}
//add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');

/**
 * Add postMessage support
 *
 * @param $wp_customize
 */
function customize_register($wp_customize)
{
  $wp_customize->add_section('go2hr_settings', array(
    'title'    => __('Theme Settings', 'go2hr'),
    'priority' => 30,
  ));

  $wp_customize->add_setting('header_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'header_logo', array(
    'label'    => esc_html__('Header Logo', 'go2hr'),
    'section'  => 'go2hr_settings',
  )));

  $wp_customize->add_setting('footer_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
    'label'    => esc_html__('Footer Logo', 'go2hr'),
    'section'  => 'go2hr_settings',
  )));

  $wp_customize->add_setting('social_facebook', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('social_facebook', array(
    'label'    => esc_html__('Facebook URL', 'go2hr'),
    'section'  => 'go2hr_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('social_twitter', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control('social_twitter', array(
    'label'    => esc_html__('Twitter URL', 'go2hr'),
    'section'  => 'go2hr_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('social_linkedin', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control('social_linkedin', array(
    'label'    => esc_html__('LinkedIn URL', 'go2hr'),
    'section'  => 'go2hr_settings',
    'type'     => 'text',
  ));
  $wp_customize->add_setting('social_instagram', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control('social_instagram', array(
    'label'    => esc_html__('Instagram URL', 'go2hr'),
    'section'  => 'go2hr_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('social_googleplus', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control('social_googleplus', array(
    'label'    => esc_html__('Google+ URL', 'go2hr'),
    'section'  => 'go2hr_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('social_youtube', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control('social_youtube', array(
    'label'    => esc_html__('YouTube URL', 'go2hr'),
    'section'  => 'go2hr_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('front_page_job_board_bg', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'front_page_job_board_bg', array(
    'label'    => esc_html__('Front Page Job Board Image', 'go2hr'),
    'section'  => 'go2hr_settings',
  )));

  $wp_customize->add_setting('front_page_job_board', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'front_page_job_board', array(
    'label'    => esc_html__('Job Board Image', 'go2hr'),
    'section'  => 'go2hr_settings',
  )));

  $wp_customize->add_setting('dream_job_board', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'dream_job_board', array(
    'label'    => esc_html__('Dream Job Image', 'go2hr'),
    'section'  => 'go2hr_settings',
  )));

  $wp_customize->add_setting('visit_job_board', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'visit_job_board', array(
    'label'    => esc_html__('Visit Job Board', 'go2hr'),
    'section'  => 'go2hr_settings',
  )));

  $wp_customize->add_setting('show_latest_news', array(
    'default'           => '1',
  ));

  $wp_customize->add_control(new \WP_Customize_Control($wp_customize, 'show_latest_news', array(
    'label'     => __('Show Latest News Section on Homepage', 'go2hr'),
    'section'   => 'go2hr_settings',
    'settings'  => 'show_latest_news',
    'type'      => 'checkbox'
  )));
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');



function customize_company_listing($wp_customize) {
  //Company Listing
  $wp_customize->add_section('go2hr_company_listing_settings', array(
    'title'    => __('Company Listing', 'go2hr'),
    'priority' => 40,
  ));

  $wp_customize->add_setting('generic__logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic__logo', array(
    'label'    => esc_html__('Generic Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));

  $wp_customize->add_setting('generic_accommodation_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic_accommodation_logo', array(
    'label'    => esc_html__('Generic Accomodation Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));

  $wp_customize->add_setting('generic_food_beverage_services_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic_food_beverage_services_logo', array(
    'label'    => esc_html__('Generic Food & Beverage Services Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));

  $wp_customize->add_setting('generic_recreation_and_entertainment_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic_recreation_and_entertainment_logo', array(
    'label'    => esc_html__('Generic Recreation and Entertainment Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));

  $wp_customize->add_setting('generic_snow_sports_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic_snow_sports_logo', array(
    'label'    => esc_html__('Generic Snow Sports Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));

  $wp_customize->add_setting('generic_transportation_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic_transportation_logo', array(
    'label'    => esc_html__('Generic Transportation Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));

  $wp_customize->add_setting('generic_travel_services_logo', array(
    'transport'         => 'postMessage'
  ));

  $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, 'generic_travel_services_logo', array(
    'label'    => esc_html__('Generic Travel Services Logo', 'go2hr'),
    'section'  => 'go2hr_company_listing_settings',
  )));
}

add_action('customize_register', __NAMESPACE__ . '\\customize_company_listing');

function customize_emails($wp_customize) {
  //Company Listing
  $wp_customize->add_section('go2hr_email_settings', array(
    'title'    => __('E-Mail Addresses', 'go2hr'),
    'priority' => 40,
  ));

  $wp_customize->add_setting('e_contact_tourism', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_contact_tourism', array(
    'label'    => esc_html__('Contact Us - Tourism Careers', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('e_contact_jobboard', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_contact_jobboard', array(
    'label'    => esc_html__('Contact Us - Job board', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('e_user_registration', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_user_registration', array(
    'label'    => esc_html__('Admin E-mail for User Registration', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('e_subuser_registration', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_subuser_registration', array(
    'label'    => esc_html__('Admin E-mail for Sub-User Registration', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('e_company_registration', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_company_registration', array(
    'label'    => esc_html__('Admin E-mail for Company Registration', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('e_job_validation', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_job_validation', array(
    'label'    => esc_html__('Admin E-mail for Job Validation', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));

  $wp_customize->add_setting('e_company_profile_update', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('e_company_profile_update', array(
    'label'    => esc_html__('Admin E-mail for Company Profile Updates', 'go2hr'),
    'section'  => 'go2hr_email_settings',
    'type'     => 'text',
  ));
}

add_action('customize_register', __NAMESPACE__ . '\\customize_emails');

/**
 * Enable selection of service for each available featured purchase status. With this we bind purchase actions with services.
 * @author Igor Hrcek (igor.hrcek@mint.rs)
 * @date    2017-08-03
 * @version 1.0.0
 * @param   object     $wp_customize WP_Customize Object
 */
function service_customizer($wp_customize) {
  $wp_customize->add_section('go2hr_purchase_settings', array(
    'title'    => __('Purchase Settings', 'go2hr'),
    'priority' => 40,
  ));

  $wp_customize->add_setting('purchase_featured_job', array(
    'transport'         => 'postMessage',
  ));

//  $wp_customize->add_control('purchase_featured_job', array(
//    'label'    => esc_html__('Select Service for Featured Job', 'go2hr'),
//    'section'  => 'go2hr_purchase_settings',
//    'type'     => 'select',
//    'choices'  => Services\get_services('jobs')
//  ));

  $wp_customize->add_setting('purchase_featured_event', array(
    'transport'         => 'postMessage',
  ));

//  $wp_customize->add_control('purchase_featured_event', array(
//    'label'    => esc_html__('Select Service for Featured Event', 'go2hr'),
//    'section'  => 'go2hr_purchase_settings',
//    'type'     => 'select',
//    'choices'  => Services\get_services('events')
//  ));

  $wp_customize->add_setting('purchase_featured_company', array(
    'transport'         => 'postMessage',
  ));

//  $wp_customize->add_control('purchase_featured_company', array(
//    'label'    => esc_html__('Select Service for Featured Company', 'go2hr'),
//    'section'  => 'go2hr_purchase_settings',
//    'type'     => 'select',
//    'choices'  => Services\get_services('companies')
//  ));

  $wp_customize->add_setting('purchase_payto_text', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('purchase_payto_text', array(
    'label'    => esc_html__('Please enter the text for the Pay To block which is displayed on the Invoice', 'go2hr'),
    'section'  => 'go2hr_purchase_settings',
    'type'     => 'textarea',
  ));
}
add_action('customize_register', __NAMESPACE__ . '\\service_customizer');

/**
 * Enable Page Terms text settings.
 */
function page_terms_customizer($wp_customize) {
  $wp_customize->add_section('go2hr_page_terms_settings', array(
    'title'    => __('Page Terms', 'go2hr'),
    'priority' => 40,
  ));

  $wp_customize->add_setting('terms_1', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('terms_1', array(
    'label'    => esc_html__('Please enter the text which is going to be displayed if article may not be republished', 'go2hr'),
    'section'  => 'go2hr_page_terms_settings',
    'type'     => 'textarea',
  ));

  $wp_customize->add_setting('terms_2', array(
    'transport'         => 'postMessage',
  ));

  $wp_customize->add_control('terms_2', array(
    'label'    => esc_html__('Please enter the text which is going to be displayed if article may be republished', 'go2hr'),
    'section'  => 'go2hr_page_terms_settings',
    'type'     => 'textarea',
  ));

}
add_action('customize_register', __NAMESPACE__ . '\\page_terms_customizer');
