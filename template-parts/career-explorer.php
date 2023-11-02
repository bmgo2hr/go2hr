<?php
/**
 * Template Name: Career-Explorer-template
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
                        <li><span>For Workers</span></li>
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

			<!-- grid Section 3 -->
      <section class="popularjob_sec space bg-grey" >
         <div class="container">
		 <?php
		 $section3Heading = get_field('section_3_heading'); if(!empty($section3Heading)){ ?>
            <div class="row">
               <div class="col-12 mx-auto">
				 <div class="heading-pnel text-center">
					<h2><?=$section3Heading;?></h2>

                  </div>
               </div>
		 </div><?php } ?>

             <?php
//             if(have_rows('accordians_tab')) {
//                while( have_rows('accordians_tab') ){
//                    the_row();
//                    $most_popular = get_sub_field('most_popular');
//                    echo "<pre>";
//                    print_r($most_popular);
//                }
//                exit;
//             }

             ?>


			<div class="popularjob-main">
				<div>
                <!-- TODO: refactor the code, this is temporal -->
				<?php if(have_rows('accordians_tab')) {
						$tmp = 0;
						while( have_rows('accordians_tab') ){
							the_row();

							if ($tmp == 0) {
							    echo '<div class="popular_content'.$tmp.' is_open">';

							} else {
								echo '<div class="popular_content'.$tmp.' d-none">';
							}
							echo "<div class='row'>";
							$tmp++;

							$most_popular = get_sub_field('most_popular');
							$taxonomy_id = get_sub_field('career_sector')[0];


							foreach ($most_popular as $one_popular) {

								$pjobIcon = get_the_post_thumbnail_url($one_popular->ID);
								$pjobTitle = $one_popular->post_title;
								$pjobLink = "/career-explorer/" . $one_popular->post_name; ?>
								<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-5">
									<div class="pularjob-box">
									<?php if(!empty($pjobIcon)){ ?>
										<figure>
											<a href="<?php echo ($pjobLink)? $pjobLink : '#';?>"><img src="<?=$pjobIcon;?>" class="" alt="" /></a>
										</figure>
									<?php } ?>
									<?php if(!empty($pjobTitle)){ ?>
									<a href="<?php echo ($pjobLink)? $pjobLink : '#';?>"><h4><?=$pjobTitle;?></h4></a>
									<?php } ?>
								</div>

							</div> <?php }
							echo "</div>"; ?>


                            <div>
                            <?php
                                echo "<div class='row' id='more_popular".$tmp."' style='display: none;'>"; ?>

									<!-- All Alphabetical -->
									<div class="col-12 mx-auto">
										<div class="heading-pnel text-center">
											<h2>All Alphabetical</h2>

										</div>
									</div>

								<?php
                                $tax_query = array(
                                    array(
                                            'taxonomy' => 'career_s_sector',
                                            'terms' => $taxonomy_id

                                    )
                                );

                                $allpopulars = new WP_Query(array('post_type' => 'go2hr_careersummary', 'tax_query' => $tax_query, 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC','orderby' => 'title' ));
                                $idx = 0;
                                $total = $allpopulars->post_count;
                                $lastLineIdx = ceil($total / 4) - 1;
                                while ($allpopulars -> have_posts()) {
                                    $allpopulars->the_post();

                                    $pjobIcon = get_the_post_thumbnail_url();
								    $pjobTitle = get_the_title();
//								    $pjobLink = ;


//                                    if ($idx % 4 == 0 && $lastLineIdx == $idx / 4 ) {
//                                        echo "<div class='d-flex justify-content-start mb-5' style='gap: 20px;'>";
//                                    } else if ($idx % 4 == 0) {
//                                        echo "<div class='d-flex justify-content-start mb-5' style='gap: 20px;'>";
//                                    }
                                    ?>

                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-5">

	    								<div class="pularjob-box">
                                            <figure>

											    <a href="<?php the_permalink();?>"><img src="<?=$pjobIcon;?>" class="" alt="" /></a>
										    </figure>
                                            <a href="<?php the_permalink();?>"><h4><?=$pjobTitle;?></h4></a>
                                        </div>
                                    </div>
                                    <?php
                                    if ($idx % 4 == 3) {
//                                        echo "</div>";
                                    }
                                    $idx++;
                                }
                                wp_reset_query();
                                echo "<div>";
                            ?>
                            </div>
						<?php echo "</div></div>";?>
                            <div class="row">
						        <div class="col-12">
							        <div class="ViewAll-row text-center" data-idx="<?php echo $tmp; ?>">
								        <a href="#" class="btn-border"><i class="fa fa-caret-down" aria-hidden="true"></i><?php echo get_sub_field("view_all_button"); ?></a>
    				    			</div>
	    		    			</div>
                            </div></div>
						<?php } } ?>
				</div>
			</div>

         </div>
      </section>


	<!-- grid Section 4 -->
      <section class="training-prog-sec space" >
         <div class="container">
		  <?php
		 $section4Heading = get_field('section_4_heading'); if(!empty($section4Heading)){ ?>
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
					<?php get_template_part( 'template-parts/content/cor/sb-resources1' ); ?>

					</div>
					</div>
					</div>

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
