<?php

get_header();

get_template_part('company-directory/maps-company-directory');
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php
    $company_website = get_field('company_website');
    $company_phone = get_field('company_phone');
    $company_locations = get_field('company_locations');

    $company_facebook = get_field('company_facebook');
    $company_twitter = get_field('company_twitter');
    $company_linkedin = get_field('company_linkedin');
    $company_instagram = get_field('company_instagram');

    $company_id = get_field('company_id');
    $no_company_logo = get_stylesheet_directory_uri() . '/assets/images/no-company-logo.png';

    $company_map = get_field('company_map');
?>

<main class="inr-page Training-page Recruit-page" id="newsDetail">
    <div class="individual-job-page">
        <section class="EventDetail-sec space" >
            <div class="container">
                <div class="individual-width">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="EventDetail-content">

                                <h2><?php the_title()?></h2>
                                <ul>
                                <?php if($company_locations):?>
                                    <?php if(!empty($company_locations[0]['company_address'])):?>
                                    <li class="mb-0"><?php echo $company_locations[0]['company_address'] ?>,</li>
                                    <?php endif;?>

                                    <div class="d-flex">
                                    <?php if(!empty($company_locations[0]['company_city'])):?>
                                        <li><?=$company_locations[0]['company_city']?>, </li>
                                    <?php endif;?>

                                    <?php if(!empty($company_locations[0]['company_postal_code'])):?>
                                        <li>&nbsp;<?=$company_locations[0]['company_postal_code']?></li>
                                    <?php endif;?>
                                    </div>
                                <?php endif;?>

                                <?php if(!empty($company_phone)):?>
                                    <li class="mt-3">T. <?=$company_phone?></li>
                                <?php endif;?>

                                <?php if(!empty($company_website)):?>
                                    <div class="d-flex mt-3">
                                        <li>W.&nbsp;</li>
                                        <li><a target="_blank" href="<?=esc_url($company_website) ?>"><?=esc_url($company_website) ?></a></li>
                                    </div>
                                <?php endif;?>
                                </ul>

                                <?php if(!empty($company_facebook) || !empty($company_twitter) || !empty($company_linkedin) || !empty($company_instagram) ):?>
                                <div class="footer_bottom_icon clearfix">
                                    <ul>
                                    <?php if(!empty($company_facebook)):?>
                                        <li class="facebook">
                                            <a target="_blank" href="<?=esc_url($company_facebook) ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                        </li>
                                    <?php endif;?>

                                    <?php if(!empty($company_twitter)):?>
                                        <li class="twitter">
                                            <a target="_blank" href="<?=esc_url($company_twitter) ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                        </li>
                                    <?php endif;?>

                                    <?php if(!empty($company_linkedin)):?>
                                        <li class="linkedin">
                                            <a target="_blank" href="<?=esc_url($company_linkedin) ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                    <?php endif;?>

                                    <?php if(!empty($company_instagram)):?>
                                        <li class="instagram">
                                            <a target="_blank" href="<?=esc_url($company_instagram) ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        </li>
                                    <?php endif;?>
                                    </ul>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-sm-6  col-12 Img_Outer">
                            <div class="EventDetail-img">
                                <img src="<?php echo (!empty($company_id)) ? $company_id : $no_company_logo ?>" class="w-100" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </section>
         <!-- section -->
         <section class="NewsDetail-content space ">
             <div class="container">
                 <div class="NewsContent-box">
                     <h3>About Us</h3>
                     <?php the_content();?>

<!--                     --><?php //if( $company_map ): ?>
<!--                     <div class="acf-map" data-zoom="16">-->
<!--                         <div class="marker" data-lat="--><?php //echo esc_attr($company_map['lat']); ?><!--" data-lng="--><?php //echo esc_attr($company_map['lng']); ?><!--"></div>-->
<!--                     </div>-->
<!--                     --><?php //endif; ?>

                     <?php echo get_template_part('company-directory/newest-jobs-company-directory')?>
                </div>
            </div>
        </section>
    </div>
</main>


      <?php endwhile; else : ?>
         <p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
      <?php endif; ?>

<?php get_footer()?>
