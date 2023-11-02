<?php
/**
 * Template name: Job Board Resources
 */

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
                        <div class="space mx-758 job-board-resources">
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="dashboard-card">
                                        <div class="card-heading fff">
                                            <h3><?php echo get_field('featured_resource')['title']; ?></h3>
                                        </div>
                                        <div class="card-content">
                                            <h4><?php echo get_field('featured_resource')['subtitle']; ?></h4>

                                            <a href="<?php echo get_field('featured_resource')['button']['url']; ?>" target="<?php echo get_field('featured_resource')['button']['target']; ?>" class="green-btn"><?php echo get_field('featured_resource')['button']['title']; ?></a>
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="dashboard-card">
                                        <div class="card-heading">
                                            <h3>Quick Links</h3>
                                        </div>
                                        <div class="card-content">
                                            <div class="Recruit-list m-0">
                                                <?php foreach (get_field('quick_links') as $link) : ?>
                                                <div class="Recruit-list-item">
                                                    <h3>
                                                        <a href="<?php echo $link['link']['url']; ?>">
                                                            <p><?php echo $link['link']['title']; ?></p>
                                                            <span class="icon-light"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/recruit/arrow-light.svg"></span>
                                                            <span class="icon-dark"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/recruit/arrow.svg"></span>
                                                        </a>
                                                    </h3>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="dashboard-card">
                                        <div class="card-heading">
                                            <h3>How-to Videos</h3>
                                        </div>
                                        <div class="card-content pt-5 video-section">
                                            <div class="row">
                                                <?php foreach (get_field('how-to_videos') as $video) : ?>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <div class="Videos-box">
                                                        <div class="Videos-item">
                                                        <iframe width="100%"  src="<?php echo $video['url']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="Videos-content">
                                                        <h5><?php echo $video['title']; ?></h5>
                                                    </div>
                                                    </div>
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
            </div>
        </section>
    </div>
</main>

<?php  get_footer(); ?>
