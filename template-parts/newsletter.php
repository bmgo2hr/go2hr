<?php
/**
 * Template Name: Newsletter-template
 *
 */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>

  <main class="inr-page Training-page" id="Newsletters">
		
		<section class="Newsletter-sec space">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-md-10 col-12 mx-auto">
						
						<div class="newsletter-box">
						<?php $content = get_the_content(); if(!empty($content)){ ?>
							<div class="heading-pnel line-head">
								<?php the_content();?>
						</div><?php } ?>
					    <?php echo do_shortcode('[contact-form-7 id="1341" title="Newsletter Form"]   ');?>
							
						</div>
					</div>
				</div>
			</div>
		</section>
	 	  
	  </main>
	  


<?php get_footer();
