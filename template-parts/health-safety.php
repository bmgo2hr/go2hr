<?php
/**
 * Template Name: Health & Safety-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<!-- header end -->


    <main class="inr-page Training-page HealthOverview health-safety" id="Training">

		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

		<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <div class="page-content">
		<!-- grid -->
      <section class="WEbinar-video space" >
         <div class="container">
		 <?php $pageContent = get_the_content(); if(!empty($pageContent)){ ?>
            <div class="row">
               <div class="col-lg-10 col-12 mx-auto">
				 <div class="heading-pnel line-head text-center">
					<?php the_content();?>
					</div>
               </div>
            </div><?php }


			 $section1Title = get_field('page_notes');
			 $section1Image = get_field('page_notes_logo');
			 if(!empty($section1Title)){ ?>
			<div class="row">
				<div class=" col-lg-10 col-12 mx-auto">
					<div class="benefit-box servay-strip D-radius">
						<figcaption class="w-100">
							<?php if(!empty($section1Image)){ ?><img src="<?=$section1Image;?>" class="" alt="" /><?php } ?>
							<p><?=$section1Title;?></p>
						</figcaption>
					</div>
				</div>
			 </div><?php } ?>
         </div>
      </section>

			<!-- grid -->
      <section class="WEbinar-video space bg-grey" >
         <div class="container">
		 <?php
		     $section2Title = get_field('section_2_heading');
			 $section2Desc = get_field('section_2_description');
			 if(!empty($section2Title) || !empty($section2Desc)){ ?>
            <div class="row">
               <div class="col-lg-9 col-12 mx-auto">
				 <div class="heading-pnel text-center">
					<?php if(!empty($section2Title)){ ?><h4><?=$section2Title;?></h4><?php } ?>
                    <?php if(!empty($section2Desc)){ ?><p><?=$section2Desc;?></p><?php } ?>
                  </div>
               </div>
			 </div><?php } ?>

			<?php get_template_part( 'template-parts/content/health-safety/centers' ); ?>

         </div>
      </section>

	<!-- section -->
	<section class="featured-slider space">
		<div class="container-fluid">
		<?php $section3Heading = get_field('section_3_heading'); if(!empty($section3Heading)){ ?>
		 <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head text-center">
					<h2><?=$section3Heading;?></h2>
                  </div>
               </div>
		</div><?php } ?>

			<?php get_template_part( 'template-parts/content/health-safety/slider', null, array('note' => get_field('section_3_note')) ); ?>

		</div>
	</section>


		<!-- grid -->
      <section class="WEbinar-video space pt-0" >
         <div class="container">
		 <?php
		     $section4Title = get_field('section_4_heading');
			 $section4Desc = get_field('section_4_description');
			 if(!empty($section4Title) || !empty($section4Desc)){ ?>
            <div class="row">
               <div class="col-lg-9 col-12 mx-auto">
				 <div class="heading-pnel line-head text-center">
					<?php if(!empty($section4Title)){ ?><h2><?=$section4Title;?></h2><?php } ?>
                   <?php if(!empty($section4Desc)){ ?> <p><?=$section4Desc;?></p><?php } ?>
                  </div>
               </div>
			 </div><?php } ?>


			<div class="row">
			<ul class="links-listing text-center">
			<?php if(have_rows('our_tools')){
				while( have_rows('our_tools') ){ the_row();
				  $toolsTitle = get_sub_field('tools_tittle');
				  $toolsImg = get_sub_field('tools_image');
				  if(!empty($toolsTitle)){
				?>
				<div class=" col-lg-9 col-12 mx-auto">
					<div class="benefit-box servay-strip D-radius">
						<figcaption>
							<?php if(!empty($toolsImg)){ ?><img src="<?=$toolsImg;?>" class="" alt="" /><?php } ?>
							<p><?=$toolsTitle;?></p>
						</figcaption>
					</div>
			</div><?php } } } ?>
			</div>
         </div>
      </section>

		<!-- grid -->
      <section class="long-sec double-sec space pt-0 section5">
         <div class="container-fluid p-0">
		 <?php $section5Heading = get_field('section_5_heading'); if(!empty($section5Heading)){ ?>
		 <div class="row">
               <div class=" col-md-10 col-11 mx-auto">
				 <div class="heading-pnel line-head">
					<h2><?=$section5Heading;?></h2>
                  </div>
               </div>
		 </div><?php }  ?>


		<?php get_template_part( 'template-parts/content/health-safety/workplace' ); ?>

         </div>
      </section>


		<section class="training-prog-sec space pt-0" >
			<div class="container">
				<div class="OnlineTraining-Tab">

				 <?php $section6Heading = get_field('section_6_heading'); if(!empty($section6Heading)){ ?>
				<div class="heading-pnel line-head">
					<h2><?=$section6Heading;?></h2>
				 </div><?php } ?>


                           <?php get_template_part( 'template-parts/content/health-safety/key-initiatives' ); ?>

                        </div>
					</div>
			</section>

		<section class="services sector-spcfic space pt-0">
         <div class="container">
		  <?php
		     $section7Title = get_field('section_7_heading');
			 $section7Desc = get_field('section_7_description');
			 if(!empty($section7Title) || !empty($section7Desc)){ ?>
            <div class="row">
               <div class=" col-lg-6 col-12 mr-auto">
                  <div class="heading-pnel line-head">
					<?php if(!empty($section7Title)){ ?><h2><?=$section7Title;?></h2><?php } ?>
					<?php if(!empty($section7Desc)){ ?><p><?=$section7Desc;?></p><?php } ?>
                  </div>
               </div>
			 </div><?php } ?>

            <div class="row">
			<?php if(have_rows('sector_specific_health_safety')){
					 while( have_rows('sector_specific_health_safety') ){ the_row();

					  $hsImg = get_sub_field('health_&_safety_image');
					  $hsTitle = get_sub_field('health_&_safety_title');
					  $btnLink = get_sub_field('button_link');
					  if(!empty($hsImg)){
					?>
               <div class="col-lg-3 col-md-6 col-12">
                  <div class="new_top">
                     <div class="flip-card-front">
                        <!-- front -->
                        <figure>
                           <img src="<?=$hsImg;?>" alt="" class="w-100">
                        </figure>
                        <?php if(!empty($hsTitle)){ ?><figcaption class="text-left">
                           <h4 class="text-left"><?=$hsTitle;?></h4>
                        </figcaption><?php } ?>
                     </div>
					 <div class="flip-card-back">
                        <div class="Learn-more">
                           <a href="<?php echo ($btnLink)? $btnLink : '#';?>" class="link-btn fff">Learn More <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                     </div>
                  </div>
			</div><?php } } } ?>

            </div>
         </div>
      </section>

		<?php get_template_part( 'template-parts/content/footer-section' ); ?>
      </div>
	</main>


<?php get_footer(); ?>
 <script>
		$('#Dashbaord').owlCarousel({
		center: true,
		items:2,
		nav:false,
		navigation : false,
		dots:true,
		loop:true,
		margin:10,
			responsive:{
				600:{
					items:2,
					navigation : false
				}
			}
		});
	  </script>
