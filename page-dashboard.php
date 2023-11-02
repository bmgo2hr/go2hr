<?php
/**
 * Template name: Dashboard
 */

apply_filters('g2hr_set_page_attributes','1');

$user = \Go2HR\Helpers\UserProfile\get_user_profile();

if (count((array) $user) == 0) {
    wp_redirect(home_url('/login'));
}

$company_core = new Go2hr_Companies_Core($user->user_company[0]);
$company = $company_core->get_company();

get_header(); ?>

<main class="inr-page Training-page bg-grey <?php if (is_user_logged_in() && current_user_can('administrator')) echo "signed-in"; ?> id="ContactUs">
    <div class="my-account-pages">
        <?php get_template_part('dashboard/templates/global/dashboard-topbar'); ?>
        <section class="contactUs-sec space">
            <div class="container">
                <div class="mx-1000">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="Dashboard-welcome-box">
                                <div class="welcome-box-item">
                                    <div class="welcome-box-image">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/user.png" />
                                    </div>
                                    <div class="welcome-box-content">
                                        <h1>Welcome Back, <?php echo $user->nickname[0]; ?></h1>
                                        <span><?php echo $company->post_name; ?></span>
                                        <p>
                                            You spoke and we listened! welcome to your new <br />
                                            dashboard.
                                        </p>
                                        <div class="welcome-content-btn">
                                            <a href="/dashboard/my-jobs/add-job" class="green-btn">Post a job</a>
                                            <a href="/dashboard/my-profile" class="border-green-btn">Update Your Account</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-box">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="dashboard-card">
                                    <div class="card-heading">
                                        <h3>Your Activity</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="Recruit-list m-0">
                                            <div class="Recruit-list-item">
                                                <div class="Recruit-list-main">
                                                    <p><b><?php echo \Go2Hr\Helpers\Dashboard\get_user_posted_job_num(); ?> jobs</b> posted</p>
                                                    <div>
                                                    <a href="/dashboard/my-jobs/"><span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/eye.svg" /></span></a>
                                                     <a href="/dashboard/my-jobs/add-job"> <span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/plus.svg" /></span></a>
                                                 </div>
                                                </div>
                                            </div>

                                            <div class="Recruit-list-item">
                                                <div class="Recruit-list-main">
                                                    <p><b><?php echo \Go2Hr\Helpers\Dashboard\get_user_added_user_num(); ?> account users</b></p>
                                                    <div>
                                                        <a href="/dashboard/my-users/"><span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/eye.svg" /></span></a>
                                                         <a href="/dashboard/my-users/add-sub-user"> <span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/plus.svg" /></span></a>
                                                     </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                <div class="dashboard-card">
                                    <div class="card-heading">
                                        <h3>Latest Sector Resources</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="Recruit-list m-0">

                                            <?php $latest_sector_resources = get_field('latest_sector_resources'); ?>
                                            <?php foreach ($latest_sector_resources as $resource) : ?>
                                            <div class="Recruit-list-item">
                                                <h3>
                                                    <a href="/explore-all-resources/<?php echo $resource->post_name; ?>">
                                                        <p><?php echo $resource->post_title; ?></p>
                                                        <span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/recruit/arrow-light.svg" /></span>
                                                        <span class="icon-dark"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/recruit/arrow.svg" /></span>
                                                    </a>
                                                </h3>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                                <div class="dashboard-card">
                                    <div class="card-heading">
                                        <h3>Latest Recruiting Articles</h3>
                                    </div>
                                    <div class="card-content">
                                        <div class="Recruit-list m-0">

                                            <?php $latest_recruiting_articles = get_field('latest_recruiting_articles'); ?>
                                            <?php foreach ($latest_recruiting_articles as $resource) : ?>
                                            <div class="Recruit-list-item">
                                                <h3>
                                                    <a href="/explore-all-resources/<?php echo $resource->post_name; ?>">
                                                        <p><?php echo $resource->post_title; ?></p>
                                                        <span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/recruit/arrow-light.svg" /></span>
                                                        <span class="icon-dark"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/recruit/arrow.svg" /></span>
                                                    </a>
                                                </h3>
                                            </div>
                                            <?php endforeach; ?>
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
