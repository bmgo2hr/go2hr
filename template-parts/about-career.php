<?php
/**
 * Template Name: Carrer-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<!-- header end -->
      <main class="inr-page About-page" id="careerpage">

         <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_site_url();?>">Home</a></li>
                           <li><a href="#">About Us</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <div class="page-content">
         <!-- content -->
		 <?php $pageContent = get_the_content(); if(!empty($pageContent)){ ?>
         <section class="WEbinar-video space pb-0">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 col-12 mx-auto">
                     <div class="heading-pnel line-head text-center">
                       <?php the_content();?>
					   </div>
                  </div>
               </div>
            </div>
         </section><?php } ?>
         <!-- section -->
         <section class="circle-sec grid-left space">
            <div class="container">
               <div class="row justify-content-between">
                  <div class="col-lg-6">
                     <div class="circle-content pr-5">
					 <?php $section1Heading = get_field('section_1_heading');
					 $section1Desc = get_field('section_1_description');
					 $section1Image = get_field('section_1_image');
					 if(!empty($section1Heading)){ ?>
					 <h3 class="sub-title" style="font-size: 2.2rem;"><?=$section1Heading;?></h3><?php } ?>
                        <?php echo ($section1Desc)? $section1Desc : '';?>
                     </div>
                  </div>
                  <?php if(!empty($section1Image)){ ?><div class="col-lg-6 Img_Outer">
                     <div class="circle-img wow animated zoomIn animated" style="visibility: visible; animation-name: zoomIn;">
                        <img src="<?=$section1Image;?>" alt="" class="w-100">
                     </div>
                  </div><?php } ?>
               </div>
            </div>
         </section>
         <!-- section -->
         <section class="our-value space pt-0">
            <div class="container">
			<?php $section2Heading = get_field('section_2_heading'); if(!empty($section2Heading)){ ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel line-head text-center p-0">
                        <h2><?=$section2Heading;?></h2>
                     </div>
                  </div>
               </div><?php } ?>

               <div class="row">
			   <?php if(have_rows('box_data')){
				        while( have_rows('box_data') ){ the_row();
					      $boxIcon = get_sub_field('box_icon');
						  $boxTitle = get_sub_field('box_heading');
						  $boxDesc = get_sub_field('box_description');
				    ?>
                  <div class="col-lg-3 col-md-6 col-sm-6 col-12 pr-0">
                     <div class="value-box D-radius">
                        <?php if(!empty($boxIcon)){ ?><figure>
                           <img src="<?=$boxIcon;?>"  alt="icon" class="" />
                        </figure><?php } if(!empty($boxTitle)){ ?>
                        <figcaption>
                           <h5 class="check"><?=$boxTitle;?></h5>
                        </figcaption><?php } ?>
                     </div>
			   </div><?php } } ?>

               </div>
            </div>
         </section>
         <section class="long-sec double-sec space pt-0">
            <div class="container-fluid p-0">
               <!-- box -->
			    <?php if(have_rows('similar_section')){
					$flag = 1;
				        while( have_rows('similar_section') ){ the_row();
					      $sctionImg = get_sub_field('section_image');
						  $sectionTitle = get_sub_field('section_heading');
						  $sectionDesc = get_sub_field('section_description');
						  $flag++;
				    ?>
               <div class="long-main-box <?php echo ($flag%2 == 0)? 'pnel-zag safety-zag' : 'pnel-zig safety-zig';?>">
                  <div class="row no-gutters">
				  <?php if(!empty($sctionImg)){ ?>
                     <div class="col-lg-7 col-md-12 Img_Outer">
                        <div class="long-img">
                           <img src="<?=$sctionImg;?>" alt="" class="w-100">
                        </div>
				  </div><?php } ?>
                     <div class="col-lg-5 col-md-12">
                        <div class="long-content D-radius">
                           <?php if(!empty($sectionTitle)){ ?><h4><?=$sectionTitle;?></h4><?php } ?>
                           <?php echo ($sectionDesc)? $sectionDesc : '';?>
                        </div>
                     </div>
                  </div>
				</div><?php } } ?>

            </div>
         </section>
         <?php get_template_part( 'template-parts/content/footer-section' ); ?>
         </div>
      </main>

<?php get_footer();
