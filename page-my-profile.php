<?php
/**
 * Template name: My Profile
 */

use Go2HR\Helpers\UserProfile;

$user = UserProfile\get_user_profile();

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<?php get_template_part('dashboard/templates/layouts/form-my-profile', null, array('user' => $user)); ?>

<?php get_footer(); ?>
