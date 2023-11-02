<?php
/**
 * Template Name: Partnership-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

  <main class="inr-page Training-page bg-grey" id="Partnership">
		
		
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
                        <li><a href="#">About Us</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>

         <!-- section -->
         <section class="partnership-sec space">
            <div class="container">
			<?php $content = get_the_content(); if(!empty($content)){ ?>
               <div class="row">
                  <div class="col-lg-8 col-12 mx-auto">
                     <div class="heading-pnel text-center">
                        <?php the_content();?>
						</div>
                  </div>
			   </div><?php } ?>
			   
                     <div class="row justify-content-center">
					 <?php if(have_rows('partnership_box')){
							while( have_rows('partnership_box') ){ the_row();
							
							  $partnerLogo = get_sub_field('partner_logo');
							  $partnerName = get_sub_field('partner_name');
							  $partnerDesc = get_sub_field('partner_description');
							  							  
							  $partnerBtnText = get_sub_field('partner_button_text');
							  $partnerBtnLink = get_sub_field('partner_button_link');
							  ?>
							<div class="col-lg-4 col-md-6 col-12">
							   <div class="partnership-box">
								  <?php if(!empty($partnerLogo)){ ?><figure>
									 <a href="<?php echo ($partnerBtnLink)? $partnerBtnLink : '#';?>"><img src="<?=$partnerLogo;?>" class="" alt="" /></a>
								  </figure><?php } ?>
								  <figcaption>
									 <?php if(!empty($partnerName)){ ?><a href="<?php echo ($partnerBtnLink)? $partnerBtnLink : '#';?>"><h4><?=$partnerName;?></h4></a><?php } ?>
									 <?php echo ($partnerDesc)? $partnerDesc : '';?>
									 <?php if(!empty($partnerBtnText)){ ?><a href="<?php echo ($partnerBtnLink)? $partnerBtnLink : '#';?>" class="btn-border"><?=$partnerBtnText;?></a><?php } ?>
								  </figcaption>
							   </div>
						   </div>
						   <?php } } ?>
					
                     </div>
				</div>
         </section>

      </main>



<?php get_footer();
