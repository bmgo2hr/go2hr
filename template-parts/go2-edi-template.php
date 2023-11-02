<?php
/**
 * Template Name: Go2-EDI-template
  */
$pageId = get_the_ID();
$pageHeading = get_field('page_heading',$pageId);

get_header();?>



 <div class="inr-page Training-page" id="Recruit">


		<?php get_template_part( 'template-parts/content/inner-page-banner' ); ?>


		<!-- Breadcrumb -->
		<section class="Breadcrumb-go2">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <div class="pagination-box">
                     <ul>
                        <li><a href="<?=get_site_url();?>">Home</a></li>
                        <li><a href="<?=get_page_link(205);?>">Human Resources</a></li>
                        <li><span><?php echo ($pageHeading)? $pageHeading : get_the_title();?></span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </section>

		<!-- grid Page Top Content-->
		<?php $pageContent = get_the_content(); if(!empty($pageContent)){ ?>
      <div class="page-content">
      <section class="WEbinar-video space" >
         <div class="container">
            <div class="row">
               <div class="col-lg-10 col-12 mx-auto">
				 <div class="heading-pnel line-head text-center  mb-0">
					<?php the_content();?>
					</div>
               </div>
            </div>
         </div>
		</section><?php } ?>

<!-- grid  Section 1-->
      <section class="Career_job space pt-0">
         <div class="container">
		 <?php
		 $section1Heading = get_field('section1_heading');
		 $section1Desc = get_field('section1_description');
		 if(!empty($section1Heading) || !empty($section1Desc)){
		 ?>
            <div class="row">
               <div class="col-lg-10 col-12 mx-auto">
				 <div class="heading-pnel line-head text-center">
					<?php if(!empty($section1Heading)){ ?><h2><?=$section1Heading;?></h2><?php } ?>
                    <?php if(!empty($section1Desc)){ ?><p><?=$section1Desc;?></p><?php } ?>
                  </div>
               </div>
		 </div><?php } ?>


			<div class="Career_main">
				<div class="row no-gutters">
				<?php if(have_rows('career_job')) $count = 0;{
				        while( have_rows('career_job') ){ the_row(); $count++;

					      $jobIcon = get_sub_field('job_box_icon');
						  $jobTitle = get_sub_field('job_box_name');
						  $jobTitleColor = get_sub_field('job_box_name_color');
						  $jobColor = get_sub_field('job_box_color');
				    ?>

					<div class="col " data-toggle="modal" data-target="#exampleModalCenter<?=$count;?>">
						<div class="CareerJob_Box" style="border-color:<?=$jobColor;?>">
							<?php if(!empty($jobIcon)){ ?>
								<figure>
									<?php $url_icon = $jobIcon['url'];
									$ext = pathinfo( $url_icon, PATHINFO_EXTENSION );
									?>
									<?php
									if ( $ext == 'svg' ):
										echo file_get_contents( $url_icon ) ;
										// Non SVG Fallback
										else: ?>
										<img src="<?php echo $url_icon; ?>" alt="<?php echo $alt; ?>"> <?php
									endif; ?>

								</figure>
							<?php } ?>
							<?php if(!empty($jobTitle)){ ?><p><?=$jobTitle;?><span style="color:<?=$jobColor;?>"><?=$jobTitleColor?></span></p><?php } ?>
						</div>
					</div>


					<?php if( have_rows('popup_career_explorer') ): ?>
					<?php while( have_rows('popup_career_explorer') ): the_row();

						// Get sub field values.
						$background = get_sub_field('background');
						$title = get_sub_field('title');
						$description = get_sub_field('description');

						?>

						<!-- Modal -->
							<div class="modal fade" id="exampleModalCenter<?=$count;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
								<div class="modal-dialog modal-dialog-career modal-dialog-centered" role="document">
									<div class="modal-content">

									<div class="modal-header" <?php if(!empty($background)): ?> style="background: url(<?php echo esc_url($background['url']); ?>)" <?php endif; ?>>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>

										<div class="modal-body">
											<div class="px-5 pt-5">
												<?php if(!empty($title)):?>
													<h4 class="mb-5"><?=$title?></h4>
												<?php endif;?>

												<?php if(!empty($title)):?>
													<?=$description ?>
												<?php endif;?>

												<!-- <div class="mb-4">
													<h5>Where you can work</h5>
													<p>Adventure Tour Operators, Airports & Airlines, Luxury Travel Specialists, Tour Operators, Tour Wholesalers</p>
												</div>

												<div class="mb-4">
													<h5>Sample Positions in this Sector</h5>
													<p>Air Traffic Controller, Ecotour Planner, Flight Attendant, Incentive Travel Specialist, Luxury Travel Designer, Pilot, Sales and Marketing Coordinator, Tour Promotions Manager, Travel Counsellor</p>
												</div> -->

											</div>
										</div>

										<?php if(!empty($jobTitle)){ ?>
											<div class="modal-footer" style="background:<?=$jobColor;?>;">
												<div class="px-5 py-2">
													<h3 class="text-white"><?=$jobTitle;?><?=$jobTitleColor;?></h3>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>

							<?php wp_reset_postdata();?>
						<?php endwhile; ?>
					<?php endif; ?>
					<?php wp_reset_query();?>
					<?php wp_reset_postdata();?>
				<?php } } ?>

				<?php wp_reset_query();?>

				</div>
			</div>





         </div>
      </section>

<!-- grid  Section 2-->
	<section class="CanHelp-sec Explore-Career space pt-0">
         <div class="container">
		 <?php
		 $section2Heading = get_field('section_2_heading'); if(!empty($section2Heading)){ ?>
            <div class="row">
               <div class="col-lg-6 col-12">
                  <div class="heading-pnel line-head">
                     <h2><?=$section2Heading;?></h2>
                  </div>
               </div>
		    </div><?php } ?>

			<?php get_template_part( 'template-parts/content/common-accordian' ); ?>
         </div>
      </section>

		<!-- grid Section 5 -->
		<div class="long-main-box">
                  <div class="container">
				<?php
				 $section5Heading = get_field('section_5_heading');
				 $section5Desc = get_field('section_5_description');
				 $section5Img = get_field('section_5_image');
				 $section5btnName = get_field('section_5_button_name');
				 $section5btnLink = get_field('section_5_button_link');
				 ?>
                  <div class="row no-gutters align-items-center">

                     <div class="col-lg-6 col-md-6 col-12">
                        <div class="simple-content">
                           <div class="double-side">
                              <div class="simple-content">
                                 <?php if(!empty($section5Heading)){ ?><h3><?=$section5Heading;?></h3><?php } ?>
                                 <?php echo !empty($section5Desc)? $section5Desc : '';?>
                                <?php if(!empty($section5btnName)){ ?> <div class="simple-btn mt-5">
                                    <a href="<?php echo !empty($section5btnLink)? $section5btnLink : '#';?>" class="btn-border blue-border"><?=$section5btnName;?></a>
								</div><?php } ?>
                              </div>

                           </div>
                        </div>
                     </div>

					 <?php if(!empty($section5Img)){ ?> <div class="col-lg-6 col-md-6 col-12 Img_Outer">
                        <div class="long-img">
                           <img src="<?=$section5Img;?>" alt="" class="w-100">
                        </div>
                     </div><?php } ?>


                  </div>
               </div>
               </div>

		<?php get_template_part( 'template-parts/content/footer-section' ); ?>
        </div>

	</main>

<?php get_footer(); ?>
<script src="<?=get_template_directory_uri();?>/assets/js/career-explore.js"></script>
