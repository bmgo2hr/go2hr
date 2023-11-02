<?php
/**
 * Template name: My Jobs - Expired
 */

use Go2HR\Helpers\CompanyProfile;

get_header();

apply_filters('g2hr_set_page_attributes','1'); ?>

<main class="inr-page Training-page bg-grey <?php if (is_user_logged_in() && current_user_can('administrator')) echo "signed-in"; ?>" id="ContactUs">
    <div class="my-account-pages">
        <?php get_template_part('dashboard/templates/global/dashboard-topbar'); ?>
        <section class="My-job-dashboard">
            <div class="container">
                <div class="row">
                    <?php get_template_part('dashboard/templates/global/dashboard-sidebar-for-job'); ?>

                    <div class="col-lg-9 col-md-12">
                    <?php if(!CompanyProfile\is_company_active()): ?>
                        <div class="space">
                            <?php echo get_template_part('dashboard/templates/components/block-company-pending-approval'); ?>
                        </div>
                    <?php else: ?>
                        <?php echo get_template_part('dashboard/templates/layouts/dashboard-jobs-list-expired'); ?>
                    <?php endif; ?>

                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
