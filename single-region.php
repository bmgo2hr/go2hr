<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
$regionId = get_the_ID();
$pageHeading = get_field('page_heading', $regionId);
$PageBanner = get_field('banner_image', $regionId);

$regionName = get_the_title();
$regionDesc = get_the_content();
$regionImg = get_the_post_thumbnail_url();

$linkedinLink = get_option('linkedin_link', 'option');
$fbLink = get_option('fb_link', 'option');
$instagramLink = get_option('Instagram_link', 'option');

get_header(); ?>

    <main class="inr-page Training-page" id="Region">
        <!-- banner -->
        <?php get_template_part('template-parts/content/inner-page-banner'); ?>
        <!-- Breadcrumb -->
        <section class="Breadcrumb-go2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="pagination-box">
                            <ul>
                                <li>
                                    <a href="<?= get_site_url(); ?>">Home</a>
                                </li>
                                <li><span><?php echo ($pageHeading) ? $pageHeading : get_the_title($regionId); ?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="page-content">
        <!-- grid -->
        <section class="WEbinar-video space bg-grey">
            <div class="container">
                <div class="row align-items-center">
                    <?php if (!empty($regionDesc)) { ?>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="heading-pnel line-head m-0">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    <?php }
                    if (!empty($regionImg)) { ?>
                        <div class="col-lg-3 col-md-4 col-12">
                        <div class="">
                            <img src="<?= $regionImg; ?>" alt="" class="w-100"/>
                        </div>
                        </div><?php } ?>
                </div>
            </div>
        </section>
        <!-- section  -->
        <?php $fullWidthImg = get_field('banner_image', $regionId);
        if (!empty($fullWidthImg)) { ?>
            <section class="full-img-sec space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="full-img-main">
                            <figure>
                                <img src="<?= $fullWidthImg; ?>" class="w-100"/>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            </section><?php } ?>
        <!-- grid -->
        <section class="RegionHr-sec space pt-0">
            <div class="container">
                <?php
                if (have_rows('region_hr')) {
                    while (have_rows('region_hr')) {
                        the_row();
                        $hrImg = get_sub_field('hr_image');
                        $hrName = get_sub_field('hr_name');
                        $hrShortDesc = get_sub_field('hr_short_description');
                        $hrServiceHeading = get_sub_field('hr_sevrice_heading');
                        $hrServiceDesc = get_sub_field('hr_service_description');
                        $hrServiceBtnText = get_sub_field('hr_service_button_text');
                        $hrServiceBtnLink = get_sub_field('hr_sevice_button_link');
                        ?>
                        <div class="row">
                            <div class="col-lg-11 col-12 mx-auto">
                                <div class="row">
                                    <div class="col-lg-4 col-md-5 col-12">
                                        <div class="team-box D-radius">
                                            <?php if (!empty($hrImg)) { ?>
                                                <figure>
                                                <img src="<?= $hrImg; ?>">
                                                </figure><?php } ?>
                                            <figcaption>
                                                <?php if (!empty($hrName)) { ?>
                                                    <h4><?= $hrName; ?></h4><?php } ?>
                                                <?php if (!empty($hrShortDesc)) { ?>
                                                    <p><?= $hrShortDesc; ?></p><?php } ?>
                                            </figcaption>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-12">
                                        <div class="heading-pnel line-head m-0">
                                            <?php if (!empty($hrServiceHeading)) { ?>
                                                <h2><?= $hrServiceHeading; ?> </h2><?php } ?>
                                            <?php echo ($hrServiceDesc) ? $hrServiceDesc : ''; ?>
                                            <?php if (!empty($hrServiceBtnText)) { ?>
                                                <a href="<?php echo ($hrServiceBtnLink) ? $hrServiceBtnLink : '#'; ?>"
                                                   class="green-btn"><?= $hrServiceBtnText; ?> <i
                                                    class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } ?>
            </div>
        </section>
        <!-- grid -->
        <?php
        $workforceHeading = get_field('workforce_heading', $regionId);
        $workforceDesc = get_field('workforce_description', $regionId);
        $workforceBtnText = get_field('workforce_button_text', $regionId);
        $workforceBtnLink = get_field('workforce_button_link', $regionId);
        $workforceImg = get_field('workforce_image', $regionId);
        ?>
        <section class="Grapgh-sec space pt-0">
            <div class="container-wider">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-12">
                        <div class="heading-pnel line-head m-0">
                            <?php if (!empty($workforceHeading)) { ?>
                                <h2><?= $workforceHeading; ?></h2><?php } ?>
                            <?php echo ($workforceDesc) ? $workforceDesc : ''; ?>
                            <?php if (!empty($workforceBtnText)) { ?>
                                <a href="<?php echo ($workforceBtnLink) ? $workforceBtnLink : '#'; ?>"
                                   class="green-btn"><?= $workforceBtnText; ?> <i class="fa fa-angle-right"
                                                                                  aria-hidden="true"></i></a><?php } ?>
                        </div>
                    </div>
                    <?php if (!empty($workforceImg)) { ?>
                        <div class="col-lg-5 col-md-6 col-12">
                        <figure>
                            <img src="<?= $workforceImg; ?>" class="w-100" alt="">
                        </figure>
                        </div><?php } ?>
                </div>
            </div>
        </section>

        <!-- services -->
        <section class="services space pt-0">
            <div class="container">
                <?php $keyResourcesHeading = get_field('key_resources_heading', $regionId);
                if (!empty($keyResourcesHeading)) { ?>
                    <div class="row">
                    <div class="col-12 mx-auto">
                        <div class="heading-pnel line-head">
                            <h2><?= $keyResourcesHeading; ?></h2>
                        </div>
                    </div>
                    </div><?php } ?>
                <div class="row">
                    <?php
                    if (have_rows('key_resources')) {
                        while (have_rows('key_resources')) {
                            the_row();
                            $keyImg = get_sub_field('key_resources_image');
                            $keyheading = get_sub_field('key_resources_heading');
                            $keyDesc = get_sub_field('key_resources_short_description');
                            $keyBtnText = get_sub_field('key_resources_button_text');
                            $keyBtnLink = get_sub_field('key_resources_button_link');
                            if (!empty($keyImg)) {
                                ?>
                                <div class="col p-0">
                                <div class="new_top">
                                    <div class="flip-card-front">
                                        <!-- front -->
                                        <?php if (!empty($keyImg)) { ?>
                                            <figure>
                                            <img src="<?= $keyImg; ?>" alt="" class="w-100">
                                            </figure><?php }
                                        if (!empty($keyheading)) { ?>
                                            <figcaption>
                                            <h4><?= $keyheading; ?></h4>
                                            </figcaption><?php } ?>
                                    </div>
                                    <!-- back -->
                                    <div class="flip-card-back">
                                        <?php if (!empty($keyheading)) { ?>
                                            <h5><?= $keyheading; ?></h5><?php } ?>
                                        <?php if (!empty($keyDesc)) { ?>
                                            <p><?= $keyDesc; ?></p><?php } ?>
                                        <?php if (!empty($keyBtnText)) { ?>
                                            <div class="Learn-more">
                                            <a href="<?php echo ($keyBtnLink) ? $keyBtnLink : '#'; ?>"
                                               class="link-btn fff"><?= $keyBtnText; ?> <i class="fa fa-angle-right"
                                                                                           aria-hidden="true"></i></a>
                                            </div><?php } ?>
                                    </div>
                                </div>
                                </div><?php }
                        }
                    } ?>

                </div>
            </div>
        </section>

        <!-- grid -->
        <section class="JobBaord-sec space pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-11 col-12 mx-auto">
                        <?php $jobBoardHeading = get_field('job_board_heading', $regionId);
                        if (!empty($jobBoardHeading)) { ?>
                            <div class="row">
                            <div class="col-12">
                                <div class="heading-pnel line-head text-center">
                                    <h2><?= $jobBoardHeading; ?></h2>
                                </div>
                            </div>
                            </div><?php } ?>
                        <div class="row">
                            <?php

                                $slug = end(explode('/', $_SERVER['REQUEST_URI']));

                                $args = [
                                    'post_type'         =>  'go2hr_jobs',
                                    'post_status'       =>  'publish',
                                    'posts_per_page'    =>  4,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'jobs_region',
                                            'field'    => 'slug',
                                            'terms' => $slug
                                        )
                                    ),
                                ];

                                $the_query = new WP_Query($args); ?>


                            <?php  if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                <?php
                                    $job_company = get_field('field_5946b72feab10');

                                    $arrJobTypes = array();
                                    foreach (get_the_terms( get_the_ID(), 'jobs_types' ) as $objType) {
                                        $arrJobTypes[] = $objType->name;
                                    }

                                    $jobType = implode(" | ", $arrJobTypes);
                                    $jobName = get_the_title();
                                    $jobRegion = get_the_terms( get_the_ID(), 'jobs_region' )[0]->name;
                                    $jobImg = get_field('company_id', $job_company->ID) ?? get_stylesheet_directory_uri() . "/assets/images/no_Image_available.jpeg";

                                ?>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="JObBoard-box">
                                            <?php if (!empty($jobImg)) : ?>
                                                <div class="board-icon">
                                                    <img src="<?= $jobImg; ?>" class="" alt=""/>
                                                </div>
                                            <?php endif; ?>
                                            <figcaption>
                                                <p><?= $job_company->post_title; ?></p>
                                                <?php if (!empty($jobName)) : ?>
                                                    <a href="<?= the_permalink(); ?>">
                                                    <p><b> <?= get_the_title(); ?></b></p>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (!empty($jobRegion)) : ?>
                                                    <p><?= $jobRegion; ?></p>
                                                <?php endif; ?>
                                                <?php if (!empty($jobType)) : ?>
                                                    <p><?= $jobType; ?></p>
                                                <?php endif; ?>
                                                <?php //echo ($jobDesc) ? $jobDesc : ''; ?>
                                            </figcaption>
                                        </div>
                                    </div>
                                <?php endwhile; wp_reset_postdata(); ?>
                        <?php endif; ?>

                        </div>
                        <?php
                        $btnText = get_field('view_more_button_text', $regionId);
                        $btnLink = get_field('view_more_button_link', $regionId);
                        if (!empty($btnText)) {
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="ViewAll-row text-center">
                                        <a href="<?php echo ($btnLink) ? $btnLink : ''; ?>"
                                           class="green-btn"><?= $btnText; ?> <i class="fa fa-angle-right"
                                                                                 aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- links -->
        <section class="H-linksGreen space bg-grey">
            <div class="container">
                <div class="row">
                    <?php $helpFullHeading = get_field('helpful_links_heading', $regionId);
                    if (!empty($helpFullHeading)) { ?>
                        <div class="col-lg-6 col-md-6 col-12">
                        <div class="heading-pnel line-head">
                            <h2><?= $helpFullHeading; ?></h2>
                        </div>
                        </div><?php } ?>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="helpfull-green">
                            <?php
                            if (have_rows('helpful_links')) {
                                while (have_rows('helpful_links')) {
                                    the_row();
                                    $helpfulText = get_sub_field('helpful_links_text');
                                    $helpfulUrl = get_sub_field('helpful_links_url');

                                    $isExternal = strpos($helpfulUrl, str_replace("www.", "", $_SERVER["HTTP_HOST"])) === false;
                                    if (!empty($helpfulText)) {
                                        ?>
                                        <p>
                                            <a href="<?= $helpfulUrl; ?>" <?php if ($isExternal) echo " target=_blank"; ?> class="btn-border"><?= $helpfulText; ?></a>
                                        </p>
                                    <?php }
                                }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- newsletter -->
        <section class="space Newsletter-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="newsletter-main">
                            <div class="letter-box">
                                <div class="Newsletter-image">
                                    <img src="<?= get_template_directory_uri() ?>/assets/images/events/newsletter.png"
                                         class="newsletter">
                                </div>
                                <div class="Newsletter-form">
                                    <div class="heading-pnel mb-5 fff">
                                        <h3>Keep up with the latest industry updates</h3>
                                        <p>Sign up to get the latest news, insights and resources about the tourism and
                                            hospitality industry in BC.
                                        </p>
                                    </div>
                                    <form method="">
                                        <div class="Newsletter-box">
                                            <a href="/newsletters" type="submit" class="btn btn-default subscribe region-subscribe">Subscribe</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="newsletter-main">
                            <div class="letter-box text-center">
                                <div class="Newsletter-image">
                                    <img src="<?= get_template_directory_uri() ?>/assets/images/region/follow.png"
                                         class="newsletter">
                                </div>
                                <div class="Newsletter-form">
                                    <div class="heading-pnel mb-5 fff">
                                        <h3>Follow Us</h3>
                                        <div class="FollowUsS">
                                            <ul>
                                                <li>
                                                    <a href="<?php echo $linkedinLink; ?>" target="_blank">
                                                        <img
                                                            src="<?= get_template_directory_uri() ?>/assets/images/region/in.svg"
                                                            class="w-100" alt=""/>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $fbLink; ?>" target="_blank">
                                                        <img
                                                            src="<?= get_template_directory_uri() ?>/assets/images/region/insta.svg"
                                                            class="w-100" alt=""/>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo $instagramLink; ?>" target="_blank">
                                                        <img
                                                            src="<?= get_template_directory_uri() ?>/assets/images/region/fb.svg"
                                                            class="w-100" alt=""/>
                                                    </a>
                                                </li>
                                            </ul>
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

<?php get_footer();
