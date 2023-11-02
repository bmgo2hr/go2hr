<?php
/**
 * Template Name: Customer-services-training-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

 <!-- header end -->
      <main class="inr-page Training-page detail-training" id="Training-detail">
         <!-- banner -->
		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>


         <!-- Breadcrumb -->
         <section class="Breadcrumb-go2">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="pagination-box">
                        <ul>
                           <li><a href="<?=get_site_url();?>">Home</a></li>
                           <li><a href="<?=get_page_link(348);?>">Training</a></li>
                           <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>

         <div class="page-content">
         <!-- grid -->
         <section class="long-sec space pt-0" >
            <div class="container-fluid p-0">
               <div class="row no-gutters">
			   <?php
					$section1Img = get_field('section_1_image',$pageId);
					$section1Heading = get_field('section_1_heading',$pageId);
					$section1Desc = get_field('section_1_description',$pageId);
					if($section1Img){
					?>
                  <div class="col-lg-6 col-md-6 Img_Outer">
                     <div class="long-img">
                        <img src="<?=$section1Img;?>" alt="" class="w-100" />
                     </div>
			</div><?php } ?>
                  <div class="col-lg-6 col-md-6">
                     <div class="long-content D-radius">
                        <?php if($section1Heading){ ?><h3><?=$section1Heading;?></h3><?php } ?>
                        <?php echo ($section1Desc)? $section1Desc : '';?>
						</div>
                  </div>
               </div>
            </div>
         </section>

		<!-- grid -->
      <section class="WEbinar-video space pt-0" >
         <div class="container">
		 <?php $section2Heading = get_field('section_2_heading',$pageId); if($section2Heading){ ?>
			<div class="row">
				<div class="col-12 mx-auto">
					<div class="heading-pnel">
						<h4 class="green-text mt-4"><?=$section2Heading;?></h4>
					</div>
				</div>
			</div><?php } ?>

			<div class="row">
			<?php if(have_rows('box_data')){
				   $count = count(get_field("box_data"));
					while( have_rows('box_data') ){ the_row();
					  $boxTitle = get_sub_field('box_heading');
					  $boxDesc = get_sub_field('box_description');
				       if(!empty($boxTitle) || !empty($boxDesc)){
					  ?>
					<div class="col-md-4 col-sm-6 col-12 pr-0">
						<div class="value-box benefit-box D-radius">
							<figcaption>
								<?php if(!empty($boxTitle)){ ?><h5 class="check"><?=$boxTitle;?></h5><?php } ?>
								<?php  if(!empty($boxDesc)){ ?><p><?=$boxDesc;?></p><?php } ?>
							</figcaption>
						</div>
				   </div><?php } } } ?>

			</div>
         </div>
      </section>

         <!-- grid -->
         <section class="long-sec double-sec space pt-0" >
            <div class="container">
			<?php
			  $section3MainHeading = get_field('section_3_main_heading',$pageId); if(!empty($section3MainHeading)): ?>
               <div class="row">
                  <div class=" col-12 mx-auto">
                     <div class="heading-pnel line-head">
                        <h2><?=$section3MainHeading;?></h2>
                     </div>
                  </div>
               </div><?php endif; ?>

               <?php get_template_part( 'template-parts/content/training/mental-health-courses' ); ?>

            </div>
         </section>


         <!-- grid -->
         <section class="training-prog-sec T-detail-prog space pt-0" >
            <div class="container">
			<?php
			  $section6Heading = get_field('section_6_heading',$pageId);
			  if(!empty($section6Heading)){
			  ?>
               <div class="row">
                  <div class="col-12">
                     <div class="heading-pnel line-head">
                        <h2><?=$section6Heading;?></h2>
                     </div>
                  </div>
			  </div><?php } ?>

               <?php
                $resources = get_field('section_4_resources');
                 //echo '<pre>'; print_r($resources); echo '</pre>';
               ?>

                <?php if(!empty($resources)) : ?>
                <div class="row">
                  <div class="col-12">
                     <div class="training-prog-main">
                        <?php foreach($resources["resource"] as $resource) :?>
                        <div class="training-prog-box">
                           <?php if($resource["title"]) { ?><h4><?=$resource["title"];?></h4><?php } ?>
                           <?php if($resource["description"]){ ?><p><?=$resource["description"];?></p><?php } ?>

                            <a href="<?php echo $resource["link"]["url"] ?? ""; ?>" target="<?php echo $resource["link"]["target"] ?? "";?>" class="btn-border">Read More</a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                  </div>
               </div>
                <?php endif; ?>
            </div>
         </section>

		 <?php get_template_part( 'template-parts/content/footer-section' ); ?>
         </div>
      </main>


<?php get_footer();
