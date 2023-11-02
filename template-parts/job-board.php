<?php
/**
 * Template Name: Job-board-template
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);
$PageBanner = get_field('banner_image',$pageId);


get_header();?>

<!-- header end -->
      <main class="inr-page Training-page Recruit-page" id="Recruit">
	  
         <!-- banner -->
		 <?php if($PageBanner):?>
         <section class="jobBig-image">
            <div class="container" style="position:relative;">
				<div class="BigImage-main">
					<img src="<?=$PageBanner?>" class="w-100" alt="" />
				</div>
				<div class="big-imgTitle">
					<div class="row">
					  <div class="col-lg-8 col-12 mx-auto">
						 <div class="">
							<h2><?php echo ($pageHeading)? $pageHeading : get_the_title();?></h2>
						 </div>
					  </div>
				  </div>
				</div> 
            </div>
         </section><?php endif;?>

		 
         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-8 col-md-8 col-12 mx-auto">
                     <div class="sharejob-main">
                        <div class="pagination-box">
                           <ul>
                              <li><a href="<?=get_site_url();?>">Home</a></li>
                              <li><a href="#">For Workers</a></li>
                              <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                           </ul>
                        </div>
                        <div class="share-job">
                           <ul>
                              <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                              <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                              <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                              <li><a href="#"><i class="fa fa-link" aria-hidden="true"></i></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- section -->
         
        <?php 
			$jobSections = get_field('page_sections');
			 if($jobSections){ 
			   foreach($jobSections as $jobSection){
				echo $jobSection['job_sections'];
			} } ?>
         
        <?php get_template_part( 'template-parts/content/footer-section' ); ?>
      </main>

<?php get_footer();
