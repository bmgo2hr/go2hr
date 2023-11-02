<?php
/**
 * The template for displaying all single posts
 */

$strName = get_the_title();
$strShortDesc = get_the_excerpt();
//$strImg = get_the_post_thumbnail_url();

$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header(); ?>

<!-- header end -->
      <main class="inr-page Training-page Recruit-page" id="ResearchLabour">

		<!-- banner -->
		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-12 mx-auto">
                     <div class="sharejob-main">
                        <div class="pagination-box">
                           <ul>
                              <li><a href="<?=get_page_link(8);?>">Home</a></li>
                              <li><a href="<?=get_page_link(5122);?>">Strategy</a></li>
                              <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

          <div class="page-content">
		 <?php get_template_part('template-parts/content/background_and_text');?>


		 <?php
		//   $section1Title = get_field('section_1_heading');
		//   $section1Desc = get_field('section_1_description');
		//   $section1Image = get_field('section_1_image');

		//   $section1BtnText = get_field('section_1_button_text');
		//   $section1BtnLink = get_field('section_1_button_link');

		//   if(!empty($section1Image)){
		  ?>
		<!-- <section class="long-sec safety-basic-long">
			<div class="container-fluid p-0">
				<div class="row no-gutters">
					<div class="col-lg-6 col-md-6 Img_Outer">
					  <div class="long-img">
						 <img src="<?=$section1Image;?>" alt="" class="w-100">
					  </div>
				   </div>
				   <div class="col-lg-6 col-md-6">
					  <div class="long-content D-radius">
						 <?php if(!empty($section1Title)){ ?><h3><?=$section1Title;?></h3><?php } ?>
						 <?php echo ($section1Desc)? $section1Desc : '';?>
						<?php if(!empty($section1BtnText)){ ?> <div class="long-btn ml-0">
                            <a href="<?php echo ($section1BtnLink)? $section1BtnLink : '#';?>" class="green-btn"><?=$section1BtnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
						</div><?php } ?>
					  </div>
				   </div>
				</div>
			</div>
		</section> -->
		  <?php //}
		  $section2Title = get_field('section_2_heading');
		  $section2Desc = get_field('section_2_description');
          if(!empty($section2Title) || !empty($section2Desc)){
		 ?>
		<section class="WEbinar-video space pb-0">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-lg-8 col-md-8 col-12 mx-auto">
                     <div class="heading-pnel line-head m-0">
                        <?php if(!empty($section2Title)){ ?><h2><?=$section2Title;?></h2><?php } ?>
						<?php echo ($section2Desc)? $section2Desc : '';?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
		  <?php } ?>
         <!-- section -->
         <section class="long-sec safer-space space">
		 <?php
		  $section3Title = get_field('section_3_heading');
		  $section3Desc = get_field('section_3_description');
          if(!empty($section3Title) || !empty($section3Desc)){
		 ?>
            <div class="container">
               <div class="long-main-box">
                  <div class="row align-items-center">
                     <div class="col-lg-8 col-md-12 mx-auto">
						<div class="heading-pnel line-head m-0">
                        <?php if(!empty($section3Title)){ ?><h2><?=$section3Title;?></h2><?php } ?>
                        <?php echo ($section3Desc)? $section3Desc : '#';?>
						</div>
                     </div>
                  </div>
               </div>
		  </div><?php } ?>

			 <div class="container">
				<div class="row">
					<div class="col-lg-10 mx-auto">
						<div id="FrameWork" class="owl-carousel">
						<?php
						   if(have_rows('labour_box')){
							while( have_rows('labour_box') ){ the_row();
							  $boxNo = get_sub_field('box_number');
							  $boxTitle = get_sub_field('box_title');
							  $boxDesc = get_sub_field('box_description');
							  if(!empty($boxTitle) || !empty($boxDesc)){
						   ?>
							<div class="item">
								<div class="LbourBox">
									<div class="lbor-box-front">
										<?php if(!empty($boxNo)){ ?><h2><?=$boxNo;?></h2><?php } ?>
										<?php if(!empty($boxTitle)){ ?><h3><?=$boxTitle;?></h3><?php } ?>
									</div>
									<?php if(!empty($boxDesc)){ ?><div class="hover-state">
										<?=$boxDesc;?>
									</div><?php } ?>
								</div>
							</div>
						   <?php } } } ?>

						</div>
					</div>
				</div>
			 </div>

         </section>
         <!-- section -->

	  <section class="RecoveryFAQ space pt-0">
        <div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12 mx-auto">
				 <?php
					  $section4Title = get_field('section_4_heading');
					  $section4Desc = get_field('section_4_description');
					  if(!empty($section4Title) || !empty($section4Desc)){
					 ?>
				  <div class="heading-pnel line-head">
                        <?php if(!empty($section4Title)){ ?><h2><?=$section4Title;?></h2><?php } ?>
						<?php echo ($section4Desc)? $section4Desc : '';?>
					  </div><?php } ?>
					 <!-- FAQ -->
					<div id="accordion">
					<?php
					   if(have_rows('labour_recovery')){ $flg = 0;
						while( have_rows('labour_recovery') ){ the_row();
						  $recoveryNo = get_sub_field('recovery_number');
						  $recoveryTitle = get_sub_field('recovery_name');
						  $recoveryDesc = get_sub_field('recovery_data');
						  if(!empty($recoveryTitle) || !empty($recoveryDesc)){ $flg++;
					   ?>
					  <div class="card">
						<?php if(!empty($recoveryTitle)){ ?><div class="card-header">
						  <a class="<?php echo ($flg == 1)? '' :'collapsed';?> card-link accordion-title" data-toggle="collapse" href="#collapse<?=$flg;?>"><span><?php echo ($recoveryNo)? $recoveryNo : '';?></span> <?=$recoveryTitle;?></a>
						</div><?php } ?>
						<div id="collapse<?=$flg;?>" class="collapse <?php echo ($flg == 1)? 'show' :'';?>" data-parent="#accordion">
						  <div class="card-body">
								<?php echo ($recoveryDesc)? $recoveryDesc : '';?>
						  </div>
						</div>
					  </div>
					   <?php } } } ?>

					</div>

				</div>
			</div>
		</div>
	  </section>


         <?php get_template_part( 'template-parts/content/footer-section' ); ?>


		 <section class="training-prog-sec space">
         <div class="container">
		 <?php
		  $section5Title = get_field('section_5_heading'); if(!empty($section5Title)){ ?>
		   <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head">
					<h2><?=$section5Title;?></h2>
                  </div>
               </div>
		  </div><?php } ?>


			<div class="row">
				<div class="col-12">

					<div class="training-prog-main">
					<?php $str = new WP_Query(array('post_type' => 'strategy','post_status' =>'publish','post__not_in' => array ($pageId),'posts_per_page' => 3,'orderby' => 'date','order' => 'ASC'));
					  if ( $str -> have_posts() ) {
						 while ( $str -> have_posts() ) { $str -> the_post();

					  $strName = get_the_title();
					  $strShortDesc = get_the_excerpt();

					 ?>
						<div class="training-prog-box">
							<h4><?=$strName;?></h4>
							<p><?php echo ($strShortDesc)? $strShortDesc : '';?></p>
							<a href="<?=get_the_permalink();?>" class="btn-border">Read More</a>
						</div>
					  <?php } } wp_reset_postdata();?>

					</div>

				</div>
			</div>
			</div>
			</section>
          </div>
      </main>

<?php get_footer();
