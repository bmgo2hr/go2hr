<?php

$urlExplodedBySlash = explode('/', $_SERVER['REQUEST_URI']);
$targetActiveSlug = end($urlExplodedBySlash);
?>

<div class="col-12 desktop-none">
    <div class="filter-mobile-btn text-right mt-5">
        <button class="green-btn filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> Sidebar</button>
    </div>
</div>

<div class="col-lg-3 col-md-12">
    <div class="ResourceFilter D-radius">
        <div class="close-filter desktop-none">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
        <div id="accordion" class="filter-accordion my-account-sidebar">
            <!-- accordion -->
            <div class="card single-list">
                <div class="card-header" >
                    <div class="btn btn-link collapsed <?php if ('my-profile' == $targetActiveSlug) echo "active";?>">
                        <a href="/dashboard/my-profile"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/my-profile.svg" /> My Profile</a>
                    </div>
                </div>
            </div>
            <?php if (Go2HR\Helpers\UserProfile\is_user_owner()) : ?>
            <div class="card single-list">
                <div class="card-header" >
                    <div class="btn btn-link collapsed <?php if ('my-company' == $targetActiveSlug) echo "active";?>">
                        <a href="/dashboard/my-company"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/company-info.svg" /> Company Info</a>
                    </div>
                </div>
            </div>
            <div class="card single-list">
                <div class="card-header" >
                    <div class="btn btn-link collapsed <?php if ('my-users' == $targetActiveSlug) echo "active";?>" >
                        <a href="/dashboard/my-users"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/users.png" style="width: 19px;height: 20px;
object-fit: contain;" /> Users</a>
                    </div>
                </div>
            </div>
            <div class="card single-list">
                <div class="card-header" >
                    <div class="btn btn-link collapsed <?php if ('account-setting' == $targetActiveSlug) echo "active";?>">
                        <a href="/dashboard/account-setting"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/account/settings.svg" /> Account setting</a>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
