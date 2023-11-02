<?php

$myJobsPages = array(
    'my-jobs',
    'archived',
    'job-board-resources',
    'featured-resource',
    'add-job'
);

$myAccountPages = array(
    'my-profile',
    'my-company',
    'my-users',
    'account-setting'
);

$urlExplodedBySlash = explode('/', $_SERVER['REQUEST_URI']);
$targetActiveSlug = end($urlExplodedBySlash);

?>

<div class="my-account-bar dashboard-bar">
    <div class="container">
        <div class="account-bar-box">
            <ul class="Dashboard-links">
                <li>
                    <a href="/dashboard"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/dashboard.png" /> Dashboard</a>
                </li>
                <li <?php if(in_array($targetActiveSlug, $myJobsPages)) echo 'class="active"'; ?>>
                    <a href="/dashboard/my-jobs"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/job.svg" /> My Jobs</a>
                </li>
                <li <?php if(in_array($targetActiveSlug, $myAccountPages)) echo 'class="active"'; ?>>
                    <a href="/dashboard/my-profile"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/account.svg" /> Account</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="" class="logout"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/logout.png" />Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
