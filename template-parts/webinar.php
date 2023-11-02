<?php
/**
 * Template Name: Webinar-template
 *
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

<main class="inr-page About-page" id="aboutus">
		
	<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>
		
		
		<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><a href="<?=get_page_link(205);?>">Human Resource</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>
		
		
		
		<!-- grid -->
      <section class="WEbinar-video space" >
         <div class="container">
            <div class="row">
			<?php $aboutText = get_the_content();
			if($aboutText):
			?>
               <div class="col-lg-10 col-12 mx-auto">
				 <div class="heading-pnel line-head text-center">
                   <?php the_content();?>
				   </div>
               </div><?php endif;?>
               
            	</div>	
			<?php $iframe = get_field('video_iframe'); if($iframe): ?>
			<div class="row">
				<div class="col-lg-8 col-12 mx-auto">
					<div class="video-iframe">
					<?=$iframe;?>	
						</div>
				</div>
			</div><?php endif;?>

         </div>
      </section>
		
		
		
				
		<!-- grid -->
      <section class="WEbinar-video space pt-0">
         <div class="container">
            <div class="row">
			<?php $speakerSectionHeading = get_field('speakers_section_heading'); if($speakerSectionHeading):?>
               <div class="col-12">
				 <div class="heading-pnel line-head">
						<h2><?=$speakerSectionHeading;?></h2>
                  </div>
               </div><?php endif;?>
               
            </div>
			
			<!-- box -->
			<?php 
			$speakers = get_post_meta($post->ID, 'featured-speakers', true);
			foreach($speakers as $speaker){
			  $name_and_desig = $speaker['name-designation'];
			  $speakersImg = $speaker['speakers-image'];
			  $speakersDesc = $speaker['speakers-descriptions'];
			?>
			<div class="card-content-box">
				<div class="row">
				<?php
					 if(!empty($speakersImg)){
						$spImg = wp_get_attachment_image_src($speakersImg);						
					  ?>
					<div class="col-lg-4 col-md-4 col-12">
						<figure>
							<img src="<?=$spImg[0];?>" class="w-100" alt="" />
						</figure>
					 </div><?php } ?>
					<div class="col-lg-8 col-md-8 col-12">
						<div class="card-content">
							<?php if($name_and_desig):?><h4 class="mb-3"><?=$name_and_desig;?> </h4><?php endif;?>
							<?php echo ($speakersDesc)? $speakersDesc : '';?></div>
					</div>
				</div>
			</div><?php } ?>
					
			
         </div>
      </section>
			
		
	</main>
      

<?php get_footer();
