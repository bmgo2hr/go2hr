<?php
/**
 * Template Name: Employment-tracker-template
 * Template Post Type: page, research
 *
*/
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

 <!-- header end -->
      <main class="inr-page Training-page Recruit-page" id="EmoloymentTracker">
         <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>
		 
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_page_link(8);?>">Home</a></li>
                           <li><a href="<?=get_page_link(1661);?>">Research</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
        </section>

        <?php get_template_part('template-parts/content/background_and_text');?>

        <!-- <?php 
          $section1Title = get_field('section_1_heading');
          $section1Desc = get_field('section_1_description');
          $section1Image = get_field('section_1_image');
          
          $section1BtnText = get_field('section_1_button_text');
          $section1BtnLink = get_field('section_1_button_link');
          if(!empty($section1Title) || !empty($section1Desc)){
        ?>

            <section class="long-sec safety-basic-long">
              <div class="container-fluid p-0">
                <div class="row no-gutters">
                  <?php if(!empty($section1Image)){ ?>
                    <div class="col-lg-6 col-md-6 Img_Outer">
                      <div class="long-img">
                        <img src="<?=$section1Image;?>" alt="" class="w-100">
                      </div>
                    </div>
                  <?php } ?>
                  <div class="col-lg-6 col-md-6">
                    <div class="long-content D-radius">
                      <?php if(!empty($section1Title)){ ?><h3><?=$section1Title;?></h3><?php } ?>
                        <?php echo ($section1Desc)? $section1Desc : '';?>
                        <?php if(!empty($section1BtnText)){ ?>  
                          <div class="long-btn ml-0">
                            <a href="<?php echo ($section1BtnLink)? $section1BtnLink : '';?>" class="green-btn"><?=$section1BtnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
            </section>
          <?php } ?> -->

      
         <!-- section -->
         <section class="NewsDetail-content space">
            <div class="container">
              <div class="row">
                <div class="col-lg-10 col-12 mx-auto">
                  <div class="NewsContent-box">
                    <?php get_template_part('employment-tracker/index') ?> 
                  </div>
                </div>
              </div>
            </div>
         </section>
         <!-- Related News -->
      </main>

<?php get_footer(); ?>

<script>
         $(document).ready(function() {
               $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                 disableOn: 700,
                 type: 'iframe',
                 mainClass: 'mfp-fade',
                 removalDelay: 160,
                 preloader: false,
         
                 fixedContentPos: false
               });
             });
          
      </script>
