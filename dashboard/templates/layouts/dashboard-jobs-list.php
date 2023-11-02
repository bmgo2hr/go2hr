<?php

use Go2HR\Helpers\Jobs;
use Go2HR\Helpers\CompanyProfile;

$user_company = get_field('user_company', 'user_' . get_current_user_id());

$company_id = is_object($user_company) ? $user_company->ID : $user_company;

$args = array(
    'post_type'             =>  'go2hr_jobs',
    'post_status'           =>  array('publish', 'job_unvalidated', 'draft'),
    'pagination'            =>  true,
    'posts_per_page'        =>  -1,
    'ignore_sticky_posts'   =>  true,
    'meta_query'            =>  array(
        array(
            'key'           =>  'job_company',
            'value'         =>  $company_id,
        )
    )
);

$query = new WP_Query( $args ); ?>

<div class="card-content p-5 ">
    <div class="table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th class="title-img"><div class="d-flex">Job Title</div></th>
                <th>Status</th>
                <th>Date Posted</th>
                <th>Expiry Date</th>
                <th class="text-right">Edit/Repost</th>
              </tr>
            </thead>
            <tbody>
                <?php if ($query->found_posts == 0 ) : ?>
                <tr>
                    <td colspan="5">You don’t have any active job postings.</td>
                </tr>
                <?php else: ?>
                    <?php if ($query->have_posts()) : while ( $query->have_posts() ) : $query->the_post(); ?>
                    <tr>
                        <td class="title-img">
                            <div class="d-flex">
                                <input type="checkbox" value="<?php echo the_ID(); ?>" class="delete_checkbox"><?php echo get_the_title(); ?>
                            </div>
                        </td>
                        <td>
                            <?php
                                $status = get_post_status();
                                if ($status == 'publish') { $status = 'published'; }
                                $status = strtolower(str_replace('job_', '', $status)); ?>
                            <?php echo $status; ?>
                        </td>
                        <td>
                            <?php echo date('M jS, Y', strtotime(get_the_date())); ?>
                        </td>
                        <td>
                            <?php if (get_post_status() == 'publish') : ?>
                                <?php echo date('F jS, Y', strtotime(get_the_date()) + (86400 * 30)); ?>
                            <?php else : ?>
                                --
                            <?php endif; ?>
                        </td>
                        <td class="text-right Edit-td"><a href="<?php echo home_url('/dashboard/my-jobs/modify-job/?fid=' . get_field('job_fid')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/edit.svg"> </a></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php get_template_part('dashboard/templates/components/alert-boxes'); ?>
    <div class="row mt-5">
        <div class="col-lg-8 col-md-8">
            <div class="welcome-content-btn">
                <a href="/dashboard/my-jobs/add-job" class="green-btn">Post a job</a>
                <a href="/dashboard/my-jobs/archived" class="border-green-btn">View Archived Jobs</a>
            </div>
        </div>
    </div>
</div>
