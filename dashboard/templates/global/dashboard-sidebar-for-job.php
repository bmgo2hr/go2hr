<?php

$urlExplodedBySlash = explode('/', $_SERVER['REQUEST_URI']);
$targetActiveSlug = end($urlExplodedBySlash);

?>

<div class="col-12  desktop-none">
    <div class="filter-mobile-btn text-right mt-5">
        <button class="green-btn filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Sidebar </button>
    </div>
</div>
<div class="col-lg-3 col-md-12 ">
    <div class="ResourceFilter D-radius">
        <div class="close-filter desktop-none">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
        <div id="accordion" class="filter-accordion my-account-sidebar">
            <!-- accordion -->
            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="btn btn-link collapsed <?php if ($targetActiveSlug == 'my-jobs') echo "active"; ?>">
                        <i class="fas fa-angle-down" aria-hidden="true" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne"></i>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/my-jobs.svg">
                        <a href="/dashboard/my-jobs"> My Jobs</a>
                    </div>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                    <div class="card-body">
                        <div class="child-checkboxes card-header">
                             <a class="btn btn-link <?php if ($targetActiveSlug == 'archived') echo "active"; ?>" href="/dashboard/my-jobs/archived"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/archived.png" style="height: 10px; width: 15px;"> Archived Jobs</a>
                        </div>
                    </div>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                    <div class="card-body">
                        <div class="child-checkboxes card-header">
                             <a class="btn btn-link <?php if ($targetActiveSlug == 'expired') echo "active"; ?>" href="/dashboard/my-jobs/expired"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/archived.png" style="height: 10px; width: 15px;"> Expired Jobs</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingOne">
                    <div class="btn btn-link collapsed <?php if ($targetActiveSlug == 'job-board-resources') echo "active"; ?>">
                        <i class="fas fa-angle-down" aria-hidden="true" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false" aria-controls="collapseOne"></i>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/job-board.svg">
                        <a href="/dashboard/job-board-resources/"> Jobs Board Resources</a>
                    </div>
                </div>
                <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                    <div class="card-body">
                        <div class="child-checkboxes card-header">
                             <a class="btn btn-link <?php if ($targetActiveSlug == 'featured-resource') echo "active"; ?>" href="/dashboard/job-board-resources/featured-resource"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/star.svg"> Featured Resource</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card single-list">
                <div class="card-header" id="headingOne">
                    <div class="btn btn-link collapsed <?php if ($targetActiveSlug == 'add-job') echo "active show"; ?>">
                        <a class="" href="/dashboard/my-jobs/add-job"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/post-job.svg"> Post a job</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
