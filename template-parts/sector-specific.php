<?php
/**
 * Template Name: Sector-specific-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<!-- header end -->


    <main class="inr-page Training-page Recruit-page" id="Recruit">

	 <?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

		<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><a href="/health-safety">Health & Safety</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>

		 <?php
		  $section1Title = get_field('section_1_heading');
		  $section1Desc = get_field('section_1_description');
		  $section1Image = get_field('section_1_image');
		  if(!empty($section1Title) || !empty($section1Desc)){
		 ?>
        <div class="page-content">
		<section class="long-sec double-sec space pt-0">
            <div class="container-fluid p-0">

               <div class="long-main-box pnel-zag safety-zag">
                  <div class="row no-gutters">
				  <?php if(!empty($section1Image)){ ?>
                     <div class="col-lg-7 col-md-12 Img_Outer">
                        <div class="long-img">
                           <img src="<?=$section1Image;?>" alt="" class="w-100">
                        </div>
				  </div><?php } ?>
                     <div class="col-lg-5 col-md-12">
                        <div class="long-content D-radius" style="left:0;">
				       <?php if(!empty($section1Title)){ ?> <h4 class="mb-3"><?=$section1Title;?></h4><?php } ?>
								 <?php echo ($section1Desc)? $section1Desc : '';?>

						</div>
                     </div>
                  </div>
				  </div>
            </div>
         </section>

		<!-- grid -->
		  <?php }
		  $section2Title = get_field('section_2_heading');
		  $section2Desc = get_field('section_2_description');
		  $section2Image = get_field('section_2_image');
		  if(!empty($section2Title) || !empty($section2Desc)){
		  ?>
      <section class="long-sec space pt-0" >
         <div class="container-wider">

            <div class="row align-items-center">
			<div class="col-lg-5 col-md-12 Img_Outer">
                  <?php if(!empty($section2Image)){ ?><div class="long-img mb-3">
                     <img src="<?=$section2Image;?>" alt="" class="w-100" />
                  </div><?php } ?>
               </div>
               <div class="col-lg-7 col-md-12 ">
                  <div class="heading-pnel line-head mb-0 pl-4 m-pl-0">
					<?php if(!empty($section2Title)){ ?><h2><?=$section2Title;?></h2><?php } ?>
                     <?php echo ($section2Desc)? $section2Desc : '';?>
					 </div>
               </div>

            </div>
         </div>
		  </section><?php } ?>


	<!-- Insight -->
        <?php global $post; ?>
        <?php $section3Image = get_field('section_3_image'); ?>
        <section class="SectorInsight-sec space" style="background-image: url('<?php echo $section3Image; ?>')">
         <div class="container">
		  <?php $section3Heading = get_field('section_3_hading'); if(!empty($section3Heading)){ ?>
		     <div class="row">
				 <div class="col-12">
					 <div class="heading-pnel line-head text-center">
							<h2><?=$section3Heading;?></h2>
					  </div>
				  </div>
		  </div><?php } ?>


			  <div class="insight-main">
				<div class="row">
				<?php if(have_rows('section_3_description')){
					$count = count(get_field("section_3_description"));

					while( have_rows('section_3_description') ){ the_row();
					  $descTitle = get_sub_field('description_title');
					  $descText = get_sub_field('description_text');
					  $descIcon = get_sub_field('description_icon');

					  if(!empty($descTitle)){

					 if($count == 2){ ?>
				        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 3){ ?>
					  <div class="col-lg-4 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 4){ ?>
					  <div class="col-lg-3 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 5){ ?>
					  <div class="col-lg-2 col-md-6 col-sm-6 col-12">
					  <?php } else if($count == 6){ ?>
					  <div class="col-lg-2 col-md-6 col-sm-6 col-12"> <?php } ?>

						<div class="insight-box">
							<?php if(!empty($descTitle)){ ?><h1><?=$descTitle;?></h1><?php } ?>
							<?php if(!empty($descText)){ ?><p><?=$descText;?></p><?php } ?>
							<?php if(!empty($descIcon)){ ?><div class="insight-icon">
								<img src="<?=$descIcon;?>" class="" alt="" />
							</div><?php } ?>
						</div>
				</div><?php } } } ?>

				  </div>
			  </div>

         </div>
      </section>

<!-- section -->
	<section class="featured-slider space">
		<div class="container-fluid">
		 <?php $section4Heading = get_field('section_4_heading'); if(!empty($section4Heading)){ ?>
		 <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head text-center">
					<h2><?=$section4Heading;?></h2>
                  </div>
               </div>
		</div><?php } ?>

			<?php get_template_part( 'template-parts/content/health-safety/slider', null, array('note' => get_field('section_4_note')) ); ?>

		</div>
	</section>
				<!-- grid -->
      <section class="training-prog-sec space pt-0" >
         <div class="container">
		 <?php $section5Heading = get_field('section_5_heading'); if(!empty($section5Heading)){ ?>
		 <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head">
					<h2><?=$section5Heading;?></h2>
                  </div>
               </div>
		 </div> <?php } ?>

		 		<div class="row">
				<div class="col-12">
					<div class="training-prog-main">
					<?php get_template_part( 'template-parts/content/cor/sb-resources1' ); ?>

					</div>
					</div>
					</div>

				</div>


				</div>
			</section>


		<section class="CanHelp-sec space pt-0">
         <div class="container">
		 <?php $section6Heading = get_field('section_6_heading'); if(!empty($section6Heading)){ ?>
            <div class="row">
               <div class="col-lg-6 col-12">
                  <div class="heading-pnel line-head mb-0">
                     <h2><?=$section6Heading;?></h2>
                  </div>
               </div>
		 </div><?php } ?>

			<div class="row">
					<div class="col-lg-6 col-md-12 col-12">
						  <div class="tab-grid-content pr-5">
							<div class="Recruit-list">
							<?php if(have_rows('section_6_dscription')){

								while( have_rows('section_6_dscription') ){ the_row();
								  $descTitle = get_sub_field('description_title');
								  $descLink = get_sub_field('dscription_link');
								  if(!empty($descTitle)){
								   ?>
								<div class="Recruit-list-item">
									<h3>
									<a href="<?php echo ($descLink)? $descLink : '';?>"><p><?=$descTitle;?></p>
									<span class="icon-light"><img src="<?=get_template_directory_uri()?>/assets/images/recruit/arrow-light.svg"></span>
									<span class="icon-dark"><img src="<?=get_template_directory_uri()?>/assets/images/recruit/arrow.svg"></span>
									</a></h3>
								</div>
							<?php } } } ?>

							</div>

						  </div>
					   </div>

					</div>
				 </div>
			  </section>

		<?php get_template_part( 'template-parts/content/footer-section' ); ?>
        </main>
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
