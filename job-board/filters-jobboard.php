<?php

$job_board_ad = get_field('job_board_ad', 'option');
$job_board_ad_image = $job_board_ad['image'] ?? "";
$job_board_ad_url = $job_board_ad['url'] ?? "";
$job_board_ad_display = $job_board_ad['display'] ?? "";
?>

<div class="col-12 mb-4 desktop-none">
    <div class="filter-mobile-btn text-right">
        <button class="green-btn filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Filters</button>
    </div>
</div>

<div class="col-lg-3 col-md-12 col-12 pr-0">
    <div class="ResourceFilter D-radius">
<!--        <div class="close-filter desktop-none">-->
<!--            <i class="fa fa-times" aria-hidden="true"></i>-->
<!--        </div>-->

        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">

            <div id="accordion" class="filter-accordion">
            <?php
                $taxonomies = [
                    'Region' => 'jobs_region',
                    'Job Status' => 'jobs_status',
                    'Job Type' => 'jobs_types',
                    'Level' => 'jobs_levels'
                ];
            ?>
            <?php foreach ($taxonomies as $taxonomy => $value_taxonomy ): ?>

                <div class="card">
                    <div class="card-header" id="heading<?php echo $value_taxonomy?>">
                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo $value_taxonomy?>" aria-expanded="false" aria-controls="collapse<?php echo $value_taxonomy?>"><?php echo $taxonomy?></a>
                    </div>

                    <div id="collapse<?php echo $value_taxonomy?>" class="collapse  <?php echo ($value_taxonomy == 'jobs_region') ? 'show' : 'show'?>" aria-labelledby="heading<?php echo $value_taxonomy?>" style="">

                    <!-- Start filter -->
                    <div class="card-body">
                        <div class="child-checkboxes">
                        <?php if( $terms = get_terms( array( 'taxonomy' => $value_taxonomy, 'orderby' => 'name' ) ) ) : ?>

                            <?php foreach ( $terms as $term ) : ?>
                                <div class="form-group">
                                    <label>
                                        <input class="auto_filter" type="checkbox" name="<?php echo $value_taxonomy; ?>-filter[]" value="<?php echo $term->term_id ; ?>" /> <?php echo $term->name; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>

            </div>

            <input type="hidden" name="action" value="myfilter_job_board_regions">
            <input type="hidden" name="paged_value" id="paged_value" value="1">
            <input type="hidden" name="s" id="paged_value" value="<?php echo (isset($_GET['search']) ? $_GET['search'] : ""); ?>">
            <input type="hidden" value="<?php echo $args['targetActiveSlug'] ?? ""; ?>" id="jobs_sectors-filter">
            <input type="hidden" name="job_board_ad_display" value="<?php echo $job_board_ad_display; ?>">
            <input type="hidden" name="job_board_ad_url" value="<?php echo $job_board_ad_url; ?>">
            <input type="hidden" name="job_board_ad_image" value="<?php echo $job_board_ad_image; ?>">
        </form>
    </div>

    <div class="group-btns">
        <a href="<?php echo home_url('/company-directory') ?>" class="green-btn">View Company Directory <i class="fa fa-angle-right ml-0" aria-hidden="true"></i></a>
    </div>
</div>
