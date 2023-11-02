<?php
/**
 * Template name: Account Setting
 */

$user = \Go2HR\Helpers\UserProfile\get_user_profile();
if (!$user) wp_redirect(home_url());

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
                                                <h4>My Settings</h4>
                                            </div>
                                            <form action="" id="g2hr-account-setting-form">
                                                <div class="row no-gutters">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input class="form-control" placeholder="" name="user_name" value="<?php echo $user->data->user_login; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Email Address <span>*</span></label>
                                                            <input class="form-control" placeholder="" name="user_email" value="<?php echo $user->data->user_email; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Password <span>*</span></label>
                                                            <input class="form-control" placeholder="**********" type="Password" name="password" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="RegionField setting-checkbox">
                                                            <div class="checkbox-item">
                                                                <?php $subscriptions = explode(',', get_user_meta($user->data->ID, 'user_newsletter_lists', true)); ?>
                                                                <input type="checkbox" id="newsletter" name="newsletter" value="employer_nl" <?php if(in_array('employer_nl', $subscriptions)): ?> checked="checked"<?php endif; ?>>
                                                                <label for="newsletter"> I would like to receive newsletters from go2HR about recruitment, retention, managing staff, training & development.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-4 mb-5 " >
                                                    <a href="#" class="green-btn" id="g2hr-update-account-setting">Update Information</a>
                                                </div>

                                                <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>

                                            </form>
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
