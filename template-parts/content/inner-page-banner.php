 <?php

$pageHeading = get_field('page_heading');
$PageBanner = get_field('banner_image');

if (empty($pageHeading) && !empty($args['option_prefix'])) {
    $pageHeading = get_field('page_heading_' . $args['option_prefix'], 'options');
    $PageBanner = get_field('banner_image_' . $args['option_prefix'], 'options');
}

 if($PageBanner):?>
         <section class="inr-banner" style="background-image: url(<?=$PageBanner?>);">
            <div class="container">
               <div class="row">
                  <div class="col-lg-7 col-md-9  col-sm-12 col-12">
                     <div class="banner_top_title  wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                        <h1><?php echo ($pageHeading)? $pageHeading : get_the_title();?></h1>
                     </div>
                  </div>
               </div>
            </div>
         </section><?php endif;?>
