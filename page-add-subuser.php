<?php
/**
 * Template name: Add Sub User
 */

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<main class="inr-page Training-page bg-grey <?php if (is_user_logged_in() && current_user_can('administrator')) echo "signed-in"; ?>" id="ContactUs">
    <div class="my-account-pages">
        <?php get_template_part('dashboard/templates/global/dashboard-topbar'); ?>
        <section class="My-job-dashboard">
            <div class="container">
                <div class="row">
                    <?php get_template_part('dashboard/templates/global/dashboard-sidebar'); ?>
                    <div class="col-lg-9 col-md-12">
                        <div class="space mx-450 Post-a-job">
                             <div class="row">
                                 <div class="col-lg-12 col-md-12">
                                     <div class="step-box">
                                         <div class="newsletter-box">
                                             <div class="heading-pnel">
                                                <h4>New User</h4>
                                             </div>
                                             <?php get_template_part('dashboard/templates/layouts/form-subuser', null, array('user' => null)); ?>
                                        </div>
                                     </div>
                                 </div>
                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
