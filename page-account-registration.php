<?php
/**
 * Template name: User Registration
 */

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<form method="POST" id="g2hr-user-registration-form">
    <!-- Create Account -->
    <?php get_template_part('dashboard/templates/layouts/form-user-registration'); ?>

    <!-- Step 1 -->
    <?php get_template_part('dashboard/templates/layouts/form-user-registration-step1'); ?>

    <!-- Step 2 -->
    <?php get_template_part('dashboard/templates/layouts/form-user-registration-step2'); ?>
</form>

<?php get_footer(); ?>
