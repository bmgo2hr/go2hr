<?php

    $user_company = get_field('user_company', 'user_' . get_current_user_id());

    $company_id = is_object($user_company) ? $user_company->ID : $user_company;

    $args = array(
        'post_type'             =>  'go2hr_jobs',
        'post_status'           =>  array('job_expired'),
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
    $query = new WP_Query( $args );
?>

<div class="space">
    <a href="/dashboard/my-jobs" class="green-btn2 m1-3 my-jobs-btn" ><i class="fa fa-angle-left mr-2" aria-hidden="true"></i> My Jobs  </a>
    <div class="dashboard-card">
        <div class="card-heading pl-5 pr-5 d-flex align-items-center justify-content-between">
            <h3>Expired Jobs</h3>
            <div class="dashboard-action">
                <a href="" class="delete-action" data-type="expired"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/remove.svg"></a>
                 <a href="/dashboard/my-jobs/add-job"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/plus1.svg"></a>
            </div>
        </div>

        <div class="card-content p-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="title-img"><div class="d-flex">Job Title</div></th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Date Posted</th>
                            <th class="text-center">Expiry Date</th>
                            <th class="text-right">Edit/Repost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($query->found_posts == 0) : ?>
                        <tr>
                            <td colspan="5">You don’t have any expired job postings.</td>
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
                                        $status = strtolower(str_replace('job_', '', $status));
                                    ?>
                                </td>
                                <td>
                                    <?php echo date('M jS, Y', strtotime(get_the_date())); ?>
                                </td>
                                <td>
                                    <?php if (get_post_status() == 'publish' || get_post_status() == 'job_expired') : ?>
                                        <?php echo date('F jS, Y', strtotime(get_the_date()) + (86400 * 30)); ?>
                                    <?php else : ?>
                                        --
                                    <?php endif; ?>
                                </td>
                                <td class="text-right Edit-td"><a href="<?php echo home_url('/dashboard/my-jobs/modify-job/?repost=1&fid=' . get_field('job_fid')); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/edit.svg"> </a></td>
                            </tr>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
