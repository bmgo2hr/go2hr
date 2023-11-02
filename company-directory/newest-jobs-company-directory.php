<?php

    $args = array(
        'post_type'             =>  'go2hr_jobs',
        'post_status'           =>  array('publish'),
        'posts_per_page'        =>  20,
        'meta_query'            =>  array(
            array(
                'key'           =>  'job_company',
                'value'         =>  get_the_ID(),
            )
        )
    );

    $query = new WP_Query($args);
?>

<div class="card-content p-0 mb-5 new-job-posts">

    <div class="table-title">
        <h4>Current Job Postings</h4>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
               <tr>
                  <th class="title-img"> Job Title </th>
                  <th class="text-left">Status</th>
                  <th class="text-left">Date Posted</th>
                  <th class="text-center">Expiry Date</th>
               </tr>
            </thead>
            <tbody>
                <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <a href="">
                    <tr data-url="<?php echo get_permalink(get_the_ID()); ?>" style="cursor: pointer;">
                        <td class="title-img"><?= get_the_title(); ?></td>
                        <?php
                                $status = get_post_status();
                                if ($status == 'publish') { $status = 'published'; }
                                $status = strtolower(str_replace('job_', '', $status));
                        ?>
                        <td class="text-left"><?= $status; ?></td>
                        <td class="text-left">
                             <?php echo date('M jS, Y', strtotime(get_the_date())); ?>
                        </td>
                        <td class="text-center">
                            <?php if (get_post_status() == 'publish') : ?>
                                <?php echo date('F jS, Y', strtotime(get_the_date()) + (86400 * 30)); ?>
                            <?php else : ?>
                                --
                            <?php endif; ?>
                        </td>
                    </tr>
                </a>
                <?php endwhile; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="text-center">
   <a href="<?php echo home_url('/job-board') ?>" class="green-btn"> See All Job Postings <i class="fa fa-angle-right" aria-hidden="true"></i></a>
</div>

<script>
    jQuery(".new-job-posts tr").click(function() {
        window.location.href = $(this).data("url");
    });
</script>
