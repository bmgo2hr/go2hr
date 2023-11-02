<?php
/**
 * Template name: Featured Resource Policies
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
                        <div class="space mx-700 job-board-resources">
                             <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <a href="/dashboard/job-board-resources" class="green-btn2"><i class="fa fa-angle-left mr-2" aria-hidden="true"></i>  Jobs Board Resources  </a>
                                    <div class="dashboard-card" style="height: auto;">
                                        <div class="card-heading">
                                            <h3><?php echo get_field('title'); ?></h3>
                                        </div>
                                        <div class="card-content Questions-Every ">
                                            <?php foreach (get_field('question') as $question): ?>
                                            <div class="Questions-box">
                                                <h4><?php echo $question['title']; ?></h4>
                                                <?php echo $question['text']; ?>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                 </div>

                                <div class="col-lg-12">
                                    <?php get_template_part('dashboard/templates/components/interested-in-box-in-featured-resource'); ?>
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
