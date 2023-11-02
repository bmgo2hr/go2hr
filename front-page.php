<?php
/**
 * Template Name: Home-template
 *
 */
$pageID = get_the_ID();
$bannerImg = get_field('banner_image', $pageID);
$bannerHeading = get_field('banner_tittle', $pageID);
$bannerDesc = get_field('banner_description', $pageID);

$section2Heading = get_field('section_2_heading', $pageID);
$section3Heading = get_field('section_3_heading', $pageID);

get_header(); ?>

    <!-- Banner Start -->
<?php if ($bannerImg) { ?>
    <section class="slider-section">

        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" style="background-image: url('<?= $bannerImg; ?>');">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-10 col-12">
                            <div class="banner-text">
                                <?php if ($bannerHeading) { ?>
                                    <h1 class="fadeInLeft animated"> <?= $bannerHeading; ?></h1><?php } ?>
                                <?php if ($bannerDesc) { ?>
                                    <p class="fadeInLeft"><?= $bannerDesc; ?></p><?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section> <?php } ?>
    <!-- Banner End -->
    <!-- Search Start -->
    <section class="search-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="search-box">
                        <form method="get" action="<?php echo home_url(); ?>">
                            <div class="input-box">
                                <input type="text" name="s" class="input"
                                       placeholder="What kind of resources are you looking for?">
                            </div>
                            <div class="input-btn-box">
                                <button type="submit" class="search-btn"><i class="fa fa-search" aria-hidden="true"></i>
                                    <span>Search</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search End -->
    <!-- Start Section 2 -->
    <section class="feature-sec space">
        <div class="container-fluid">
            <?php if ($section2Heading) { ?>
                <div class="row">
                <div class="col-md-10 col-12 mx-auto">
                    <div class="heading-pnel text-center">
                        <h2><?= $section2Heading; ?></h2>
                    </div>
                </div>
                </div><?php } ?>
            <div class="row no-gutters">
                <div class="col-lg-10 col-md-12 col-12 mx-auto">
                    <div id="feature" class="owl-carousel">
                        <?php
                        $initiatives = get_post_meta($post->ID, 'initiatives-and-campaigns', true);
                        foreach ($initiatives as $initiative) {
                            $initiativesLogo = $initiative['initiative-icon'];
                            $initiativesHeading = $initiative['initiatives-headings'];
                            $initiativesURL = $initiative['initiatives-url'];

                            if (!empty($initiativesLogo)) {
                                $logo = wp_get_attachment_image_src($initiativesLogo);
                                ?>
                                <div>
                                <div class="feature-box text-center">
                                    <a href="<?= $initiativesURL; ?>">
                                        <figure>
                                            <img src="<?= $logo[0]; ?>">
                                        </figure>
                                        <?php if ($initiativesHeading) { ?>
                                            <figcaption>
                                            <h4 class="feature-title"><?= $initiativesHeading; ?></h4>
                                            </figcaption><?php } ?>
                                    </a>
                                </div>
                                </div><?php }
                        } ?>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- end section 2 -->
    <!-- start section 3 - resources -->
    <section class="services bg-grey space">
        <div class="container">
            <?php if ($section3Heading) { ?>
                <div class="row">
                <div class="col-md-10 col-12 mx-auto">
                    <div class="heading-pnel text-center">
                        <h2><?= $section3Heading; ?></h2>
                    </div>
                </div>
                </div><?php } ?>
            <div class="row">
                <?php
                $discovers = get_post_meta($post->ID, 'discover-resources', true);
                foreach ($discovers as $discover) {
                    $discoverIMG = $discover['discover-image'];
                    $discoverHeading = $discover['discover-name'];
                    $discoverDesc = $discover['discover-description'];
                    $discoverBtnLink = $discover['learn-more-link'];
                    if (!empty($discoverIMG)) {
                        $IMG = wp_get_attachment_image_src($discoverIMG);
                        ?>
                        <div class="col p-0">
                        <div class="new_top">
                            <div class="flip-card-front">
                                <!-- front -->
                                <?php if ($IMG[0]) { ?>
                                    <figure>
                                    <img src="<?= $IMG[0]; ?>" alt="" class="w-100"/>
                                    </figure><?php } ?>
                                <?php if ($discoverHeading) { ?>
                                    <figcaption>
                                        <h4><?= $discoverHeading; ?></h4>
                                    </figcaption> <?php } ?>
                            </div>
                            <!-- back -->
                            <div class="flip-card-back">
                                <?php if ($discoverHeading) { ?>
                                    <h5><?= $discoverHeading; ?></h5><?php } ?>
                                <?php if ($discoverDesc) { ?>
                                    <p><?= $discoverDesc; ?></p><?php } ?>
                                <div class="Learn-more">
                                    <a href="<?php echo ($discoverBtnLink) ? $discoverBtnLink : '#'; ?>"
                                       class="link-btn fff">Learn More <i class="fa fa-angle-right"
                                                                          aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        </div><?php }
                }
                wp_reset_postdata(); ?>

            </div>
        </div>
    </section>
    <!-- end section 3 -->
    <!-- start section 4 -->
    <section class="circle-sec grid-left space">
        <div class="container">
            <?php
            $eventImg = get_field('event_image', $pageID);
            $eventHeading = get_field('events_heading', $pageID);
            $eventDesc1 = get_field('events_description_1', $pageID);
            $eventDesc2 = get_field('events_description_2', $pageID);
            $viewEventText = get_field('view_events_button_text', $pageID);
            $viewEventLink = get_field('view_events_button_link', $pageID);
            ?>
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="circle-content">
                        <?php if ($eventHeading) { ?>
                            <h3><?= $eventHeading; ?></h3><?php } ?>
                        <?php if ($eventDesc1) { ?>
                            <p><?= $eventDesc1; ?></p><?php } ?>
                        <?php echo ($eventDesc2) ? $eventDesc2 : ''; ?>
                        <?php if ($viewEventText) { ?>
                            <div class="group-btns">
                            <a href="<?php echo ($viewEventLink) ? $viewEventLink : '#'; ?>"
                               class="green-btn"><?= $viewEventText; ?> <i class="fa fa-angle-right"
                                                                           aria-hidden="true"></i></a>
                            </div><?php } ?>
                    </div>
                </div>
                <?php if ($eventImg) { ?>
                    <div class="col-lg-6 Img_Outer">
                    <div class="circle-img wow animated zoomIn">
                        <img src="<?= $eventImg; ?>" alt="" class="w-100"/>
                    </div>
                    </div><?php } ?>
            </div>
        </div>
    </section>
    <!-- end section 4 -->
    <!-- start section 5 -->
    <section class="circle-sec grid-right space pt-0">
        <div class="container">
            <?php
            $sec5Img = get_field('section_5_image', $pageID);
            $sec5Heading = get_field('section_5_heading', $pageID);
            $sec5Desc = get_field('section_5_description', $pageID);
            $sec5Btn1Text = get_field('section_5_button_1_text', $pageID);
            $sec5Btn1Link = get_field('section_5_button_1_link', $pageID);
            $sec5Btn2Text = get_field('section_5_button_2_text', $pageID);
            $sec5Btn2Link = get_field('section_5_button_2_link', $pageID);
            ?>
            <div class="row justify-content-between">
                <?php if ($sec5Img) { ?>
                    <div class="col-lg-6 Img_Outer">
                    <div class="circle-img wow animated zoomIn">
                        <img src="<?= $sec5Img; ?>" alt="" class="w-100"/>
                    </div>
                    </div><?php } ?>
                <div class="col-lg-6">
                    <div class="circle-content">
                        <?php if ($sec5Heading) { ?>
                            <h3><?= $sec5Heading; ?></h3><?php } ?>
                        <?php if ($sec5Desc) { ?>
                            <p><?= $sec5Desc; ?></p><?php } ?>
                        <?php if ($sec5Btn1Text || $sec5Btn2Text) { ?>
                            <div class="group-btns">
                            <?php if ($sec5Btn1Text) { ?>
                                <a href="<?php echo ($sec5Btn1Link) ? $sec5Btn1Link : '#'; ?>"
                                   class="green-btn"><?= $sec5Btn1Text; ?> <i class="fa fa-angle-right"
                                                                              aria-hidden="true"></i></a><?php } ?>
                            <?php if ($sec5Btn2Text) { ?>
                                <a href="<?php echo ($sec5Btn2Link) ? $sec5Btn2Link : '#'; ?>"
                                   class="blue-btn ml-5"><?= $sec5Btn2Text; ?> <i class="fa fa-angle-right"
                                                                                  aria-hidden="true"></i></a><?php } ?>
                            </div><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 5 -->
    <!-- Newsletter -->
    <section class="space pt-0 Newsletter-section">
        <div class="container">
            <?php
            $newLImg = get_field('section_6_image', $pageID);
            $newLHeading = get_field('section_6_heading', $pageID);
            $newLDesc = get_field('section_6_description', $pageID);

            ?>
            <div class="newsletter-main">
                <div class="row no-gutters">
                    <?php if ($newLImg) { ?>
                        <div class="col-lg-5 col-md-5 col-12">
                        <div class="Newsletter-image">
                            <img src="<?= $newLImg; ?>" class="newsletter" class="w-100"/>
                        </div>
                        </div><?php } ?>
                    <div class="col-lg-7 col-md-7 col-12">
                        <div class="Newsletter-form">
                            <div class="heading-pnel mb-5 fff">
                                <?php if ($newLHeading) { ?>
                                    <h3><?= $newLHeading; ?></h3><?php } ?>
                                <?php if ($newLDesc) { ?>
                                    <p><?= $newLDesc; ?></p><?php } ?>
                            </div>

                            <!-- newletter Subscriber Shortcode-->
                            <div class="Newsletter-box">
                                <a href="/newsletters" class="btn btn-default subscribe region-subscribe">Subscribe</a>
                                <?php // echo do_shortcode('[newsletter_form type="minimal" placeholder="Enter Your Email" confirmation_url="'.home_url('/').'"] ');?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- start section 7 -->
    <section class="explore-sec space bg-grey">
        <div class="container">
            <?php
            $sec7Heading = get_field('section_7_heading', $pageID);
            if ($sec7Heading) {
                ?>
                <div class="row">
                <div class="col-12">
                    <div class="heading-pnel line-head text-center">
                        <h2><?= $sec7Heading; ?></h2>
                    </div>
                </div>
                </div><?php } ?>


            <div class="row">
                <div class="col-md-6 col-sm-6 col-12">

                    <?php
                    $regions = new WP_Query(array('post_type' => 'region', 'post_status' => 'publish', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC')); // get All regions
                    if ($regions->have_posts()) {
                        $flag = 0; ?>


                        <?php while ($regions->have_posts()) {
                            $regions->the_post();

                            $regionTitle = get_the_title();
                            $regionShortDesc = get_the_excerpt();
                            $regionMap = get_the_post_thumbnail_url();
                            $link = get_permalink();
                            $flag++;
                            ?>


                            <div class="explore-box">
                                <div class="number">
                                    <h4 class="map<?= $flag; ?>"><?= $flag; ?></h4>
                                </div>
                                <?php if ($regionTitle) { ?>
                                    <figcaption>
                                    <p>
                                        <a href="<?= $link; ?>"><?= $regionTitle; ?> <i class="fa fa-angle-right"
                                                                                        aria-hidden="true"></i></a>
                                    </p>
                                    </figcaption><?php } ?>
                            </div>

                        <?php }
                    }
                    wp_reset_postdata(); ?>

                </div>

                <div class="col-md-6 col-sm-6 col-12">

                    <?php
                    $regions = new WP_Query(array('post_type' => 'region', 'post_status' => 'publish', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC', 'offset' => 3)); // get All regions
                    if ($regions->have_posts()) {
                        $flag = 3; ?>


                        <?php while ($regions->have_posts()) {
                            $regions->the_post();

                            $regionTitle = get_the_title();
                            $regionShortDesc = get_the_excerpt();
                            $regionMap = get_the_post_thumbnail_url();
                            $flag++;
                            ?>

                            <div class="explore-box">
                                <div class="number">
                                    <h4 class="map<?= $flag; ?>"><?= $flag; ?></h4>
                                </div>
                                <?php if ($regionTitle) { ?>
                                    <figcaption>
                                    <p>
                                        <a href="<?php echo get_the_permalink(); ?>"><?= $regionTitle; ?> <i class="fa fa-angle-right"
                                                                            aria-hidden="true"></i></a>
                                    </p>
                                    </figcaption><?php } ?>
                            </div>


                        <?php }
                    }
                    wp_reset_postdata(); ?>

                </div>
            </div>
        </div>
    </section>
    <!-- end section 7 -->
    <!-- blog section -->
    <section class="blog-sec space">
        <div class="container">
            <?php
            $sec8Heading = get_field('section_8_heading', $pageID);
            $sec8BtnText = get_field('section_8_button_text', $pageID);
            $sec8BtnLink = get_field('section_8_button_link', $pageID);
            if ($sec8Heading) {
                ?>
                <div class="row">
                <div class="col-12">
                    <div class="heading-pnel line-head text-center">
                        <h2><?= $sec8Heading; ?></h2>
                    </div>
                </div>
                </div><?php } ?>
            <div class="row">
                <?php

                $date_now = date('Y-m-d H:i:s');
                $args2 = array(
                    'posts_per_page' => 4,
                    'post_type' => 'go2hr_events',
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'event_start_date',
                            'compare' => '>=',
                            'value' => $date_now,
                            'type' => 'DATETIME'
                        )
                    ),
                    'order' => 'ASC',
                    'orderby' => 'meta_value',
                    'meta_key' => 'event_start_date',
                    'meta_type' => 'DATE'
                );


                $events = new WP_Query($args2);  // get All Events
                if ($events->have_posts()) {
                    while ($events->have_posts()) {
                        $events->the_post();

                        $eventTitle = get_the_title();
                        $eventShortDesc = get_the_excerpt();
                        $eventDate = get_field('event_start_date');
                        $month = @date("F", strtotime($eventDate));
                        $date = @date("d", strtotime($eventDate));
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="blog-box">
                            <?php if ($eventDate) { ?>
                                <div class="blog-date dott">
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <h4><span><?php echo $month; ?></span> <?php echo $date; ?></h4>
                                </a>
                                </div><?php } ?>
                            <figcaption>
                                <?php if ($eventTitle) { ?>
                                    <h4>
                                    <a href="<?php echo get_the_permalink(); ?>"><?php echo $eventTitle; ?> </a>
                                    </h4><?php } ?>
                                <?php if ($eventShortDesc) { ?>
                                    <p><?= $eventShortDesc; ?></p><?php } ?>
                                    <a href="<?php echo get_the_permalink(); ?>" class="btn-border">Learn More</a>
                            </figcaption>
                        </div>
                        </div><?php }
                }
                wp_reset_postdata(); ?>

            </div>
            <?php if ($sec8BtnText) { ?>
                <div class="row">
                <div class="col-12">
                    <div class="view-all text-center">
                        <a href="<?php echo ($sec8BtnLink) ? $sec8BtnLink : '#'; ?>"
                           class="green-btn"><?= $sec8BtnText; ?> <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
                </div><?php } ?>
        </div>
    </section>

<?php get_footer();
