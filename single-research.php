<?php
/**
 * The template for displaying all single posts
 *
  *
  */
$rsName = get_the_title();
$rsShortDesc = get_the_excerpt();

$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);


get_header(); ?>

 </header>
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
                              <li><a href="<?=get_page_link(1661);?>">Research</a></li>
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
						<?php if(!empty($section1Title)){ ?> <h3><?=$section1Title;?></h3><?php } ?>
                            <?php echo ($section1Desc)? $section1Desc : '';?>
						<?php if(!empty($section1BtnText)){ ?> <div class="long-btn ml-0">
                            <a href="<?php echo ($section1BtnLink)? $section1BtnLink : '#';?>" class="green-btn"><?=$section1BtnText;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
						</div><?php } ?>
					  </div>
				   </div>
				</div>
			</div>
		  </section><?php //} ?> -->

		 <?php
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
		  <?php
		  $section3Title = get_field('section_3_heading');
		  $section3Desc1 = get_field('section_3_description');
		  $section3Desc2 = get_field('section_3_description_2');
       if(!empty($section3Title) || !empty($section3Desc1) || !empty($section3Desc2)){
		  ?>
         <section class="long-sec safer-space space">
            <div class="container">
               <div class="long-main-box">
                  <div class="row align-items-center">
                     <div class="col-lg-8 col-md-12 mx-auto">
						<div class="heading-pnel line-head m-0">
                        <?php if(!empty($section3Title)){ ?><h2><?=$section3Title;?></h2><?php } ?>
							<?php echo ($section3Desc1)? $section3Desc1 : '';?>
							</div>
                       <?php if(!empty($section3Desc2)){ ?> <div class="D-radius jobDetail-box mt-5 BlackWhite">
                           <?=$section3Desc2;?>
					   </div><?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- section -->
	   <?php } ?>

          <?php get_template_part( 'template-parts/content/footer-section' ); ?>


		 <section class="training-prog-sec space">
         <div class="container">
		 <?php
		  $section4Title = get_field('section_4_heading'); if(!empty($section4Title)){ ?>
		    <div class="row">
               <div class="col-12">
				 <div class="heading-pnel line-head">
					<h2><?=$section4Title;?></h2>
                  </div>
               </div>
		  </div><?php } ?>

			<div class="row">
				<div class="col-12">

					<div class="training-prog-main">
					<?php $rs = new WP_Query(array('post_type' => 'research','post_status' =>'publish','post__not_in' => array ($pageId),'posts_per_page' => 3,'orderby' => 'date','order' => 'ASC'));
					  if ( $rs -> have_posts() ) {

					  while ( $rs -> have_posts() ) { $rs -> the_post();

					  $rsName = get_the_title();
					  $rsShortDesc = get_the_excerpt();

					 ?>
						<div class="training-prog-box">
							<h4><?=$rsName;?></h4>
							<p><?php echo ($rsShortDesc)? $rsShortDesc : '';?></p>
							<a href="<?=get_permalink();?>" class="btn-border">Read More</a>
						</div>
					  <?php } } ?>

					</div>

				</div>
			</div>
			</div>
			</section>

          </div>
      </main>

<?php get_footer();
