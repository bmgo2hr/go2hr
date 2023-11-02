<?php
/**
 * Template name: Modify Sub User
 */

get_header();

apply_filters('g2hr_set_page_attributes','1');

$user = get_subuser_by_fid($_REQUEST['id']);

?>

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
                                               <h4>Modify User</h4>
                                            </div>
                                            <?php get_template_part('dashboard/templates/layouts/form-subuser', null, array('user' => $user)); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!--                    <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12">-->
<!--                        --><?php //$user = get_subuser_by_fid($_REQUEST['id']); ?>
<!--                        <div class="g2hr-dashboard-content-container">-->
<!--                            --><?php //include(locate_template('templates/layouts/form-modify-sub-user.php')); ?>
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
