<?php
/**
 * Template Name: Strategy-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

//$pid =wp_get_post_parent_id($pageId);
//echo get_the_title($pid);
get_header();?>

<!-- header end -->
      <main class="inr-page Training-page Recruit-page" id="ResearchPage">
         <!-- banner -->
         <<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>

         <!-- Breadcrumb -->
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
         <!-- grid -->

          <div class="page-content">
         <?php get_template_part('template-parts/content/background_and_text');?>

		  <?php
		//   $section1Title = get_field('section_1_heading');
		//   $section1Desc = get_field('section_1_description');
		//   $section1Image = get_field('section_1_image');
		//   if(!empty($section1Image)){
		  ?>
         <!-- <section class="long-sec space pt-0" >
            <div class="container-fluid p-0">
               <div class="row no-gutters">
                  <div class="col-lg-6 col-md-6 Img_Outer">
                     <div class="long-img">
                        <img src="<?=$section1Image;?>" alt="" class="w-100" />
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <div class="long-content D-radius">
                        <?php if(!empty($section1Title)){ ?><h3><?=$section1Title;?></h3> <?php } ?>
                        <?php echo ($section1Desc)? $section1Desc : '';?>
					</div>
                  </div>
               </div>
            </div>
         </section> -->
		  <?php //} ?>
         <!-- grid -->
         <section class="training-prog-sec space pt-0" >
            <div class="container">
			<?php $section2Heading = get_field('section_2_heading'); if(!empty($section2Heading)){ ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel line-head text-center">
                        <h2><?=$section2Heading;?></h2>
                     </div>
                  </div>
			   </div><?php } ?>

               <div class="row justify-content-center">

                 <?php  $temp = array();
			        $rs = new WP_Query(array('post_type' => 'strategy','post_status' =>'publish','posts_per_page' => 4,'orderby' => 'date','order' => 'ASC'));
				  if ( $rs -> have_posts() ) {

				  while ( $rs -> have_posts() ) { $rs -> the_post();

				  $rsName = get_the_title();
				  $rsShortDesc = get_the_excerpt();
				  $temp = get_the_ID();
				 ?>
                  <div class="col-lg-3 col-md-6 col-12">
                     <div class="training-prog-box">
                        <h4><?=$rsName;?></h4>
                        <p><?php echo ($rsShortDesc)? $rsShortDesc : '';?></p>
                        <a href="<?=get_the_permalink();?>" class="btn-border">Learn More</a>
                     </div>
                  </div>
				  <?php } } wp_reset_postdata();?>

               </div>
            </div>
         </section>
         <!-- Research Archive -->
		 <?php
		  $section3Title = get_field('section_3_heading');
		  $section3Desc = get_field('section_3_description');
		  $section3BtnText = get_field('section_3_link_text');
		  $section3BtnLink = get_field('section_3_link_url');
		  if(!empty($section3Title) || !empty($section3Desc)){
		  ?>
         <section class="ResArchive space bg-grey" >
            <div class="container">
               <div class="row">
                  <div class="col-lg-5 col-md-9 col-sm-12 col-12 mx-auto">
                     <div class="heading-pnel line-head text-center m-0">
                        <?php if(!empty($section3Title)){ ?><h2><?=$section3Title;?></h2><?php } ?>
                         <?php echo ($section3Desc)? $section3Desc : '';?>
                         <?php if(!empty($section3BtnText)){ ?> <div class="simple-btn mt-4">
		                    <a href="<?php echo ($section3BtnLink)? $section3BtnLink : '#';?>" class="btn-border blue-border"><?=$section3BtnText;?></a>
                        </div><?php } ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
		  <?php } ?>

        <!-- Related Resources -->
         <section class="training-prog-sec space" >
            <div class="container-fluid">
			<?php $section4Heading = get_field('section_4_heading'); if(!empty($section4Heading)){ ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel line-head">
                        <h2><?=$section4Heading;?></h2>
                     </div>
                  </div>
               </div><?php } ?>

               <div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">

                   <?php
				   if(have_rows('related_resource')){
					while( have_rows('related_resource') ){ the_row();

					  $name = get_sub_field('resource_title');
					  $shortDesc = get_sub_field('resource_description');
					  $btntext = get_sub_field('resource_button_text');
					  $btntLink = get_sub_field('resource_button_link');

					  if(!empty($name) || !empty($shortDesc)){
					 ?>
                        <div class="training-prog-box">
                           <?php if(!empty($name)){ ?><h4><?=$name;?></h4><?php } ?>
                           <p><?php echo ($shortDesc)? $shortDesc : '';?></p>
                           <?php if(!empty($btntext)){ ?><a href="<?php echo ($btntLink)? $btntLink : '#';?>" class="btn-border" target="_blank"><?=$btntext;?></a><?php } ?>
                        </div>
				   <?php } } } ?>

                     </div>
                  </div>
               </div>
            </div>
         </section>


      <!-- Related Resources -->


         <section class="blue-strip ResStrip bg-blue">
            <div class="container">
               <div class="row justify-content-between">

                  <?php
			   if(have_rows('section_5_rows')){
				while( have_rows('section_5_rows') ){ the_row();

				  $rowName = get_sub_field('row_name');
				  $rowDesc = get_sub_field('row_description');
				  $rowBtntext = get_sub_field('row_button_text');
				  $rowBtntLink = get_sub_field('row_button_link');

				  if(!empty($rowName) || !empty($rowDesc)){
				?>
                  <div class="col-lg-6 col-md-6 col-12">
                     <div class="heading-pnel fff text-center m-0">
                       <?php if($rowName){ ?> <h2><?=$rowName;?></h2><?php } ?>
                        <?php echo ($rowDesc)? $rowDesc : '';?>
                       <?php if($rowBtntext){ ?> <a href="<?php echo ($rowBtntLink)? $rowBtntLink : '#';?>" class="green-btn"><?=$rowBtntext;?> <i class="fa fa-angle-right" aria-hidden="true"></i></a><?php } ?>
                     </div>
                  </div>
			   <?php } } } ?>

               </div>
            </div>
         </section>
         </div>
      </main>


<?php get_footer();
